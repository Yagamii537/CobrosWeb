<?php
include '../../config/db.php';
include '../../controllers/ClienteController.php';

$clienteController = new ClienteController($pdo);
$clientes = $clienteController->obtenerClientes();
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Lista de Clientes</h2>
    <a href="crear.php" class="btn btn-primary mb-3">Agregar Cliente</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['cedula']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $cliente['apellido']; ?></td>
                    <td><?php echo $cliente['direccion']; ?></td>
                    <td><?php echo $cliente['telefono']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $cliente['fecha_registro']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-success mr-2"><i class="bi bi-pencil-square"></i></a>
                        <a href="eliminar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este cliente?');"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../../includes/footer.php'; ?>