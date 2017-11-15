<?php
$config['api_name']='Test api';


$config['app_path']='App/';


$config['database']=[
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => 'root',
	'database' => 'soc',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'db_debug' => TRUE,
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(''),
	'save_queries' => TRUE
];



$config['error_codes'][404]=$config['api_name'].' :: End-point or method :: not found!';
$config['error_codes'][400]=$config['api_name'].' :: bad request!';
$config['error_codes'][401]=$config['api_name'].' :: Not authorized!';
$config['error_codes'][500]=$config['api_name'].' :: Something went wrong!!';