<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/models/pacientesModel.php';

class PacienteController extends Connection
{
    public function create($documento, $nombre, $direccion, $telefono, $ciudad, $departamento, $codigoPostal, $seguridadSocial, $idMedico)
    {
        $paciente_obj = new Paciente(null, $documento, $nombre, $direccion, $telefono, $ciudad, $departamento, $codigoPostal, $seguridadSocial, $idMedico);
        $paciente = $paciente_obj->create();
        return $paciente;
    }

    public function update($id, $documento, $nombre, $direccion, $telefono, $ciudad, $departamento, $codigoPostal, $seguridadSocial, $idMedico)
    {
        $paciente_obj = new Paciente($id, $documento, $nombre, $direccion, $telefono, $ciudad, $departamento, $codigoPostal, $seguridadSocial, $idMedico);
        $paciente = $paciente_obj->update();
        return $paciente;
    }

    public function delete($id)
    {
        $paciente_obj = new Paciente($id);
        $paciente = $paciente_obj->delete();
        return $paciente;
    }

    public function view($id)
    {
        $paciente_obj = new Paciente($id);
        $paciente = $paciente_obj->view();
        return $paciente;
    }

    public function list()
    {
        $paciente_obj = new Paciente();
        $pacientes = $paciente_obj->list();
        return $pacientes;
    }

    public function select($id)
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM pacientes WHERE id_pac = ?");
        $sql->bindParam(1, $id);
        $sql->execute();

        if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $paciente_obj = new Paciente(
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
            $paciente_obj = null;
        }
        
        return $paciente_obj;
    }
}
?>
