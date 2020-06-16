<?php

class VolunteerActivityDao{


	public function __construct(){}


    public function create($volunteerActivity){

    $db = Database::singleton();

    $sql = "INSERT INTO volunteer_activity (_user, activity, time, sector, volunteer, schedule, date, description) VALUES (?,?,?,?,?,?,?,?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $volunteerActivity->getUser(), PDO::PARAM_STR);

    $sth->bindValue(2, $volunteerActivity->getActivity(), PDO::PARAM_STR);

    $sth->bindValue(3, $volunteerActivity->getTime(), PDO::PARAM_STR);

    $sth->bindValue(4, $volunteerActivity->getSector(), PDO::PARAM_STR);

    $sth->bindValue(5, $volunteerActivity->getVolunteer(), PDO::PARAM_STR);

		$sth->bindValue(6, $volunteerActivity->getSchedule(), PDO::PARAM_STR);

		$sth->bindValue(7, $volunteerActivity->getDate(), PDO::PARAM_STR);

		$sth->bindValue(8, $volunteerActivity->getDescription(), PDO::PARAM_STR);


    if($sth->execute())
      return $db->lastInsertId();;

    return false;

  }

  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM volunteer_activity WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $volunteerActivity = new activity();

      $volunteerActivity->setUser($obj->User);
      $volunteerActivity->setActivity($obj->activity);

      return $volunteerActivity;
    }
  }

  public function update($volunteerActivity){

    $db = Database::singleton();

    $sql = "UPDATE volunteer_activity SET user = ?, activity =  ? WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $volunteerActivity->getUser(), PDO::PARAM_STR);

    $sth->bindValue(2, $volunteerActivity->getActivity(), PDO::PARAM_STR);

    $sth->bindValue(3, $volunteerActivity->getTime(), PDO::PARAM_STR);

    $sth->bindValue(4, $volunteerActivity->getSector(), PDO::PARAM_STR);

    $sth->bindValue(5, $volunteerActivity->getId(), PDO::PARAM_STR);

    $sth->bindValue(6, $volunteerActivity->getCreate(), PDO::PARAM_STR);

    $sth->bindValue(7, $volunteerActivity->getVolunteer(), PDO::PARAM_STR);

    $sth->bindValue(8, $volunteerActivity->getSchedule(), PDO::PARAM_STR);

		$sth->bindValue(9, $volunteerActivity->getDate(), PDO::PARAM_STR);


    $sth->execute();

  }



  public function delete($id){

    $db = Database::singleton();

    $sql = "DELETE FROM volunteer_activity WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  volunteer_activity";

    $sth = $db->prepare($sql);

    $sth->execute();

    $volunteerActivities = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $volunteerActivity = new VolunteerActivity();
      $volunteerActivity->setUser($obj->user);
      $volunteerActivity->setActivity($obj->activity);
      $volunteerActivity->setId($obj->id);

      $volunteerActivities[] = $volunteerActivity;

    }

    return $volunteerActivities;
  }

	public function acceptEvent($id){

    $db = Database::singleton();

    $sql = "UPDATE volunteer_activity SET accept = 1 WHERE id = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

		return $sth;

  }


		public function ignoreEvent($id){

	    $db = Database::singleton();

	    $sql = "UPDATE volunteer_activity SET accept = '0' WHERE id = ?";

	    $sth = $db->prepare($sql);

	    $sth->bindValue(1, $id, PDO::PARAM_STR);

	    $sth->execute();

	  }

}
