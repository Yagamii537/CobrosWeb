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
    <link href="../assets/css/estilos.css" rel="stylesheet"> <!-- Enlace al archivo de estilos externo -->
</head>

<body>
    <!-- Encabezado con botón de menú móvil -->
    <div class="header">
        <button class="btn btn-light d-md-none" id="menu-toggle">
            <i class="bi bi-list"></i>
        </button>
        <h1>Sistema Cobros</h1>
        <div class="user-info d-none d-md-flex align-items-center">
            <span>Usuario</span>
            <i class="bi bi-person-circle ml-2"></i>
            <a class="btn btn-light btn-sm ml-2" href="sesion/cerrarSesion.php">Cerrar sesión</a>
        </div>
    </div>

    <!-- Barra lateral con módulos -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="d-flex align-items-center"><i class="bi bi-house mr-2"></i> Inicio</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-gear mr-2"></i> Configuración</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-people mr-2"></i> Usuarios</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-file-earmark-text mr-2"></i> Reportes</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-bell mr-2"></i> Notificaciones</a>
    </div>

    <div class="content" id="content">