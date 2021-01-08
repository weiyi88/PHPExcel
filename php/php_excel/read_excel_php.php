<?php
header("Content-Type:text/html;charset=utf-8");
$dir=dirname(__FILE__);
require_once $dir.'/../php_excel_config/db.php';
require_once $dir.'/../php_excel_config/PHPExcel-1.8/Classes/PHPExcel.php';
//引入读取excel 类的文件
require_once $dir.'/../php_excel_config/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

try {
    //获取文件路径
    $filename=$dir.'/user.xls';
    $db=DB::getIntance();

//io工厂加载文件路径
    //全部加载
    $objPHPExcel=PHPExcel_IOFactory::load($filename);


/*//部分加载
    $file_type=PHPExcel_IOFactory::identify($filename);//自动获取文件类型，提供给phpexcel用
    $objRread=PHPExcel_IOFactory::createReader($file_type);//获取文件读取操作对象
    //选择加载哪个sheet
    $sheetName='2年级';
    $objRread->canRead($sheetName);//只加载指定的sheet
    $objPHPExcel=$objRread->load($filename);//加载文件*/

//全部读取
    $sheetCount=$objPHPExcel->getSheetCount();//获取excel文件有多少个sheet

    for ($i=0;$i<$sheetCount;$i++){
        $data=$objPHPExcel->getSheet($i)->toArray();
        //读取每个sheet里面的数据 全部放入数组中
        print_r($data);
    }

//逐行读取
   /* foreach ($objPHPExcel->getWorksheetIterator() as $sheet){
        //逐行读取sheet

        foreach ($sheet->getRowIterator()as $row){
            //逐行处理
            if ($row->getRowIndex()<2){
                //跳过题目
                continue;
            }
            foreach ($row->getCellIterator()as $cell){
                //逐列读取
                $data=$cell->getValue();//获取单元格数据
                echo $data."";
                echo PHP_EOL;
            }
            echo "<br>";
        }
        echo "<br>";
    }*/

}catch (\Exception $exception){
    echo $exception->getMessage();
}

