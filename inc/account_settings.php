<?php
session_start();
define("MYSQL_QUERY_ERROR", 1);
define("MYSQL_CONNECTION_ERROR", 2);
define("USER_NOT_LOGGED_IN", 3);
define("WRONG_OLD_PASSWORD", 4);
define("LEVEL_LIMIT", 5);
define("WRONG_NEW_PASSWORD", 6);
try {
	require_once("../config.php");
	require_once("classes/user.class.php");
	require_once("classes/core.class.php");
	$db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
	if($db->connect_errno) throw new Exception(MYSQL_CONNECTION_ERROR);
	$user = new User(0,$_SESSION['id']);
	if($user->loginError) throw new Exception(USER_NOT_LOGGED_IN);

	$result=0;

	$login = $user->login;
	if($user->level>=$config['permissions']['canChangeLogin']) {
		$login = htmlentities($_POST['login'],ENT_QUOTES,'utf-8');
		$result++;
	}

	$name = $user->name;
	$surname = $user->surname;
	if($user->level>=$config['permissions']['canChangeName']) {
		$name = htmlentities($_POST['name'],ENT_QUOTES,'utf-8');
		$surname = htmlentities($_POST['surname'],ENT_QUOTES,'utf-8');
		$result+=2;
	}

	switch ($result) {
		case 0:
			$result = "Nie masz uprawnień do zmiany loginu i danych osobowych";
			break;
		case 1:
			$result = "Nie masz uprawnień do zmiany danych osobowych (zmieniono login)";
			break;
		case 2:
			$result = "Nie masz uprawnień do zmiany loginu (zmieniono dane osobowe)";
			break;
		case 3:
			$result = "Poprawnie zmieniono dane osobowe.";
			break;
		default:
			throw new Exception(false);
			break;
	}

	$sql = "UPDATE `lspd_users` SET `login`='$login', `name`='$name', `surname`='$surname' WHERE `id`='$user->id'";
	if($db->query($sql)) {
		echo json_encode(['result'=>true, 'reason'=>$result]);
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
		case WRONG_OLD_PASSWORD:
			$row=['result'=>false,'reason'=>'Podano niepoprawne hasło '.$old_password.' - '.$user->password];
		break;
		case WRONG_NEW_PASSWORD:
			$row=['result'=>false,'reason'=>'Podane hasła różnią się od siebie'];
		break;
		default:
			$row=['result'=>false,'reason'=>'Nieokreślony błąd'];
		break;
	}
	echo json_encode($row);
}