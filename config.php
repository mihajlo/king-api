<?php

$config['api_name'] = 'Test api';

$config['app_path'] = APP_PATH.'App/';

$config['origin'] = '*';

//Authentication password list
$config['auth'] = [
    'mihajlo'=>'mihajlo123',
    'john'=>'john123'
];

$config['database'] = [
    'dsn' => '',
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

$config['email_config']=[
    'protocol' => 'smtp',
    'smtp_host' => 'example.com',
    'smtp_port' => 25,
    'smtp_user' => 'info@example.com',
    'smtp_pass' => 'p@ssL0rD',
    'smtp_timeout' => 30,
    'charset'=>'utf-8',
    'mailtype'=>'html',
    'newline'=>'\r\n'
];

$config['error_codes'][404] = $config['api_name'] . ' :: End-point or method :: not found!';
$config['error_codes'][400] = $config['api_name'] . ' :: bad request!';
$config['error_codes'][401] = $config['api_name'] . ' :: Not authorized!';
$config['error_codes'][500] = $config['api_name'] . ' :: Something went wrong!!';
