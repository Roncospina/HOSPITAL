<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT']. "/" . $rutaProyecto[1] .'/core/Connection.php';

class Empleado extends Connection
{
    private $documento;
    private $nombre;
    private $direccion;
    private $telefono;
    private $ciudad;
    private $departamento;
    private $codigoPostal;
    private $seguridadSocial;
    private $tipo;
    private $estadoVacaciones;

    public function __construct($doc=null,$nom=null,$dir=null,$tel=null,$ciu=null,$dep=null,$cod=null,$seg=null,$tip=null,$est=null)
    {
        $this->documento=$doc;
        $this->nombre=$nom;
        $this->direccion=$dir;
        $this->telefono=$tel;
        $this->ciudad=$ciu;
        $this->departamento=$dep;
        $this->codigoPostal=$cod;
        $this->seguridadSocial=$seg;
        $this->tipo=$tip;
        $this->estadoVacaciones=$est;
        parent::__construct();
    }

    //getters y setters
    public function getDocumento()
    {
        return $this->documento;
    }
    public function setDocumento($doc)
    {
        $this->documento=$doc;
        return $this;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nom)
    {
        $this->nombre=$nom;
        return $this;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function setDireccion($dir)
    {
        $this->direccion=$dir;
        return $this;
    }
    public function getTelefono()
    {
        return $this->telefono;
    }
    public function setTelefono($tel)
    {
        $this->telefono=$tel;
        return $this;
    }
    public function getCiudad()
    {
        return $this->ciudad;
    }
    public function setCiudad($ciu)
    {
        $this->ciudad=$ciu;
        return $this;
    }
    public function getDepartamento()
    {
        return $this->departamento;
    }
    public function setDepartamento($dep)
    {
        $this->departamento=$dep;
        return $this;
    }
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }
    public function setCodigoPostal($cod)
    {
        $this->codigoPostal=$cod;
        return $this;
    }
    public function getSeguridadSocial()
    {
        return $this->seguridadSocial;
    }
    public function setSeguridadSocial($seg)
    {
        $this->seguridadSocial=$seg;
        return $this;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tip)
    {
        $this->tipo=$tip;
        return $this;
    }
    public function getEstadoVacaciones()
    {
        return $this->estadoVacaciones;
    }
    public function setEstadoVacaciones($est)
    {
        $this->estadoVacaciones=$est;
        return $this;
    }

    //metodo para mostrar todos los empleados en una lista en el index
    public function list()
    {
        try
        {
            // FETCH_OBJ
            $sql=$this->dbConnection->prepare("SELECT * FROM empleados");

            //ejecutamos
            $sql->execute();
            $resultSet=null;

            //Ahora indicamos el fetch mode cuando llamamos a fetch:
            while($row=$sql->fetch(PDO::FETCH_OBJ))
            {
                $resultSet[]=$row;
            }

            return $resultSet;
        }catch(PDOException $ex){   
            echo $ex->getMessage();
            die();
        }
    }

    //metodo para insertar empleados
    public function create()
    {
        try
        {
            $sql = $this->dbConnection->prepare("INSERT INTO empleados (documento_emp,nombre_emp,direccion_emp,
            telefono_emp,ciudad_emp,departamento_emp,codigoPostal_emp,seguridadSocial_emp,tipo_emp,
            estadoVacaciones_emp)values(?,?,?,?,?,?,?,?,?,?)");
            $sql->bindParam(1, $this->documento);
            $sql->bindParam(2, $this->nombre);
            $sql->bindParam(3, $this->direccion);
            $sql->bindParam(4, $this->telefono);
            $sql->bindParam(5, $this->ciudad);
            $sql->bindParam(6, $this->departamento);
            $sql->bindParam(7, $this->codigoPostal);
            $sql->bindParam(8, $this->seguridadSocial);
            $sql->bindParam(9, $this->tipo);
            $sql->bindParam(10, $this->estadoVacaciones);
            //ejetecutamos
            $sql->execute();
            return $sql;
        }catch(PDOException $ex){
            echo $ex->getMessage();
            die();
        }
    }

    //metodo para actualizar empleado
    public function update($doc_nuevo)
{
    try
    {
        $documento = $this->documento;
        $nombre = $this->nombre;
        $direccion = $this->direccion;
        $telefono = $this->telefono;
        $ciudad = $this->ciudad;
        $departamento = $this->departamento;
        $codigoPostal = $this->codigoPostal;
        $seguridadSocial = $this->seguridadSocial;
        $tipo = $this->tipo;
        $estadoVacaciones = $this->estadoVacaciones;

        $sql = $this->dbConnection->prepare("UPDATE empleados SET documento_emp=:doc_nuevo,
        nombre_emp=:nombre,direccion_emp=:direccion,telefono_emp=:telefono,ciudad_emp=:ciudad,
        departamento_emp=:departamento,codigoPostal_emp=:codigoPostal,seguridadSocial_emp=:seguridadSocial,
        tipo_emp=:tipo,estadoVacaciones_emp=:estadoVacaciones
        WHERE documento_emp=:documento");
        $sql->bindParam(":doc_nuevo", $doc_nuevo);
        $sql->bindParam(":documento", $documento);
        $sql->bindParam(":nombre", $nombre);
        $sql->bindParam(":direccion", $direccion);
        $sql->bindParam(":telefono", $telefono);
        $sql->bindParam(":ciudad", $ciudad);
        $sql->bindParam(":departamento", $departamento);
        $sql->bindParam(":codigoPostal", $codigoPostal);
        $sql->bindParam(":seguridadSocial", $seguridadSocial);
        $sql->bindParam(":tipo", $tipo);
        $sql->bindParam(":estadoVacaciones", $estadoVacaciones);

        $sql->execute();
        return $sql;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
        die();
    }
}


    //metodo para eliminar empleados
    public function delete()
    {
        try
        {
            $sql = $this->dbConnection->prepare("DELETE FROM empleados where documento_emp=?");
            $sql->bindParam(1, $this->documento);
            $sql->execute();
            return $sql;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }

    }

    //metodo para ver todos los atributos del empleado
    public function view()
    {
        try {
            $sql = $this->dbConnection->prepare("SELECT * FROM empleados WHERE documento_emp =?");
            $sql->bindParam(1, $this->documento);
            $sql->execute();
            $resultSet = null;
            while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
                $resultSet = $row;
            }
            return $resultSet;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }
}
