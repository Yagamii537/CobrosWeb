<?php
include '../../config/db.php';
include '../../controllers/CuotaController.php';

$cuotaController = new CuotaController($pdo);
$prestamo_id = $_GET['prestamo_id'];
$cuotas = $cuotaController->obtenerCuotasPorPrestamo($prestamo_id);
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Cuotas del Préstamo #<?php echo $prestamo_id; ?></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cuota</th>
                <th>Fecha de Vencimiento</th>
                <th>Monto</th>
                <th>Interés</th>
                <th>Saldo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cuotas as $cuota): ?>
                <tr>
                    <td><?php echo $cuota['numero_cuota']; ?></td>
                    <td><?php echo $cuota['fecha_vencimiento']; ?></td>
                    <td><?php echo $cuota['monto']; ?></td>
                    <td><?php echo $cuota['interes']; ?></td>
                    <td><?php echo $cuota['monto']; ?></td>
                    <td><?php echo $cuota['estado'] ? 'Pendiente' : 'Pagada'; ?></td>
                    <td>
                        <?php if ($cuota['estado']): ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#pagoModal" onclick="setCuotaId(<?php echo $cuota['id']; ?>)">Registrar Pago</button>
                        <?php endif; ?>
                        <a href="ver_pagos.php?cuota_id=<?php echo $cuota['id']; ?>" class="btn btn-info">Ver Pagos</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para Registrar Pago -->
<div class="modal fade" id="pagoModal" tabindex="-1" role="dialog" aria-labelledby="pagoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pagoModalLabel">Registrar Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="registrar_pago.php" method="POST">
                    <input type="hidden" name="cuota_id" id="cuota_id">
                    <div class="form-group">
                        <label for="monto_pagado">Monto del Pago</label>
                        <input type="number" step="0.01" name="monto_pagado" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="metodo_pago">Método de Pago</label>
                        <input type="text" name="metodo_pago" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observaciones" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Pago</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Establece el ID de la cuota en el modal
    function setCuotaId(id) {
        document.getElementById('cuota_id').value = id;
    }
</script>

<?php include '../../includes/footer.php'; ?>