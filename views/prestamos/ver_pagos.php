<?php
include '../../config/db.php';
include '../../controllers/CuotaController.php';

$cuotaController = new CuotaController($pdo);

// Obtener el ID de la cuota desde los parámetros de la URL
$cuota_id = $_GET['cuota_id'] ?? null;

// Obtener los pagos de la cuota
$pagos = $cuotaController->obtenerPagosPorCuota($cuota_id);

// Obtener la información de la cuota para saber el `prestamo_id`
$cuota = $cuotaController->obtenerCuotaPorId($cuota_id); // Asegúrate de que este método esté en CuotaController
$prestamo_id = $cuota['prestamo_id'];
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Pagos de la Cuota #<?php echo $cuota_id; ?></h2>

    <?php if (empty($pagos)): ?>
        <p>No se han registrado pagos para esta cuota.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Monto Pagado</th>
                    <th>Fecha de Pago</th>
                    <th>Método de Pago</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagos as $pago): ?>
                    <tr>
                        <td><?php echo $pago['id']; ?></td>
                        <td><?php echo $pago['monto_pagado']; ?></td>
                        <td><?php echo $pago['fecha_pago']; ?></td>
                        <td><?php echo $pago['metodo_pago']; ?></td>
                        <td><?php echo $pago['observaciones']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Botón para volver a la lista de cuotas -->
    <a href="cuotas.php?prestamo_id=<?php echo $prestamo_id; ?>" class="btn btn-secondary">Volver a Cuotas</a>
</div>
<?php include '../../includes/footer.php'; ?>