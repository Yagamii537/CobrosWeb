<?php
class AuthController
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function accesoUser()
    {
        session_start();

        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $hash = hash("sha256", $password); // Genera el hash de la contraseña ingresada

        // Consulta SQL para verificar usuario y contraseña
        $consulta = "SELECT * FROM empleado WHERE usuario = :nombre AND clave = :hash";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':hash', $hash);
        $stmt->execute();

        $filas = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($filas) {
            $_SESSION['nombre'] = $filas['usuario'];
            $_SESSION['rol'] = $filas['rol'];

            // Redirección según el rol
            if ($filas['rol'] == 1) {
                header('Location: ../views/principal.php');
            } elseif ($filas['rol'] == 2) {
                header('Location: ../views/lector.php');
            } else {
                session_destroy();
                header('Location: ../views/login.php');
            }
        } else {
            session_destroy();
            header('Location: ../views/login.php?error=credenciales');
        }
        exit();
    }


    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location: ../../views/login.php");
        exit();
    }
}
