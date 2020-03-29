<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 
if(isset($_POST['riqi'])&&isset($_POST['jitai'])&&isset($_POST['guige'])
&&isset($_POST['dengji'])&&isset($_POST['jianshu'])
&&isset($_POST['zhongliang'])&&isset($_POST['mingcheng'])&&isset($_POST['danjia'])
&&isset($_POST['jine'])&&isset($_POST['kehumingcheng'])){
	$id = $_POST['id'];
	$riqi = $_POST['riqi'];
	$jitai = $_POST['jitai'];
	$guige = $_POST['guige'];
	$dengji = $_POST['dengji'];
	$jianshu = $_POST['jianshu'];
	if(isset($_POST['dingzhong'])){
		$dingzhong = $_POST['dingzhong'];
		if($dingzhong==null||$dingzhong==''){
			$dingzhong = 0;
		}
	}else{
		$dingzhong = 0;
	}
	$zhongliang = $_POST['zhongliang'];
	$mingcheng = $_POST['mingcheng'];	
	$danjia = $_POST['danjia'];
	$jine = $_POST['jine'];
	$kehumingcheng = $_POST['kehumingcheng'];
	
	$oldRiqi = $_POST['oldRiqi'];
	$oldJitai = $_POST['oldJitai'];
	$oldGuige = $_POST['oldGuige'];
	$oldDengji = $_POST['oldDengji'];
	$oldJianshu = $_POST['oldJianshu'];
	if(isset($_POST['oldDingzhong'])){
		$oldDingzhong = $_POST['oldDingzhong'];
	}else{
		$oldDingzhong = 0;
	}
	$oldZhongliang = $_POST['oldZhongliang'];
	$oldMingcheng = $_POST['oldMingcheng'];	
	$oldDanjia = $_POST['oldDanjia'];
	$oldJine = $_POST['oldJine'];
	$oldKehumingcheng = $_POST['oldKehumingcheng'];
	$sql = "update chuku set riqi = '".$riqi."',jitai='".$jitai."',mingcheng='".$mingcheng."',guige='".$guige."',dengji='".$dengji."',jianshu='".$jianshu."',dingzhong='".$dingzhong."',zhongliang='".$zhongliang."',danjia='".$danjia."',jine='".$jine."',kehumingcheng='".$kehumingcheng."' where id = '".$id."'";
	//$sql = "insert into  chuku (riqi,jitai,mingcheng,guige,dengji,jianshu,dingzhong,zhongliang,danjia,jine,kehumingcheng) values ('".$riqi."','".$jitai."','".$mingcheng."','".$guige."','".$dengji."','".$jianshu."','".$dingzhong."','".$zhongliang."','".$danjia."','".$jine."','".$kehumingcheng."')";
	echo $sql;
	$qres=mysql_query($sql);
	updateOldReport(substr($oldRiqi,0,7).'-01',$oldJitai,$oldGuige,$oldMingcheng,$oldDengji,$oldJianshu,$oldDingzhong,$oldZhongliang);
	updateReport(substr($riqi,0,7).'-01',$jitai,$guige,$mingcheng,$dengji,$jianshu,$dingzhong,$zhongliang);
}
	$url = "chukumingxi.php";
	if (isset($url)) 
	{ 
		Header("refresh:2;url=$url");
		print("修改成功");
	} 
	function updateOldReport($riqi, $jitai,$guige,$mingcheng,$dengji,$jianshu,$dingzhong,$zhongliang){
		$sql = "SELECT count(1) cnt FROM report where jitai = '".$jitai."' and riqi='".$riqi."' and guige = '".$guige."' and mingcheng = '".$mingcheng."' and dengji = '".$dengji."' and dingzhong = ".$dingzhong." ";
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
			$updateSql = "update report set chukujianshu = chukujianshu - ".$jianshu.",chukuzhongliang = chukuzhongliang - ".$zhongliang." where jitai = '".$jitai."' and riqi='".$riqi."' and guige = '".$guige."' and mingcheng = '".$mingcheng."' and dengji = '".$dengji."' and dingzhong = ".$dingzhong." ";
			echo "==updateSql".$updateSql."==";
			mysql_query($updateSql);
		}
	}
	function updateReport($riqi, $jitai,$guige,$mingcheng,$dengji,$jianshu,$dingzhong,$zhongliang){
		$sql = "SELECT count(1) cnt FROM report where jitai = '".$jitai."' and riqi='".$riqi."' and guige = '".$guige."' and mingcheng = '".$mingcheng."' and dengji = '".$dengji."' and dingzhong = ".$dingzhong." ";
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
			$updateSql = "update report set chukujianshu = chukujianshu + ".$jianshu.",chukuzhongliang = chukuzhongliang + ".$zhongliang.",dingzhong = ".$dingzhong." where jitai = '".$jitai."' and riqi='".$riqi."' and guige = '".$guige."' and mingcheng = '".$mingcheng."' and dengji = '".$dengji."' and dingzhong = ".$dingzhong." ";
			echo "==updateSql".$updateSql."==";
			mysql_query($updateSql);
		}else{
			$isnertSql = "insert into report (jitai,riqi,guige,mingcheng,dengji,chukujianshu,dingzhong,chukuzhongliang,rukujianshu,rukuzhongliang) values ('".$jitai."','".$riqi."','".$guige."','".$mingcheng."','".$dengji."',".$jianshu.",".$dingzhong.",".$zhongliang.",0,0)";
			echo "==isnertSql".$isnertSql."==";
			mysql_query($isnertSql);
		}
	}
	mysql_close();
?>
