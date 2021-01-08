<?php
$dir=dirname(__FILE__);
require_once $dir.'/../php_excel_config/db.php';
require_once $dir.'/../php_excel_config/PHPExcel-1.8/Classes/PHPExcel.php';

$db=DB::getIntance();

$excel=new PHPExcel();

$excel->createSheet();
$key=1;
$excel->setActiveSheetIndex($key);

$sheet=$excel->getActiveSheet();

$sheet->setTitle('student');

$sql='select * from Student ';

$data=$db->getAll($sql);

print_r($data);

$sheet->setCellValue('A1','SId')
    ->setCellValue('B1','Sname')
    ->setCellValue('C1','Sage')
    ->setCellValue('D1','Ssex');
$j=2;

foreach ($data as $k =>$v){
    $sheet->setCellValue('A'.$j,$v['Sid'])
        ->setCellValue('B'.$j,$v['Sname'])
        ->setCellValue('C'.$j,$v['Sage'])
        ->setCellValue('D'.$j,$v['Ssex']);
    $j++;
}

$excel_write=PHPExcel_IOFactory::createWriter($excel,'Excel5');
$excel_write->save($dir.'/student.xls');