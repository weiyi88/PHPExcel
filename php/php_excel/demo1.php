<?php
//找到当前脚本路径
$dir = dirname(__FILE__);
/*
 * __FILE__     当前脚本路径，连同脚本名
 * dirname()    将路径中，文件名去掉剩下目录路径
 * */
//require_once "../PHPExcel-1.8/Classes/PHPExcel.php";
require_once $dir . "/../PHPExcel-1.8/Classes/PHPExcel.php";
//使用dirname（）需要加/在文件名前，1，转义符，2，因为dirname是获取文件目录名最后没有/
$objPHPExcel=new PHPExcel();
//实例化PHPExcel类，等同于在桌面上新建一个excel表格
$objSheet=$objPHPExcel->getActiveSheet();
//获得当前活动sheet的操作对象
$objSheet->setTitle("Aring");
//插入数据，方法一
/*$objSheet->setCellValue('A1','姓名')
    ->setCellValue('B1','分数');
//给当前活动的sheet填充数据
$objSheet->setCellValue('A2','Aring')
    ->setCellValue('B2','100');*/
//插入数据，方法二
/*
 * 不建议使用
 * 数据大，phpexcel会内存不够
 * 代码阅读不方便
 * */
$data=array(
    array(),       //第一行设置为空
    array("","姓名","分数"),
    array("","boring","88"),
    array("","fuck","99"),
    //第一列设置为空
);
$objSheet->fromArray($data);    //直接加载数据块填充数据，数组填充数据
$objWrite=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
//按照指定格式生成excel文件
$objWrite->save($dir."/demo_1.xlsx");
/**
 * 总概括
 * $objPHPExcel     实例化sheet
 * $objSheet        操作sheet表内容
 * $objWrite    ==> PHPExcel_IOfactory  工厂生成文件对象，和设置格式
 * $save()          按照路径存储生成的文件
 * */
?>