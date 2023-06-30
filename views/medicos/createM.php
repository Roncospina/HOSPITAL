<?php
include '../header.php';
include_once '../../controllers/medicosTitularesController.php';

// Se crea una instancia de la clase MedicoController
$medico_obj = new MedicoController();

// Variable para almacenar el mensaje de la alerta
$alertMessage = '';

// Verificar si se ha enviado el formulario de creación
if (isset($_POST["create"])) {
    $nom = $_POST["nombre"];
    $dir = $_POST["direccion"];
    $tel = $_POST["telefono"];
    $ciu = $_POST["ciudad"];
    $dep = $_POST["departamento"];
    $cod = $_POST["codigoPostal"];
    $ced = $_POST["cedula"];
    $seg = $_POST["numSeguridadSocial"];
    $mat = $_POST["matriculaProfesional"];
    $tip = $_POST["tipoMedico"];

    // Validar que todos los campos estén llenos
    if (empty($nom) || empty($dir) || empty($tel) || empty($ciu) || empty($dep) || empty($cod) || empty($ced) || empty($seg) || empty($mat) || empty($tip)) {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
    } else {
        // Llamar a la función create del controlador
        $medico_obj->create($nom, $dir, $tel, $ciu, $dep, $cod, $ced, $seg, $mat, $tip);
        echo "<script>alert('Médico creado exitosamente');</script>";
        echo "<script>window.location.href = 'indexM.php';</script>";
        exit(); // Asegurar que el código se detenga después de la redirección
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Médico</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <div class="container">
        <h2>Crear Médico</h2>
    </div>
    <div class="container ml-5">
        <a class='btn btn-danger m-3' href='indexM.php' role='button'>Cancelar</a>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <!-- Primer grupo de campos -->
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Ingrese la dirección">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" placeholder="Ingrese el teléfono">
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" placeholder="Ingrese la ciudad">
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <input type="text" class="form-control" name="departamento" placeholder="Ingrese el departamento">
                    </div>
                    <!-- Fin del primer grupo de campos -->
            </div>
            <div class="col-md-6">
                <!-- Segundo grupo de campos -->
                <div class="form-group">
                    <label for="codigoPostal">Código Postal</label>
                    <input type="text" class="form-control" name="codigoPostal" placeholder="Ingrese el código postal">
                </div>
                <div class="form-group">
                    <label for="cedula">Cédula</label>
                    <input type="number" class="form-control" name="cedula" placeholder="Ingrese la cédula">
                </div>
                <div class="form-group">
                    <label for="numSeguridadSocial">Número de Seguridad Social</label>
                    <input type="number" class="form-control" name="numSeguridadSocial" placeholder="Ingrese el número de Seguridad Social">
                </div>
                <div class="form-group">
                    <label for="matriculaProfesional">Matrícula Profesional</label>
                    <input type="text" class="form-control" name="matriculaProfesional" placeholder="Ingrese la matrícula profesional">
                </div>
                <div class="form-group">
                    <label for="tipoMedico">Tipo de Médico</label>
                    <select name="tipoMedico" class="form-control">
                        <option selected>Seleccione una opción</option>
                        <option value="Titular">Titular</option>
                        <option value="Adjunto">Interino</option>
                        <option value="Residente">Sustituto</option>
                    </select>
                </div>
                <!-- Fin del segundo grupo de campos -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="create">Crear</button>
                </div>
                </form>


                <?php
                if (!empty($alertMessage)) {
                    echo "<script>alert('$alertMessage');</script>";
                }
                ?>
            </div>
        </div>

        <!-- </div> -->


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../../js/jquery-3.3.1.min.js"></script>
        <script src="../../js/popper.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
</body>

</html>