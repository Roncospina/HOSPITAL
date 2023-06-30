<?php
include '../header.php';
include_once '../../controllers/pacientesController.php';
include_once '../../controllers/medicosTitularesController.php';

// Verificar si se ha proporcionado la llave primaria del paciente
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Crear instancia del controlador y obtener los datos del paciente
    $paciente_obj = new PacienteController();
    $paciente = $paciente_obj->view($id);

    // Verificar si el paciente existe
    if ($paciente == null) {
        // Redirigir a la página de lista si el paciente no existe
        header("Location: indexP.php");
        exit();
    }
} else {
    // Redirigir a la página de lista si no se proporciona la llave primaria
    header("Location: indexP.php");
    exit();
}

// Variable para almacenar el mensaje de la alerta
$alertMessage = '';

// Verificar si se ha enviado el formulario de actualización
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $documento = $_POST["documento"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $ciudad = $_POST["ciudad"];
    $departamento = $_POST["departamento"];
    $codigoPostal = $_POST["codigoPostal"];
    $seguridadSocial = $_POST["seguridadSocial"];
    $idMedico = $_POST["idMedico"];

    // Llamar a la función update del controlador
    $paciente_obj->update($id, $documento, $nombre, $direccion, $telefono, $ciudad, $departamento, $codigoPostal, $seguridadSocial, $idMedico);

    // Establecer el mensaje de la alerta
    $alertMessage = 'Paciente actualizado exitosamente';
}

// Verificar si se debe redirigir al índice
if (!empty($alertMessage)) {
    echo "<script>alert('$alertMessage'); window.location.href = 'indexP.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Paciente</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <?php
    // Se crea una instancia de la clase MedicosTitularesController
    $medico_obj = new MedicoController();
    $medicos = $medico_obj->list();
    ?>
    <div class="container">
        <h2>Editar Paciente</h2>
    </div>
    <div class="container ml-5">
        <a class='btn btn-danger m-3' href='indexP.php' role='button'>Cancelar</a>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <!-- Primer grupo de campos -->
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="number" class="form-control" name="id" value="<?php echo $paciente->getIdPac(); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="text" class="form-control" name="documento" value="<?php echo $paciente->getDocumentoPac(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $paciente->getNombrePac(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" value="<?php echo $paciente->getDireccionPac(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="<?php echo $paciente->getTelefonoPac(); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Segundo grupo de campos -->
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" value="<?php echo $paciente->getCiudadPac(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <input type="text" class="form-control" name="departamento" value="<?php echo $paciente->getDepartamentoPac(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="codigoPostal">Código Postal</label>
                        <input type="text" class="form-control" name="codigoPostal" value="<?php echo $paciente->getCodigoPostalPac(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="seguridadSocial">Seguridad Social</label>
                        <input type="text" class="form-control" name="seguridadSocial" value="<?php echo $paciente->getSeguridadSocialPac(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="idMedico">Médico Titular</label>
                        <select name="idMedico" class="form-control">
                            <?php
                            foreach ($medicos as $medico) {
                                if ($medico->getIdMedico() == $paciente->getIdMedico()) {
                                    echo "<option value='" . $medico->getIdMedico() . "' selected>" . $medico->getNombre() . "</option>";
                                } else {
                                    echo "<option value='" . $medico->getIdMedico() . "'>" . $medico->getNombre() . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Actualizar</button>
        </form>
    </div>
</body>

</html>
