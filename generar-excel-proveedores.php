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
        ->setTitle("Listado de Proveedores")
        ->setSubject("Proveedores")
        ->setDescription("Listado de proveedores")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Proveedores");
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

if($_SESSION['idnivel']=="1"){
$consultaProveedores = $conexion->prepare(sql_select_contactos_proveedores_extended());

} else if($_SESSION['idnivel']=="2"){
    $consultaProveedores=$conexion->prepare(sql_select_contactos_proveedores_bydIdproveedor_nivel_excel());
    $consultaProveedores->bindParam(':idnivel', $_SESSION['idnivel']); //Debería ser nivel  2
    $consultaProveedores->bindParam(':idusuario', $_SESSION['idusuario']);

} else if($_SESSION['idnivel']=="3"){
      $consultaProveedores=$conexion->prepare(sql_select_contactos_proveedores_bydIdproveedor_usuario_excel());
      $consultaProveedores->bindParam(':idusuario', $_SESSION['idusuario']);
      $consultaProveedores->bindParam(':idnivel', $_SESSION['idnivel']);
}


$consultaProveedores->execute();
$proveedoresExist = $consultaProveedores->rowCount();
$lastRow = 9;
$contadorGlobal = 1;
if ($proveedoresExist > 0) {
    $objPHPExcel->getActiveSheet()->mergeCells("A6:Y6");
    $objPHPExcel->getActiveSheet()->getStyle("A6:Y6")->applyFromArray($separador);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue("A6", "Proveedores");
    $objPHPExcel->getActiveSheet()->mergeCells('A7:B8');
    $objPHPExcel->getActiveSheet()->mergeCells('C7:D8');
    $objPHPExcel->getActiveSheet()->mergeCells('E7:F8');
    $objPHPExcel->getActiveSheet()->mergeCells('G7:H8');
    $objPHPExcel->getActiveSheet()->mergeCells('I7:J8');
    $objPHPExcel->getActiveSheet()->mergeCells('K7:L8');
    $objPHPExcel->getActiveSheet()->mergeCells('M7:N8');
    $objPHPExcel->getActiveSheet()->mergeCells('O7:P8');
    $objPHPExcel->getActiveSheet()->mergeCells('Q7:R8');
    $objPHPExcel->getActiveSheet()->mergeCells('S7:U8');
    $objPHPExcel->getActiveSheet()->mergeCells('V7:Y8');
    $objPHPExcel->getActiveSheet()->getStyle('A7:Y8')->applyFromArray($cabecera1);
    $objPHPExcel->getActiveSheet()->getStyle('A7:Y8')->getAlignment()->setWrapText(TRUE);
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A7', 'Empresa')
            ->setCellValue('C7', 'Tipo')
            ->setCellValue('E7', 'Rubro')
            ->setCellValue('G7', 'Sub-Rubro')
            ->setCellValue('I7', 'Contacto')
            ->setCellValue('K7', 'Cargo')
            ->setCellValue('M7', 'Teléfono 1')
            ->setCellValue('O7', 'Teléfono 2')
            ->setCellValue('Q7', 'Teléfono 3')
            ->setCellValue('S7', 'Email 1')
            ->setCellValue('V7', 'Email 2')
    ;


    $cellPrimerEquipo = 9;
    foreach ($consultaProveedores->fetchAll() as $proveedor) {
        $jplus1 = $lastRow + 1;
        $jplus2 = $lastRow + 2;
        $jplus3 = $lastRow + 3;
        $objPHPExcel->getActiveSheet()->mergeCells("A$lastRow:B$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("C$lastRow:D$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("E$lastRow:F$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("G$lastRow:H$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("I$lastRow:J$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("K$lastRow:L$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("M$lastRow:N$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("O$lastRow:P$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("Q$lastRow:R$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("S$lastRow:U$lastRow");
        $objPHPExcel->getActiveSheet()->mergeCells("V$lastRow:Y$lastRow");
        
        

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A$lastRow", $proveedor['proveedor'])
                    ->setCellValue("C$lastRow", $proveedor['tipo'])
                    ->setCellValue("E$lastRow", $proveedor['rubro'])
                    ->setCellValue("G$lastRow", $proveedor['sub_rubro'])
                    ->setCellValue("I$lastRow", $proveedor['nombre_contacto'])
                    ->setCellValue("K$lastRow", $proveedor['cargo'])
                    ->setCellValue("M$lastRow", $proveedor['telefono_1'])
                    ->setCellValue("O$lastRow", $proveedor['telefono_2'])
                    ->setCellValue("Q$lastRow", $proveedor['telefono_3'])
                    ->setCellValue("S$lastRow", $proveedor['email_1'])
                    ->setCellValue("V$lastRow", $proveedor['email_2'])
            ;



        $lastRow++;

        
        $contadorGlobal++;
    }
    $lastRow--;
    $objPHPExcel->getActiveSheet()->getStyle("A9:Y$lastRow")->applyFromArray($cuerpo1);
    $objPHPExcel->getActiveSheet()->getStyle("A9:Y$lastRow")->getAlignment()->setWrapText(TRUE);
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
header('Content-Disposition: attachment;filename="listado_proveedores.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit();
