<?php

class Schedule
{
  private $id;
  private $date;
  private $category;
  private $_user;//Criador ou organizador
  private $_create;//Data de criação
  private $_update;//Última alteração
  private $_order;
  private $description;

  public function setId($id){ $this->id = $id; }

  public function getId() { return $this->id; }

  public function setDate($date) { $this->date = $date; }

  public function getDate(){ return $this->date; }

  public function setDescription($description) { $this->description = $description; }

  public function getDescription() { return $this->description; }

  public function getUser() { return $this->user; }

  public function setUser($_user) { $this->user = $_user; }

  public function getCreate() { return $this->create; }

  public function setCreate($_create) { $this->create = $_create; }

  public function getUpdate() { return $this->update; }

  public function setUpdate($_update) { $this->update = $_update; }

  public function getOrder() { return $this->order; }

  public function setOrder($_order) { $this->order = $_order; }

  public function getCategory() { return $this->order; }

  public function setCategory($category) { $this->category = $category; }

  public function __construct() { }


}
