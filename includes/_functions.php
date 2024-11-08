<?php

require_once("_db.php");

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'editar_registro':
            editar_registro();
            break;

        case 'eliminar_registro';
            eliminar_registro();

            break;
            //casos de registros

        case 'eliminar_registroReg';
            eliminar_registroReg();

            break;
        case 'acceso_user';
            acceso_user();
            break;
    }
}

function editar_registro()
{
    include("_db.php");
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $contacto = $_POST['contacto'];
    $trabajador = $_POST['trabajador'];
    $consulta = "UPDATE recibo SET nombreCli = '$nombre', contactoCli = '$contacto', trabajador = '$trabajador' WHERE idRecibo = '$id' ";

    mysqli_query($conexion, $consulta);


    header('Location: ../views/caja.php');
}

function eliminar_registro()
{
    include("_db.php");
    extract($_POST);
    $id = $_POST['id'];
    $confir = $_POST['confir'];
    $hash = hash("sha256", $confir);

    $verf = "SELECT * FROM empleado WHERE confir='$hash' ";
    $resultado = mysqli_query($conexion, $verf);



    if (mysqli_num_rows($resultado) > 0) {
        $consulta = "DELETE FROM recibo WHERE idRecibo= $id";
        mysqli_query($conexion, $consulta);
        header('Location: ../views/caja.php');
    } else {
        $url = "Location: ../views/eliminarRecibo.php?id=" . $id;
        header($url);
    }
}

function eliminar_registroReg()
{
    include("_db.php");
    extract($_POST);
    $id = $_POST['id'];
    $consulta = "DELETE FROM recibo WHERE idRecibo= $id";

    mysqli_query($conexion, $consulta);


    header('Location: ../views/registro.php');
}

function acceso_user()
{
    include("_db.php");
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $hash = hash("sha256", $password);
    session_start();
    $_SESSION['nombre'] = $nombre;



    $consulta = "SELECT * FROM empleado WHERE usuario='$nombre' AND clave='$hash'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas = mysqli_fetch_array($resultado);


    if ($filas['rol'] == 1) { //? admin

        header('Location: ../views/principal.php');
        //header('Location: ../views/user.php');

    } else if ($filas['rol'] == 2) { //lector
        //header('Location: ../views/lector.php');
    } else {

        header('Location: login.php');
        session_destroy();
    }
}
