<?php
date_default_timezone_set("America/Guayaquil");
session_start();
error_reporting(0);
$validar = $_SESSION['nombre'];
if ($validar == null || $validar = '') {
    header("Location: ../includes/login.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Sistema</title>
    <!-- Importar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Importar Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Estilos para la página principal */
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        /* Encabezado */
        .header {
            width: 100%;
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            height: 60px;
            z-index: 1;
        }

        .header h1 {
            font-size: 1.5rem;
        }

        /* Barra lateral colapsable */
        .sidebar {
            background-color: #007bff;
            color: white;
            padding-top: 80px;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            width: 250px;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-250px);
        }

        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #0056b3;
            color: white;
        }

        /* Área de contenido principal */
        .content {
            margin-left: 250px;
            margin-top: 60px;
            padding: 20px;
            overflow-y: auto;
            flex: 1;
            background-color: #f8f9fa;
            transition: margin-left 0.3s ease;
        }

        .content.collapsed {
            margin-left: 0;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .sidebar.collapsed {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .content.collapsed {
                margin-left: 250px;
            }
        }
    </style>
</head>



<body>
    <!-- Encabezado con botón de menú móvil -->
    <div class="header">
        <button class="btn btn-light d-md-none" id="menu-toggle">
            <i class="bi bi-list"></i>
        </button>
        <h1>Sistema Cobros</h1>
        <div class="user-info d-none d-md-flex align-items-center">
            <span>Usuario</span>
            <i class="bi bi-person-circle ml-2"></i>
            <a class="btn btn-light btn-sm ml-2" href="../includes/_sesion/cerrarSesion.php">Cerrar sesión</a>
        </div>
    </div>

    <!-- Barra lateral con módulos -->
    <div class="sidebar" id="sidebar">
        <a href="#" class="d-flex align-items-center"><i class="bi bi-house mr-2"></i> Inicio</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-gear mr-2"></i> Configuración</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-people mr-2"></i> Usuarios</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-file-earmark-text mr-2"></i> Reportes</a>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-bell mr-2"></i> Notificaciones</a>
    </div>


    <div class="content" id="content">
        <h2>Bienvenido al Sistema</h2>
        <p>Aquí puedes acceder a los distintos módulos y funcionalidades del sistema.</p>


        <div class="row">

            <div class="col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-people-fill display-4 text-primary"></i>
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Administra y gestiona los usuarios del sistema.</p>
                        <a href="recibo.php" class="btn btn-primary">Ir a Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-file-earmark-text-fill display-4 text-primary"></i>
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Consulta y exporta reportes detallados.</p>
                        <a href="#" class="btn btn-primary">Ir a Reportes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-bell-fill display-4 text-primary"></i>
                        <h5 class="card-title">Notificaciones</h5>
                        <p class="card-text">Consulta notificaciones recientes.</p>
                        <a href="#" class="btn btn-primary">Ir a Notificaciones</a>
                    </div>
                </div>
            </div>



            <div id="login-row" class="row justify-content-center align-items-center">
                <div class="col-sm-2" id="pelicula">
                    <a href="recibo.php">
                        <img src=" ../img/recibo.png" class="img-fluid" alt="...">
                    </a>
                    <a href="recibo.php">
                        <h3 class="text-center text-white">RECIBO</h3>
                    </a>
                </div>
                <div class="col-sm-2" id="pelicula">
                    <a href="caja.php">
                        <img src="../img/caja.png" class="img-fluid" alt="...">
                    </a>
                    <a href="caja.php">
                        <h3 class="text-center text-white">CAJA</h3>
                    </a>
                </div>
                <div class="col-sm-2" id="pelicula">
                    <a href="saldos.php">
                        <img src=" ../img/saldos.png" class="img-fluid" alt="...">
                    </a>
                    <a href="saldos.php">
                        <h3 class="text-center text-white">SALDOS</h3>
                    </a>
                </div>
                <div class="col-sm-2" id="pelicula">
                    <a href="registro.php">
                        <img src=" ../img/registro.png" class="img-fluid" alt="...">
                    </a>
                    <a href="registro.php">
                        <h3 class="text-center text-white">REGISTRO</h3>
                    </a>
                </div>
            </div>
        </div>
        <br>


        <br>

        <center>

            <p class="text-center">

                Desarrollado por

                <span class="text-primary">Xerat Solutions</span>

            </p>

        </center>



    </div>



    <!-- Importar Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Script para manejar el botón de menú en móviles
        const toggleButton = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        });
    </script>

</body>



</html>