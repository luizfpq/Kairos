<?php

class Logon
{
  public $user;

  public function __construct() { }

  public function setUser($email, $senha)
  {
    $this->user = new User();
    $this->user->setEmail($email);
    $this->user->setSenha($senha);
  }

  public function getUser()
  {
    return $this->user;
  }
}