<?php

class UserDao
{
  public function __construct(){}

  public function create($user)
  {

    $db = Database::singleton();

    $sql = "INSERT INTO volunteer (username,email, password) VALUES (?,?,?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $user->getUsername(), PDO::PARAM_STR);

    $sth->bindValue(2, $user->getEmail(), PDO::PARAM_STR);

    $sth->bindValue(3, sha1($user->getPassword()), PDO::PARAM_STR);

    if($sth->execute())
      return $db->lastInsertId();;

    return false;

  }

  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM volunteer WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $user = new User();

      $user->setUsername($obj->username);
      $user->setEmail($obj->email);
      $user->setId($obj->id);

      return $user;
    }
  }

  public function update($user){

    $db = Database::singleton();

    $sql = "UPDATE volunteer SET username = ?, email =  ? WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $user->getUsername(), PDO::PARAM_STR);

    $sth->bindValue(2, sha1($user->getEmail()), PDO::PARAM_STR);

    $sth->bindValue(3, $user->getId(), PDO::PARAM_STR);

    $sth->execute();

  }

  public function setLocale($user){

    $db = Database::singleton();

    $sql = "UPDATE volunteer SET locale = ? WHERE id = ? ";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $user->getLocale(), PDO::PARAM_STR);

    $sth->bindValue(2, $user->getId(), PDO::PARAM_STR);

    $sth->execute();

  }

  public function delete($id){

    $db = Database::singleton();

    $sql = "DELETE FROM volunteer WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  volunteer";

    $sth = $db->prepare($sql);

    $sth->execute();

    $users = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $user = new User();
      $user->setUsername($obj->username);
      $user->setEmail($obj->email);
      $user->setId($obj->id);

      $users[] = $user;

    }

    return $users;
  }

  public function setGroup($user)
  {
    $db = Database::singleton();

    foreach($user->getGroup() as $group)
    {
      $sql = 'INSERT INTO user_group (volunteer,"group") VALUES (?,?)';

      $sth = $db->prepare($sql);

      $sth->bindValue(1, $user->getId(), PDO::PARAM_STR);

      $sth->bindValue(2, $group, PDO::PARAM_STR);

      $sth->execute();
    }

    return true;
  }
}
