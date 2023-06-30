<?php
include '../header.php';
include_once '../../controllers/medicosTitularesController.php';

// Verificar si se ha proporcionado la llave primaria del médico
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Crear instancia del controlador y obtener los datos del médico
    $medico_obj = new MedicoController();
    $medico = $medico_obj->view($id);

    // Verificar si el médico existe
    if ($medico == null) {
        // Redirigir a la página de lista si el médico no existe
        header("Location: indexM.php");
        exit();
    }
} else {
    // Redirigir a la página de lista si no se proporciona la llave primaria
    header("Location: indexM.php");
    exit();
}

// Variable para almacenar el mensaje de la alerta
$alertMessage = '';

// Verificar si se ha enviado el formulario de actualización
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $ciudad = $_POST["ciudad"];
    $departamento = $_POST["departamento"];
    $codigoPostal = $_POST["codigoPostal"];
    $cedula = $_POST["cedula"];
    $seguridadSocial = $_POST["seguridadSocial"];
    $matriculaProfesional = $_POST["matriculaProfesional"];
    $tipoMedico = $_POST["tipoMedico"];

    // Llamar a la función update del controlador
    $medico_obj->update($id, $nombre, $direccion, $telefono, $ciudad, $departamento, $codigoPostal, $cedula, $seguridadSocial, $matriculaProfesional, $tipoMedico);

    // Establecer el mensaje de la alerta
    $alertMessage = 'Médico actualizado exitosamente';
}

// Verificar si se debe redirigir al índice
if (!empty($alertMessage)) {
    echo "<script>alert('$alertMessage'); window.location.href = 'indexM.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Médico</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <?php
    // Se crea una instancia de la clase MedicosTitularesController
    $medico_obj = new MedicoController();
    ?>
    <div class="container">
        <h2>Editar Médico</h2>
    </div>
    <div class="container ml-5">
        <a class='btn btn-danger m-3' href='index.php' role='button'>Cancelar</a>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <!-- Primer grupo de campos -->
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="number" class="form-control" name="id" value="<?php echo $medico->getIdMedico(); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $medico->getNombre(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="<?php echo $medico->getDireccion(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="<?php echo $medico->getTelefono(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" value="<?php echo $medico->getCiudad(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <input type="text" class="form-control" name="departamento" value="<?php echo $medico->getDepartamento(); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Segundo grupo de campos -->
                    <div class="form-group">
                        <label for="codigoPostal">Código Postal</label>
                        <input type="text" class="form-control" name="codigoPostal" value="<?php echo $medico->getCodigoPostal(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" name="cedula" value="<?php echo $medico->getCedula(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="seguridadSocial">Número de Seguridad Social</label>
                        <input type="text" class="form-control" name="seguridadSocial" value="<?php echo $medico->getNumSeguridadSocial(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="matriculaProfesional">Matrícula Profesional</label>
                        <input type="text" class="form-control" name="matriculaProfesional" value="<?php echo $medico->getMatriculaProfesional(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tipoMedico">Tipo de Médico</label>
                        <select name="tipoMedico" class="form-control">
                            <option value="" selected>Seleccione un tipo de médico</option>
                            <?php
                            $tiposMedico = $medico_obj->getTiposMedico(); // Obtener los tipos de médico desde el controlador
                            foreach ($tiposMedico as $tipo) {
                                $selected = ($tipo === $medico->getTipoMedico()) ? 'selected' : '';
                                echo "<option value='$tipo' $selected>$tipo</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary" name="update">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>