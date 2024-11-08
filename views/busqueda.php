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
    <title>Imagen - Caja</title>
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
                </a>
            </div>
        </div>
        <h2>Bienvenido <?php echo $_SESSION['nombre']; ?></h2>
        <div>
            <a class="btn btn-secondary" href="principal.php">Regresar
                <i class="fa fa-backward"></i>
            </a>
        </div>
        <br>
        <div class="container-fluid">
            <form class="d-flex">
                <form action="" method="GET">
                    <input class="form-control me-2" type="text" placeholder="Buscar por Recibo o Nombre de Cliente" name="busqueda"> <br>
                    <button class="btn btn-outline-info" type="submit" name="enviar"> <b>Buscar </b> </button>
                </form>
        </div>
        <?php


        if (isset($_GET['enviar'])) {
            $busqueda = $_GET['busqueda'];


            if (isset($_GET['busqueda'])) {
                $SQL = "SELECT r.idRecibo, r.fecha, r.nombreCli,r.contactoCli,r.trabajador,p.efectivo,p.transferencia,r.saldo,r.total,r.estado
                    FROM recibo r
                    INNER JOIN recibo_pagos rp
                    ON r.idRecibo=rp.idRecibo
                    INNER JOIN pagos p
                    ON rp.idPagos=p.idPagos
                    WHERE r.nombreCli='$busqueda' OR r.idRecibo='$busqueda' AND p.nivel=1";

                $SQL1 = "SELECT r.nombreCli,p.fecha,p.efectivo,p.transferencia,r.idRecibo
                FROM pagos p
                INNER JOIN recibo_pagos rp
                ON rp.idPagos=p.idPagos
                INNER JOIN recibo r
                ON r.idRecibo=rp.idRecibo
                WHERE r.nombreCli='$busqueda' OR r.idRecibo='$busqueda' AND p.nivel=2";
            }
        }


        ?>
        <br>


        </form>
        <br>
        <div class="container">
            <div class="row bg-primary rounded-3">
                <div class="col-4">

                    <h3 class="text-white"><i class="fa fa-money" aria-hidden="true"></i> Efectivo: <span id="efectivo"></span></h3>
                </div>
                <div class="col-4">
                    <h3 class="text-white"><i class="fa fa-mobile" aria-hidden="true"></i> Transferencia: <span id="transferencia"></span></h3>
                </div>
                <div class="col-4">
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

                    $conexion = mysqli_connect("localhost", "root", "", "imagenp1_Sistema");


                    $dato = mysqli_query($conexion, $SQL);
                    if ($dato->num_rows > 0) {
                        while ($fila = mysqli_fetch_array($dato)) {

                    ?>
                            <tr>

                                <td><?php echo $fila['nombreCli']; ?></td>

                                <td><?php echo $fila['total']; ?></td>
                                <td><?php echo $fila['efectivo']; ?></td>
                                <td><?php echo $fila['transferencia']; ?></td>
                                <td><?php echo $fila['saldo']; ?></td>
                                
                                <td>
                                   
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#create<?php echo $fila['idRecibo']; ?>">
                                        <i class="fa fa-eye"></i> </a>


                                    <?php include('../includes/modalCajaR.php'); ?>

                                    

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


        <!-- //?DIVISION DE TABLAS -->
        <div class="col-xs-12">
            <h3 class="text-white">Pagos</h3>

            <table class="table table-striped table-dark table_id " id="pagos">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Efectivo</th>
                        <th>Transferencia</th>
                        <th>Nº Recibo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $conexion = mysqli_connect("localhost", "root", "", "imagenp1_Sistema");




                    $ress = mysqli_query($conexion, $SQL1);

                    if ($ress->num_rows > 0) {
                        while ($fila = mysqli_fetch_array($ress)) {

                    ?>
                            <tr>
                                <td><?php echo $fila['nombreCli'];      ?></td>
                                <td><?php echo $fila['fecha'];          ?></td>
                                <td><?php echo $fila['efectivo'];       ?></td>
                                <td><?php echo $fila['transferencia'];  ?></td>
                                <td><?php echo $fila['idRecibo'];       ?></td>


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



    <script src="../js/caja.js"></script>

</body>

</html>