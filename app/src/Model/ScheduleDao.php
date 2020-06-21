<?php

class ScheduleDao{


	public function __construct(){}


    public function create($schedule){

    $db = Database::singleton();

    $sql = "INSERT INTO schedule (date, category, description, _user) VALUES (?,?,?,?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $schedule->getDate(), PDO::PARAM_STR);

    $sth->bindValue(2, $schedule->getCategory(), PDO::PARAM_STR);

    $sth->bindValue(3, $schedule->getDescription(), PDO::PARAM_STR);

    $sth->bindValue(4, $schedule->getUser(), PDO::PARAM_STR);

    if($sth->execute())
      return $db->lastInsertId();;

    return false;

  }

  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM schedule WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $schedule = new schedule();

      $schedule->setDate($obj->date);
      $schedule->setDescription($obj->description);

      return $schedule;
    }
  }

  public function update($schedule){

    $db = Database::singleton();

    $sql = "UPDATE schedule SET date = ?, description =  ? WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $schedule->getDate(), PDO::PARAM_STR);

    $sth->bindValue(2, $schedule->getCategory(), PDO::PARAM_STR);

    $sth->bindValue(3, $schedule->getDescription(), PDO::PARAM_STR);

    $sth->bindValue(4, $schedule->getUser(), PDO::PARAM_STR);

    $sth->bindValue(5, $schedule->getCreate(), PDO::PARAM_STR);

    $sth->bindValue(6, $schedule->getUpdate(), PDO::PARAM_STR);

    $sth->bindValue(7, $schedule->getOrder(), PDO::PARAM_STR);


    $sth->execute();

  }


  public function delete($id){

    $db = Database::singleton();

    $sql = "DELETE FROM schedule WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  schedule";

    $sth = $db->prepare($sql);

    $sth->execute();

    $schedule = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $schedule = new Schedule();
      $schedule->setDate($obj->date);
      $schedule->setDescription($obj->description);
      $schedule->setId($obj->id);

      $schedules[] = $schedule;

    }

    return $schedules;
  }

	public function listCalendar(){

		$db = Database::singleton();

		$sql = "select description as title, date as start from schedule";

		$sth = $db->prepare($sql);

		$sth->execute();

		$schedule = array();

		while($obj = $sth->fetch(PDO::FETCH_ASSOC))
		{
			$schedules[] = $obj;

		}

    echo json_encode($schedules);
	}

}
