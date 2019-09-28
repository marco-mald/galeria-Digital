<?php
if(isset($_POST['id'])){
$id=$_POST['id'];
$cantidad=$_POST['cantidad'];
$digitales= $_POST['digitales'];
}

require_once("PHPExcel-1.8/Classes/PHPExcel.php");
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()
->setCreator("PixiDigital")
->setLastModifiedBy("PixiDigital")
->setTitle("Resumen de venta")
->setSubject("")
->setDescription("Resumen del pedido ")
->setKeywords("")
->setCategory("Pruebas ");

$longitud = count($_POST['id']);
//longitid de arreglo

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'id_foto')
->setCellValue('B1', 'Cantidad');
//hacer letra en negrita
$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
///ancho de las columnas 
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
///color del campo
$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->getStartColor()->setARGB('29bb04');
$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
///get current date 
$hoy="Pedido"."-".date("d")."-".date("m")."-".date("y")."Hora-". date("h-i-sa");
$curdir= getcwd();

///create a directory 
mkdir($curdir."/".$hoy); 
// Add some data
$objPHPExcel->getActiveSheet()->mergeCells('D2:F2');
$objPHPExcel->getActiveSheet()->setCellValue('D2','Resumen de Pedido ');
$objPHPExcel->getActiveSheet()->setCellValue('D3','Fecha: '.$hoy);
///si quieren la copia digital
$objPHPExcel->getActiveSheet()->setCellValue('D4','Copia digital:  '.$digitales);


///add ticket resumen
for($i=0; $i<$longitud; $i++)
      {
          $cell=$i+2;
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$cell, $id[$i])
        ->setCellValue('B'.$cell, $cantidad[$i]);
      }
///copy images to new path
for ($i=0;$i<$longitud; $i++)
      {
        copy("raiz/".$id[$i].".jpg",$hoy."/".$id[$i].".jpg");
      }

// indicar que se envia un archivo de Excel para descargar.
/*
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Resumen de pedido.xlsx"');
header('Cache-Control: max-age=0');
*/

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace(__FILE__,dirname(__FILE__).'/'.$hoy.'/'.$hoy.'.xlsx',__FILE__));
//pedido realizado
echo("Pedido realizado");
//para descargar via web
///$objWriter->save('php://output');

?>