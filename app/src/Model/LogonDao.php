<?php

class LogonDao
{

  const _table = 'volunteer';

  public function __construct(){}

  public function authenticate($logon)
  {
    $db = Database::singleton();

    $sql = 'SELECT * FROM ' . self::_table . ' WHERE email = ? AND password = ?';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $logon->getUser()->getEmail(), PDO::PARAM_STR);

    $sth->bindValue(2, sha1($logon->getUser()->getPassword()), PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $user = new User();
      $user->setUsername($obj->username);
      $user->setEmail($obj->email);
      $user->setId($obj->id);
      $user->setLocale($obj->locale);

      return $user;
    }

    return false;
  }
}
