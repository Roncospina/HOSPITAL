<?php
include '../header.php';
include_once '../../controllers/horariosController.php';

// Verificar si se ha enviado el parámetro de eliminar
if (isset($_GET['eliminar_horario'])) {
    $id_horario = $_GET['eliminar_horario'];

    // Llamar a la función delete del controlador para eliminar el horario
    $horario_obj = new HorariosController();
    $horario_obj->delete($id_horario);

    // Redirigir a la página de lista después de la eliminación
    header("Location: indexH.php");
    exit();
}

// Se crea una instancia de la clase HorariosController
$horario_obj = new HorariosController();
// Se llama al método que lista todos los horarios
$horarios = $horario_obj->list();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <div class="container">
        <h1>Gestionar Horarios</h1>

        <div class="row">
            <div class="col">
                <a class='btn btn-success' href='createH.php' role='button'>
                    Crear nuevo horario
                </a>
            </div>
        </div><br>
    </div>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Médico</th>
                <th scope="col">Día de la semana</th>
                <th scope="col">Hora de inicio</th>
                <th scope="col">Hora de fin</th>
                <th colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($horarios)) {
                foreach ($horarios as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdHorario() . "</td>";
                    echo "<td>" . $item->getMedico() . "</td>"; // Aquí se muestra el nombre del médico
                    echo "<td>" . $item->getDiaSemana() . "</td>";
                    echo "<td>" . $item->getHoraInicio() . "</td>";
                    echo "<td>" . $item->getHoraFin() . "</td>";
                    echo "<td>
                        <a class='btn btn-primary' href='editH.php?id=" . $item->getIdHorario() . "' role='button'>
                            <img src='../../images/editar.png' width='18'>
                        </a>
                    </td>";
                    echo "<td>
                        <a class='btn btn-danger' href='indexH.php?eliminar_horario=" . $item->getIdHorario() . "' role='button' onclick='return confirmarEliminacion()'>
                            <img src='../../images/basura.png' width='18'>
                        </a>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No hay horarios disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este horario?");
        }
    </script>

    <br>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>