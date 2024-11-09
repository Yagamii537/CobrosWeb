<?php
date_default_timezone_set("America/Guayaquil");
session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];
if ($validar == null || $validar == '') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Sistema</title>
    <!-- Importar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Importar Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- ! //!REDIRECCION DESDE LA RAIZ DEL SISTEMA, SE COLOCA EL NOMBRE DE LA CARPETA PRINCIPAL SEGUIDO DE LA RUTA PARA
    !      //!EL CSS FUNCIONE EN TODO EL SISTEMA -->
    <link href="/cobros/assets/css/estilos.css" rel="stylesheet"> <!-- Enlace al archivo de estilos externo -->

</head>

<body>
    <!-- Encabezado con botón de menú móvil -->
    <div class="header">
        <button class="btn btn-light d-md-none" id="menu-toggle">
            <i class="bi bi-list"></i>
        </button>
        <h1>Sistema Cobros</h1>
        <div class="user-info d-none d-md-flex align-items-center">
            <span><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario'; ?></span>
            <i class="bi bi-person-circle ml-2"></i>
            <a class="btn btn-light btn-sm ml-2" href="sesion/cerrarSesion.php">Cerrar sesión</a>
        </div>
    </div>

    <!-- Barra lateral con módulos -->
    <div class="sidebar" id="sidebar">
        <a href="/cobros/views/principal.php" class="d-flex align-items-center"><i class="bi bi-house mr-2"></i> Inicio</a>

        <a href="/cobros/views/clientes/index.php" class="d-flex align-items-center"><i class="bi bi-people mr-2"></i> Clientes</a>
        <a href="/cobros/views/prestamos/index.php" class="d-flex align-items-center"><i class="bi bi-cash-coin mr-2"></i> Prestamos</a>

    </div>

    <div class="content" id="content">