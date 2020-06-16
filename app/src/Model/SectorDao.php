<?php

class SectorDao
{
  public function __construct(){ }

  public function create($sector)
  {

    $db = Database::singleton();

    $sql = "INSERT INTO sector (name,description, _user, category) VALUES (?,?,?,?)";

    echo '<script>';
    echo 'console.log('. json_encode( $sql ) .')';
    echo '</script>';

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $sector->getName(), PDO::PARAM_STR);

    $sth->bindValue(2, $sector->getDescription(), PDO::PARAM_STR);

    $sth->bindValue(3, $sector->getUser(), PDO::PARAM_STR);

		$sth->bindValue(4, $sector->getCategory(), PDO::PARAM_STR);

    if($sth->execute()) {
      return $db->lastInsertId();;
    }
    return false;

  }

  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM sector WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $sector = new Sector();

      $sector->setName($obj->name);
      $sector->setDescription($obj->description);
      $sector->setCategory($obj->category);
      $sector->setId($obj->id);

      return $sector;
    }
  }

  public function update($sector){

    $db = Database::singleton();

    $sql = "UPDATE sector SET name = ?, description =  ?, category = ? WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $sector->getName(), PDO::PARAM_STR);

    $sth->bindValue(2, $sector->getDescription(), PDO::PARAM_STR);

		$sth->bindValue(3, $sector->getCategory(), PDO::PARAM_STR);

    $sth->bindValue(4, $sector->getId(), PDO::PARAM_STR);

    $sth->execute();

  }

  public function setLocale($sector){

    $db = Database::singleton();

    $sql = "UPDATE sector SET locale = ? WHERE id = ? ";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $sector->getLocale(), PDO::PARAM_STR);

    $sth->bindValue(2, $sector->getId(), PDO::PARAM_STR);

    $sth->execute();

  }

  public function delete($id){

    $db = Database::singleton();

    $sql = "DELETE FROM sector WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  sector";

    $sth = $db->prepare($sql);

    $sth->execute();

    $sectors = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $sector = new Sector();
      $sector->setId($obj->id);
      $sector->setName($obj->name);
      $sector->setDescription($obj->description);
      $sector->setCategory($obj->category);

      $sectors[] = $sector;
    }

    return $sectors;
  }
}
