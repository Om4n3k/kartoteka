<?php
session_start();
define("MYSQL_QUERY_ERROR", 1);
define("MYSQL_CONNECTION_ERROR", 2);
define("USER_NOT_LOGGED_IN", 3);
define("NO_PERMISSION", 4);
define("BAD_NAMES",5);
define("NO_IMAGES_UPLOADED",6);
define("BAD_EXTENSIONS",7);
define("BAD_CALCULATE",8);
try {
	require_once("../config.php");
	require_once("classes/user.class.php");
	require_once("classes/core.class.php");
	$db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
	if($db->connect_errno) throw new Exception(MYSQL_CONNECTION_ERROR);
	$user = new User(0,$_SESSION['id']);
	$core = new Core();
	if($user->loginError) throw new Exception(USER_NOT_LOGGED_IN);
	if($user->level<$config['permissions']['addKartoteka']) throw new Exception(NO_PERMISSION);
	
	$name = htmlentities($_POST['k_name'],ENT_QUOTES,'utf-8');
	$surname = htmlentities($_POST['k_surname'],ENT_QUOTES,'utf-8');
	if(is_numeric($name)||is_numeric($surname)) throw new Exception(BAD_NAMES);
	$months = htmlentities($_POST['k_months'],ENT_QUOTES,'utf-8');
	$money = htmlentities($_POST['k_money'],ENT_QUOTES,'utf-8');
	if(!is_numeric($months)||!is_numeric($money)) throw new Exception(BAD_CALCULATE);
	$reason = htmlentities($_POST['k_reason'],ENT_QUOTES,'utf-8');
	if(empty($_FILES)) {
		print_r($_FILES);
		throw new Exception(NO_IMAGES_UPLOADED);
	}

	if(!$pid = $core->doesPederastianExist($name, $surname)){
		$db->query("INSERT INTO `lspd_pederastians` (`name`,`surname`) VALUES ('$name','$surname')");
		$pid = $db->insert_id;
	}

	//image
	$img = $_FILES['k_driver']['name'];
	$tmp = $_FILES['k_driver']['tmp_name'];

	$img2 = $_FILES['k_photo']['name'];
	$tmp2 = $_FILES['k_photo']['tmp_name'];
	
	// get uploaded file's extension
	
	$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
	$ext2 = strtolower(pathinfo($img2, PATHINFO_EXTENSION));
	
	// can upload same image using rand function
	
	$final_image = md5($pid) .'.'.$ext;
	$final_image2 = md5($pid) .'.'.$ext2;
	
	// check's valid format
	
	if(!in_array($ext, $config['upload']['extensions'])||!in_array($ext2, $config['upload']['extensions'])) throw new Exception(BAD_EXTENSIONS);
	
	$path_dl = '../'.$config['upload']['driverLicensePath'].strtolower($final_image);
	$path_p = '../'.$config['upload']['photosPath'].strtolower($final_image2);

	$upload_errors = 0;
	//
	if(move_uploaded_file($tmp, $path_dl))
	{
		$path_dl = substr($path_dl, 3);
		$result['driver_license'] = "$path_dl";
	} else {
		$result['driver_license'] = false;
		$result['dl_reason'] = "Nie udało się przenieść zdjęcia prawa jazdy";
		$upload_errors++;
	}

	if(move_uploaded_file($tmp2, $path_p))
	{
		$path_p = substr($path_p, 3);
		$result['photo'] = "$path_p";
	} else {
		$result['photo'] = false;
		$result['p_reason'] = "Nie udało się przenieść zdjęcia obywatela";
		$upload_errors++;
	}

	if(!$upload_errors) {
		$db->query("UPDATE `lspd_pederastians` SET `dl_path`='$path_dl', `p_path`='$path_p' WHERE `id`='$pid'");
		($db->affected_rows >=0) ? $result['update']=true : $result['update']=false;
	} else {$result['update']=false;}

	$result['result']=true;

	$time=time();

	$sql = "INSERT INTO `lspd_kartoteka`(`pid`, `powod`, `data`, `admin`, `months`, `money`) VALUES ('$pid', '$reason', '$time', '{$user->id}', '$months', '$money')";
	if($db->query($sql)) {
		echo json_encode($result);
	} else throw new Exception(MYSQL_QUERY_ERROR);

} catch(Exception $e) {
	switch($e->getMessage()) {
		case MYSQL_CONNECTION_ERROR:
			$row=['result'=>false,'reason'=>'Brak połączenia z bazą danych'];
		break;
		case MYSQL_QUERY_ERROR:
			$row=['result'=>false,'reason'=>'Błąd w zapytaniu MySQL'];
		break;
		case USER_NOT_LOGGED_IN:
			$row=['result'=>false,'reason'=>'Nie jesteś zalogowany'];
		break;
		case NO_PERMISSION:
			$row=['result'=>false,'reason'=>'Nie masz prawa by to wykonać'];
		break;
		case BAD_NAMES:
			$row=['result'=>false,'reason'=>'Niepoprawne imię i/lub nazwisko'];
		break;
		case NO_IMAGES_UPLOADED:
			$row=['result'=>false,'reason'=>'Nie wgrano zdjęć prawa jazdy i/lub obywatela'];
		break;
		case BAD_EXTENSIONS:
			$row=['result'=>false,'reason'=>'Niepoprawny format zdjęć (dozwolone: jpg, jpeg, png, gif)'];
		break;
		case BAD_CALCULATE:
			$row=['result'=>false,'reason'=>'Niepoprawny wynik w kalkulatorze przestępstw'];
		break;
		default:
			$row=['result'=>false,'reason'=>'Nieokreślony błąd'];
		break;
	}
	echo json_encode($row);
}