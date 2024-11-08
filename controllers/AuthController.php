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
        $hash = hash("sha256", $password);

        $consulta = "SELECT * FROM empleado WHERE usuario=? AND clave=?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("ss", $nombre, $hash);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $filas = $resultado->fetch_assoc();

        if ($filas) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['rol'] = $filas['rol'];

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
    }

    public function cerrarSesion()
    {
        session_start();
        session_destroy();
        header("Location: ../../views/login.php");
        exit();
    }
}
