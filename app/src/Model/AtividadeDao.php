<?php

class AtividadeDao{

/* Em caso de alteração, insira no tipo de atividade qual tipo de inserção
 * a que ela é dependente
 */
	private $atvTipoA = array(1,2,3,4,17,18,19,20,22,24,27,30,31,32,33);
	private $atvTipoB = array(6,7,8,9,10,11,12,13,14,15,16,21,23,25,26,29,34);
	private $atvTipoC = array(5,28);

	public function __construct(){}

  public function create($atividade){

    $db = Database::singleton();

/**
 * Verifica se o tipo de atividade está no array definido
 * caso esteja faz o tipo de chamada diferente
 */
		if (in_array($atividade->getIdRegulamento(), $this->atvTipoA) ) {
			$sql = 'select inserir_atividadea (?, ?, ?, ?, ?)';
		}
		else if (in_array($atividade->getIdRegulamento(), $this->atvTipoB) ) {
			$sql = 'select inserir_atividadeb (?, ?, ?, ?, ?)';
		}
		else if (in_array($atividade->getIdRegulamento(), $this->atvTipoC) ) {
			$sql = 'select inserir_atividadec (?, ?, ?, ?, ?, ?)';
		}

		$sth = $db->prepare($sql);
		$sth->bindValue(1, $atividade->getDescricao(), PDO::PARAM_STR);
		$sth->bindValue(2, $atividade->getCargaHrTotal(), PDO::PARAM_STR);
		$sth->bindValue(3, $atividade->getIdAluno(), PDO::PARAM_STR);
		$sth->bindValue(4, $atividade->getIdRegulamento(), PDO::PARAM_STR);
		$sth->bindValue(5, $atividade->getIdAluno(), PDO::PARAM_STR);

		if (in_array($atividade->getIdRegulamento(), $this->atvTipoC) ) {
			$sth->bindValue(6, $atividade->getIntervalo(), PDO::PARAM_STR);
			
		}

		if($sth->execute())
      		return $db->lastInsertId();

    return false;

  }



  public function getById($id)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM vw_atividade WHERE id_atividade = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);

    $sth->execute();


    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $atividade = new Atividade();

      $atividade->setIdAtividade($obj->id_atividade);
			$atividade->setDescricao($obj->descricao);
			$atividade->setCargaHrTotal($obj->carga_hr_total);
			$atividade->setCarHrAproveitada($obj->car_hr_aproveitada);
			$atividade->setStatus($obj->status);
			$atividade->setDocumento($obj->documento);
			$atividade->setIdRegulamento($obj->id_regulamento);
			$atividade->setIdAluno($obj->id_usuario);
			$atividade->setIdUsuario($obj->id_usuario);
			$atividade->setNome($obj->nome);
			$atividade->setLogin($obj->login);
			$atividade->setEmail($obj->email);
			$atividade->setNivel($obj->nivel);
			$atividade->setSituacao($obj->situacao);

      return $atividade;
    }
  }

  public function update($atividade){

    $db = Database::singleton();

    $sql = "UPDATE atividade SET name = ?, description = ?, sector = ? WHERE id = ?";
		//$atividade->consoleLog($sql);
    $sth = $db->prepare($sql);

	$sth->bindValue(1, $atividade->getName(), PDO::PARAM_STR);
    $sth->bindValue(2, $atividade->getDescription(), PDO::PARAM_STR);
    $sth->bindValue(3, $atividade->getSector(), PDO::PARAM_STR);
	$sth->bindValue(4, $atividade->getId(), PDO::PARAM_STR);

    $sth->execute();

  }


  public function delete($id_usuario, $id_atividade){

    $db = Database::singleton();

    $sql = "select remover_atividade(?, ?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id_usuario, PDO::PARAM_STR);
		$sth->bindValue(2, $id_atividade, PDO::PARAM_STR);

    $sth->execute();

  }

  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  vw_atividade";

    $sth = $db->prepare($sql);

    $sth->execute();

    $atividade = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $atividade = new Atividade();

			$atividade->setIdAtividade($obj->id_atividade);
			$atividade->setDescricao($obj->descricao);
			$atividade->setCargaHrTotal($obj->carga_hr_total);
			$atividade->setCarHrAproveitada($obj->car_hr_aproveitada);
			$atividade->setStatus($obj->status);
			$atividade->setDocumento($obj->documento);
			$atividade->setIdRegulamento($obj->id_regulamento);
			$atividade->setIdAluno($obj->id_usuario);
			$atividade->setIdUsuario($obj->id_usuario);
			$atividade->setNome($obj->nome);
			$atividade->setLogin($obj->login);
			$atividade->setEmail($obj->email);
			$atividade->setNivel($obj->nivel);
			$atividade->setSituacao($obj->situacao);

      $activities[] = $atividade;

    }

    return $activities;
  }

}
