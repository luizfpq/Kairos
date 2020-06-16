<?php

class VolunteerActivity{
	private $user;
	private $activity;
    private $time;
    private $sector;
    private $id;
    private $create;
    private $volunteer;
    private $schedule;
		private $description;
		private $date;


	public function __construct(){}

	public function setUser($user){ $this->user = $user;}

	public function getUser(){ return $this->user;}

	public function setActivity($activity){ $this->activity = $activity;}

    public function getActivity(){ return $this->activity;}

    public function getTime(){ return $this->time;}

    public function setTime($time){$this->time = $time;}

    public function getSector(){ return $this->sector;}

    public function setSector($sector){ $this->sector = $sector;}

    public function getId(){ return $this->id;}

    public function setId($id){ $this->id = $id;}

    public function getCreate(){ return $this->create;}

    public function setCreate($create){$this->create = $create;}

		public function getVolunteer(){ return $this->volunteer;}

    public function setVolunteer($volunteer){$this->volunteer = $volunteer;}

    public function getSchedule(){ return $this->schedule;}

    public function setSchedule($schedule){ $this->schedule = $schedule;}

		public function getDescription(){ return $this->description;}

    public function setDescription($description){ $this->description = $description;}

		public function getDate(){ return $this->schedule;}

		public function setDate($date){ $this->date = $date;}
}
