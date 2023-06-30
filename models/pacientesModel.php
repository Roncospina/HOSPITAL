<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);
require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/Connection.php';

class Paciente extends Connection
{
    private $id_pac;
    private $documento_pac;
    private $nombre_pac;
    private $direccion_pac;
    private $telefono_pac;
    private $ciudad_pac;
    private $departamento_pac;
    private $codigo_postal_pac;
    private $seguridad_social_pac;
    private $id_medico;

    public function __construct(
        $id_pac = null,
        $documento_pac = null,
        $nombre_pac = null,
        $direccion_pac = null,
        $telefono_pac = null,
        $ciudad_pac = null,
        $departamento_pac = null,
        $codigo_postal_pac = null,
        $seguridad_social_pac = null,
        $id_medico = null
    ) {
        $this->id_pac = $id_pac;
        $this->documento_pac = $documento_pac;
        $this->nombre_pac = $nombre_pac;
        $this->direccion_pac = $direccion_pac;
        $this->telefono_pac = $telefono_pac;
        $this->ciudad_pac = $ciudad_pac;
        $this->departamento_pac = $departamento_pac;
        $this->codigo_postal_pac = $codigo_postal_pac;
        $this->seguridad_social_pac = $seguridad_social_pac;
        $this->id_medico = $id_medico;
        parent::__construct();

    }

    public function create()
{
    try {
        $sql = $this->dbConnection->prepare("INSERT INTO Pacientes (documento_pac, nombre_pac, direccion_pac, telefono_pac, ciudad_pac, departamento_pac, codigo_postal_pac, seguridad_social_pac, id_medico) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bindParam(1, $this->documento_pac);
        $sql->bindParam(2, $this->nombre_pac);
        $sql->bindParam(3, $this->direccion_pac);
        $sql->bindParam(4, $this->telefono_pac);
        $sql->bindParam(5, $this->ciudad_pac);
        $sql->bindParam(6, $this->departamento_pac);
        $sql->bindParam(7, $this->codigo_postal_pac);
        $sql->bindParam(8, $this->seguridad_social_pac);
        $sql->bindParam(9, $this->id_medico);

        $sql->execute();
        return $sql;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
}

public function update()
{
    try {
        $sql = $this->dbConnection->prepare("UPDATE Pacientes SET documento_pac = ?, nombre_pac = ?, direccion_pac = ?, telefono_pac = ?, ciudad_pac = ?, departamento_pac = ?, codigo_postal_pac = ?, seguridad_social_pac = ?, id_medico = ? WHERE id_pac = ?");
        $sql->bindParam(1, $this->documento_pac);
        $sql->bindParam(2, $this->nombre_pac);
        $sql->bindParam(3, $this->direccion_pac);
        $sql->bindParam(4, $this->telefono_pac);
        $sql->bindParam(5, $this->ciudad_pac);
        $sql->bindParam(6, $this->departamento_pac);
        $sql->bindParam(7, $this->codigo_postal_pac);
        $sql->bindParam(8, $this->seguridad_social_pac);
        $sql->bindParam(9, $this->id_medico);
        $sql->bindParam(10, $this->id_pac);

        $sql->execute();
        return $sql;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
}

public function delete()
{
    try {
        $sql = $this->dbConnection->prepare("DELETE FROM Pacientes WHERE id_pac = ?");
        $sql->bindParam(1, $this->id_pac);
        $sql->execute();
        return $sql;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
}

public function view()
{
    try {
        $sql = $this->dbConnection->prepare("SELECT * FROM Pacientes WHERE id_pac = ?");
        $sql->bindParam(1, $this->id_pac);
        $sql->execute();

        if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $this->documento_pac = $row->documento_pac;
            $this->nombre_pac = $row->nombre_pac;
            $this->direccion_pac = $row->direccion_pac;
            $this->telefono_pac = $row->telefono_pac;
            $this->ciudad_pac = $row->ciudad_pac;
            $this->departamento_pac = $row->departamento_pac;
            $this->codigo_postal_pac = $row->codigo_postal_pac;
            $this->seguridad_social_pac = $row->seguridad_social_pac;
            $this->id_medico = $row->id_medico;
        }

        return $this;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
}

public function list()
{
    try {
        $sql = $this->dbConnection->prepare("SELECT * FROM pacientes");
        $sql->execute();

        $pacientes = [];

        while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $paciente = new Paciente(
                $row->id_pac,
                $row->documento_pac,
                $row->nombre_pac,
                $row->direccion_pac,
                $row->telefono_pac,
                $row->ciudad_pac,
                $row->departamento_pac,
                $row->codigo_postal_pac,
                $row->seguridad_social_pac,
                $row->id_medico
            );

            $pacientes[] = $paciente;
        }

        return $pacientes;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
}

public function select($id)
{
    try {
        $sql = $this->dbConnection->prepare("SELECT * FROM Pacientes WHERE id_pac = ?");
        $sql->bindParam(1, $id);
        $sql->execute();

        if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $paciente = new Paciente(
                $row->id_pac,
                $row->documento_pac,
                $row->nombre_pac,
                $row->direccion_pac,
                $row->telefono_pac,
                $row->ciudad_pac,
                $row->departamento_pac,
                $row->codigo_postal_pac,
                $row->seguridad_social_pac,
                $row->id_medico
            );
        } else {
            $paciente = null;
        }

        return $paciente;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
}


    // Aquí puedes agregar getters y setters para los atributos del modelo

    public function getIdPac()
    {
        return $this->id_pac;
    }

    public function getDocumentoPac()
    {
        return $this->documento_pac;
    }

    public function getNombrePac()
    {
        return $this->nombre_pac;
    }

    public function getDireccionPac()
    {
        return $this->direccion_pac;
    }

    public function getTelefonoPac()
    {
        return $this->telefono_pac;
    }

    public function getCiudadPac()
    {
        return $this->ciudad_pac;
    }

    public function getDepartamentoPac()
    {
        return $this->departamento_pac;
    }

    public function getCodigoPostalPac()
    {
        return $this->codigo_postal_pac;
    }

    public function getSeguridadSocialPac()
    {
        return $this->seguridad_social_pac;
    }

    public function getIdMedico()
    {
        return $this->id_medico;
    }

    // Aquí puedes agregar setters para los atributos del modelo

    public function setIdPac($id_pac)
    {
        $this->id_pac = $id_pac;
    }

    public function setDocumentoPac($documento_pac)
    {
        $this->documento_pac = $documento_pac;
    }

    public function setNombrePac($nombre_pac)
    {
        $this->nombre_pac = $nombre_pac;
    }

    public function setDireccionPac($direccion_pac)
    {
        $this->direccion_pac = $direccion_pac;
    }

    public function setTelefonoPac($telefono_pac)
    {
        $this->telefono_pac = $telefono_pac;
    }

    public function setCiudadPac($ciudad_pac)
    {
        $this->ciudad_pac = $ciudad_pac;
    }

    public function setDepartamentoPac($departamento_pac)
    {
        $this->departamento_pac = $departamento_pac;
    }

    public function setCodigoPostalPac($codigo_postal_pac)
    {
        $this->codigo_postal_pac = $codigo_postal_pac;
    }

    public function setSeguridadSocialPac($seguridad_social_pac)
    {
        $this->seguridad_social_pac = $seguridad_social_pac;
    }

    public function setIdMedico($id_medico)
    {
        $this->id_medico = $id_medico;
    }
}
