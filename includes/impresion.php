<?php
date_default_timezone_set("America/Guayaquil");
error_reporting(0);

# Incluyendo librerias necesarias #
require "../lib/code128.php";



function imprimir($id)
{

    $fechaHoraActual = date("d/m/Y H:i:s");

    $conexion = mysqli_connect("localhost", "root", "", "imagenp1_Sistema");
    $consulta = "SELECT * FROM recibo WHERE idRecibo='$id'";
    $resultado = mysqli_query($conexion, $consulta);
    $recibo = mysqli_fetch_assoc($resultado);

    $pdf = new PDF_Code128('P', 'mm', array(80, 600));
    $pdf->SetMargins(1, 4, 4);
    $pdf->AddPage();
    $pdf->Image('../img/LOGOTIPO.png', 12, 5, 50);
    $pdf->Ln(20);

    # Encabezado y datos de la empresa #
    //$pdf->SetFont('Arial', 'B', 15);
    $pdf->SetTextColor(0, 0, 0);
    //$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper("IMAGEN")), 0, 'C', false);


    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", "RUC: 0803705896001"), 0, 'C', false);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", "Av. Pedro Vicente Maldonado y Guayas(Potosi)"), 0, 'C', false);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", "Tel: 098 122 3229 - 098 812 6069"), 0, 'C', false);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", "Email: imagenpublicidad_@hotmail.com"), 0, 'C', false);

    $pdf->Ln(1);
    $pdf->Cell(0, 3, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(3);

    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " Fecha: " . $fechaHoraActual), 0, 'L', false);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " Cajero: " . $recibo['trabajador']), 0, 'L', false);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 4, iconv("UTF-8", "ISO-8859-1", strtoupper(" Recibo Nº " . $recibo['idRecibo'])), 0, 'L', false);
    $pdf->SetFont('Arial', '', 9);

    $pdf->Ln(1);
    $pdf->Cell(0, 1, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(2);

    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " Cliente: " . $recibo['nombreCli']), 0, 'L', false);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " Teléfono: " . $recibo['contactoCli']), 0, 'L', false);


    $pdf->Ln(1);
    $pdf->Cell(0, 1, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(2);

    # Tabla de productos #
    $pdf->Cell(11, 2, iconv("UTF-8", "ISO-8859-1", "Cant."), 0, 0, 'C');
    $pdf->Cell(20, 2, iconv("UTF-8", "ISO-8859-1", "Descripcion"), 0, 0, 'C');
    $pdf->Cell(28, 2, iconv("UTF-8", "ISO-8859-1", "V. Unit."), 0, 0, 'C');
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "Total"), 0, 0, 'C');

    $pdf->Ln(3);
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(3);






    /*----------  Detalles de la tabla  ----------

    

    if ($dato->num_rows > 0) {
        while ($fila = mysqli_fetch_array($dato)) {
            $pdf->Cell(11, 4, iconv("UTF-8", "ISO-8859-1", $fila['cantidad']), 0, 0, 'C');
            $pdf->Cell(20, 4, iconv("UTF-8", "ISO-8859-1", $fila['descripcion']), 0, 0, 'C');
            $pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", $fila['valorUnitario']), 0, 0, 'C');
            $pdf->Cell(0, 4, iconv("UTF-8", "ISO-8859-1", $fila['cantidad'] * $fila['valorUnitario']), 0, 0, 'C');
            $pdf->Ln(4);
        }
    }
*/
    $aux = $recibo['idRecibo'];
    //echo $aux;
    $SQL = "SELECT cantidad,descripcion,valorUnitario 
            FROM detalle
            WHERE idRecibo=$aux";
    $dato = mysqli_query($conexion, $SQL);
    //echo $SQL;
    $sum = 0;
    if ($dato->num_rows > 0) {
        while ($fila = mysqli_fetch_array($dato)) {
            $pdf->Cell(11, 4, iconv("UTF-8", "ISO-8859-1", $fila['cantidad']), 0, 0, 'C');
            $detaa = substr($fila['descripcion'], 0, 14);

            $pdf->Cell(20, 4, iconv("UTF-8", "ISO-8859-1", $detaa . "."), 0, 0, 'C');
            $pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", $fila['valorUnitario']), 0, 0, 'C');
            $pdf->Cell(0, 4, iconv("UTF-8", "ISO-8859-1", $fila['cantidad'] * $fila['valorUnitario']), 0, 0, 'C');
            $sum = $sum + ($fila['cantidad'] * $fila['valorUnitario']);
            $pdf->Ln(4);
        }
    }






    /*----------  Fin Detalles de la tabla  ----------*/



    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');

    $pdf->Ln(5);

    # Impuestos & totales #
    $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
    $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL"), 0, 0, 'C');
    $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "$" . $sum), 0, 0, 'C');

    $pdf->Ln(5);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " Efectivo: " . $recibo['efectivo']), 0, 'L', false);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " Transferencia: " . $recibo['transferencia']), 0, 'L', false);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->MultiCell(0, 3, iconv("UTF-8", "ISO-8859-1", " Saldo: " . $recibo['saldo']), 0, 'L', false);
    $pdf->SetFont('Arial', '', 9);


    $pdf->Ln(2);
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(5);





    $pdf->SetFont('Arial', 'B', 9);

    $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "GRACIAS POR SU COMPRA"), '', 0, 'C');
    $pdf->Ln(6);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');

    $pdf->Ln(4);
    $pdf->SetFont('Arial', 'B', 6);
    // Establecer el color de fondo (negro)
    $pdf->SetFillColor(0, 0, 0);

    // Establecer el color del texto (blanco)
    $pdf->SetTextColor(255, 255, 255);
    $textWidth = $pdf->GetStringWidth("ESTIMADO CLIENTE") + 2;

    $paperWidth = $pdf->GetPageWidth();
    $x = ($paperWidth - $textWidth) / 2;

    // Establecer la posición X
    $pdf->SetX($x);

    $pdf->Cell($textWidth, 3, iconv("UTF-8", "ISO-8859-1", "ESTIMADO CLIENTE"), 0, 1, 'C', true);

    // Establecer el color de fondo (negro)
    $pdf->SetFillColor(255, 255, 255);

    // Establecer el color del texto (blanco)
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "»Favor una vez confirmado su diseño no se aceptan cambios ni devoluciones"), 0, 0, 'L');
    $pdf->Ln(2);
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "»Imagen no se responsabiliza por trabajos olvidados a partir de los 45 dias"), 0, 0, 'L');
    $pdf->Ln(2);
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "»Presentar este documento para cancelar el valor total y retirar su trabajo"), 0, 0, 'L');


    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 6);
    // Establecer el color de fondo (negro)
    $pdf->SetFillColor(0, 0, 0);

    // Establecer el color del texto (blanco)
    $pdf->SetTextColor(255, 255, 255);
    $textWidth = $pdf->GetStringWidth("HORARIO DE ATENCION") + 2;

    $paperWidth = $pdf->GetPageWidth();
    $x = ($paperWidth - $textWidth) / 2;

    // Establecer la posición X
    $pdf->SetX($x);

    $pdf->Cell($textWidth, 3, iconv("UTF-8", "ISO-8859-1", "HORARIO DE ATENCION"), 0, 1, 'C', true);

    // Establecer el color de fondo (negro)
    $pdf->SetFillColor(255, 255, 255);

    // Establecer el color del texto (blanco)
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "Lunes a Viernes: 8:00am - 6:30pm"), 0, 0, 'C');
    $pdf->Ln(2);
    $pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", "Sábado: 8:00am - 4:00pm"), 0, 0, 'C');
    $pdf->Ln(2);



    # Codigo de barras #
    //$pdf->Code128(5, $pdf->GetY(), "471", 70, 20);
    //$pdf->SetXY(0, $pdf->GetY() + 21);
    //$pdf->SetFont('Arial', '', 14);
    //$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "1"), 0, 'C', false);

    # Nombre del archivo PDF #
    $pdf->Output("I", "Ticket_Nro_1.pdf", true);
}
if (isset($_GET['id'])) {
    // Obtener los valores de los parámetros
    $id = $_GET['id'];

    imprimir($id);
} else {
    echo "No se han recibido los datos correctamente.";
}
