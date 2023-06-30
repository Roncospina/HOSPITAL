<?php
include '../header.php';
include_once '../../controllers/medicosTitularesController.php';
// Verificar si se ha enviado el parámetro de eliminar
if (isset($_GET['eliminar_medico'])) {
    $id_medico = $_GET['eliminar_medico'];

    // Llamar a la función delete del controlador para eliminar el médico
    $medico_obj = new MedicoController();
    $medico_obj->delete($id_medico);

    // Redirigir a la página de lista después de la eliminación
    header("Location: indexM.php");
    exit();
}
// Se crea una instancia de la clase MedicosController
$medico_obj = new MedicoController();
// Se llama al método que lista a todos los médicos
$medicos = $medico_obj->list();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médicos</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <div class="container">
        <h1>Gestionar Médicos</h1>

        <div class="row">
            <div class="col">
                <a class='btn btn-success' href='createM.php' role='button'>
                    Crear nuevo médico
                </a>
            </div>
        </div><br>
    </div>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope>ID</th>
                <th scope>Nombre</th>
                <th scope>Dirección</th>
                <th scope>Telefono</th>
                <th scope>Ciudad</th>
                <th scope>Departamento</th>
                <th scope>Código Postal</th>
                <th scope>Cédula</th>
                <th scope>Número Seguridad Social</th>
                <th scope>Matrícula Profesional</th>
                <th scope>Tipo Médico</th>
                <th colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($medicos)) {
                foreach ($medicos as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->getIdMedico() . "</td>";
                    echo "<td>" . $item->getNombre() . "</td>";
                    echo "<td>" . $item->getDireccion() . "</td>";
                    echo "<td>" . $item->getTelefono() . "</td>";
                    echo "<td>" . $item->getCiudad() . "</td>";
                    echo "<td>" . $item->getDepartamento() . "</td>";
                    echo "<td>" . $item->getCodigoPostal() . "</td>";
                    echo "<td>" . $item->getCedula() . "</td>";
                    echo "<td>" . $item->getNumSeguridadSocial() . "</td>";
                    echo "<td>" . $item->getMatriculaProfesional() . "</td>";
                    echo "<td>" . $item->getTipoMedico() . "</td>";
                    echo "<td>
                <a class='btn btn-primary' href='editM.php?id=" . $item->getIdMedico() . "' role='button'>
                    <img src='../../images/editar.png' width='18'>
                </a>
            </td>";
                    echo "<td>
                    <a class='btn btn-danger' href='indexM.php?eliminar_medico=" . $item->getIdMedico() . "' role='button' onclick='return confirmarEliminacion()'>
                    <img src='../../images/basura.png' width='18'>
                </a>
            </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No hay médicos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este médico?");
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
