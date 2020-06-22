<?php

class Regulamento
{
  private $id_regulamento;
  private $tipo;
  private $carga_hr;
  private $limite_hr;




  public function __construct() { }




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
     * Get the value of Tipo
     *
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of Tipo
     *
     * @param mixed $tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of Carga Hr
     *
     * @return mixed
     */
    public function getCargaHr()
    {
        return $this->carga_hr;
    }

    /**
     * Set the value of Carga Hr
     *
     * @param mixed $carga_hr
     *
     * @return self
     */
    public function setCargaHr($carga_hr)
    {
        $this->carga_hr = $carga_hr;

        return $this;
    }


    /**
     * Get the value of Limite Hr
     *
     * @return mixed
     */
    public function getLimiteHr()
    {
        return $this->limite_hr;
    }

    /**
     * Set the value of Limite Hr
     *
     * @param mixed $limite_hr
     *
     * @return self
     */
    public function setLimiteHr($limite_hr)
    {
        $this->limite_hr = $limite_hr;

        return $this;
    }

}
