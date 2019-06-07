<?php
session_start();
define("MYSQL_QUERY_ERROR", 1);
define("MYSQL_CONNECTION_ERROR", 2);
define("USER_NOT_LOGGED_IN", 3);
define("NO_PERMISSION", 4);
try {
	require_once("../config.php");
	require_once("classes/user.class.php");
	require_once("classes/core.class.php");
	$db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
	if($db->connect_errno) throw new Exception(MYSQL_CONNECTION_ERROR);
	$user = new User(0,$_SESSION['id']);
	if($user->loginError) throw new Exception(USER_NOT_LOGGED_IN);
	if($user->level<$config['permissions']['archivKartoteka']) throw new Exception(NO_PERMISSION);

	$id = htmlentities($_POST['id'],ENT_QUOTES,'utf-8');

	$sql = "UPDATE `lspd_kartoteka` SET `archiv`='1' WHERE `id`='$id'";
	if($db->query($sql)) {
		echo json_encode(['result'=>true, 'reason'=>'Poprawnie zarchiwizowano wpis']);
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
		default:
			$row=['result'=>false,'reason'=>'Nieokreślony błąd'];
		break;
	}
	echo json_encode($row);
}