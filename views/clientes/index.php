<?php
include '../config/db.php';

// Obtener todos los clientes
$query = $pdo->query("SELECT * FROM clientes");
$clientes = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../includes/header.php'; ?>
<div class="container">
    <h2>Lista de Clientes</h2>
    <a href="crear.php" class="btn btn-primary">Agregar Cliente</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $cliente['apellido']; ?></td>
                    <td><?php echo $cliente['direccion']; ?></td>
                    <td><?php echo $cliente['telefono']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-warning">Editar</a>
                        <a href="eliminar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este cliente?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?>