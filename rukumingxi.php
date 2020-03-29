<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 

?>
<form action="" method="post" enctype="multipart/form-data">
开始日期：<input type="text" name="dateFrom" id="dateFrom" placeholder="2017-08-01" /> 
结束日期：<input type="text" name="dateTo" id="dateTo" placeholder="2017-08-31"  /> 
机台：<select name="jitai" id="jitai">
<option value="">不限</option>
<option value="1#">1#</option>
<option value="2#">2#</option>
<option value="3#">3#</option>
<option value="4#">4#</option>
<option value="5#">5#</option>
<option value="6#">6#</option>
<option value="7#">7#</option>
<option value="8#">8#</option>
<option value="9#">9#</option>
<option value="10#">10#</option>
<option value="11#">11#</option>
<option value="12#">12#</option>
<option value="13#">13#</option>
</select>
<input type="submit" name="submit" value="查询" />
</form>
<?php

    echo "<table cellspacing='1' bordercolor='#990000'   cellpadding='1' border='1'>";
    echo "<tr><td colspan='10' align='center'>能德化纤产品（DTY）入库明细</td></tr>";
    echo "<tr align='center'><td>序号</td><td>日期</td><td>机台</td><td>名称/规格</td><td>单位</td><td>等级</td><td>数量</td><td>定重</td><td>重量</td><td>编辑</td></tr>";
		if(isset($_POST['dateFrom'])&&isset($_POST['dateTo'])&&$_POST['dateFrom']!=null&&$_POST['dateTo']!=null){
			$dateFrom = $_POST['dateFrom'];
			$dateTo = $_POST['dateTo'];
		}else{
			$dateFrom = date('Y-m-01', strtotime(date("Y-m-d")));
			$dateTo = date('Y-m-d', strtotime("$dateFrom +1 month -1 day"));
		}
		$sql = "select * from ruku where riqi <='".$dateTo."' and riqi >='".$dateFrom."'";
		if(isset($_POST['jitai'])&&$_POST['jitai']!=null){
			$jitai = $_POST['jitai'];
			$sql = $sql." and jitai = '".$jitai."' ";
		}
			$sql = $sql." order by riqi asc";
		  $qres=mysql_query($sql);
		  //echo $sql;
	    // 循环取出记录
	    $num = 1;
	    if($qres){
	    	  while ($row=mysql_fetch_array($qres))
			    {
			    		echo "<tr align='center'><td>".$num."</td>";
			    		echo "<td>".$row['riqi']."</td>";
							echo "<td>".$row['jitai']."</td>";
							echo "<td>".$row['mingcheng']."/".$row['guige']."</td>";
							echo "<td>件</td>";
							echo "<td>".$row['dengji']."</td>";
							echo "<td>".$row['jianshu']."</td>";
							echo "<td>".$row['dingzhong']."</td>";
							echo "<td>".$row['zhongliang']."</td>";
							echo "<td><a href='updateRuku.php?id=".$row['id']."'>修改</href></td></tr>";
							echo "</tr>";
							$num = $num+1;
			    }
	    }
	mysql_close();
    echo "</table>";
?>