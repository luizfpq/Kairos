<?php

class AlunoDao
{
  public function __construct(){}


  public function getById($id_usuario)
  {

    $db = Database::singleton();

    $sql = "SELECT * FROM vw_aluno WHERE id_usuario = ?";

    $sth = $db->prepare($sql);

    $sth->bindValue(1, $id_usuario, PDO::PARAM_STR);

    $sth->execute();

    if($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $aluno = new Aluno();

      $aluno->setIdUsuario($obj->id_usuario);
      $aluno->setNome($obj->nome);
      $aluno->setLogin($obj->login);
      $aluno->setEmail($obj->email);
      $aluno->setNivel($obj->nivel);
      $aluno->setSituacao($obj->situacao);
      $aluno->setIdAluno($obj->id_aluno);

      return $aluno;
    }
  }


  public function getAll(){

    $db = Database::singleton();

    $sql = "SELECT * FROM  vw_aluno";

    $sth = $db->prepare($sql);

    $sth->execute();

    $alunos = array();

    while($obj = $sth->fetch(PDO::FETCH_OBJ))
    {
      $aluno = new Aluno();

      $aluno->setIdUsuario($obj->id_usuario);
      $aluno->setNome($obj->nome);
      $aluno->setLogin($obj->login);
      $aluno->setEmail($obj->email);
      $aluno->setNivel($obj->nivel);
      $aluno->setSituacao($obj->situacao);
      $aluno->setIdAluno($obj->id_aluno);

      $alunos[] = $aluno;

    }

    return $alunos;
  }

}
