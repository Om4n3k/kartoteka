<?php
session_start();
require_once('../config.php');
require_once('classes/core.class.php');
require_once('classes/user.class.php');
require_once("classes/pagination.class.php");

try{
    $db = new mysqli($config['db']['host'],$config['db']['user'],$config['db']['password'],$config['db']['name']);
    $route_db = new mysqli($config['route_db']['host'],$config['route_db']['user'], $config['route_db']['password'],$config['route_db']['name']);
	$core=new Core;
	$perPage = new PerPage();
	if($db->connect_errno) {
		throw new Exception(MYSQL_NO_CONNECT);
	}
	$user=new User(0,$_SESSION['uid']);

	$sql = "SELECT COUNT(*) as count FROM `owned_vehicles`";
	$paginationlink = "inc/getresult.php?page=";	
	$pagination_setting = $_GET["pagination_setting"];
					
	$page = 1;
	if(!empty($_GET["page"])) {
		$page = htmlentities($_GET["page"],ENT_QUOTES,"utf-8");
	}
	
	$start = ($page-1)*$perPage->perpage;
	if($start < 0) $start = 0;

	$result = $route_db->query($sql);

	$_GET["rowcount"]=$result->fetch_object()->count;

	$sql="SELECT user.firstname, user.lastname, veh.plate FROM owned_vehicles AS veh, users AS user WHERE user.identifier = veh.owner";
	$query =  $sql." limit ".$start.",".$perPage->perpage; 
	$result = $route_db->query($query);

	if(!$result) {echo var_dump($result); exit();}
	
	if(empty($_GET["rowcount"])) {
		$_GET["rowcount"] = $result->num_rows;
	}

	if($pagination_setting == "prev-next") {
		$perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink,$pagination_setting);	
	} else {
		$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);	
	}
	
	
	$output = '<div class="table-responsive"><table class="table table-sm table-bordered table-hover"><thead><th>Rejestracja</th><th>Imię właściciela</th><th>Nazwisko właściciela</th></thead><tbody>';
	while($row=$result->fetch_Assoc()) {
		$output .= "<tr><td>{$row['plate']}</td><td>{$row['firstname']}</td><td>{$row['lastname']}</td></tr>";
	}
	$output.='</tbody></table></div>';
	if(!empty($perpageresult)) {
		$output .= '<div id="pagination">' . $perpageresult . '</div>';
	}
	print $output;
	exit();

} catch(Exception $e) {
	echo 'ERROR';
}
echo json_encode($js);
exit();
?>