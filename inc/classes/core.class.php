<?php
class Core {
	public $users_count;
	public $card_count;
	public $report_count;

	function __construct() {
		global $db;
		$sql = "SELECT  (
			SELECT COUNT(*)
			FROM   lspd_users
			) AS count1,
			(
			SELECT COUNT(*)
			FROM   lspd_reports
			) AS count2,
			(
			SELECT COUNT(*)
			FROM   lspd_kartoteka
			) AS count3
		FROM    dual";
		$r=$db->query($sql)->fetch_Assoc();
		$this->users_count = $r['count1'];
		$this->report_count = $r['count2'];
		$this->card_count = $r['count3'];
	}

	function createUsersTable() {
		global $db,$user;
		$sql="SELECT * FROM `lspd_users`";
		if($r=$db->query($sql)){
			if($r->num_rows){
				$t;
				while($row=$r->fetch_assoc()){
					if($user->id != $row['id']) {
						$button_delete = "<a href=\"a--DeleteUser\" uid=\"{$row['id']}\" class=\"btn btn-circle btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Usuń policjanta\"><i class=\"fas fa-fw fa-user-times\"></i></a>";
						if($row['level']>1) $button_minus = "<a href=\"a--LevelUserDown\" uid=\"{$row['id']}\" class=\"btn btn-circle btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Degraduj policjanta\"><i class=\"fas fa-fw fa-user-minus\"></i></a>";
						if($row['level']<8) $button_plus = "<a href=\"a--LevelUserUp\" uid=\"{$row['id']}\" class=\"btn btn-circle btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Awansuj policjanta\"><i class=\"fas fa-fw fa-user-plus\"></i></a>";
					}
					$t.="
					<tr>
					  <td>{$row['id']}</td>
					  <td>{$row['level']}</td>
					  <td>{$row['name']}</td>
					  <td>{$row['surname']}</td>
					  <td class=\"text-right\">
					  	$button_plus
					    $button_delete
					    $button_minus
					  </td>
					</tr>";
					$button_plus = false;
					$button_minus = false;
					$button_delete = false;
				}
				return $t;
			} return "<tr><td colspan=\"5\">Brak policjantów</td></tr>";
		} return "<tr><td colspan=\"5\">Błąd</td></tr>";
	}

	function createKartotekaTable($archiv=false) {
		global $db,$user;
		$sql="SELECT * FROM `lspd_kartoteka` $addon ORDER BY `id` DESC";
		if($r=$db->query($sql)){
			if($r->num_rows){
				$t;
				while($row=$r->fetch_assoc()){
					$button_delete = "<a href=\"a--DeleteKartoteka\" uid=\"{$row['id']}\" class=\"btn btn-circle btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Usuń wpis w kartotece\"><i class=\"fas fa-fw fa-trash-alt\"></i></a>";
					$button_edit = "<a href=\"?page=kartoteka_edit&id={$row['id']}\" class=\"btn btn-circle btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edytuj wpis\"><i class=\"far fa-fw fa-edit\"></i></a>";
					$button_pederastian = "<a href=\"?page=pederastian_show&id={$row['pid']}\" class=\"btn btn-circle btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Pokaż obywatela\"><i class=\"fas fa-fw fa-user\"></i></a>";
					$policeman = $this->getUserData($row['admin']);
					$row['data'] = date('d.m.Y',$row['data']);
					$names=$this->getPederastianNames($row['pid']);
					$row['imie']=$names['name'];
					$row['nazwisko']=$names['surname'];
					$t.="
					<tr>
            		  <td>{$row['id']}</td>
            		  <td>
            		  	$button_delete
						$button_edit
						$button_pederastian
            		  </td>
            		  <td>{$row['imie']}</td>
            		  <td>{$row['nazwisko']}</td>
            		  <td>{$row['powod']}</td>
            		  <td>{$row['data']}</td>
            		  <td>{$row['money']}$</td>
            		  <td>{$row['months']}</td>
            		  <td>{$policeman['name']} {$policeman['surname']}</td>
            		</tr>
            		";
				}
				return $t;
			} return "<tr><td colspan=\"8\">Brak wpisów w kartotece</td></tr>";
		} return "<tr><td colspan=\"8\">Błąd ".$sql."</td></tr>";
	}

	function createPederastianKartotekaTable($id,$archiv=false) {
		global $db,$user,$config;
		$sql="SELECT * FROM `lspd_kartoteka` WHERE `pid`='$id' $addon ORDER BY `id` DESC";
		if($r=$db->query($sql)){
			if($r->num_rows){
				$t;
				while($row=$r->fetch_assoc()){
					$button_delete = "<a href=\"a--DeleteKartoteka\" uid=\"{$row['id']}\" class=\"btn btn-circle btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Usuń wpis w kartotece\"><i class=\"fas fa-fw fa-trash-alt\"></i></a>";
					if($user->level>=$config['permissions']['addKar'])$button_edit = "<a href=\"?page=kartoteka_edit&id={$row['id']}\" class=\"btn btn-circle btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edytuj wpis\"><i class=\"far fa-fw fa-edit\"></i></a>";
					$policeman = $this->getUserData($row['admin']);
					$row['data'] = date('d.m.Y',$row['data']);
					$names=$this->getPederastianNames($row['pid']);
					$row['imie']=$names['name'];
					$row['nazwisko']=$names['surname'];
					$t.="
					<tr>
            <td>{$row['id']}</td>
            <td>
            	$button_delete
							$button_edit
            </td>
            <td>{$row['powod']}</td>
            <td>{$row['data']}</td>
            <td>{$row['money']}$</td>
            <td>{$row['months']}</td>
            <td>{$policeman['name']} {$policeman['surname']}</td>
          </tr>
          ";
				}
				return $t;
			} return "<tr><td colspan=\"6\">Brak wpisów w kartotece</td></tr>";
		} return "<tr><td colspan=\"6\">Błąd</td></tr>";
	}

	function createReportsTable() {
		global $db;
		$sql="SELECT * FROM `lspd_reports` ORDER BY `id` DESC";
		if($r=$db->query($sql)){
			if($r->num_rows){
				$t;
				while($row=$r->fetch_assoc()){
					$policeman = $this->getUserData($row['policeman_id']);
					$row['date'] = date('H:i d/m/y',$row['date']);
					$button_goto = "<a href=\"?page=report_view&id={$row['id']}\" class=\"btn btn-circle btn-info\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Przejdź do wpisu\"><i class=\"fas fa-external-link-alt fa-fw\"></i></a>";
					$button_delete = "<a href=\"a--DeleteRaport\" id=\"{$row['id']}\" class=\"btn btn-circle btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Usuń wpis\"><i class=\"fas fa-trash-alt fa-fw\"></i></i></a>";
					$t.="
					<tr>
						<td>{$row['id']}</td>
						<td>
							$button_goto
							$button_delete
						</td>
						<td>{$policeman['name']}</td>
						<td>{$policeman['surname']}</td>
						<td>{$row['date']}</td>
						<td>{$row['title']}</td>
					";
				}
				return $t;
			} return "<tr><td colspan=\"6\">Brak raportów</td></tr>";
		} return "<tr><td colspan=\"6\">Błąd</td></tr>";
	}

	function getUserLevel($id){
		global $db;
		$sql="SELECT `level` as `level` FROM `lspd_users` WHERE `id`='$id'";
		return $db->query($sql)->fetch_object()->level;
	}

	function getUserData($id){
		global $db;
		$sql="SELECT * FROM `lspd_users` WHERE `id`='$id'";
		return $db->query($sql)->fetch_assoc();
	}

	function hashPassword($string) {
		$salt=md5("vaVaSpokoZiom321");
		$string=md5($string);
		md5(md5($string.$salt));
		return $string;
	}

	function doesPederastianExist($name, $surname) {
		global $db;
		htmlentities($name,ENT_QUOTES,'utf-8');
		htmlentities($surname,ENT_QUOTES,'utf-8');
		return $db->query("SELECT `id` AS `id` FROM `lspd_pederastians` WHERE `name`='$name' AND `surname`='$surname'")->fetch_object()->id;
	}

	function getPederastianNames($id) {
		global $db;
		htmlentities($id,ENT_QUOTES,'utf-8');
		return $db->query("SELECT `name`,`surname` FROM `lspd_pederastians` WHERE `id`='$id'")->fetch_assoc();
	}

	function getPederastianInfo($id) {
		global $db;
		htmlentities($id,ENT_QUOTES,'utf-8');
		return $db->query("SELECT * FROM `lspd_pederastians` WHERE `id`='$id'")->fetch_assoc();
	}

	function getWpisFromKartoteka($id) {
		global $db;
		$id = htmlentities($id,ENT_QUOTES,'utf-8');
		return $db->query("SELECT * FROM `lspd_kartoteka` WHERE `id`='$id'")->fetch_assoc();
	}

	function getReportValues($id) {
		global $db;
		$id = htmlentities($id,ENT_QUOTES,'utf-8');
		return $db->query("SELECT * FROM `lspd_reports` WHERE `id`='$id'")->fetch_assoc();
	}
}