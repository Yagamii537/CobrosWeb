<?php
include '../../config/db.php';
include '../../controllers/ClienteController.php';

$clienteController = new ClienteController($pdo);
$cliente = $clienteController->obtenerClientePorId($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clienteController->actualizarCliente($_GET['id'], $_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['direccion'], $_POST['telefono'], $_POST['email']);
    header("Location: index.php");
    exit();
}
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Editar Cliente</h2>
    <form action="editar.php?id=<?php echo $_GET['id']; ?>" method="POST">
        <div class="form-group">
            <label>Cédula</label>
            <input type="text" name="cedula" class="form-control" value="<?php echo $cliente['cedula']; ?>" required>
        </div>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $cliente['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="<?php echo $cliente['apellido']; ?>" required>
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="<?php echo $cliente['direccion']; ?>">
        </div>
        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="<?php echo $cliente['telefono']; ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $cliente['email']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<?php include '../../includes/footer.php'; ?>