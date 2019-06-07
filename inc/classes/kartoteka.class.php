<?php
class Kartoteka {
	public $id;
	public $imie_obywatela;
	public $nazwisko_obywatela;
	public $powod_wpisu;
	public $data_wpisu;
	public $kto_wpisal;
	public $do_kiedy;

	function __construct($imie_obywatela, $nazwisko_obywatela, $powod_wpisu, $data_wpisu, $kto_wpisal, $do_kiedy) {
		$this->$imie_obywatela = $imie_obywatela;
		$this->$nazwisko_obywatela = $nazwisko_obywatela;
		$this->$powod_wpisu = $powod_wpisu;
		$this->$data_wpisu = $data_wpisu;
		$this->$kto_wpisal = $kto_wpisal;
		$this->$do_kiedy = $do_kiedy;
	}

	//function create() {
	//	global $db;
	//	$sql = "INSERT INTO `lspd_kartoteka`"
	//}
}