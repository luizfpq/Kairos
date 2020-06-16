<?php

class ScheduleCategory{
	private $id;
	private $name;
    private $description;
    private $user;
    private $create;
    private $update;
    private $order;





	public function __construct(){}

	public function setName($name){ $this->name = $name;}

	public function getName(){ return $this->name;}

	public function setDescription($description){ $this->description = $description;}

    public function getDescription(){ return $this->description;}

    public function getUser(){ return $this->user;}

    public function setUser(){ return $this->user = $user;}

    public function getCreate(){ return $this->create;}

    public function setCreate(){ return $this->create = $create;}

    public function getUpdate(){ return $this->update;}

    public function setUpdate(){ return $this->update = $update;}

    public function getOrder(){ return $this->order;}

    public function setOrder(){ return $this->order = $order;}

		public function getId(){ return $this->id;}

		public function setId(){ return $this->id;}


}
