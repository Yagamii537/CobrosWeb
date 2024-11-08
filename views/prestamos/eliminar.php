<?php
include '../../config/db.php';
include '../../controllers/PrestamoController.php';

$prestamoController = new PrestamoController($pdo);
$prestamoController->eliminarPrestamo($_GET['id']);

header("Location: index.php");
exit();
