<?php
include '../../config/db.php';
include '../../controllers/ClienteController.php';

$clienteController = new ClienteController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clienteController->crearCliente($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['email']);
    header("Location: index.php");
    exit();
}
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Agregar Cliente</h2>
    <form action="crear.php" method="POST">
        <div class="form-group">
            <label>Cédula</label>
            <input type="text" name="cedula" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>