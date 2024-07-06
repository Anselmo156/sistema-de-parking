<?php 
// Include the main TCPDF library (search for installation path).
require_once('../app/templates/TCPDF-main/tcpdf.php');
include('../app/config.php');

// Cargar el encabezado
$query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1'");
$query_informacions->execute();
$informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);
foreach($informacions as $informacion){
    $id_informacion = $informacion['id_informacion'];
    $nombre_parqueo = $informacion['nombre_parqueo'];
    $actividad_empresa = $informacion['actividad_empresa'];
    $sucursal = $informacion['sucursal'];
    $direccion = $informacion['direccion'];
    $zona = $informacion['zona'];
    $telefono = $informacion['telefono'];
    $departamento_ciudad = $informacion['departamento_ciudad'];
    $pais = $informacion['pais'];
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79, 175), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de Parking');
$pdf->setTitle('Sistema de Parking');
$pdf->setSubject('Sistema de Parking');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 7);

// add a page
$pdf->AddPage();

// create some HTML content
$html = '
<div>
    <p style="text-align: center">
        <b>'.$nombre_parqueo.'</b> <br>
        '.$actividad_empresa.' <br>
        SUCURSAL Nº '.$sucursal.' <br>
        '.$direccion.' <br>
        ZONA: '.$zona.' <br>
        TELÉFONO: '.$telefono.' <br>
        '.$departamento_ciudad.' - '.$pais.' <br>
        --------------------------------------------------------------------------------
        <b>FACTURA Nro.</b> 00001
        --------------------------------------------------------------------------------
        <div style="text-align: left">
            <b>DATOS DEL CLIENTE</b> <br>
            <b>SEÑOR(A): </b> ANSELMO EGURROLA PINEDO <br>
            <b>DNI/CIF.: </b> 15351877K <br>
            <b>Fecha de la factura: </b> Eibar, 6 de Julio de 2024  <br>
            -------------------------------------------------------------------------------- <br>
            <b>De: </b> 06/07/2024 <b>Hora: </b>09:00<br>
            <b>A: </b> 06/07/2024  <b>Hora: </b>11:00<br>
            <b>Tiempo:  </b> 2 horas en el espacio 10<br>
            -------------------------------------------------------------------------------- <br>
            <table border="1" cellpadding="3">
                <tr>
                    <td style="text-align: center" width="99px"><b>Detalle</b></td>    
                    <td style="text-align: center" WIDTH="45PX"><b>Precio</b></td>    
                    <td style="text-align: center" width="45px"><b>Cantidad</b></td>    
                    <td style="text-align: center" width="45px"><b>Total</b></td>
                </tr>
                <tr>
                    <td>Servicio de parking de 2 horas</td>
                    <td style="text-align: center">€. 1</td>
                    <td style="text-align: center">1</td>
                    <td style="text-align: center">€. 2</td>
                </tr>
            </table>
            <p style="text-align: right">
                <b>Total Factura: </b> €. 2
            </p>
            <p>
                <b>Son: </b>Dos 00/002 €.
            </p>
            <br>
            -------------------------------------------------------------------------------- <br>
            <b>USUARIO:</b> ANSELMO EGURROLA PINEDO
            <p style="text-align: center">
                <img src="https://borealtech.com/wp-content/uploads/2018/10/codigo-qr-1024x1024-1.jpg" width="100px" alt=""/>;
            </p>
            <p style="text-align: center">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO DE ESTA SERÁ SANCIONADO DE ACUERDO A LA LEY"
            </p>
            <p style="text-align: center"><b>GRACIAS POR SU PREFERENCIA</b></p>
        </div>
    </p>
</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+