<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 
if(isset($_GET['id'])){
	$id = $_GET['id'];
	echo "===".$id;
	$sql = "DELETE FROM jiecun where id = ".$id." ";
	echo "aaa===".$sql;
	$qres=mysql_query($sql);
	$url = "jiecunmingxi.php";
	if (isset($url)) 
	{ 
		Header("refresh:2;url=$url");
		print("删除成功");
	}
}
mysql_close();
?>
