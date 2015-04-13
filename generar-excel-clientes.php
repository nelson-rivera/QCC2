<?php

if (PHP_SAPI == 'cli')
    die('Este reporte debe ser visto en un navegador web');

/** Include PHPExcel */
session_start();
include_once './includes/file_const.php';
include_once './includes/connection.php';
include_once './includes/sql.php';
require_once './includes/phpexcel/Classes/PHPExcel.php';

$conexion = openConnection();

$objPHPExcel = new PHPExcel();

// propiedades del documento
$objPHPExcel->getProperties()->setCreator("QCC")
        ->setLastModifiedBy("QCC")
        ->setTitle("Listado de clientes")
        ->setSubject("Clientes")
        ->setDescription("Listado de clientes")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Clientes");
//algunos estilos del documento
$objPHPExcel->getDefaultStyle()->getFont()->setName('Helvetica');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
$cabecera1 = array(
    'font' => array(
        'bold' => true,
        'size' => 11,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '7fb0d8'),
    ),
);
$breakdownCell = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '7fb0d8'),
    ),
);
$totalCell = array(
    'font' => array(
        'bold' => true,
        'size' => 11,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '84a2ba'),
    ),
);
$nota = array(
    'font' => array(
        'bold' => true,
        'size' => 11,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'f6a190'),
    ),
);
$separador = array(
    'font' => array(
        'bold' => true,
        'size' => 11,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
);
$tinyElegant = array(
    'font' => array(
        'bold' => true,
        'size' => 9,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
);
$subCabecera = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'dcd7d8'),
    ),
);

$bordes = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
);


$titulo1 = array(
    'font' => array(
        'bold' => true,
        'size' => 16,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ),
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
);
$cuerpo1 = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
);
$empty = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '827878'),
    ),
);

$resaltado = array(
    'font' => array(
        'bold' => true,
        'size' => 12,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'color' => array('rgb' => 'FFFF00'),
    ),
);

$resaltado2 = array(
    'font' => array(
        'bold' => true,
        'size' => 12,
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
);

$cuerpo2 = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_HAIR,
        ),
    ),
);
//Logo JM
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('./images/logo.png');
$objDrawing->setHeight(36);
$objDrawing->setCoordinates('A2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objPHPExcel->getActiveSheet()->mergeCells('A2:C3');





//Tabla cotizaciones
// Cabecera de la tabla
$consultaClientes = $conexion->prepare(sql_select_contactos_clientes_extended());
$consultaClientes->execute();
$clienteExist = $consultaClientes->rowCount();
$lastRow = 9;
$contadorGlobal = 1;
if ($clienteExist > 0) {
    $objPHPExcel->getActiveSheet()->mergeCells("A6:S6");
    $objPHPExcel->getActiveSheet()->getStyle("A6:S6")->applyFromArray($separador);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A6", "Clientes");
    $objPHPExcel->getActiveSheet()->mergeCells('A7:B8');
    $objPHPExcel->getActiveSheet()->mergeCells('C7:D8');
    $objPHPExcel->getActiveSheet()->mergeCells('E7:F8');
    $objPHPExcel->getActiveSheet()->mergeCells('G7:H8');
    $objPHPExcel->getActiveSheet()->mergeCells('I7:J8');
    $objPHPExcel->getActiveSheet()->mergeCells('K7:L8');
    $objPHPExcel->getActiveSheet()->mergeCells('M7:N8');
    $objPHPExcel->getActiveSheet()->mergeCells('O7:P8');
    $objPHPExcel->getActiveSheet()->mergeCells('Q7:S8');
//    $objPHPExcel->getActiveSheet()->mergeCells('S7:U8');
//    $objPHPExcel->getActiveSheet()->mergeCells('V7:Y8');
    $objPHPExcel->getActiveSheet()->getStyle('A7:S8')->applyFromArray($cabecera1);
    $objPHPExcel->getActiveSheet()->getStyle('A7:S8')->getAlignment()->setWrapText(TRUE);
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A7', 'Empresa')
            ->setCellValue('C7', 'Vendedor')
            ->setCellValue('E7', 'Rubro')
            ->setCellValue('G7', 'Departamento')
            ->setCellValue('I7', 'Municipio')
            ->setCellValue('K7', 'Contacto')
            ->setCellValue('M7', 'Cargo')
            ->setCellValue('O7', 'Teléfono 1')
//            ->setCellValue('Q7', 'Teléfono 2')
            ->setCellValue('Q7', 'Email 1')
//            ->setCellValue('V7', 'Email 2')
    ;


    $cellPrimerEquipo = 9;
    foreach ($consultaClientes->fetchAll() as $cliente) {
        $jplus1 = $lastRow + 1;
        $jplus2 = $lastRow + 2;
        $jplus3 = $lastRow + 3;
        $objPHPExcel->getActiveSheet()->mergeCells("A$lastRow:B$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("C$lastRow:D$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("E$lastRow:F$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("G$lastRow:H$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("I$lastRow:J$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("K$lastRow:L$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("M$lastRow:N$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("O$lastRow:P$jplus1");
        $objPHPExcel->getActiveSheet()->mergeCells("Q$lastRow:S$jplus1");
//        $objPHPExcel->getActiveSheet()->mergeCells("S$lastRow:U$jplus1");
//        $objPHPExcel->getActiveSheet()->mergeCells("V$lastRow:Y$jplus1");
        
        

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A$lastRow", $cliente['nombre_cliente'])
                    ->setCellValue("C$lastRow", $cliente['nombre_vendedor'])
                    ->setCellValue("E$lastRow", $cliente['rubro'])
                    ->setCellValue("G$lastRow", $cliente['departamento'])
                    ->setCellValue("I$lastRow", $cliente['municipio'])
                    ->setCellValue("K$lastRow", $cliente['nombre_contacto'])
                    ->setCellValue("M$lastRow", $cliente['cargo'])
                    ->setCellValue("O$lastRow", $cliente['telefono_1'])
//                    ->setCellValue("Q$lastRow", $cliente['telefono_2'])
                    ->setCellValue("Q$lastRow", $cliente['email_1'])
//                    ->setCellValue("V$lastRow", $cliente['email_2'])
            ;



        $lastRow = $lastRow + 2;

        
        $contadorGlobal++;
    }
    $lastRow--;
    $objPHPExcel->getActiveSheet()->getStyle("A9:S$lastRow")->applyFromArray($cuerpo1);
    $objPHPExcel->getActiveSheet()->getStyle("A9:S$lastRow")->getAlignment()->setWrapText(TRUE);
    $lastRowBrakeDown = $lastRow + 4;
    $cellUltimoEquipo = $lastRow - 1;



    

}


//        $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
//        $objPHPExcel->getActiveSheet()->getStyle("A1:T$lastRow")->getProtection()->setLocked(
//                PHPExcel_Style_Protection::PROTECTION_PROTECTED
//        );

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="listado_clientes.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
