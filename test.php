<?php
include("conn.php"); 
 	require_once './PHPExcel/PHPExcel.php';
    require_once './PHPExcel/PHPExcel/IOFactory.php';
    require_once './PHPExcel/PHPExcel/Reader/Excel5.php';
$objReader = PHPExcel_IOFactory::createReader('excel2007'); //use Excel5 for 2003 format 
$excelpath='myexcel.xlsx';
$objPHPExcel = $objReader->load($excelpath); 
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow();           //取得总行数 
$highestColumn = $sheet->getHighestColumn(); //取得总列数
for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据
    { 
$str="";
        for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
         { 
             $str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
         } 
$str=mb_convert_encoding($str,'GBK','auto');//根据自己编码修改
$strs = explode("|*|",$str);
//echo $str . "<br />";
//exit;
            $sql = "insert into test (title,content,sn,num) values ('{$strs[0]}','{$strs[1]}','{$strs[2]}','{$strs[3]}')";
//echo $sql;
//exit;
            if(!mysql_query($sql,$conn))
            {
               echo 'excel err';
            }
 
}
?>