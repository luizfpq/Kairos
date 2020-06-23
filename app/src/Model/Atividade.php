<?php

class Atividade
{
  private $id_atividade;
  private $descricao;
  private $carga_hr_total;
  private $car_hr_aproveitada;
  private $status;
  private $documento;
  private $id_regulamento;
  private $id_aluno;
  private $id_usuario;
  private $nome;
  private $login;
  private $senha;
  private $email;
  private $locale;
  private $nivel;
  private $situacao;
  private $intervalo;




  public function __construct() { }



    /**
     * Get the value of Id Atividade
     *
     * @return mixed
     */
    public function getIdAtividade()
    {
        return $this->id_atividade;
    }

    /**
     * Set the value of Id Atividade
     *
     * @param mixed $id_atividade
     *
     * @return self
     */
    public function setIdAtividade($id_atividade)
    {
        $this->id_atividade = $id_atividade;

        return $this;
    }

    /**
     * Get the value of Descricao
     *
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of Descricao
     *
     * @param mixed $descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of Carga Hr Total
     *
     * @return mixed
     */
    public function getCargaHrTotal()
    {
        return $this->carga_hr_total;
    }

    /**
     * Set the value of Carga Hr Total
     *
     * @param mixed $carga_hr_total
     *
     * @return self
     */
    public function setCargaHrTotal($carga_hr_total)
    {
        $this->carga_hr_total = $carga_hr_total;

        return $this;
    }

    /**
     * Get the value of Car Hr Aproveitada
     *
     * @return mixed
     */
    public function getCarHrAproveitada()
    {
        return $this->car_hr_aproveitada;
    }

    /**
     * Set the value of Car Hr Aproveitada
     *
     * @param mixed $car_hr_aproveitada
     *
     * @return self
     */
    public function setCarHrAproveitada($car_hr_aproveitada)
    {
        $this->car_hr_aproveitada = $car_hr_aproveitada;

        return $this;
    }

    /**
     * Get the value of Status
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of Status
     *
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of Documento
     *
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set the value of Documento
     *
     * @param mixed $documento
     *
     * @return self
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get the value of Id Regulamento
     *
     * @return mixed
     */
    public function getIdRegulamento()
    {
        return $this->id_regulamento;
    }

    /**
     * Set the value of Id Regulamento
     *
     * @param mixed $id_regulamento
     *
     * @return self
     */
    public function setIdRegulamento($id_regulamento)
    {
        $this->id_regulamento = $id_regulamento;

        return $this;
    }

    /**
     * Get the value of Id Aluno
     *
     * @return mixed
     */
    public function getIdAluno()
    {
        return $this->id_aluno;
    }

    /**
     * Set the value of Id Aluno
     *
     * @param mixed $id_aluno
     *
     * @return self
     */
    public function setIdAluno($id_aluno)
    {
        $this->id_aluno = $id_aluno;

        return $this;
    }

    /**
     * Get the value of Id Usuario
     *
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of Id Usuario
     *
     * @param mixed $id_usuario
     *
     * @return self
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of Nome
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of Nome
     *
     * @param mixed $nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of Login
     *
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of Login
     *
     * @param mixed $login
     *
     * @return self
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of Senha
     *
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of Senha
     *
     * @param mixed $senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Locale
     *
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the value of Locale
     *
     * @param mixed $locale
     *
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get the value of Nivel
     *
     * @return mixed
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set the value of Nivel
     *
     * @param mixed $nivel
     *
     * @return self
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }


    /**
     * Get the value of Situacao
     *
     * @return mixed
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set the value of Situacao
     *
     * @param mixed $situacao
     *
     * @return self
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }




    /**
     * Get the value of Intervalo
     *
     * @return mixed
     */
    public function getIntervalo()
    {
        return $this->intervalo;
    }

    /**
     * Set the value of Intervalo
     *
     * @param mixed $intervalo
     *
     * @return self
     */
    public function setIntervalo($intervalo)
    {
        $this->intervalo = $intervalo;

        return $this;
    }

    
}
