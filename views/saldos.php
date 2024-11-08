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
    <title>Imagen - Saldos</title>
    <link rel="stylesheet" href="../css/fontawesome-all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://kit.fontawesome.com/4f37010be3.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/yagamiStyle.css">

</head>

<body>

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
        <br>
        <div class="container">
            <div class="row bg-primary rounded-3">

                <div class="col-12">
                    <h3 class="text-white"><i class="fa fa-balance-scale" aria-hidden="true"></i> Saldo: <span id="saldo"></span></h3>
                </div>

            </div>

        </div>


    </div>
    <div class="container is-fluid">


        <div class="col-xs-12">
            <h3 class="text-white">Recibos</h3>
            <table class="table table-striped table-dark table_id" id="recibos">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Fechas</th>
                        <th>Cliente</th>
                        <th>Valor</th>
                        <th>Efectivo</th>
                        <th>Transferencia</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $fecha_actual = date("Y-m-d");
                    $conexion = mysqli_connect("localhost", "root", "", "imagenp1_Sistema");
                    $SQL = "SELECT * FROM recibo WHERE estado=1";

                    $dato = mysqli_query($conexion, $SQL);
                    if ($dato->num_rows > 0) {
                        while ($fila = mysqli_fetch_array($dato)) {

                    ?>
                            <tr>
                                <td><?php echo $fila['idRecibo']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                                <td><?php echo $fila['nombreCli']; ?></td>
                                <td><?php echo $fila['total']; ?></td>
                                <td><?php echo $fila['efectivo']; ?></td>
                                <td><?php echo $fila['transferencia']; ?></td>
                                <td><?php echo $fila['saldo']; ?></td>

                                <td>


                                    <a class="btn btn-primary" data-toggle="modal" data-target="#create<?php echo $fila['idRecibo']; ?>">
                                        <i class="fa fa-eye"></i> </a>
                                    <?php include('../includes/modalSaldos.php'); ?>


                                </td>
                            </tr>



                        <?php
                        }
                    } else {

                        ?>
                        <tr class="text-center">
                            <td colspan="16">No existen registros</td>
                        </tr>


                    <?php
                    }
                    ?>
                </tbody>



            </table>



        </div>





    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>



    <script src="../js/saldos.js"></script>

</body>

</html>