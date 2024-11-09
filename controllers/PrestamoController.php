<?php
include_once 'CuotaController.php';
class PrestamoController
{
    private $pdo;
    private $cuotaController;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->cuotaController = new CuotaController($pdo); // Instancia del controlador de cuotas
    }

    public function obtenerPrestamos()
    {
        $stmt = $this->pdo->query("SELECT * FROM prestamos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearPrestamo($cliente_id, $monto_total, $interes, $plazos, $fecha_inicio)
    {
        // Insertar el préstamo en la base de datos
        $stmt = $this->pdo->prepare("INSERT INTO prestamos (cliente_id, monto_total, interes, plazos, fecha_inicio, estado) VALUES (?, ?, ?, ?, ?, 1)");
        $stmt->execute([$cliente_id, $monto_total, $interes, $plazos, $fecha_inicio]);

        // Obtener el ID del préstamo recién creado
        $prestamo_id = $this->pdo->lastInsertId();

        // Registrar las cuotas para este préstamo
        $this->cuotaController->registrarCuotas($prestamo_id, $monto_total, $plazos, $interes, $fecha_inicio);
    }

    public function obtenerPrestamoPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM prestamos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerPrestamosActivos()
    {
        $stmt = $this->pdo->query("SELECT * FROM prestamos WHERE estado = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPrestamosPorCliente($cliente_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM prestamos WHERE cliente_id = ?");
        $stmt->execute([$cliente_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarPrestamo($id, $monto_total, $interes, $plazos, $fecha_inicio, $estado)
    {
        $stmt = $this->pdo->prepare("UPDATE prestamos SET monto_total = ?, interes = ?, plazos = ?, fecha_inicio = ?, estado = ? WHERE id = ?");
        $stmt->execute([$monto_total, $interes, $plazos, $fecha_inicio, $estado, $id]);
    }

    public function eliminarPrestamo($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM prestamos WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function tieneCuotasVencidas($prestamo_id)
    {
        $stmt = $this->pdo->prepare("
        SELECT COUNT(*) 
        FROM cuotas 
        WHERE prestamo_id = ? AND fecha_vencimiento < CURDATE() AND estado = 1");
        $stmt->execute([$prestamo_id]);
        return $stmt->fetchColumn() > 0; // Devuelve `true` si hay cuotas vencidas
    }
}
