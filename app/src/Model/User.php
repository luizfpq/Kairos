<?php

class User
{
  private $id_usuario;
  private $nome;
  private $login;
  private $senha;
  private $email;
  private $locale;
  private $nivel;
  private $group = array();

  public function __construct() { }

  public function getId_usuario() { return $this->id; }
	public function setId_usuario($id_usuario) { $this->id_usuario = $id_usuario; }


  public function getNome() { return $this->nome; }
  public function setNome($nome) { $this->nome = $nome; }
  

  public function getLogin() { return $this->login; }
	public function setLogin($login) { $this->login = $login; }


  public function getSenha() { return $this->senha; }
	public function setSenha($senha) { $this->senha = $senha; }

  public function getEmail() { return $this->email; }
	public function setEmail($email) { $this->email = $email; }
  

  public function getLocale() { return $this->locale; }
	public function setLocale($locale) { $this->locale = $locale; }


  public function getNivel($nivel) {return $this->nivel;}
  public function setNivel($nivel) {$this->nivel = $nivel;}





  public function getGroup(){ return $this->group; }
  public function setGroup($group){ $this->group = $group; }

}