<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 
?>
<form action="" method="post" enctype="multipart/form-data">
查询月份：<input type="text" name="dateFrom" id="dateFrom" placeholder="2017-08" /> 
<input type="submit" name="submit" value="查询" />
</form>
<?php
		if(isset($_POST['dateFrom'])&&$_POST['dateFrom']!=null){
			$dateFrom = $_POST['dateFrom'].'-01';
			$dateTo = date('Y-m-d', strtotime("$dateFrom +1 month -1 day"));
		}else{
			$dateFrom = date('Y-m-01', strtotime(date("Y-m-d")));
			$dateTo = date('Y-m-d', strtotime("$dateFrom +1 month -1 day"));
		}
		/*$sql = "select report.jitai,report.guige,report.mingcheng,report.dengji,
			report.riqi,report.dingzhong,report.rukujianshu,report.rukuzhongliang,
			report.chukujianshu,report.chukuzhongliang,jiecun.jianshu jiecunjianshu,jiecun.zhongliang jiecunzhongliang
			from report 
			left join jiecun on report.jitai = jiecun.jitai 
			and report.guige = jiecun.guige 
			and report.mingcheng = jiecun.mingcheng 
			and report.dengji = jiecun.dengji 
			and report.dingzhong = jiecun.dingzhong 
			and report.riqi = jiecun.riqi
			where report.riqi>='".$dateFrom."' and report.riqi<='".$dateTo."' 
			union 
			select jiecun.jitai,jiecun.guige,jiecun.mingcheng,jiecun.dengji,
			'".$dateFrom."',jiecun.dingzhong,report.rukujianshu,report.rukuzhongliang,
			report.chukujianshu,report.chukuzhongliang,jiecun.jianshu jiecunjianshu,jiecun.zhongliang jiecunzhongliang
			from report 
			right join jiecun on report.jitai = jiecun.jitai 
			and report.guige = jiecun.guige 
			and report.mingcheng = jiecun.mingcheng 
			and report.dengji = jiecun.dengji 
			and report.dingzhong = jiecun.dingzhong 
			where jiecun.riqi = '".$dateFrom."'
			order by CAST(replace(jitai,'#','') AS SIGNED) asc";*/
			$sql = "select jinxiaocunhuizong.jitai,jinxiaocunhuizong.guige,jinxiaocunhuizong.mingcheng,jinxiaocunhuizong.dengji,
			jinxiaocunhuizong.riqi,jinxiaocunhuizong.dingzhong,jinxiaocunhuizong.rukujianshu,jinxiaocunhuizong.rukuzhongliang,
			jinxiaocunhuizong.chukujianshu,jinxiaocunhuizong.chukuzhongliang,jiecun.jianshu jiecunjianshu,jiecun.zhongliang jiecunzhongliang
			from jinxiaocunhuizong 
			left join jiecun on jinxiaocunhuizong.jitai = jiecun.jitai 
			and jinxiaocunhuizong.guige = jiecun.guige 
			and jinxiaocunhuizong.mingcheng = jiecun.mingcheng 
			and jinxiaocunhuizong.dengji = jiecun.dengji 
			and jinxiaocunhuizong.dingzhong = jiecun.dingzhong 
			and jinxiaocunhuizong.riqi = jiecun.riqi
			where jinxiaocunhuizong.riqi>='".$dateFrom."' and jinxiaocunhuizong.riqi<='".$dateTo."' 
			union 
			select jiecun.jitai,jiecun.guige,jiecun.mingcheng,jiecun.dengji,
			'".$dateFrom."',jiecun.dingzhong,jinxiaocunhuizong.rukujianshu,jinxiaocunhuizong.rukuzhongliang,
			jinxiaocunhuizong.chukujianshu,jinxiaocunhuizong.chukuzhongliang,jiecun.jianshu jiecunjianshu,jiecun.zhongliang jiecunzhongliang
			from jinxiaocunhuizong 
			right join jiecun on jinxiaocunhuizong.jitai = jiecun.jitai 
			and jinxiaocunhuizong.guige = jiecun.guige 
			and jinxiaocunhuizong.mingcheng = jiecun.mingcheng 
			and jinxiaocunhuizong.dengji = jiecun.dengji 
			and jinxiaocunhuizong.dingzhong = jiecun.dingzhong 
			and jinxiaocunhuizong.riqi = jiecun.riqi 
			where jiecun.riqi = '".$dateFrom."'
			order by CAST(replace(jitai,'#','') AS SIGNED) asc";
		
		//echo $sql;
	  $qres=mysql_query($sql);
    // 循环取出记录
    echo "<table cellspacing='1' bordercolor='#990000'   cellpadding='1' border='1'>";
    echo "<tr><td colspan='18' align='center'>能德化纤产品（DTY）进销存汇总</td></tr>";
    echo "<tr align='center'><td rowspan='2'>机台</td><td rowspan='2'>名称</td><td rowspan='2'>规格</td><td rowspan='2'>等级</td><td rowspan='2'>单位</td><td colspan='3'>月初库存</td><td colspan='3'>本月入库</td><td colspan='3'>本月出库</td><td colspan='3'>月末结存</td></tr>";
    echo "<tr align='center'><td>数量</td><td>定重</td><td>重量</td><td>数量</td><td>定重</td><td>重量</td><td>数量</td><td>定重</td><td>重量</td><td>数量</td><td>定重</td><td>重量</td></tr>";
    
    $num = 1;
    if($qres){
    	  while ($row=mysql_fetch_array($qres))
		    {
		    		echo "<tr align='center'>";
		    		echo "<td>".$row['jitai']."</td>";
						echo "<td>".$row['mingcheng']."</td>";
						echo "<td>".$row['guige']."</td>";
						echo "<td>".$row['dengji']."</td>";
						echo "<td>件</td>";
						if($row['jiecunjianshu']==null||$row['jiecunjianshu']==''){
							$jiecunjianshu = 0;
							echo "<td>0</td>";
						}else{
							$jiecunjianshu = $row['jiecunjianshu'];
							echo "<td>".$row['jiecunjianshu']."</td>";
						}
						echo "<td>".$row['dingzhong']."</td>";
						if($row['jiecunzhongliang']==null||$row['jiecunzhongliang']==''){
							$jiecunzhongliang = 0;
							echo "<td>0</td>";
						}else{
							$jiecunzhongliang = $row['jiecunzhongliang'];
							echo "<td>".$row['jiecunzhongliang']."</td>";
						}
						if($row['rukujianshu']==null||$row['rukujianshu']==''){
							$rukujianshu = 0;
							echo "<td>0</td>";
						}else{
							$rukujianshu = $row['rukujianshu'];
							echo "<td>".$row['rukujianshu']."</td>";
						}
						echo "<td>".$row['dingzhong']."</td>";
						if($row['rukuzhongliang']==null||$row['rukuzhongliang']==''){
							$rukuzhongliang = 0;
							echo "<td>0.00</td>";
						}else{
							$rukuzhongliang = $row['rukuzhongliang'];
							echo "<td>".$row['rukuzhongliang']."</td>";
						}
						if($row['chukujianshu']==null||$row['chukujianshu']==''){
							$chukujianshu = 0;
							echo "<td>0</td>";
						}else{
							$chukujianshu = $row['chukujianshu'];
							echo "<td>".$row['chukujianshu']."</td>";
						}
						echo "<td>".$row['dingzhong']."</td>";
						if($row['chukuzhongliang']==null||$row['chukuzhongliang']==''){
							$chukuzhongliang = 0;
							echo "<td>0.00</td>";
						}else{
							$chukujianshu = $row['chukuzhongliang'];
							echo "<td>".$row['chukuzhongliang']."</td>";
						}
						echo "<td>".($jiecunjianshu+$row['rukujianshu']-$row['chukujianshu'])."</td>";
						echo "<td>".$row['dingzhong']."</td>";
						echo "<td>".($jiecunzhongliang+$row['rukuzhongliang']-$row['chukuzhongliang'])."</td>";
						echo "</tr>";
		    }
    }
    mysql_close();
    echo "</table>";
?>