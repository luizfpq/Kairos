<?php

class ScheduleCategoryDao{


	public function __construct(){}


    public function create($scheduleCategory){

    $db = Database::singleton();

    $sql = "INSERT INTO schedule_category (name,description, _user, _create, _update, order) VALUES (?,?,?,?,?,?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $scheduleCategory->getName(), PDO::PARAM_STR);

    $sth->bindValue(2, $scheduleCategory->getDescription(), PDO::PARAM_STR);

    $sth->bindValue(3, $scheduleCategory->getUser(), PDO::PARAM_STR);

    $sth->bindValue(4, $scheduleCategory->getCreate(), PDO::PARAM_STR);

    $sth->bindValue(5, $scheduleCategory->getUpdate(), PDO::PARAM_STR);

    $sth->bindValue(6, $scheduleCategory->getOrder(), PDO::PARAM_STR);



    if($sth->execute())
      return $db->lastInsertId();;

    return false;

  }

  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM schedule_category WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $scheduleCategory = new scheduleCategory();

      $scheduleCategory->setName($obj->name);
      $scheduleCategory->setDescription($obj->description);

      return $scheduleCategory;
    }
  }

  public function update($scheduleCategory){

    $db = Database::singleton();

    $sql = "UPDATE schedule_category SET name = ?, description =  ? WHERE id = ?";

    $sth = $db->prepare($sql);

     $sth->bindValue(1, $scheduleCategory->getName(), PDO::PARAM_STR);

    $sth->bindValue(2, $scheduleCategory->getDescription(), PDO::PARAM_STR);

    $sth->bindValue(3, $scheduleCategory->getUser(), PDO::PARAM_STR);

    $sth->bindValue(4, $scheduleCategory->getCreate(), PDO::PARAM_STR);

    $sth->bindValue(5, $scheduleCategory->getUpdate(), PDO::PARAM_STR);

    $sth->bindValue(6, $scheduleCategory->getOrder(), PDO::PARAM_STR);


    $sth->execute();

  }


  public function delete($id){

    $db = Database::singleton();

    $sql = "DELETE FROM schedule_category WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  schedule_category";

    $sth = $db->prepare($sql);

    $sth->execute();

    $scheduleCategory = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $scheduleCategory = new ScheduleCategory();
      $scheduleCategory->setName($obj->name);
      $scheduleCategory->setDescription($obj->description);
      $scheduleCategory->setId($obj->id);

      $schedulesCategory[] = $scheduleCategory;

    }

    return $schedulesCategory;
  }

}
