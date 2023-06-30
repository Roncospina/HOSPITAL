<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/Connection.php';

class Sustitucion extends Connection
{
    private $idSustitucion;
    private $fechaInicio;
    private $fechaFin;
    private $medico;

    public function __construct($id = null, $inicio = null, $fin = null, $medico = null)
    {
        $this->idSustitucion = $id;
        $this->fechaInicio = $inicio;
        $this->fechaFin = $fin;
        $this->medico = $medico;
        parent::__construct();
    }

    // Getters y setters
    public function getIdSustitucion()
    {
        return $this->idSustitucion;
    }

    public function setIdSustitucion($id)
    {
        $this->idSustitucion = $id;
        return $this;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio($inicio)
    {
        $this->fechaInicio = $inicio;
        return $this;
    }

    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    public function setFechaFin($fin)
    {
        $this->fechaFin = $fin;
        return $this;
    }

    public function getMedico()
    {
        return $this->medico;
    }

    public function setMedico($medico)
    {
        $this->medico = $medico;
        return $this;
    }

    // Métodos para acceder y manipular los datos de las sustituciones en la base de datos
    // ...
}
