<?php
include '../config/db.php';            // Conexión a la base de datos con $pdo
include '../controllers/AuthController.php';

$authController = new AuthController($pdo);
$authController->accesoUser();
