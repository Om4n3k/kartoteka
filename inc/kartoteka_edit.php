<?php
session_start();
define("MYSQL_QUERY_ERROR", 1);
define("MYSQL_CONNECTION_ERROR", 2);
define("USER_NOT_LOGGED_IN", 3);
define("NO_PERMISSION", 4);
define("BAD_NAMES",5);
define("NO_IMAGES_UPLOADED",6);
define("BAD_EXTENSIONS",7);
try {
	require_once("../config.php");
	require_once("classes/user.class.php");
	require_once("classes/core.class.php");
	$db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
	if($db->connect_errno) throw new Exception(MYSQL_CONNECTION_ERROR);
	$user = new User(0,$_SESSION['id']);
	$core = new Core();
	if($user->loginError) throw new Exception(USER_NOT_LOGGED_IN);
	if($user->level<$config['permissions']['editKartoteka']) throw new Exception(NO_PERMISSION);
	
	$date = htmlentities($_POST['k_time'],ENT_QUOTES,'utf-8');
	$money = htmlentities($_POST['k_money'],ENT_QUOTES,'utf-8');
	$reason = htmlentities($_POST['k_reason'],ENT_QUOTES,'utf-8');
	$id = htmlentities($_POST['k_id'],ENT_QUOTES,'utf-8');

	$result['result']=true;

	$sql = "UPDATE `lspd_kartoteka` SET `months`='$date', `money`='$money', `powod`='$reason' WHERE `id`='$id'";
	if($db->query($sql)) {
		if($db->affected_rows) echo json_encode($result);
		else throw new Exception(MYSQL_QUERY_ERROR);
	} else throw new Exception(MYSQL_QUERY_ERROR);

} catch(Exception $e) {
	switch($e->getMessage()) {
		case MYSQL_CONNECTION_ERROR:
			$row=['result'=>false,'reason'=>'Brak połączenia z bazą danych'];
		break;
		case MYSQL_QUERY_ERROR:
			$row=['result'=>false,'reason'=>'Błąd w zapytaniu MySQL','query'=>$sql];
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
		default:
			$row=['result'=>false,'reason'=>'Nieokreślony błąd'];
		break;
	}
	echo json_encode($row);
}