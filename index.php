<?php

session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];

if ($validar == null || $validar = '') {

    //TODO redireccionamiento a login si no esta logeado 

    header("Location: views/login.php");
    die();
} else {
    header("Location: views/principal.php");
}
