<?php
include '../../config/db.php';
include '../../controllers/PrestamoController.php';

$prestamoController = new PrestamoController($pdo);
$prestamo = $prestamoController->obtenerPrestamoPorId($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prestamoController->actualizarPrestamo($_GET['id'], $_POST['monto_total'], $_POST['interes'], $_POST['plazos'], $_POST['fecha_inicio'], $_POST['estado']);
    header("Location: index.php");
    exit();
}
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Editar Préstamo</h2>
    <form action="editar.php?id=<?php echo $prestamo['id']; ?>" method="POST">
        <div class="form-group">
            <label>Monto Total del Préstamo</label>
            <input type="number" step="0.01" name="monto_total" class="form-control" value="<?php echo $prestamo['monto_total']; ?>" required>
        </div>
        <div class="form-group">
            <label>Interés (%)</label>
            <input type="number" step="0.01" name="interes" class="form-control" value="<?php echo $prestamo['interes']; ?>" required>
        </div>
        <div class="form-group">
            <label>Plazos (en meses)</label>
            <input type="number" name="plazos" class="form-control" value="<?php echo $prestamo['plazos']; ?>" required>
        </div>
        <div class="form-group">
            <label>Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="<?php echo $prestamo['fecha_inicio']; ?>" required>
        </div>
        <div class="form-group">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="1" <?php echo $prestamo['estado'] == 1 ? 'selected' : ''; ?>>Activo</option>
                <option value="0" <?php echo $prestamo['estado'] == 0 ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Préstamo</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>