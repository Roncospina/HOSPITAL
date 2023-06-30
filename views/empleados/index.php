<?php
include '../header.php';
include_once '../../controllers/empleadosController.php';

// Verificar si se ha proporcionado la llave primaria del empleado a eliminar
if (isset($_GET['eliminar_documento'])) {
    $documento = $_GET['eliminar_documento'];

    // Crear instancia del controlador y eliminar el empleado
    $empleado_obj = new EmpleadoController();
    $eliminado = $empleado_obj->delete($documento);

    if ($eliminado) {
        // Redirigir a la página de lista después de la eliminación exitosa
        header("Location: index.php");
        exit();
    }
}

// Se crea una instancia de la clase EmpleadoController
$empleado_obj = new EmpleadoController();
// Se llama al método que lista a todos los empleados
$empleados = $empleado_obj->list();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <div class="container">
        <h1>Gestionar Empleados</h1>

        <div class="row">
            <div class="col">
                <a class='btn btn-success' href='create.php' role='button'>
                    Crear nuevo empleado
                </a>
            </div>
        </div><br>
    </div>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope>Documento</th>
                <th scope>Nombre</th>
                <th scope>Direccion</th>
                <th scope>Telefono</th>
                <th scope>Ciudad</th>
                <th scope>Departamento</th>
                <th scope>Codigo Postal</th>
                <th scope>Seguridad Social</th>
                <th scope>Tipo</th>
                <th scope>Vacaciones</th>
                <th colspan="2">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($empleados)) {
                foreach ($empleados as $item) {
                    echo "<tr>";
                    echo "<td>" . $item->documento_emp . "</td>";
                    echo "<td>" . $item->nombre_emp . "</td>";
                    echo "<td>" . $item->direccion_emp . "</td>";
                    echo "<td>" . $item->telefono_emp . "</td>";
                    echo "<td>" . $item->ciudad_emp . "</td>";
                    echo "<td>" . $item->departamento_emp . "</td>";
                    echo "<td>" . $item->codigoPostal_emp . "</td>";
                    echo "<td>" . $item->seguridadSocial_emp . "</td>";
                    echo "<td>" . $item->tipo_emp . "</td>";
                    echo "<td>" . $item->estadoVacaciones_emp . "</td>";
                    echo "<td>
                <a class='btn btn-primary' href='edit.php?documento=" . $item->documento_emp . "' role='button'>
                    <img src='../../images/editar.png' width='18'>
                </a>
            </td>";
                    echo "<td>
                    <a class='btn btn-danger' href='index.php?eliminar_documento=" . $item->documento_emp . "' role='button' onclick='return confirmarEliminacion()'>
                    <img src='../../images/basura.png' width='18'>
                </a>
            </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No hay empleados disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este empleado?");
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