<?php
date_default_timezone_set("America/Guayaquil");
session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];


if ($validar == null || $validar = '') {

    header("Location: ../includes/login.php");
    die();
}


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

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="alert alert-danger text-center">
                    <p>¿Desea confirmar la eliminacion del registro?</p>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <form action="../includes/_functions.php" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="accion" value="eliminar_registro">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <input type="submit" name="" value="Eliminar" class=" btn btn-danger">
                                <a href="caja.php" class="btn btn-success">Cancelar</a>
                            </div>
                             <div class="form-group">
                                <label for="username">Clave de Confirmacion</label><br>
                                <input type="password" name="confir" id="confir" class="form-control" placeholder="Ingrese clave de confirmacion">
                            </div> 


                    </div>
                </div>



</body>

</html>