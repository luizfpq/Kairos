<?php

class Controller
{

  private $route;

  public function __construct(){}

  public function setRoute($route)
  {
    $this->route = $route;
  }

  public function showView($viewModel = false)
  {

    $localization = Localization::singleton();

    $localization->load();

    if(isset($_SESSION['user']))
      $user = unserialize($_SESSION['user']);


    if(!isset($user))
    {
      //include ('view/admin/schedule/index.php');
      include ('view/logon/logon.php');
    }
    else
    {
        include('view/default/head.php');

        include('view/default/header.php');

        include('view/default/message.php');

        include($this->route);

        include('view/default/footer.php');
    }
  }

/**
 * Função de debug, @// TODO: se sobrar tempo passar montar um objeto proprio
 */
  public function consoleLog($string) {
    echo '<script>';
    echo 'console.log('. json_encode( 'src/Model/'. $string . '.php' ) .')';
    echo '</script>';
  }

}
