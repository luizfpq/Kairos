<?php

class LogonDao
{

  const _table = 'tbl_usuario';

  public function __construct(){}

  public function authenticate($logon)
  {
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE email = ? AND senha = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $logon->getUser()->getEmail(), PDO::PARAM_STR);

    $sth->bindValue(2, sha1($logon->getUser()->getSenha()), PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $user = new User();
     
      $user->setId($obj->id_usuario);
      $user->setNome($obj->nome);
      $user->setLogin($obj->login);
      $user->setEmail($obj->email);
      $user->setNivel($obj->nivel);
      $user->setLocale($obj->locale);

      return $user;
    }

    return false;
  }
}
