<?php
session_start();
define("MYSQL_QUERY_ERROR", 1);
define("MYSQL_CONNECTION_ERROR", 2);
define("USER_NOT_LOGGED_IN", 3);
define("NO_PERMISSION", 4);
define("EMPTY_VALUE",5);
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
	if($user->level<$config['permissions']['reportAdd']) throw new Exception(NO_PERMISSION);
	$text = htmlentities($_POST['r_text'],ENT_QUOTES,'utf-8');
    if(empty($text)) throw new Exception(EMPTY_VALUE);
    
    $time = time();

	$sql = "INSERT INTO `lspd_reports`(`policeman_id`, `text`, `date`) VALUES ('{$user->id}', '$text', '$time')";
	if($db->query($sql)) {
		echo json_encode(['result'=>true]);
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
		case EMPTY_VALUE:
			$row=['result'=>false,'reason'=>'Nie wypełniono raportu'];
		break;
		default:
			$row=['result'=>false,'reason'=>'Nieokreślony błąd'];
		break;
	}
	echo json_encode($row);
}