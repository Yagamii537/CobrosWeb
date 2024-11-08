<?php
class ClienteController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerClientes()
    {
        $stmt = $this->pdo->query("SELECT * FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearCliente($cedula, $nombre, $apellido, $direccion, $telefono, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clientes (cedula, nombre, apellido, direccion, telefono, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$cedula, $nombre, $apellido, $direccion, $telefono, $email]);
    }

    public function obtenerClientePorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCliente($id, $cedula, $nombre, $apellido, $direccion, $telefono, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE clientes SET cedula = ?, nombre = ?, apellido = ?, direccion = ?, telefono = ?, email = ? WHERE id = ?");
        $stmt->execute([$cedula, $nombre, $apellido, $direccion, $telefono, $email, $id]);
    }

    public function eliminarCliente($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
    }
}
