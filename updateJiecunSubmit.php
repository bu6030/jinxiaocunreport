<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 
if(isset($_POST['riqi'])&&isset($_POST['jitai'])&&isset($_POST['guige'])
&&isset($_POST['dengji'])&&isset($_POST['jianshu'])
&&isset($_POST['zhongliang'])&&isset($_POST['mingcheng'])){
	$id = $_POST['id'];
	$riqi = $_POST['riqi'];
	$riqi = substr($riqi,0,7).'-01';
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
	
	$sql = "update jiecun set riqi = '".$riqi."',jitai='".$jitai."',mingcheng='".$mingcheng."',guige='".$guige."',dengji='".$dengji."',jianshu='".$jianshu."',dingzhong='".$dingzhong."',zhongliang='".$zhongliang."' where id = '".$id."'";
	echo $sql;
	$qres=mysql_query($sql);

}
	mysql_close();
	$url = "jiecunmingxi.php";
	if (isset($url)) 
	{ 
		Header("refresh:2;url=$url");
		print("录入成功");
	} 

?>
