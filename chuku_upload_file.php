<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 
require_once './PHPExcel/PHPExcel.php';
require_once './PHPExcel/PHPExcel/IOFactory.php';
require_once './PHPExcel/PHPExcel/Reader/Excel5.php';
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
  
  if (($_FILES["file"]["size"] < 20000))
  {
  	if ($_FILES["file"]["error"] > 0)
    {
    	echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  	else
    {
	    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	    echo "Type: " . $_FILES["file"]["type"] . "<br />";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    }
  }
	else
  {
  	echo "Invalid file";
  }
  
  
  $objReader = PHPExcel_IOFactory::createReader('Excel2007'); //use Excel5 for 2003 format 
  $excelpath= "upload/" . $_FILES["file"]["name"];
  $objPHPExcel = $objReader->load($excelpath); 
  $sheet = $objPHPExcel->getSheet(0); 
  $highestRow = $sheet->getHighestRow();           //取得总行数 
  $highestColumn = $sheet->getHighestColumn(); //取得总列数
	//循环读取excel文件,读取一条,插入一条
	for($j=3;$j<=$highestRow;$j++)
	{
		$a = getExcelVal($objPHPExcel->getActiveSheet()->getCell("A".$j));//获取A列的值
		if($a==null||$a==''){
			break;
		}
		$b = getExcelVal($objPHPExcel->getActiveSheet()->getCell("B".$j));//获取B列的值
		$b = excelTime($b);
		$c = getExcelVal($objPHPExcel->getActiveSheet()->getCell("C".$j));//获取A列的值
		$d = getExcelVal($objPHPExcel->getActiveSheet()->getCell("D".$j));//获取B列的值
		$e = getExcelVal($objPHPExcel->getActiveSheet()->getCell("E".$j));//获取A列的值
		$f = getExcelVal($objPHPExcel->getActiveSheet()->getCell("F".$j));//获取B列的值
		$g = getExcelVal($objPHPExcel->getActiveSheet()->getCell("G".$j));//获取A列的值
		$h = getExcelVal($objPHPExcel->getActiveSheet()->getCell("H".$j));//获取B列的值
		echo $a.'==='.$b;
				echo '<br>';
		$sql = "INSERT INTO chuku (kehumingcheng,riqi,pihao,guige,jianshu,zhongliang,danjia,jine) VALUES('".$a."','".$b."','".$c."','".$d."','".$e."','".$f."','".$g."','".$h."')";
		echo $sql;
		echo '<br>';
		mysql_query($sql);
		
		$month = substr($b,0,7).'-01';
		echo $month;
		updateKucun($month,$c,$d,$e,$f);
		updateKucunTongji($month,$c,$d,$e,$f);
	}
	function excelTime($days, $time=false){
	    if(is_numeric($days)){
	        //based on 1900-1-1
	        $jd = GregorianToJD(1, 1, 1970);
	        $gregorian = JDToGregorian($jd+intval($days)-25569);
	        $myDate = explode('/',$gregorian);
	        $myDateStr = str_pad($myDate[2],4,'0', STR_PAD_LEFT)
	                ."-".str_pad($myDate[0],2,'0', STR_PAD_LEFT)
	                ."-".str_pad($myDate[1],2,'0', STR_PAD_LEFT)
	                .($time?" 00:00:00":'');
	        return $myDateStr;
	    }
	    return $days;
	}
	function getExcelVal($cell){
	    if(substr($cell->getValue(),0,1)=='='){
	        return $cell->getCalculatedValue();
	    }
	    return $cell->getValue();
	}
	function updateKucun($month, $pihao,$guige,$jianshu,$zhongliang){
		$sql = "SELECT count(1) cnt FROM kucun where pihao = '".$pihao."' and month='".$month."' and guige = '".$guige."' ";
		echo "aaa===".$sql;
	  $qres=mysql_query($sql);
		//提取一条数据
    // 循环取出记录
    while ($row=mysql_fetch_array($qres))
    {
        $cnt = $row['cnt'];
        echo '==cnt=='.$cnt.'==';
    }

		if($cnt>0){
			$updateSql = "update kucun set jianshu = jianshu - ".$jianshu.",zhongliang = zhongliang- '".$zhongliang."' where pihao = '".$pihao."' and month='".$month."' and guige = '".$guige."'";
			echo "==updateSql".$updateSql."==";
			mysql_query($updateSql);
		}
	}
	function updateKucunTongji($month, $pihao,$guige,$jianshu,$zhongliang){
		$sql = "SELECT count(1) cnt FROM kucuntongji where pihao = '".$pihao."' and month='".$month."' and guige = '".$guige."' ";
		echo "aaa===".$sql;
	  $qres=mysql_query($sql);
		//提取一条数据
    // 循环取出记录
    while ($row=mysql_fetch_array($qres))
    {
        $cnt = $row['cnt'];
        echo '==cnt=='.$cnt.'==';
    }

		if($cnt>0){
			$updateSql = "update kucuntongji set chukujianshu = chukujianshu + ".$jianshu.",chukuzhongliang = chukuzhongliang+ '".$zhongliang."' where pihao = '".$pihao."' and month='".$month."' and guige = '".$guige."'";
			echo "==updateSql".$updateSql."==";
			mysql_query($updateSql);
		}else{
			$isnertSql = "insert into kucuntongji (pihao,guige,month,chukujianshu,chukuzhongliang,rukujianshu,rukuzhonliang) values ('".$pihao."','".$guige."','".$month."','".$jianshu."','".$zhongliang."',0,0)";
			echo "==isnertSql".$isnertSql."==";
			mysql_query($isnertSql);
		}
	}
 //           $sql = "insert into ruku (xuhao,riqi,jitai,pihao,guige,dengji,jianshu,zhongliang,beizhu) values ('{$strs[0]}','{$strs[1]}','{$strs[2]}','{$strs[3]}','{$strs[4]}','{$strs[5]}','{$strs[6]}','{$strs[7]}','{$strs[8]}')";
//echo $sql;
//exit;
//            if(!mysql_query($sql,$conn))
//            {
//               echo 'excel err';
//            }
 
//}
?>