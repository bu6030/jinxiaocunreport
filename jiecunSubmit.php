<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 
echo $_POST['zhongliang'];
if(isset($_POST['riqi'])&&isset($_POST['jitai'])&&isset($_POST['guige'])
&&isset($_POST['dengji'])&&isset($_POST['jianshu'])
&&isset($_POST['zhongliang'])&&isset($_POST['mingcheng'])){
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
	$sql = "SELECT count(1) cnt FROM jiecun where jitai = '".$jitai."' and riqi='".$riqi."' and guige = '".$guige."' and mingcheng = '".$mingcheng."' and dengji = '".$dengji."' and dingzhong = '".$dingzhong."' ";
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
		$url = "jiecunmingxi.php";
		Header("refresh:2;url=$url");
		print("录入失败，该月该类内容已经结存");
	}else{
		$sql = "insert into  jiecun (riqi,jitai,mingcheng,guige,dengji,jianshu,dingzhong,zhongliang) values ('".$riqi."','".$jitai."','".$mingcheng."','".$guige."','".$dengji."','".$jianshu."','".$dingzhong."','".$zhongliang."')";
		//echo $sql;
		$qres=mysql_query($sql);
		$url = "jiecunmingxi.php";
		if (isset($url)) 
		{ 
			Header("refresh:2;url=$url");
			print("录入成功");
		} 
	}
}
mysql_close();
?>
