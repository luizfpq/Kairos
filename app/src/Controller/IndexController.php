<?php

class IndexController extends Controller
{
  private $view;

  private $route;

  public function __construct(){

    $this->view = new IndexView();
  }

  public function indexAction(){

    $this->setRoute($this->view->getIndexRoute());

    $this->showView();

  }
}