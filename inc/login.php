<?php
session_start();
define("MYSQL_QUERY_ERROR", 1);
define("MYSQL_CONNECTION_ERROR", 2);
define("USER_NOT_FOUND", 3);
try {
	require_once("../config.php");
	require_once("classes/user.class.php");
	require_once("classes/core.class.php");
	$db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
	if($db->connect_errno) throw new Exception(MYSQL_CONNECTION_ERROR);

	$login = htmlentities($_POST['login'],ENT_QUOTES,'utf-8');
	$password = htmlentities($_POST['password'],ENT_QUOTES,'utf-8');

	$core = new Core();

	$user = new User(1,$login,$core->hashPassword($password));
	if($user->loginError) {
		switch($user->loginError) {
		case 1:
			throw new Exception(USER_NOT_FOUND);
			break;
		
		case 2:
			throw new Exception(MYSQL_QUERY_ERROR);
			break;

		default:
			throw new Exception();
			break;
		}
	} else {
		echo json_encode(['result'=>true]);
	}
} catch(Exception $e) {
	switch($e->getMessage()) {
		case MYSQL_CONNECTION_ERROR:
			$row=['result'=>false,'reason'=>'Brak połączenia z bazą danych'];
		break;
		case MYSQL_QUERY_ERROR:
			$row=['result'=>false,'reason'=>'Błąd w zapytaniu MySQL'];
		break;
		case USER_NOT_FOUND:
			$row=['result'=>false,'reason'=>'Nie znaleziono użytkownika z podanym loginem i hasłem','tt'=>$core->hashPassword($password)];
		break;
		default:
			$row=['result'=>false,'reason'=>'Nieokreślony błąd'];
		break;
	}
	echo json_encode($row);
}