<?php
include '../../config/db.php';
include '../../controllers/PrestamoController.php';

$prestamoController = new PrestamoController($pdo);

// Verificar si se solicitó mostrar todos los préstamos activos
$cliente_id = $_GET['cliente_id'] ?? null;
$mostrar_todos = isset($_GET['mostrar_todos']);

// Obtener préstamos activos (sin filtro) o préstamos de un cliente específico
$prestamos = $mostrar_todos
    ? $prestamoController->obtenerPrestamosActivos()
    : ($cliente_id ? $prestamoController->obtenerPrestamosPorCliente($cliente_id) : $prestamoController->obtenerPrestamos());
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Lista de Préstamos</h2>

    <!-- Campo de búsqueda de cliente -->
    <div class="form-group">
        <h4>Buscar Cliente</h4>
        <div class="input-group">
            <input type="hidden" id="cliente_id">
            <input type="text" class="form-control" id="cliente_nombre" placeholder="Seleccione un cliente" readonly>
            <div class="input-group-append">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#buscarClienteModal">Buscar</button>
            </div>
        </div>
    </div>

    <!-- Botones para mostrar todos los préstamos activos y agregar un nuevo préstamo -->
    <a href="index.php?mostrar_todos=1" class="btn btn-info mb-3">Mostrar Préstamos</a>
    <a href="crear.php" class="btn btn-primary mb-3">Agregar Préstamo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente ID</th>
                <th>Monto Total</th>
                <th>Interés</th>
                <th>Plazos</th>
                <th>Fecha de Inicio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prestamos as $prestamo): ?>
                <tr>
                    <td><?php echo $prestamo['id']; ?></td>
                    <td><?php echo $prestamo['cliente_id']; ?></td>
                    <td><?php echo $prestamo['monto_total']; ?></td>
                    <td><?php echo $prestamo['interes']; ?></td>
                    <td><?php echo $prestamo['plazos']; ?></td>
                    <td><?php echo $prestamo['fecha_inicio']; ?></td>
                    <td><?php echo $prestamo['estado'] ? 'Activo' : 'Completado'; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $prestamo['id']; ?>" class="btn btn-success btn-sm">
                            <i class="bi bi-pencil-square"></i></a>
                        <a href="eliminar.php?id=<?php echo $prestamo['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este préstamo?');"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal para Buscar Cliente -->
<div class="modal fade" id="buscarClienteModal" tabindex="-1" role="dialog" aria-labelledby="buscarClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buscarClienteLabel">Buscar Cliente por Cédula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="buscarClienteForm">
                    <div class="form-group">
                        <label for="cedula">Cédula del Cliente</label>
                        <input type="text" class="form-control" id="cedula" placeholder="Ingrese la cédula">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="buscarCliente()">Buscar</button>
                </form>
                <div id="clienteInfo" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Función para buscar cliente por cédula
    function buscarCliente() {
        var cedula = document.getElementById("cedula").value;
        if (cedula) {
            fetch(`buscar_cliente.php?cedula=${cedula}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById("clienteInfo").innerHTML = "<p class='text-danger'>Cliente no encontrado</p>";
                    } else {
                        document.getElementById("clienteInfo").innerHTML = `
                        <p><strong>Nombre:</strong> ${data.nombre} ${data.apellido}</p>
                        <p><strong>Dirección:</strong> ${data.direccion}</p>
                        <button type="button" class="btn btn-success" onclick="seleccionarCliente(${data.id}, '${data.nombre} ${data.apellido}')">Seleccionar Cliente</button>
                    `;
                    }
                });
        }
    }

    // Función para seleccionar el cliente, actualizar la tabla y cerrar el modal
    function seleccionarCliente(id, nombre) {
        document.getElementById("cliente_id").value = id;
        document.getElementById("cliente_nombre").value = nombre;
        window.location.href = `index.php?cliente_id=${id}`; // Recarga la página con el cliente seleccionado
        $('#buscarClienteModal').modal('hide'); // Cierra el modal
    }
</script>

<?php include '../../includes/footer.php'; ?>