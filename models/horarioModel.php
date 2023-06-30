<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/Connection.php';
require_once "Medico.php";

class Horario extends Connection
{
    private $idHorario;
    private $diaSemana;
    private $horaInicio;
    private $horaFin;
    private $medico;


    public function __construct($id = null, $dia = null, $inicio = null, $fin = null, $medico = null)
    {
        $this->idHorario = $id;
        $this->diaSemana = $dia;
        $this->horaInicio = $inicio;
        $this->horaFin = $fin;
        $this->medico = $medico;
        parent::__construct();
    }

    // Getters y setters
    public function getIdHorario()
    {
        return $this->idHorario;
    }

    public function setIdHorario($id)
    {
        $this->idHorario = $id;
        return $this;
    }

    public function getDiaSemana()
    {
        return $this->diaSemana;
    }

    public function setDiaSemana($dia)
    {
        $this->diaSemana = $dia;
        return $this;
    }

    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    public function setHoraInicio($inicio)
    {
        $this->horaInicio = $inicio;
        return $this;
    }

    public function getHoraFin()
    {
        return $this->horaFin;
    }

    public function setHoraFin($fin)
    {
        $this->horaFin = $fin;
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
    public function create()
    {
        try {
            $medicoTitular = new Medico(); // Instancia del modelo de médicos titulares
            $idMedico = $medicoTitular->getIdMedico(); // Obtener el valor de idMedico del modelo de médicos titulares
            // ...
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }
    public function list()
    {
        try {
            $sql = $this->dbConnection->prepare("SELECT horarios.*, medicos.nombre AS nombre_medico FROM horarios INNER JOIN medicos ON horarios.id_medico = medicos.id_medico");
            $sql->execute();

            $horarios = [];
            while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                $horario = new Horario($row->id_horario, $row->dia_semana, $row->hora_inicio, $row->hora_fin, $row->nombre_medico);
                $horarios[] = $horario;
            }

            return $horarios;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }


    // Métodos para acceder y manipular los datos de los horarios en la base de datos
    // ...
}
