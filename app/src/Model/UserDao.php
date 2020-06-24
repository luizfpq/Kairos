<?php

class UserDao
{
  public function __construct(){}

  public function create($user)
  {

    $db = Database::singleton();

    $sql = "select inserir_usuario (?, ?, ?, ?, ?, ?, ?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $user->getNome(), PDO::PARAM_STR);

    $sth->bindValue(2, $user->getLogin(), PDO::PARAM_STR);

    $sth->bindValue(3, sha1($user->getSenha()), PDO::PARAM_STR);

    $sth->bindValue(4, $user->getEmail(), PDO::PARAM_STR);

    $sth->bindValue(5, $user->getTipo(), PDO::PARAM_STR);

    $sth->bindValue(6, $user->getNivel(), PDO::PARAM_STR);

    $sth->bindValue(7, $user->getIdentificador(), PDO::PARAM_STR);

    if($sth->execute())
      return $db->lastInsertId();

    return false;

  }

  public function getById($id_usuario)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM tbl_usuario WHERE id_usuario = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id_usuario, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $user = new User();

      $user->setId($obj->id_usuario);
      $user->setNome($obj->nome);
      $user->setLogin($obj->login);
      $user->setEmail($obj->email);
      $user->setNivel($obj->nivel);

      return $user;
    }
  }

  public function update($user){

    $db = Database::singleton();

    if ($user->getSenha() == null) {
      $sql = "UPDATE tbl_usuario SET nome = ?, login = ?, email =  ?, nivel = ? WHERE id_usuario = ?";
    } else {
      $sql = "UPDATE tbl_usuario SET nome = ?, login = ?, email =  ?, nivel = ?, senha = ? WHERE id_usuario = ?";

    }

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $user->getNome(), PDO::PARAM_STR);

    $sth->bindValue(2, $user->getLogin(), PDO::PARAM_STR);
    $sth->bindValue(3, $user->getEmail(), PDO::PARAM_STR);
    $sth->bindValue(4, $user->getNivel(), PDO::PARAM_STR);


    if ($user->getSenha() == null) {
      $sth->bindValue(5, $user->getId(), PDO::PARAM_STR);
    } else {
      $sth->bindValue(5, sha1($user->getSenha()), PDO::PARAM_STR);
      $sth->bindValue(6, $user->getId(), PDO::PARAM_STR);
    }

    $sth->execute();


    var_dump($sql);
    var_dump($user->getNome());
    var_dump($user->getLogin());
    var_dump($user->getEmail());
    var_dump($user->getNivel());
    var_dump($user->getSenha());
    var_dump($user->getId());




  }


  public function delete($id_usuario){

    $db = Database::singleton();

    $sql = "select excluir_usuario(?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id_usuario, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  tbl_usuario";

    $sth = $db->prepare($sql);

    $sth->execute();

    $users = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $user = new User();

      $user->setId($obj->id_usuario);
      $user->setNome($obj->nome);
      $user->setLogin($obj->login);
      $user->setEmail($obj->email);
      $user->setNivel($obj->nivel);

      $users[] = $user;

    }

    return $users;
  }

  public function setGroup($user)
  {
    $db = Database::singleton();

    foreach($user->getGroup() as $group)
    {
      $sql = 'INSERT INTO user_group (tbl_usuario,"group") VALUES (?,?)';

      $sth = $db->prepare($sql);

      $sth->bindValue(1, $user->getId(), PDO::PARAM_STR);

      $sth->bindValue(2, $group, PDO::PARAM_STR);

      $sth->execute();
    }

    return true;
  }
}
