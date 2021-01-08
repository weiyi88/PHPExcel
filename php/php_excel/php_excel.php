<?php
$dir=dirname(__FILE__);
require_once $dir.'/../php_excel_config/db.php';
require_once $dir.'/../php_excel_config/PHPExcel-1.8/Classes/PHPExcel.php';

$db=DB::getIntance();
$objPHPExcel=new PHPExcel();//实例化PHPExcel类，等同桌面上新建一个excel

for ($i=1;$i<=3;$i++){
    if ($i>1){
        $objPHPExcel->createSheet();    //创建新的excel表
    }
    $objPHPExcel->setActiveSheetIndex($i-1);    //把新建的sheet设定为当前活动sheet
    $objSheet=$objPHPExcel->getActiveSheet();   //获取当前活动的sheet
    $objSheet->setTitle($i.'年级');   //给当前活动sheet起个名称
    $data=$db->getDataByGrade($i);  //查询每个年级的学生数据
    $objSheet->setCellValue('A1','姓名')
        ->setCellValue('B1','分数')
        ->setCellValue('C1','班级'); //填充数据

    $j=2;
    foreach ($data as $key=>$val){
        $objSheet->setCellValue('A'.$j,$val['user_name'])
            ->setCellValue('B'.$j,$val['score'])
            ->setCellValue('C'.$j,$val['class'].'班');
        $j++;
    }
}
    $obiWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5'); //生成文件
    //$obiWriter->save($dir.'/user.xls');
    browser_export('Excel5','browser_excel03.xls'); //输出到浏览器
    $obiWriter->save('php://output');



function browser_export($type,$filename){
    // Redirect output to a client’s web browser (Excel5)
    if ($type=='Excel5'){
        header('Content-Type: application/vnd.ms-excel'); //告诉浏览器输出excel 03文件
    }else{
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //告诉浏览器输出excel 07 文件

    }
    header('Content-Disposition: attachment;filename="'.$filename.'"');  //告诉浏览器输出文件名称
    header('Cache-Control: max-age=0'); //禁止缓存
}

