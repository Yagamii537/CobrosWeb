<?php
include '../../config/db.php';

$cedula = $_GET['cedula'] ?? '';

if ($cedula) {
    $stmt = $pdo->prepare("SELECT * FROM clientes WHERE cedula = :cedula");
    $stmt->bindParam(':cedula', $cedula);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        echo json_encode($cliente);
    } else {
        echo json_encode(['error' => 'Cliente no encontrado']);
    }
} else {
    echo json_encode(['error' => 'Cédula no proporcionada']);
}
