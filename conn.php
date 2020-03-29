<?php
$conn=mysql_connect("rdsbg1u5l9442b54uvfl.mysql.rds.aliyuncs.com","","") or die("数据库服务器连接错误".mysql_error());
mysql_select_db("cms",$conn) or die("数据库访问错误".mysql_error());
mysql_query("set character set utf8");
mysql_query("set names utf8");
?>