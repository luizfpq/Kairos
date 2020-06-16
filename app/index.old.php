<?php

session_start();

//unset($_SESSION);

define('BASE_PATH', __DIR__);

try
{
  require('autoload.php');

  $controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : 'Logon';

  $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'logon';

  eval('$controller = new '. $controller .'Controller();');

  eval('$controller->'. $action . 'Action();');
}
catch(Exception $e)
{
  die($e->getMessage());
}
