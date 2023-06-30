<?php
include '../header.php';
include_once '../../controllers/medicosTitularesController.php';
include_once '../../controllers/pacientesController.php';

// Verificar si se ha enviado el parámetro de eliminar
if (isset($_GET['eliminar_paciente'])) {
    $id_paciente = $_GET['eliminar_paciente'];

    // Llamar a la función delete del controlador para eliminar al paciente
    $paciente_obj = new PacienteController();
    $paciente_obj->delete($id_paciente);

    // Redirigir a la página de lista después de la eliminación
    header("Location: indexP.php");
    exit();
}

// Se crea una instancia de la clase PacienteController
$paciente_obj = new PacienteController();

// Se llama al método que lista a todos los pacientes
$pacientes = $paciente_obj->list();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <div class="container">
        <h1>Gestionar Pacientes</h1>

        <div class="row">
            <div class="col">
                <a class='btn btn-success' href='createP.php' role='button'>
                    Crear nuevo paciente
                </a>
            </div>
        </div><br>
    </div>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Documento</th>
                <th scope="col">Nombre</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Ciudad</th>
                <th scope="col">Departamento</th>
                <th scope="col">Código Postal</th>
                <th scope="col">Seguridad Social</th>
                <th scope="col">Medico Encargado</th>
                <th colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($pacientes)) {
                foreach ($pacientes as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdPac() . "</td>";
                    echo "<td>" . $item->getDocumentoPac() . "</td>";
                    echo "<td>" . $item->getNombrePac() . "</td>";
                    echo "<td>" . $item->getDireccionPac() . "</td>";
                    echo "<td>" . $item->getTelefonoPac() . "</td>";
                    echo "<td>" . $item->getCiudadPac() . "</td>";
                    echo "<td>" . $item->getDepartamentoPac() . "</td>";
                    echo "<td>" . $item->getCodigoPostalPac() . "</td>";
                    echo "<td>" . $item->getSeguridadSocialPac() . "</td>";
                    echo "<td>";

                    // Obtener el objeto de médico correspondiente
                    $medico_obj = new MedicoController();
                    $medico = $medico_obj->getMedicoById($item->getIdMedico());

                    // Mostrar el nombre del médico en lugar de su ID
                    if ($medico) {
                        echo $medico->getNombre();
                    } else {
                        echo "No encontrado";
                    }

                    echo "</td>";
                    echo "<td>
            <a class='btn btn-primary' href='editP.php?id=" . $item->getIdPac() . "' role='button'>
                <img src='../../images/editar.png' width='18'>
            </a>
        </td>";
                    echo "<td>
            <a class='btn btn-danger' href='indexP.php?eliminar_paciente=" . $item->getIdPac() . "' role='button' onclick='return confirmarEliminacion()'>
                <img src='../../images/basura.png' width='18'>
            </a>
        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No hay pacientes disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar a este paciente?");
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