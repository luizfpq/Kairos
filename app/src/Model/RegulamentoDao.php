<?php

class RegulamentoDao{



	public function __construct(){}

  public function create($regulamento){

    $db = Database::singleton();

		$sql = "insert into tbl_regulamento (tipo, carga_hr, limite_hr) values (?, ?, ?)";

		$sth = $db->prepare($sql);
		$sth->bindValue(1, $regulamento->getTipo(), PDO::PARAM_STR);
		$sth->bindValue(2, $regulamento->getCargaHr(), PDO::PARAM_STR);
		$sth->bindValue(3, $regulamento->getLimiteHr(), PDO::PARAM_STR);

    if($sth->execute())
      return $db->lastInsertId();

    return false;

  }



  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM tbl_regulamento WHERE id_regulamento = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();


    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $regulamento = new Regulamento();

      $regulamento->setIdRegulamento($obj->id_regulamento);
			$regulamento->setTipo($obj->tipo);
			$regulamento->setCargaHr($obj->carga_hr);
			$regulamento->setLimiteHr($obj->limite_hr);

      return $regulamento;
    }
  }

  public function update($regulamento){

    $db = Database::singleton();

    $sql = "UPDATE regulamento SET name = ?, description = ?, sector = ? WHERE id = ?";
		//$regulamento->consoleLog($sql);
    $sth = $db->prepare($sql);

		$sth->bindValue(1, $regulamento->getName(), PDO::PARAM_STR);
    $sth->bindValue(2, $regulamento->getDescription(), PDO::PARAM_STR);
    $sth->bindValue(3, $regulamento->getSector(), PDO::PARAM_STR);
		$sth->bindValue(4, $regulamento->getId(), PDO::PARAM_STR);

    $sth->execute();

  }


  public function delete($id){

    $db = Database::singleton();

    $sql = "delete from tbl regulamento where id_regulamento = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  tbl_regulamento";

    $sth = $db->prepare($sql);

    $sth->execute();

    $regulamento = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $regulamento = new Regulamento();

			$regulamento->setIdRegulamento($obj->id_regulamento);
			$regulamento->setTipo($obj->tipo);
			$regulamento->setCargaHr($obj->carga_hr);
			$regulamento->setLimiteHr($obj->limite_hr);

      $regulamentos[] = $regulamento;

    }

    return $regulamentos;
  }

}
