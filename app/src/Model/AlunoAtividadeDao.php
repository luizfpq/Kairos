<?php

class AlunoAtividadeDao
{
  public function __construct(){}


  public function getStatus($id, $tipo)
  {

    $db = Database::singleton();

    $sql = "SELECT status_atv(?, ?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id, PDO::PARAM_STR);
    $sth->bindValue(2, $tipo, PDO::PARAM_STR);


    $sth->execute();
    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $alunoAtv = new AlunoAtividade();

      if (!$obj->status_atv)
        $alunoAtv->setValue(0);
      else
        $alunoAtv->setValue($obj->status_atv);


      return $alunoAtv;
    }
  }

  public function getStatusAll($tipo)
  {

    $db = Database::singleton();

    $sql = "SELECT status_atv_total(?)";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $tipo, PDO::PARAM_STR);


    $sth->execute();
    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $alunoAtv = new AlunoAtividade();

      if (!$obj->status_atv_total)
        $alunoAtv->setValue(0);
      else
        $alunoAtv->setValue($obj->status_atv_total);


      return $alunoAtv;
    }
  }
}
