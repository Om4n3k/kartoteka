<?php
class User {
	public $id;
	public $password;
	public $name;
	public $surname;
	public $login;
	public $level,$ip;
	public $last_login;
	public $loginError;

	function __construct($type,$loginID=0,$password="") {
		if($type==0) $this->useSessionID($loginID);
		if($type==1) $this->loginPlayer($loginID,$password);
	}

	private function useSessionID($sid) {
		global $db;
		try{
			$sql = "SELECT * FROM `lspd_users` WHERE `id`='$sid' LIMIT 1";
			if($r=$db->query($sql)){
				if($r->num_rows) {
					$row=$r->fetch_assoc();
					$this->id = $row['id'];
					$this->password = $row['password'];
					$this->name = $row['name'];
					$this->surname = $row['surname'];
					$this->login = $row['login'];
					$this->level = $row['level'];
					$this->ip = $row['ip'];
					$this->last_login = $row['last_login'];
				} else throw new Exception(1);
			} else throw new Exception(2);
		} catch(Exception $e) {
			$this->loginError = $e->getMessage();
		}
	}

	private function loginPlayer($login,$password) {
		global $db;
		try{
			$sql = "SELECT * FROM `lspd_users` WHERE `login`='$login' AND `password`='$password' LIMIT 1";
			if($r=$db->query($sql)){
				if($r->num_rows) {
					$row=$r->fetch_assoc();
					$this->id = $row['id'];
					$this->password = $row['password'];
					$this->name = $row['name'];
					$this->surname = $row['surname'];
					$this->login = $row['login'];
					$this->level = $row['level'];
					$this->ip = $row['ip'];
					$this->last_login = $row['last_login'];
					$_SESSION['id']=$this->id;
				} else throw new Exception(1);
			} else throw new Exception(2);
		} catch(Exception $e) {
			$this->loginError = $e->getMessage();
		}
	}
}