<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/Connection.php';

class Medico extends Connection
{
    private $id_medico;
    private $nombre;
    private $direccion;
    private $telefono;
    private $ciudad;
    private $departamento;
    private $codigoPostal;
    private $cedula;
    private $numSeguridadSocial;
    private $matriculaProfesional;
    private $tipoMedico;

    public function __construct($id = null, $nom = null, $dir = null, $tel = null, $ciu = null, $dep = null, $cod = null, $ced = null, $seg = null, $mat = null, $tip = null)
    {
        $this->id_medico = $id;
        $this->nombre = $nom;
        $this->direccion = $dir;
        $this->telefono = $tel;
        $this->ciudad = $ciu;
        $this->departamento = $dep;
        $this->codigoPostal = $cod;
        $this->cedula = $ced;
        $this->numSeguridadSocial = $seg;
        $this->matriculaProfesional = $mat;
        $this->tipoMedico = $tip;
        parent::__construct();
    }

    // Getters y setters
    public function getIdMedico()
    {
        return $this->id_medico;
    }

    public function setIdMedico($id)
    {
        $this->id_medico = $id;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nom)
    {
        $this->nombre = $nom;
        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($dir)
    {
        $this->direccion = $dir;
        return $this;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($tel)
    {
        $this->telefono = $tel;
        return $this;
    }

    public function getCiudad()
    {
        return $this->ciudad;
    }

    public function setCiudad($ciu)
    {
        $this->ciudad = $ciu;
        return $this;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($dep)
    {
        $this->departamento = $dep;
        return $this;
    }

    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal($cod)
    {
        $this->codigoPostal = $cod;
        return $this;
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function setCedula($ced)
    {
        $this->cedula = $ced;
        return $this;
    }

    public function getNumSeguridadSocial()
    {
        return $this->numSeguridadSocial;
    }

    public function setNumSeguridadSocial($seg)
    {
        $this->numSeguridadSocial = $seg;
        return $this;
    }

    public function getMatriculaProfesional()
    {
        return $this->matriculaProfesional;
    }

    public function setMatriculaProfesional($mat)
    {
        $this->matriculaProfesional = $mat;
        return $this;
    }

    public function getTipoMedico()
    {
        return $this->tipoMedico;
    }

    public function setTipoMedico($tip)
    {
        $this->tipoMedico = $tip;
        return $this;
    }
    public function create()
    {
        try {
            $sql = $this->dbConnection->prepare("INSERT INTO Medicos (nombre, direccion, telefono, ciudad, departamento, codigo_postal, cedula, num_seguridad_social, matricula_profesional, tipo_medico) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $sql->bindParam(1, $this->nombre);
            $sql->bindParam(2, $this->direccion);
            $sql->bindParam(3, $this->telefono);
            $sql->bindParam(4, $this->ciudad);
            $sql->bindParam(5, $this->departamento);
            $sql->bindParam(6, $this->codigoPostal);
            $sql->bindParam(7, $this->cedula);
            $sql->bindParam(8, $this->numSeguridadSocial);
            $sql->bindParam(9, $this->matriculaProfesional);
            $sql->bindParam(10, $this->tipoMedico);

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
            $sql = $this->dbConnection->prepare("UPDATE medicos SET nombre = ?, direccion = ?, telefono = ?, ciudad = ?, departamento = ?, codigo_postal = ?, cedula = ?, num_seguridad_social = ?, matricula_profesional = ?, tipo_medico = ? WHERE id_medico = ?");
            $sql->bindParam(1, $this->nombre);
            $sql->bindParam(2, $this->direccion);
            $sql->bindParam(3, $this->telefono);
            $sql->bindParam(4, $this->ciudad);
            $sql->bindParam(5, $this->departamento);
            $sql->bindParam(6, $this->codigoPostal);
            $sql->bindParam(7, $this->cedula);
            $sql->bindParam(8, $this->numSeguridadSocial);
            $sql->bindParam(9, $this->matriculaProfesional);
            $sql->bindParam(10, $this->tipoMedico);
            $sql->bindParam(11, $this->id_medico);

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
            $sql = $this->dbConnection->prepare("DELETE FROM Medicos WHERE id_medico = ?");
            $sql->bindParam(1, $this->id_medico);
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
            $sql = $this->dbConnection->prepare("SELECT * FROM medicos WHERE id_medico = ?");
            $sql->bindParam(1, $this->id_medico);
            $sql->execute();

            if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                $this->nombre = $row->nombre;
                $this->direccion = $row->direccion;
                $this->telefono = $row->telefono;
                $this->ciudad = $row->ciudad;
                $this->departamento = $row->departamento;
                $this->codigoPostal = $row->codigo_postal;
                $this->cedula = $row->cedula;
                $this->numSeguridadSocial = $row->num_seguridad_social;
                $this->matriculaProfesional = $row->matricula_profesional;
                $this->tipoMedico = $row->tipo_medico;
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
            $sql = $this->dbConnection->prepare("SELECT * FROM medicos");
            $sql->execute();

            $medicos = [];

            while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                $medico = new Medico(
                    $row->id_medico,
                    $row->nombre,
                    $row->direccion,
                    $row->telefono,
                    $row->ciudad,
                    $row->departamento,
                    $row->codigo_postal,
                    $row->cedula,
                    $row->num_seguridad_social,
                    $row->matricula_profesional,
                    $row->tipo_medico
                );

                $medicos[] = $medico;
            }

            return $medicos;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function select($id)
    {
        try {
            $sql = $this->dbConnection->prepare("SELECT * FROM Medicos WHERE idMedico = ?");
            $sql->bindParam(1, $id);
            $sql->execute();

            if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                $medico = new Medico(
                    $row->idMedico,
                    $row->nombre,
                    $row->direccion,
                    $row->telefono,
                    $row->ciudad,
                    $row->departamento,
                    $row->codigo_postal,
                    $row->cedula,
                    $row->num_seguridad_social,
                    $row->matricula_profesional,
                    $row->tipo_medico
                );
            } else {
                $medico = null;
            }

            return $medico;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }
}
