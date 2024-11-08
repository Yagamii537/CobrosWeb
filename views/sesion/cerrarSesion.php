<?php
include '../../config/db.php';
include '../../controllers/AuthController.php';

$authController = new AuthController($conexion);
$authController->cerrarSesion();
