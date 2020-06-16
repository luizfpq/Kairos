<?php

class Volunteer
{
  private $username;
  private $email;
  private $id;
  private $password;
  private $locale;
  private $role;


  public function __construct() { }

  public function setRole($role){ $this->role = $role; }

  public function getRole() { return $this->role; }

  public function setLocale($locale){ $this->locale = $locale; }

  public function getLocale() { return $this->locale; }

  public function setUsername($username) { $this->username = $username; }

  public function getUsername(){ return $this->username; }

  public function setEmail($email) { $this->email = $email; }

  public function getEmail() { return $this->email; }

  public function getId() { return $this->id; }

	public function setId($id) { $this->id = $id; }

  public function getPassword() { return $this->password; }

  public function setPassword($password) { $this->password = $password; }


}
