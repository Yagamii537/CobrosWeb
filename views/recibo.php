<?php
date_default_timezone_set("America/Guayaquil");
session_start();
error_reporting(0);

$validar = $_SESSION['nombre'];


if ($validar == null || $validar = '') {

    header("Location: ../includes/login.php");
    die();
}


function generarHashUnico($cadena)
{
    // Generar una salt aleatoria
    $salt = bin2hex(random_bytes(16)); // Genera 32 caracteres hexadecimales (16 bytes)

    // Combinar la cadena con la salt y generar el hash
    $hash = hash('sha256', $cadena . $salt);

    // Retornar el hash y la salt en un arreglo asociativo
    return array('hash' => $hash, 'salt' => $salt);
}

// Uso de la función para generar un hash único
$fechaHoraActual = date("Y-m-d H:i:s");


$nombreHost = gethostname();
$ipMaquina = gethostbyname($nombreHost);

// Imprimir la dirección IP de la máquina


$hashUnico = generarHashUnico($fechaHoraActual . "/" . $ipMaquina);



//echo "Hash SHA-256: " . $hashUnico['hash'] . "<br>";
$a = $hashUnico['salt'];


?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imagen - Recibo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/yagamiStyle.css">
</head>

<body>

    <div class="container py-4">
        <!--  //? Inicio del form -->
        <div class="container py-4">

            <div class="row">
                <div class="col-10">

                    <img src="../img/LOGOTIPO.png" width="200" alt="Logo Imagen" />

                </div>


                <div class="col-2"> <a class="btn btn-warning" href="../includes/_sesion/cerrarSesion.php">Cerrar Sesion
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                    </a></div>
            </div>
            <h2>Bienvenido <?php echo $_SESSION['nombre']; ?></h2>
            <div>
                <a class="btn btn-secondary" href="principal.php">Regresar
                    <i class="fa fa-backward"></i>
                </a>
            </div>

        </div>
        <hr class="bg-light border">
        <form id="formulario">
            <div class="row">
                <div class="col-6">
                    <div class="card text-white bg-secondary">
                        <div class="card-header">
                            <strong>CLIENTE</strong> <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="<?php echo $a; ?>" id="hash" name="hash">

                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Ingrese Nombre del cliente" require>
                            </div>
                            <div class="form-group">
                                <label for="contacto">Contacto</label>
                                <input id="contacto" class="form-control" type="number" name="contacto" placeholder="Ingrese numero contacto" require>
                            </div>
                            <div class="form-group">
                                <label for="empleado">Trabajo con:</label>
                                <input id="empleado" class="form-control" type="text" name="empleado" placeholder="Ingrese numero contacto" require>
                            </div>
                            <br>
                            <br><br>

                        </div>
                    </div>
                </div>
                <div class="col-6">

                    <div class="card text-white bg-secondary">
                        <div class="card-header">
                            <strong>DATOS DE ENTRADA</strong> <i class="fa fa-calculator" aria-hidden="true"></i>

                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="number" name="cantidad">
                            </div>
                            <div class="form-group">
                                <label for="detalle">Detalle</label>
                                <input id="detalle" class="form-control" type="text" name="detalle">
                            </div>
                            <div class="form-group">
                                <label for="valU">Valor Unitarios</label>
                                <input id="valU" class="form-control" type="number" name="valU">
                            </div>
                            <input type="hidden" id="datoInvisible" name="datoInvisible" value=0>
                            <hr>
                            <a class="btn btn-success" onclick="agregarDatos()">Agregar <i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>

                </div>

                <div class="row py-2">
                    <div class="col-12">
                        <!-- style="max-width: 34.2rem;"  style="width: 81rem;" -->
                        <div class="card text-white bg-secondary">
                            <div class="card-header">

                                <strong>DETALLE</strong> <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">

                                <table class="table table-sm table-secondary table-striped table-responsive table-hover" id="tabla">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>CANT</th>
                                            <th>DETALLE</th>
                                            <th>VALOR U.</th>
                                            <th>VALOR T.</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="datosTabla" class="table-responsive">
                                        <!-- Aquí se mostrarán los datos de la tabla -->


                                    </tbody>


                                </table>
                                <div class="row justify-content-end">
                                    <div class="col-1" style="width: 6rem;">

                                        <h5 class="">TOTAL: </h5>
                                    </div>

                                    <div class="col-3" style="width: 22.8rem;">

                                        <h5 id="suma" type=" number" name="suma"></h5>
                                    </div>


                                </div>

                            </div>




                        </div>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-12">
                        <!-- style="max-width: 34.2rem;"  style="width: 81rem;" -->
                        <div class="card text-white bg-secondary">
                            <div class="card-header">

                                <strong>PAGO</strong> <i class="fa fa-money-bill" aria-hidden="true"></i>
                            </div>
                            <div class="card-body">


                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label for="efectivo">Efectivo</label>
                                            <input id="efectivo" class="form-control" type="number" name="efectivo" value="0">
                                        </div>
                                    </div>

                                    <div class="col-6">

                                        <div class="form-group">
                                            <label for="transferencia">Transferencia</label>
                                            <input id="transferencia" class="form-control" type="number" name="transferencia" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>

                <div class="row py-2">
                    <div class="col-12">
                        <!-- style="max-width: 34.2rem;"  style="width: 81rem;" -->
                        <div class="card text-white bg-secondary">
                            <div class="card-body">


                                <div class="row justify-content-end">
                                    <div class="col-2">
                                        <a class="btn btn-primary" onclick="guardarTodo()">Guardar</a>

                                    </div>

                                </div>
                            </div>




                        </div>
                    </div>
                </div>

            </div>





        </form>




    </div>


    <script src="../js/reciboJ.js"></script>
    <script src="../js/tablas.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


</body>

</html>