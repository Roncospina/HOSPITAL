<?php
include '../header.php';
include_once '../../controllers/empleadosController.php';

// Verificar si se ha proporcionado la llave primaria del empleado
if (isset($_GET['documento'])) {
    $documento = $_GET['documento'];

    // Crear instancia del controlador y obtener los datos del empleado
    $empleado_obj = new EmpleadoController();
    $empleado = $empleado_obj->view($documento);

    // Verificar si el empleado existe
    if ($empleado == null) {
        // Redirigir a la página de lista si el empleado no existe
        header("Location: index.php");
        exit();
    }
} else {
    // Redirigir a la página de lista si no se proporciona la llave primaria
    header("Location: index.php");
    exit();
}

// Variable para almacenar el mensaje de la alerta
$alertMessage = '';

// Verificar si se ha enviado el formulario de actualización
if (isset($_POST["update"])) {
    $doc = $_POST["documento"];
    $nom = $_POST["nombre"];
    $dir = $_POST["direccion"];
    $tel = $_POST["telefono"];
    $ciu = $_POST["ciudad"];
    $dep = $_POST["departamento"];
    $cod = $_POST["codigoPostal"];
    $seg = $_POST["seguridadSocial"];
    $tip = $_POST["tipo"];
    $est = $_POST["estadoVacaciones"];

    // Llamar a la función update del controlador
    $empleado_obj->update($doc, $doc, $nom, $dir, $tel, $ciu, $dep, $cod, $seg, $tip, $est);

    // Establecer el mensaje de la alerta
    $alertMessage = 'Empleado actualizado exitosamente';
}

// Verificar si se debe redirigir al índice
if (!empty($alertMessage)) {
    echo "<script>alert('$alertMessage'); window.location.href = 'index.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <?php
    // Se crea una instancia de la clase EmpleadoController
    $empleado_obj = new EmpleadoController();
    ?>
    <div class="container">
        <h2>Editar Empleado</h2>
    </div>
    <div class="container ml-5">
        <a class='btn btn-danger m-3' href='index.php' role='button'>Cancelar</a>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <!-- Primer grupo de campos -->
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="number" class="form-control" name="documento" value="<?php echo $empleado->documento_emp; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $empleado->nombre_emp; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" name="direccion" value="<?php echo $empleado->direccion_emp; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" name="telefono" value="<?php echo $empleado->telefono_emp; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" value="<?php echo $empleado->ciudad_emp; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Segundo grupo de campos -->
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <input type="text" class="form-control" name="departamento" value="<?php echo $empleado->departamento_emp; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="codigoPostal">Codigo Postal</label>
                        <input type="text" class="form-control" name="codigoPostal" value="<?php echo $empleado->codigoPostal_emp; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="seguridadSocial">Numero de seguridad social</label>
                        <input type="number" class="form-control" name="seguridadSocial" value="<?php echo $empleado->seguridadSocial_emp; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de empleado</label>
                        <select name="tipo" class="form-control">
                            <option value="ATS" <?php if ($empleado->tipo_emp == "ATS") echo "selected"; ?>>ATS</option>
                            <option value="ATS de zona" <?php if ($empleado->tipo_emp == "ATS de zona") echo "selected"; ?>>ATS de zona</option>
                            <option value="Auxiliar de enfermeria" <?php if ($empleado->tipo_emp == "Auxiliar de enfermeria") echo "selected"; ?>>Auxiliar de enfermeria</option>
                            <option value="Celador" <?php if ($empleado->tipo_emp == "Celador") echo "selected"; ?>>Celador</option>
                            <option value="Aministrativo" <?php if ($empleado->tipo_emp == "Aministrativo") echo "selected"; ?>>Aministrativo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="estadoVacaciones">Seleccione el estado de vacaciones del empleado</label>
                        <select name="estadoVacaciones" class="form-control">
                            <option value="Programadas" <?php if ($empleado->estadoVacaciones_emp == "Programadas") echo "selected"; ?>>Programadas</option>
                            <option value="Ya disfrutadas" <?php if ($empleado->estadoVacaciones_emp == "Ya disfrutadas") echo "selected"; ?>>Ya disfrutadas</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary " name="update">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST["update"])) {
        $doc = $_POST["documento"];
        $nom = $_POST["nombre"];
        $dir = $_POST["direccion"];
        $tel = $_POST["telefono"];
        $ciu = $_POST["ciudad"];
        $dep = $_POST["departamento"];
        $cod = $_POST["codigoPostal"];
        $seg = $_POST["seguridadSocial"];
        $tip = $_POST["tipo"];
        $est = $_POST["estadoVacaciones"];

        // Llamar a la función update del controlador
        $empleado_obj->update($doc, $doc, $nom, $dir, $tel, $ciu, $dep, $cod, $seg, $tip, $est);
        echo "<script>alert('Empleado actualizado exitosamente')</script>";

        header("Location: index.php");
        exit();
    }

    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>