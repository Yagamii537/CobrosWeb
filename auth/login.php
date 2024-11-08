<?php
// Incluir la configuración de base de datos y el controlador de autenticación
include '../config/db.php';
include '../controllers/AuthController.php';

// Crear una instancia del controlador de autenticación
$authController = new AuthController($conexion);

// Llamar a la función de acceso del usuario
$authController->accesoUser();
