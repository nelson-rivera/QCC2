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
        ->setTitle("Listado de Vendedores")
        ->setSubject("Vendedores")
        ->setDescription("Listado de vendedores")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Vendedores");
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
$objDrawing->setName('QCC');
$objDrawing->setDescription('QCC');
$objDrawing->setPath('./images/logo.png');
$objDrawing->setHeight(36);
$objDrawing->setCoordinates('A2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
$objPHPExcel->getActiveSheet()->mergeCells('A2:C3');





//Exportar proveedores

// Cabecera de la tabla
$consultaProveedores = $conexion->prepare(sql_select_usuarios_all());
$consultaProveedores->execute();
$proveedoresExist = $consultaProveedores->rowCount();
$lastRow = 9;
$contadorGlobal = 1;
if ($proveedoresExist > 0) {
    $objPHPExcel->getActiveSheet()->mergeCells("A6:N6");
    $objPHPExcel->getActiveSheet()->getStyle("A6:N6")->applyFromArray($separador);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A6", "Vendedores");
    $objPHPExcel->getActiveSheet()->mergeCells('A7:C8');
    $objPHPExcel->getActiveSheet()->mergeCells('D7:E8');
    $objPHPExcel->getActiveSheet()->mergeCells('F7:G8');
    $objPHPExcel->getActiveSheet()->mergeCells('H7:I8');
    $objPHPExcel->getActiveSheet()->mergeCells('J7:L8');
    $objPHPExcel->getActiveSheet()->mergeCells('M7:N8');
    $objPHPExcel->getActiveSheet()->getStyle('A7:N8')->applyFromArray($cabecera1);
    $objPHPExcel->getActiveSheet()->getStyle('A7:N8')->getAlignment()->setWrapText(TRUE);
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A7', 'Nombre')
            ->setCellValue('D7', 'Cargo')
            ->setCellValue('F7', 'Teléfono 1')
            ->setCellValue('H7', 'Teléfono 2')
            ->setCellValue('J7', 'Correo 1')
            ->setCellValue('M7', 'Correo 2')
    ;


    $cellPrimerEquipo = 9;
    foreach ($consultaProveedores->fetchAll() as $proveedor) {
        $jplus1 = $lastRow + 1;
        $jplus2 = $lastRow + 2;
        $jplus3 = $lastRow + 3;
        $objPHPExcel->getActiveSheet()->mergeCells("A$lastRow:C$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("D$lastRow:E$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("F$lastRow:G$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("H$lastRow:I$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("J$lastRow:L$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("M$lastRow:N$lastRow");
        

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A$lastRow", $proveedor['nombre']." ".$proveedor['apellido'])
                    ->setCellValue("D$lastRow", $proveedor['perfil'])
                    ->setCellValue("F$lastRow", $proveedor['telefono_1'])
                    ->setCellValue("H$lastRow", $proveedor['telefono_2'])
                    ->setCellValue("J$lastRow", $proveedor['email_1'])
                    ->setCellValue("M$lastRow", $proveedor['email_2'])
            ;

        $lastRow++;
        
        $contadorGlobal++;
    }
    $lastRow--;
    $objPHPExcel->getActiveSheet()->getStyle("A9:N$lastRow")->applyFromArray($cuerpo1);
    $objPHPExcel->getActiveSheet()->getStyle("A9:N$lastRow")->getAlignment()->setWrapText(TRUE);
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
header('Content-Disposition: attachment;filename="listado_vendedores.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
