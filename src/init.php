<?php

@require_once('config.php');
@require_once('DB.php');
@require_once('Response.php');
@require_once('Request.php');
@require_once('Router.php');
@require_once('Auth.php');

$route = new Router();

use Evolution\CodeIgniterDB as CI;
$db=& CI\DB($config['database']);

define('Response',new Response());
define('Request',new Request());
define('Auth',new Auth());

@require_once($config['app_path'].'endpoints.php');

//invoke router
$route->match(@$_SERVER, @$_POST); 

