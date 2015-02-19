<?php
session_start();
include_once './includes/connection.php';
include_once './includes/sql.php';
include_once './includes/class/Helper.php';
Helper::helpSession();
require_once('./includes/tcpdf/tcpdf.php');
require_once('./includes/tcpdf/examples/lang/spa.php');

$connection=  openConnection();
if(empty($_GET['id']) && !is_numeric($_GET['id'])){
    header('location: list-quotes.php');
    exit();
}
$idCotizacion=$_GET['id'];
$getCotizacion=$connection->prepare(sql_select_cotizacion_by_idcotizacion());
$getCotizacion->execute(array($idCotizacion));
if($getCotizacion->rowCount()<1){
    header('location: list-quotes.php');
    exit();  
}
$cotizacionArray=$getCotizacion->fetch();

setlocale(LC_ALL,"es-sv");
$now = new DateTime();
$dateFormated = strftime("%d de %B de %Y",$now->getTimestamp());

if(!empty($cotizacionArray['telefono_2'])){
    $contactPhone = $cotizacionArray['telefono_1'].'/'/$cotizacionArray['telefono_2'];
}
else{
    $contactPhone = $cotizacionArray['telefono_1'];
}
if($cotizacionArray['iva']){
    $iva = 0.13;
}
else{
    $iva = 0;
}

$getCondicionValidez = $connection->prepare(sql_select_validez_by_id());
$getCondicionFormaPago = $connection->prepare(sql_select_forma_pago_by_id());
$getCondicionGarantia = $connection->prepare(sql_select_garantias_by_id());

$getCondicionValidez->execute(array($cotizacionArray['idvalidez_cotizacion']));
$getCondicionFormaPago->execute(array($cotizacionArray['idforma_pago']));
$getCondicionGarantia->execute(array($cotizacionArray['idgarantia']));

$condicionValidezArray = $getCondicionValidez->fetch();
$condicionFormaPagoArray = $getCondicionFormaPago->fetch();
$condicionGarantiaArray = $getCondicionGarantia->fetch();

class MYPDF extends TCPDF {
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}



// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('QCC');
$pdf->SetTitle('Cotización');
$pdf->SetSubject('Cotización');
$pdf->SetKeywords('QCC');


$pdf->setPrintHeader(false);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', 'B', 9, '', true);
// set font

// add a page
$pdf->AddPage();

$pdf->setJPEGQuality(100);

// Image example with resizing
// set text shadow effect
$pdf->Image('images/logo.png', 15, 10, 10, 10, 'PNG', '', 'T', true, 150, '', false, false, 1, false, false, false);
$pdf->SetFont('dejavusans', 'B', 8, '', true);
$pdf->SetTextColor(224, 53, 53);
$pdf->text(160,15,'Cotización #'.$cotizacionArray['codigo_cotizacion']);
$pdf->Ln(16);
$pdf->SetFont('dejavusans', 'B', 9, '', true);
$pdf->SetTextColor(85, 85, 85);
$pdf->Cell(0,10,utf8_encode($cotizacionArray['municipio']).', '.$dateFormated,0,1,'R');
$pdf->line(15,40,195,40);
// set some text to print
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->Cell(90,0,'Señores',0,0,'L');
$pdf->Cell(90,0,'Atención: '.utf8_encode($cotizacionArray['nombre_contacto']),0,1,'R');
$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->Cell(90,0,utf8_encode($cotizacionArray['nombre_cliente']),0,0,'L');
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->Cell(90,0,'Teléfono: '.$contactPhone,0,1,'R');
$pdf->Cell(90,0,'Presentes',0,0,'L');
$pdf->Cell(90,0,utf8_encode($cotizacionArray['email_1']),0,1,'R');
$pdf->line(15,55,195,55);
$pdf->ln(5);
//Table
//tbody
$getItemsCotizacion=$connection->prepare(sql_select_cotizacion_items());
$getItemsCotizacion->execute(array($idCotizacion));

$table = <<<EOD
    <table cellpadding="5">
        <thead>
        <tr style="background-color:#DBE5F1;text-align:center;">
            <td style="border: 1px solid black" width="50">Item</td>
            <td style="border: 1px solid black" width="70">Cant.</td>
            <td style="border: 1px solid black" width="300">Descripción</td>
            <td style="border: 1px solid black" width="120">Precio Unitario</td>
            <td style="border: 1px solid black" width="100">Precio Total</td>
        </tr>
        </thead>
        <tbody>
EOD;
$contadorItem=1;
$total = 0;
foreach ($getItemsCotizacion->fetchAll() as $itemCotizacion) {
//    print_r($itemCotizacion);
    $table .='
    <tr style="text-align:center;">
        <td style="border-right: 1px solid black;border-left: 1px solid black;" width="50">'.$contadorItem.'</td>
        <td style="border-right: 1px solid black;border-left: 1px solid black;" width="70">'.$itemCotizacion['cantidad'].'</td>
        <td style="border-right: 1px solid black;border-left: 1px solid black;" width="300">'.$itemCotizacion['descripcion'].'<div><img src="'.$itemCotizacion['imagen'].'"  width="200"></div></td>
        <td style="border-right: 1px solid black;border-left: 1px solid black;" width="120">$'.number_format($itemCotizacion['precio_unitario'], 2, '.', ',').'</td>
        <td style="border-right: 1px solid black;border-left: 1px solid black;" width="100">$'.number_format($itemCotizacion['cantidad']*$itemCotizacion['precio_unitario'], 2, '.', ',').'</td>
    </tr>';
    $total += $itemCotizacion['cantidad']*$itemCotizacion['precio_unitario']; 
}
if($iva){
    $totalIva = $total*$iva;
    $grandTotal = $total + $totalIva;
    $table .= '<tr style="text-align:right"><td style="border-right: 1px solid black;border-left: 1px solid black; border-top: 1px solid black" colspan="3"></td><td style="border: 1px solid black;background-color:#DBE5F1">Sumas</td><td style="border: 1px solid black;background-color:#DBE5F1">$'.number_format($total, 2, '.', ',').'</td></tr>'
            .'<tr style="text-align:right"><td style="border-right: 1px solid black;border-left: 1px solid black;" colspan="3"></td><td style="border: 1px solid black;background-color:#DBE5F1">13% IVA</td><td style="border: 1px solid black;background-color:#DBE5F1">$'.number_format($totalIva, 2, '.', ',').'</td></tr>'
            .'<tr style="text-align:right"><td style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black" colspan="3"></td><td style="border: 1px solid black;background-color:#DBE5F1">Total</td><td style="border: 1px solid black;background-color:#DBE5F1">$'.number_format($grandTotal, 2, '.', ',').'</td></tr>';
}
else{
    $table .= '<tr style="text-align:right"><td style="border: 1px solid black;" colspan="3"></td><td style="border: 1px solid black;background-color:#DBE5F1">Sumas</td><td style="border: 1px solid black;background-color:#DBE5F1">'.number_format($total, 2, '.', ',').'</td></tr>';
}
$table .= <<<EOD
        </tbody>
    </table>
EOD;
$pdf->writeHTML($table, true, false, false, false, ''); 

$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->cell(0,10,'Condiciones de esta cotización:',0,1,'L');
$pdf->SetFont('dejavusans', '', 9, '', true);

$pdf->cell(0,0,'Validez de la oferta: '.utf8_encode($condicionValidezArray['validez']),0,1,'L');
$pdf->cell(0,0,'Forma de pago: '.utf8_encode($condicionFormaPagoArray['forma_pago']),0,1,'L');
$pdf->cell(0,0,'Garantia: '.utf8_encode($condicionGarantiaArray['garantia']),0,1,'L');

$queryCondicionesCustom=$connection->prepare(sql_select_condiciones_by_idcotizacion());
$queryCondicionesCustom->execute(array($idCotizacion));

foreach ($queryCondicionesCustom->fetchAll() as $condicion) {
    $pdf->cell(0,0,utf8_encode($condicion['condicion']).': '.utf8_encode($condicion['valor_condicion']),0,1,'L');
}
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('cotizacion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
