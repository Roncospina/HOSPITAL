<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/models/Medico.php';

class MedicoController extends Connection
{
    public function create($nom, $dir, $tel, $ciu, $dep, $cod, $ced, $seg, $mat, $tip)
    {
        $medico_obj = new Medico(null, $nom, $dir, $tel, $ciu, $dep, $cod, $ced, $seg, $mat, $tip);
        $medico = $medico_obj->create();
        return $medico;
    }

    public function update($id, $nom, $dir, $tel, $ciu, $dep, $cod, $ced, $seg, $mat, $tip)
    {
        $medico_obj = new Medico($id, $nom, $dir, $tel, $ciu, $dep, $cod, $ced, $seg, $mat, $tip);
        $medico = $medico_obj->update();
        return $medico;
    }

    public function delete($id)
    {
        $medico_obj = new Medico($id);
        $medico = $medico_obj->delete();
        return $medico;
    }

    public function view($id)
    {
        $medico_obj = new Medico($id);
        $medico = $medico_obj->view();
        return $medico;
    }

    public function list()
    {
        $medico_obj = new Medico();
        $medicos = $medico_obj->list();
        return $medicos;
    }

    public function select($id)
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM medicos WHERE id_medico = ?");
        $sql->bindParam(1, $id);
        $sql->execute();

        if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $medico_obj = new Medico(
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
        } else {
            $medico_obj = null;
        }

        return $medico_obj;
    }
    public function getMedicoById($id)
    {
        $sql = $this->dbConnection->prepare("SELECT * FROM medicos WHERE id_medico = ?");
        $sql->bindParam(1, $id);
        $sql->execute();

        if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            $medico_obj = new Medico(
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
        } else {
            $medico_obj = null;
        }

        return $medico_obj;
    }
    public function getTiposMedico() {
        // Define los tipos de médico aquí
        $tipos = array(
            'Titular',
            'Interino',
            'Sustituto'
        );

        return $tipos;
    }
}
