<?php
date_default_timezone_set("America/Guayaquil");
session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];


if ($validar == null || $validar = '') {

    header("Location: ../includes/login.php");
    die();
}
$id = $_GET['id'];
//echo $id;
$conexion = mysqli_connect("localhost", "root", "", "imagenp1_Sistema");
$consulta = "SELECT * FROM recibo WHERE idRecibo = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen - Caja</title>
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://kit.fontawesome.com/4f37010be3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/yagamiStyle.css">

</head>

<body>


    <form action="../includes/_functions.php" method="POST">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

                            <br>
                            <br>
                            <h3 class="text-center text-white">Editar usuario</h3>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $usuario['nombreCli']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Contacto *</label><br>
                                <input type="number" name="contacto" id="contacto" class="form-control" placeholder="" value="<?php echo $usuario['contactoCli']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="form-label">Trabajador *</label>
                                <input type="text" id="trabajador" name="trabajador" class="form-control" value="<?php echo $usuario['trabajador']; ?>" required>
                                <input type="hidden" name="accion" value="editar_registro">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>


                            <br>

                            <div class="mb-3">

                                <button type="submit" class="btn btn-success">Editar</button>
                                <a href="caja.php" class="btn btn-danger">Cancelar</a>

                            </div>
                        </div>
                    </div>

    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </form>
</body>

</html>