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
    <link href="../assets/css/estilos.css" rel="stylesheet">
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