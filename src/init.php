<?php

define('APP_PATH', realpath('.').'/');

require_once(APP_PATH.'config.php');
require_once(APP_PATH.'src/ConfigLib.php');
require_once(APP_PATH.'src/Lib.php');
require_once(APP_PATH.'src/DB.php');
require_once(APP_PATH.'src/Response.php');
require_once(APP_PATH.'src/Request.php');
require_once(APP_PATH.'src/Router.php');
require_once(APP_PATH.'src/Auth.php');

$route = new Router();

use Evolution\CodeIgniterDB as CI;
$db=& CI\DB($config['database']);

@require_once($config['app_path'].'endpoints.php');



//invoke router
$route->match(@$_SERVER, @$_POST); 

