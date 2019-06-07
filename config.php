<?php
error_reporting(E_ALL & ~E_NOTICE);
$config = 
[
	'db' =>
	[
		'user' => 'root',
		'name' => 'lspd',
		'password' => '',
		'host' => 'localhost' 
	],
	'template' =>
	[
		'pages_path' => 'pages/',
		'extension' => '.php',
		'home_page' => 'home.php',
		'err_page' => '404.php',
		'navigation' => 'pages/nav.php',
	],
	'permissions' =>
	[
		'createUser' => 9,											// Poziom dostępu wymagany do: utworzenia policjanta
		'deleteUser' => 9,											// Poziom dostępu wymagany do: usunięcia policjanta
		'levelUp' => 9,												// Poziom dostępu wymagany do: awansu policjanta
		'levelDown' => 9,											// Poziom dostępu wymagany do: degradacji policjanta
		'canManipulateHigherLevels' => false,						// Czy użytkownik może zarządzać poziomem dostępu wyszym niż on sam (np. 4 poziom zmienia poziom 6 poziomowi)
		'addKartoteka' => 1,										// Poziom dostępu wymagany do: dodania wpisu w kartotece
		'editKartoteka' => 1,										// Może edytować wpis w kartotece
		'deleteKartoteka' => 8,										// Poziom dostępu wymagany do: usunięcia wpisu z kartoteki
		'archivKartoteka' => 6,										// Poziom dostępu wymagany do: zarchiwizowania wpisu w kartotece

		'canChangeLogin' => 7,										// Poziom dostępu wymagany do: zmiany loginu
		'canChangeName' => 8,										// Poziom dostępu wymagany do: zmiany imienia i nazwiska

		'reportAdd' => 1,											// Poziom wymagany do dodania raportu
		'reportDelete' => 9											// Poziom wymagany do usunięcia raportu
	],
	'upload' =>
	[
		'driverLicensePath' => 'upload/driver_license/',
		'photosPath' => 'upload/photo/',
		'extensions' => 
		[
			'jpeg',
			'jpg',
			'png',
			'gif'
		]
	]
];