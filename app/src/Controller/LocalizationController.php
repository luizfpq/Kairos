<?php

class LocalizationController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

  }

  public function setAction(){

  	$locale = isset($_POST['locale']) ? $_POST['locale'] : null;

    $localization = Localization::singleton();

    $localization->load();

    $localization->setCurrentLocale($locale);

    #Translate::$language = $localization->getCurrentLocale()->getLocale();

    $localization->save();

    $userDao = new UserDao();

    $user = unserialize ($_SESSION['user']);

    $user->setLocale($locale);

    $userDao->setLocale($user);

    $this->setRoute(IndexView::indexRoute);

    $this->showView();

  }
}