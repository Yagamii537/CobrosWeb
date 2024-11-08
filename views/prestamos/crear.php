<?php
include '../../config/db.php';
include '../../controllers/PrestamoController.php';

$prestamoController = new PrestamoController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prestamoController->crearPrestamo($_POST['cliente_id'], $_POST['monto_total'], $_POST['interes'], $_POST['plazos'], $_POST['fecha_inicio'], $_POST['estado']);
    header("Location: index.php");
    exit();
}
?>

<?php include '../../includes/header.php'; ?>
<div class="container mt-4">
    <h2>Agregar Préstamo</h2>
    <form action="crear.php" method="POST">
        <div class="form-group">
            <label>Cliente</label>
            <div class="input-group">
                <input type="hidden" name="cliente_id" id="cliente_id">
                <input type="text" class="form-control" id="cliente_nombre" placeholder="Seleccione un cliente" readonly>
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#buscarClienteModal">Buscar</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Monto Total del Préstamo</label>
            <input type="number" step="0.01" name="monto_total" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Interés (%)</label>
            <input type="number" step="0.01" name="interes" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Plazos (en meses)</label>
            <input type="number" name="plazos" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Préstamo</button>
    </form>
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

    // Función para seleccionar el cliente y cerrar el modal
    function seleccionarCliente(id, nombre) {
        document.getElementById("cliente_id").value = id;
        document.getElementById("cliente_nombre").value = nombre;
        $('#buscarClienteModal').modal('hide'); // Cierra el modal
    }
</script>

<?php include '../../includes/footer.php'; ?>