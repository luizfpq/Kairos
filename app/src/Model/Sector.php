<?php

class Sector{
	private $id;
	private $name;
  private $description;
  private $user;
  private $create;
  private $update;
  private $category;


	public function __construct(){}

	public function getId(){return $this->id;}

	public function setId($id){$this->id = $id;}			

	public function setName($name){ $this->name = $name;}

	public function getName(){ return $this->name;}

	public function setDescription($description){ $this->description = $description;}

  public function getDescription(){ return $this->description;}

  public function getUser(){ return $this->user;}

  public function setUser($user){ $this->user = $user;}

  public function getCreate(){ return $this->create;}

  public function setCreate($create){ $this->create = $create;}

  public function getUpdate(){ return $this->update;}

  public function setUpdate($update){ $this->update = $update;}

  public function getCategory(){ return $this->category;}

  public function setCategory($category){ $this->category = $category;}




}
