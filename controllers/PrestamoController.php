<?php
class PrestamoController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerPrestamos()
    {
        $stmt = $this->pdo->query("SELECT * FROM prestamos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearPrestamo($cliente_id, $monto_total, $interes, $plazos, $fecha_inicio)
    {
        // Estado se asigna como 1 automáticamente en la creación
        $estado = 1;
        $stmt = $this->pdo->prepare("INSERT INTO prestamos (cliente_id, monto_total, interes, plazos, fecha_inicio, estado) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$cliente_id, $monto_total, $interes, $plazos, $fecha_inicio, $estado]);
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
}
