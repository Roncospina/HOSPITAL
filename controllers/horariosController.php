<?php
$rutaCarpeta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$rutaProyecto = explode("/", $rutaCarpeta);

require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/core/Connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $rutaProyecto[1] . '/models/horarioModel.php';


class HorariosController extends Connection
{
    public function create($id_medico, $dia_semana, $hora_inicio, $hora_fin)
    {
        $horario_obj = new Horario($id_medico, $dia_semana, $hora_inicio, $hora_fin);
        $horario = $horario_obj->create();
        return $horario;
    }

    public function update($id_horario, $id_medico, $dia_semana, $hora_inicio, $hora_fin)
    {
        $horario_obj = new Horario($id_medico, $dia_semana, $hora_inicio, $hora_fin);
        $horario = $horario_obj->update($id_horario);
        return $horario;
    }

    public function delete($id_horario)
    {
        $horario_obj = new Horario();
        $horario = $horario_obj->delete($id_horario);
        return $horario;
    }

    public function view($id_horario)
    {
        $horario_obj = new Horario();
        $horario = $horario_obj->view($id_horario);
        return $horario;
    }

    public function list()
    {
        $horario_obj = new Horario();
        $horarios = $horario_obj->list();
        return $horarios;
    }

    public function select($id_horario)
    {
        // FETCH_OBJ
        $sql = $this->dbConnection->prepare("SELECT * FROM horarios WHERE id_horario = ?");
        $sql->bindParam(1, $id_horario);
        // Ejecutamos
        $sql->execute();

        // Ahora vamos a indicar el fetch mode cuando llamamos a fetch:
        if ($row = $sql->fetch(PDO::FETCH_OBJ)) {
            // Creacion de objeto de la clase Horario
            $horario_obj = new Horario($row->id_medico, $row->dia_semana, $row->hora_inicio, $row->hora_fin);
        } else {
            $horario_obj = null;
        }
        return $horario_obj; // Se retorna el objeto de horario
    }
}
?>
