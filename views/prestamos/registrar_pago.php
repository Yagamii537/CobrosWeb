<?php
include '../../config/db.php';
include '../../controllers/CuotaController.php';

$cuotaController = new CuotaController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cuota_id = $_POST['cuota_id'];
    $monto_pagado = $_POST['monto_pagado'];
    $metodo_pago = $_POST['metodo_pago'];
    $observaciones = $_POST['observaciones'];

    // Registrar el pago para la cuota
    $cuotaController->registrarPago($cuota_id, $monto_pagado, $metodo_pago, $observaciones);

    // Obtener el prestamo_id para redirigir correctamente
    $cuota = $cuotaController->obtenerCuotaPorId($cuota_id); // Nuevo método para obtener la cuota
    $prestamo_id = $cuota['prestamo_id'];

    // Redirigir a la tabla de cuotas del préstamo actual
    header("Location: cuotas.php?prestamo_id=" . $prestamo_id);
    exit();
}
