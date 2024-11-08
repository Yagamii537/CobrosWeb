<?php
include '../../config/db.php';
include '../../controllers/ClienteController.php';

$clienteController = new ClienteController($pdo);
$clienteController->eliminarCliente($_GET['id']);

header("Location: index.php");
exit();
