<?php
$dir=dirname(__FILE__); //查找当前脚本所在路径
require_once $dir . "/db.php";    //引入mysql操作类
require_once $dir . "/../PHPExcel-1.8/Classes/PHPExcel.php";  //引入phpexcel操作类
$db=new db($phpexcel);  //实例化db类，连接数据库
$objPHPExcel=new PHPExcel();    //实例化PHPExcel，等同新建excel文件
/*for ($i=1;$i<=3;$i++){
    if ($i>1){
        $objPHPExcel->createSheet();
        //创建新的内置表
    }
    $objPHPExcel->setActiveSheetIndex($i=1);
    //把新建的sheet设定为当前活动sheet
    $objSheet=$objPHPExcel->getActiveSheet();
    //获取当前活动的sheet
    $data=$db->select('*','student','1=1');
    $objSheet->setCellValue('A1','id')->setCellValue('B1','name')
        ->setCellValue('C1','sex');
    $j=2;
    foreach($data as $k => $v){
        $objSheet->setCellValue("A".$j,$v['SId'])->setCellValue("B".$j,$v['Sname'])
            ->setCellValue("C".$j,$v['Sage'])->setCellValue("C".$j,$v['Ssex']);
        $j++;
    }
    $objWrite=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
    //生成格式文件
    $objWrite->save($dir."/export_1");
}*/
$objSheet=$objPHPExcel->getActiveSheet();
$objSheet->setTitle('student');
$data=$db->select('*','student','1=1');
$objSheet->setCellValue("A1",'id')->setCellValue('B1',"name")->setCellValue("C1",'sex');
$j=2;
if (isset($data)){
    echo "ok";
}else{
    echo'fuck';
}
foreach ($data as $k =>$v){
    $objSheet->setCellValue("A".$j,$v['SId'])->setCellValue("B".$j,$v['Sname'])
        ->setCellValue("C".$j,$v['Sage'])->setCellValue("C".$j,$v['Ssex']);
    $j++;
}
$objWrite=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWrite->save($dir."/student.xlsx");
?>
