<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Login</title>
    <!-- Importar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Importar Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Estilos para la pantalla de login */
        .login-container {
            display: flex;
            height: 100vh;
        }

        .left-section,
        .right-section {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .left-section {
            background-color: #007bff;
            /* Azul para el lado izquierdo */
            color: white;
            position: relative;
        }

        .right-section {
            background-color: #f8f9fa;
            /* Gris claro para el lado derecho */
        }

        /* Curva de separación más pronunciada */
        .left-section::before {
            content: '';
            position: absolute;
            right: -30%;
            top: 0;
            width: 160%;
            height: 100%;
            background-color: #007bff;
            clip-path: ellipse(75% 100% at 100% 50%);
            z-index: -1;
        }

        /* Estilos para el texto de bienvenida */
        .left-section h1 {
            font-size: 3rem;
        }

        /* Estilos para el formulario de login */
        .login-form {
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .form-group {
            position: relative;
        }

        .form-control {
            padding-left: 2.5rem;
        }

        .form-group .bi {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-primary .bi,
        .btn-secondary .bi {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="login-container">

        <!-- Sección izquierda con texto de bienvenida -->
        <div class="left-section">
            <h1 class="text-center">Bienvenido</h1>
        </div>
        <div class="right-section">
            <form action="../auth/login.php" method="POST" class="login-form">
                <h2 class="mb-4">Iniciar Sesión</h2>
                <?php if (isset($_GET['error']) && $_GET['error'] == 'credenciales'): ?>
                    <div class="alert alert-danger">Usuario o contraseña incorrectos.</div>
                <?php endif; ?>

                <div class="form-group">
                    <i class="bi bi-person"></i>
                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        class="form-control"
                        placeholder="Usuario"
                        required />
                </div>
                <div class="form-group">
                    <i class="bi bi-lock"></i>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Contraseña"
                        required />
                    <input type="hidden" name="accion" value="acceso_user">
                </div>
                <!-- Botones de Ingreso y Salida -->
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right"></i> Ingresar
                </button>



            </form>
        </div>
    </div>
    <!-- Importar Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>