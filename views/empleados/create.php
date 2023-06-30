<?php
include '../header.php';
include_once '../../controllers/empleadosController.php';

// Se crea una instancia de la clase EmpleadoController
$empleado_obj = new EmpleadoController();

// Variable para almacenar el mensaje de la alerta
$alertMessage = '';

// Verificar si se ha enviado el formulario de creación
if (isset($_POST["create"])) {
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

    // Validar que todos los campos estén llenos
    if (empty($doc) || empty($nom) || empty($dir) || empty($tel) || empty($ciu) || empty($dep) || empty($cod) || empty($seg) || empty($tip) || empty($est)) {
        echo "<script>alert('Por favor, complete todos los campos.');</script>";
    } else {
        // Llamar a la función create del controlador
        $empleado_obj->create($doc, $nom, $dir, $tel, $ciu, $dep, $cod, $seg, $tip, $est);
        echo "<script>alert('Empleado creado exitosamente');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit(); // Asegurar que el código se detenga después de la redirección
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empleado</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
</head>

<body>
    <div class="container">
        <h2>Crear Empleado</h2>
    </div>
    <div class="container ml-5">
        <a class='btn btn-danger m-3' href='index.php' role='button'>Cancelar</a>
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <!-- Primer grupo de campos -->
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="number" class="form-control" name="documento" placeholder="Ingrese el documento">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" class="form-control" name="direccion" placeholder="Ingrese la direccion">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" name="telefono" placeholder="Ingrese el telefono">
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" placeholder="Ingrese la ciudad">
                    </div>
                    <!-- Fin del primer grupo de campos -->
            </div>
            <div class="col-md-6">
                <!-- Segundo grupo de campos -->
                <div class="form-group">
                    <label for="departamento">Departamento</label>
                    <input type="text" class="form-control" name="departamento" placeholder="Ingrese el departamento">
                </div>
                <div class="form-group">
                    <label for="codigoPostal">Codigo Postal</label>
                    <input type="text" class="form-control" name="codigoPostal" placeholder="Ingrese el codigo postal">
                </div>
                <div class="form-group">
                    <label for="seguridadSocial">Numero de seguridad social</label>
                    <input type="number" class="form-control" name="seguridadSocial" placeholder="Ingrese el numero de la seguridad social">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo de empleado</label>
                    <select name="tipo" class="form-control">
                        <option selected>Seleccione una opcion</option>
                        <option value="ATS">ATS</option>
                        <option value="ATS de zona">ATS de zona</option>
                        <option value="Auxiliar de enfermeria">Auxiliar de enfermeria</option>
                        <option value="Celador">Celador</option>
                        <option value="Aministrativo">Aministrativo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estadoVacaciones">Seleccione el estado de vacaciones del empleado</label>
                    <select name="estadoVacaciones" class="form-control">
                        <option selected>Seleccione una opcion</option>
                        <option value="Programadas">Programadas</option>
                        <option value="Ya disfrutadas">Ya disfrutadas</option>
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