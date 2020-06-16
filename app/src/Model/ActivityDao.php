<?php

class ActivityDao{


	public function __construct(){}

    public function create($activity){

    $db = Database::singleton();

    $sql = "INSERT INTO activity (name, description, _user, sector) VALUES (?,?,?,?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $activity->getName(), PDO::PARAM_STR);

    $sth->bindValue(2, $activity->getDescription(), PDO::PARAM_STR);

    $sth->bindValue(3, $activity->getUser(), PDO::PARAM_STR);

    $sth->bindValue(4, $activity->getSector(), PDO::PARAM_STR);



    if($sth->execute())
      return $db->lastInsertId();;

    return false;

  }

  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM activity WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $activity = new Activity();

      $activity->setName($obj->name);
			$activity->setDescription($obj->description);
			$activity->setSector($obj->sector);


			$activity->setId($obj->id);

      return $activity;
    }
  }

  public function update($activity){

    $db = Database::singleton();

    $sql = "UPDATE activity SET name = ?, description = ?, sector = ? WHERE id = ?";
		//$activity->consoleLog($sql);
    $sth = $db->prepare($sql);

		$sth->bindValue(1, $activity->getName(), PDO::PARAM_STR);
    $sth->bindValue(2, $activity->getDescription(), PDO::PARAM_STR);
    $sth->bindValue(3, $activity->getSector(), PDO::PARAM_STR);
		$sth->bindValue(4, $activity->getId(), PDO::PARAM_STR);

    $sth->execute();

  }


  public function delete($id){

    $db = Database::singleton();

    $sql = "DELETE FROM activity WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  activity";

    $sth = $db->prepare($sql);

    $sth->execute();

    $activity = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $activity = new Activity();
      $activity->setName($obj->name);
      $activity->setDescription($obj->description);
      $activity->setId($obj->id);

      $activities[] = $activity;

    }

    return $activities;
  }

}
