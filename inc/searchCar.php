<?php
session_start();
define("MYSQL_QUERY_ERROR", 1);
define("MYSQL_CONNECTION_ERROR", 2);
define("USER_NOT_LOGGED_IN", 3);
define("NO_PERMISSION", 4);
define("NOTHING_FOUND",5);
try {
	require_once("../config.php");
	require_once("classes/user.class.php");
    $db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
    $route_db = new mysqli($config['route_db']['host'],$config['route_db']['user'], $config['route_db']['password'],$config['route_db']['name']);
	if($db->connect_errno || $route_db->connect_errno) throw new Exception(MYSQL_CONNECTION_ERROR);
	$user = new User(0,$_SESSION['id']);
	if($user->loginError) throw new Exception(USER_NOT_LOGGED_IN);

    $type = htmlentities($_POST['type'],ENT_QUOTES,'utf-8');
    $value = htmlentities($_POST['value'],ENT_QUOTES,'utf-8');

    if($type==0) $where = "user.lastname";
    else $where = "veh.plate";

    $sql = "SELECT veh.plate, user.firstname, user.lastname FROM `owned_vehicles` AS veh, `users` as user WHERE user.identifier=veh.owner AND LOWER($where) LIKE '%$value%'";

    $r=$route_db->query($sql);
    if($r->num_rows) {
        $output;
        while($row = $r->fetch_Assoc()) {
            $output.='<tr>';
            $output.="<td>{$row['plate']}</td>";
            $output.="<td>{$row['firstname']}</td>";
            $output.="<td>{$row['lastname']}</td>";
            $output.='</tr>';
        }
        $result['result']=true;
        $result['output']=$output;
        $result['reason']="Znaleziono wyniki wyszukiwania";
    } else {
        throw new Exception(NOTHING_FOUND);
    }
    echo json_encode($result);
    exit();
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
        case NOTHING_FOUND:
			$row=['result'=>false,'reason'=>'Nic nie znaleziono',$sql];
		break;
		default:
			$row=['result'=>false,'reason'=>'Nieokreślony błąd'];
		break;
	}
	echo json_encode($row);
}