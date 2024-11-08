<?php
date_default_timezone_set("America/Guayaquil");
$conexion = mysqli_connect("localhost", "root", "", "imagenp1_Sistema");

if (isset($_POST['registrar'])) {

  if (
    strlen($_POST['efectivo']) >= 1 && strlen($_POST['transferencia'])  >= 1
  ) {

    $estado = 0;
    $id = trim($_POST['idR']);
    $total = trim($_POST['valor']);
    $transferencia = trim($_POST['transfActual']);
    $efectivo = trim($_POST['efectActual']);
    $ttt = trim($_POST['transferencia']);
    $fff = trim($_POST['efectivo']);


    $transferencia = $transferencia + $ttt;
    $efectivo = $efectivo + $fff;
    $aux = $transferencia + $efectivo;
    



    try {


      if ($aux > $total) {
        //mensaje de error que superar el maximo
      } else if ($aux < $total) {
        $estado = 1;
        $total = $total - ($transferencia + $efectivo);

        $sql = "UPDATE recibo SET saldo= '$total', estado=1, transferencia='$transferencia', efectivo='$efectivo' WHERE idRecibo='$id'";
        mysqli_query($conexion, $sql);


        $fecha_actual = date("Y-m-d");
        $sql2 = "INSERT INTO pagos(fecha,efectivo,transferencia,nivel) 
                VALUES('$fecha_actual',' $fff','$ttt',2)";
        mysqli_query($conexion, $sql2);

        //! consulta el ultimo id de la tabla pagos generada
        $idPagos = idPagos();

        $sql4 = "INSERT INTO recibo_pagos(idPagos,idRecibo) values('$idPagos','$id')";
        mysqli_query($conexion, $sql4);
        
      } else if ($aux == $total) {
        $estado = 0;
        $total = $total - ($transferencia + $efectivo);

        $sql = "UPDATE recibo SET saldo= '$total', estado=0, transferencia='$transferencia', efectivo='$efectivo' WHERE idRecibo='$id'";
        mysqli_query($conexion, $sql);

        $fecha_actual = date("Y-m-d");
        $sql2 = "INSERT INTO pagos(fecha,efectivo,transferencia,nivel) 
                VALUES('$fecha_actual',' $fff','$ttt',2)";
        mysqli_query($conexion, $sql2);

        $idPagos = idPagos();

        $sql4 = "INSERT INTO recibo_pagos(idPagos,idRecibo) values('$idPagos','$id')";
        mysqli_query($conexion, $sql4);
        
      }
      header('Location: ../views/saldos.php');

      
    } catch (Exception $e) {
      echo $e;
    }
  }
}

function idPagos()
{
  $conexion = mysqli_connect("localhost", "root", "", "imagenp1_Sistema");
  $sql = "SELECT MAX(idPagos) as maximo FROM pagos";
  $resultado = $conexion->query($sql);
  $fila = $resultado->fetch_assoc();
  $maximo = $fila['maximo'];

  return $maximo;

  // Cerrar la conexion u otros pasos necesarios
  $conexion->close();
}

