<?php
// Función para establecer conexión a la base de datos
date_default_timezone_set("America/Guayaquil");

function conectarDB()
{

    $servidor = "localhost"; // Nombre del servidor de la base de datos
    $usuario = "root"; // Usuario de la base de datos
    $contrasena = ""; // Contraseña de la base de datos
    $nombreBD = "imagenp1_Sistema"; // Nombre de la base de datos

    // Crear conexión
    $conexion = new mysqli($servidor, $usuario, $contrasena, $nombreBD);

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}

function guardarDetalle($datos, $idRec)
{
    $conexion = conectarDB();

    foreach ($datos as $fila) {

        $cantidad = $fila->cantidad;
        $detalle = $fila->detalle;
        $valUnit = $fila->valUnit;


        $consulta = "INSERT INTO detalle (idRecibo,cantidad,descripcion,valorUnitario) 
        VALUES ('$idRec', '$cantidad', '$detalle', '$valUnit')";
        if (mysqli_query($conexion, $consulta)) {
            echo "Detalle guardado\n";
        } else {
            echo "Error al guardar el detalle";
        }
    }

    mysqli_close($conexion);
}

function idPagos()
{
    $conexion = conectarDB();
    $sql = "SELECT MAX(idPagos) as maximo FROM pagos";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $maximo = $fila['maximo'];

    return $maximo;

    // Cerrar la conexión u otros pasos necesarios
    $conexion->close();
}



function idRecibo()
{
    $conexion = conectarDB();
    $sql = "SELECT MAX(idRecibo) as maximo FROM recibo";
    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    $maximo = $fila['maximo'];


    return $maximo;

    // Cerrar la conexión u otros pasos necesarios
    $conexion->close();
}


function guardarPagos($fecha, $efectivo, $transferencia)
{
    $conexion = conectarDB();
    $nivel = 1;
    $consulta = "INSERT INTO pagos (fecha,efectivo,transferencia,nivel)
    VALUES ('$fecha', '$efectivo','$transferencia','$nivel')";
    if (mysqli_query($conexion, $consulta)) {
        echo "Correcto por Pagos";
        mysqli_close($conexion);
    } else {
        echo "Error al guardar los datos";
    }
}

function reciboPagos($idPag, $idRec)
{
    $conexion = conectarDB();
    $consulta = "INSERT INTO recibo_pagos(idPagos,idRecibo)
    VALUES ('$idPag', '$idRec')";
    if (mysqli_query($conexion, $consulta)) {
        echo "Correcto Recibo Pagos";
        mysqli_close($conexion);
    } else {
        echo "Error al guardar los datos";
    }
}
// Función para guardar los datos en la base de datos
function guardarDatosC($fecha, $nombre, $contacto, $empleado, $efectivo, $transferencia, $saldo, $total, $estado, $hash)
{
    //echo "entre ".$hhash;
    $conexion = conectarDB();

    // Preparar la consulta SQL para insertar los datos en la tabla

    $consulta = "INSERT INTO recibo (fecha,nombreCli,contactoCli,trabajador,efectivo,transferencia,saldo,total,estado,hash)
    VALUES ('$fecha', '$nombre','$contacto','$empleado', '$efectivo', '$transferencia', '$saldo', '$total', '$estado', '$hash' )";
    mysqli_query($conexion, $consulta);
}

// Verificar qué acción se está solicitando
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datosJSON = file_get_contents("php://input");
    $datos = json_decode($datosJSON);

    switch ($datos->accion) {
        case "guardarC":

            if (isset($datos->hash) && isset($datos->nombre) && isset($datos->contacto) && isset($datos->empleado) && isset($datos->efectivo) && isset($datos->transferencia) && isset($datos->saldo) && isset($datos->total) && isset($datos->estado)) {
                $fecha = date("Y-m-d");
                $hash = $datos->hash;
                $nombre = $datos->nombre;
                $contacto = $datos->contacto;
                $empleado = $datos->empleado;
                $efectivo = $datos->efectivo;
                $transferencia = $datos->transferencia;
                $saldo = $datos->saldo;
                $total = $datos->total;
                if ($saldo == 0) {
                    $estado = 0;
                } else {
                    $estado = 1;
                }
                if($efectivo +$transferencia<=$total){
                    
                
                    echo guardarDatosC($fecha, $nombre, $contacto, $empleado, $efectivo, $transferencia, $saldo, $total, $estado, $hash);
    
                    echo guardarPagos($fecha, $efectivo, $transferencia);
                    $idPag = idPagos();
                    $idRec = idRecibo();
                    echo reciboPagos($idPag, $idRec);
                    guardarDetalle($datos->detalleR, $idRec);
                    
                }
            } 
            break;
        case "consultar":
            $valor = idRecibo();
            echo json_encode(array("valor" => $valor));
            break;
        case "detalle":


            break;
        default:
            echo "Error: Acción no válida";
    }
}
