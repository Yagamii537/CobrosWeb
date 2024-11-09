<?php
class CuotaController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function registrarCuotas($prestamo_id, $monto_total, $plazos, $tasa_interes, $fecha_inicio)
    {
        // Calcular el monto e interés de cada cuota
        $monto_cuota = ($monto_total * (1 + $tasa_interes / 100)) / $plazos;
        $interes_cuota = ($monto_total * $tasa_interes / 100) / $plazos;
        $fecha_vencimiento = new DateTime($fecha_inicio);

        // Registrar cada cuota en la base de datos
        for ($i = 1; $i <= $plazos; $i++) {
            $stmt = $this->pdo->prepare("
                INSERT INTO cuotas (prestamo_id, numero_cuota, monto, interes, fecha_vencimiento, estado) 
                VALUES (?, ?, ?, ?, ?, 1)
            ");
            $stmt->execute([$prestamo_id, $i, $monto_cuota, $interes_cuota, $fecha_vencimiento->format('Y-m-d')]);

            // Incrementar la fecha de vencimiento en un mes para la próxima cuota
            $fecha_vencimiento->modify('+1 month');
        }
    }

    public function obtenerCuotasPorPrestamo($prestamo_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cuotas WHERE prestamo_id = ?");
        $stmt->execute([$prestamo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarPago($cuota_id, $monto_pagado, $metodo_pago, $observaciones)
    {
        // Insertar el pago en la tabla de pagos
        $stmt = $this->pdo->prepare("INSERT INTO pagos (cuota_id, monto_pagado, metodo_pago, observaciones) VALUES (?, ?, ?, ?)");
        $stmt->execute([$cuota_id, $monto_pagado, $metodo_pago, $observaciones]);

        // Actualizar el estado de la cuota y la fecha de pago
        $stmt = $this->pdo->prepare("
            UPDATE cuotas 
            SET monto = monto - ?, estado = IF(monto <= 0, 0, 1), fecha_pago = NOW() 
            WHERE id = ?
        ");
        $stmt->execute([$monto_pagado, $cuota_id]);
    }

    public function obtenerPagosPorCuota($cuota_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pagos WHERE cuota_id = ?");
        $stmt->execute([$cuota_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerCuotaPorId($cuota_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cuotas WHERE id = ?");
        $stmt->execute([$cuota_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
