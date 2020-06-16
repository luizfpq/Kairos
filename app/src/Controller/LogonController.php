<?php

class LogonController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new LogonView();

  }
  public function logoffAction()
  {

    unset($_SESSION['user']);

    $this->setRoute(LogonView::logonRoute);

    $this->showView();
  }

  public function logonAction(){

    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : false;

    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : false;

    $viewModel = array();

    $this->setRoute($this->view->getLogonRoute());

    try
    {
      if(!$email || !$password)
        throw new Exception('Preencha todos os campos.');

      $logon = new Logon();
      $logonDao = new LogonDao();

      $logon->setUser($email, $password);

      $userView = new UserView();
      $userDao = new UserDao();

      if($user = $logonDao->authenticate($logon))
      {

        $_SESSION['user'] = serialize($user);

        $this->setRoute(IndexView::indexRoute);

        $localization = Localization::singleton();

        $localization->registry(new LocaleItem('pt_BR'), 'pt_BR');

        $localization->registry(new LocaleItem('en_EN'), 'en_EN');

        $localization->registry(new LocaleItem('es_ES'), 'es_ES');

        $user = unserialize($_SESSION['user']);

        $localization->setCurrentLocale($user->getLocale());

        $localization->save();

        $viewModel = array(
            'users' => $userDao->getAll(),
        );
      }
      else
      {
        throw new Exception('Usuário ou senha incorretos.');
      }
    }
    catch(Exception $e)
    {
      echo $e->getMessage();
    }

    $this->showView($viewModel);

  }
}
