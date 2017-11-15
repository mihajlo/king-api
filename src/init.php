<?php

@require_once('config.php');
@require_once('DB.php');
@require_once('Response.php');
@require_once('Router.php');

use Evolution\CodeIgniterDB as CI;

$route = new Router();

$db=& CI\DB($config['database']);
$response=new Response();

define('Response',$response);

@require_once($config['app_path'].'endpoints.php');

//invoke router
$route->match(@$_SERVER, @$_POST); 

