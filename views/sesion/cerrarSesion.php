<?php
include '../../config/db.php';
include '../../controllers/AuthController.php';

$authController = new AuthController($pdo); // Usa $pdo en lugar de $conexion
$authController->cerrarSesion();
