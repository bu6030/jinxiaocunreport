<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 

?>
<form action="" method="post" enctype="multipart/form-data">
日期：<input type="text" name="dateFrom" id="dateFrom" placeholder="2017-08" /> 
<input type="submit" name="submit" value="查询" />
</form>
<?php

    echo "<table cellspacing='1' bordercolor='#990000'   cellpadding='1' border='1'>";
    echo "<tr><td colspan='14' align='center'>能德化纤产品（DTY）月初库存</td></tr>";
    echo "<tr align='center'><td>序号</td><td>日期</td><td>机台</td><td>名称</td><td>规格</td><td>等级</td><td>定重</td><td>数量</td><td>重量</td><td>修改</td><td>删除</td></tr>";
		if(isset($_POST['dateFrom'])&&$_POST['dateFrom']!=null){
			$dateFrom = $_POST['dateFrom'].'-01';
			$dateTo = date('Y-m-d', strtotime("$dateFrom +1 month -1 day"));
		}else{
			$dateFrom = date('Y-m-01', strtotime(date("Y-m-d")));
			$dateTo = date('Y-m-d', strtotime("$dateFrom +1 month -1 day"));
		}
		$sql = "select * from jiecun where riqi <='".$dateTo."' and riqi >='".$dateFrom."'";
		$sql = $sql." order by CAST(replace(jitai,'#','') AS SIGNED)  asc";
		//echo $sql;
		$qres=mysql_query($sql);
		//echo $sql;
	  // 循环取出记录
	  $num = 1;
	  if($qres){
	    	while ($row=mysql_fetch_array($qres))
			  {
			    echo "<tr align='center'><td>".$num."</td>";
			    echo "<td>".substr($row['riqi'],0,7)."</td>";
					echo "<td>".$row['jitai']."</td>";
					echo "<td>".$row['mingcheng']."</td>";
					echo "<td>".$row['guige']."</td>";
					echo "<td>".$row['dengji']."</td>";
					echo "<td>".$row['dingzhong']."</td>";
					echo "<td>".$row['jianshu']."</td>";
					echo "<td>".$row['zhongliang']."</td>";
					echo "<td><a href='updateJiecun.php?id=".$row['id']."'>修改</href></td>";
					echo "<td><a href='deleteJiecun.php?id=".$row['id']."'>删除</href></td>";
					echo "</tr>";
					$num = $num+1;
			  }
	  }
			
    echo "</table>";
?>