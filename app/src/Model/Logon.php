<?php

class Logon
{
  public $user;

  public function __construct() { }

  public function setUser($email, $password)
  {
    $this->user = new User();
    $this->user->setEmail($email);
    $this->user->setPassword($password);
  }

  public function getUser()
  {
    return $this->user;
  }
}