<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/models/empleadosModel.php';

class EmpleadoController extends Connection
{
    public function create($doc,$nom,$dir,$tel,$ciu,$dep,$cod,$seg,$tip,$est)
    {
    $empleado_obj = new Empleado($doc,$nom,$dir,$tel,$ciu,$dep,$cod,$seg,$tip,$est);
    $empleado = $empleado_obj->create();
    return $empleado;
    }

    public function update($doc,$doc_nuevo,$nom,$dir,$tel,$ciu,$dep,$cod,$seg,$tip,$est)
    {
        $empleado_obj = new Empleado($doc,$nom,$dir,$tel,$ciu,$dep,$cod,$seg,$tip,$est);
        $empleado = $empleado_obj->update($doc_nuevo);
        return $empleado;
    }

    public function delete($doc)
    {
       $empleado_obj = new Empleado($doc);
       $empleado=$empleado_obj->delete();
       return $empleado;
    }

    public function view($doc)
    {
        $empleado_obj = new Empleado($doc);
        $empleado = $empleado_obj->view();
        return $empleado;
    }

    public function list()
    {
        $empleado_obj = new Empleado();
        $empleados = $empleado_obj->list();
        return $empleados;
    }

    public function select($doc)
    {
        // FETCH_OBJ
        $sql = $this->dbConnection->prepare("SELECT * FROM empleados WHERE documento_emp = ?");
        $sql->bindParam(1, $doc);
        // Ejecutamos
        $sql->execute();

        // Ahora vamos a indicar el fetch mode cuando llamamos a fetch:
        if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            // Creacion de objeto de la clase paciente
            $emp_obj = new Empleado($row->documento, $row->nombre, $row->direccion, $row->telefono, $row->ciudad,
        $row->departamento,$row->codigoPostal,$row->seguridadSocial,$row->tipo,$row->estadoVacaciones);
        } else {
            $emp_obj = null;
        }
        return $emp_obj; // Se retorna el objeto de empleados
    }
}

?>