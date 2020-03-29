<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 


	/*	$sql = "select * from (SELECT
	kucun.pihao shangyuepihao,
	kucun.guige shangyueguige,
	kucun.jianshu shangyuekucunjianshu,
	kucun.zhongliang shangyuekucunzhongliang,
	rukutongji.zhongliang shangyuerukuzhongliang,
	rukutongji.jianshu shangyuerukujianshu,
	chukutongji.zhongliang shangyuechukuzhongliang,
	chukutongji.jianshu shangyuechukujianshu,
	rukutongji.riqi shangyuerukuriqi,
	chukutongji.riqi shangyuechukuriqi
FROM
	kucun
LEFT JOIN (
	SELECT
		SUM(zhongliang) AS zhongliang,
		SUM(jianshu) AS jianshu,
		pihao,
		guige,
		date_format(riqi, '%Y%m') riqi
	FROM
		ruku
	GROUP BY
		pihao,
		guige,
		date_format(riqi, '%Y%m')
) rukutongji ON kucun.pihao = rukutongji.pihao
AND kucun.guige = rukutongji.guige
AND date_format(kucun. MONTH, '%Y%m') = rukutongji.riqi
LEFT JOIN (
	SELECT
		SUM(zhongliang) AS zhongliang,
		SUM(jianshu) AS jianshu,
		pihao,
		guige,
		date_format(riqi, '%Y%m') riqi
	FROM
		chuku
	GROUP BY
		pihao,
		guige,
		date_format(riqi, '%Y%m')
) chukutongji ON kucun.pihao = chukutongji.pihao
AND kucun.guige = chukutongji.guige
AND date_format(kucun. MONTH, '%Y%m') = chukutongji.riqi
WHERE
	kucun. MONTH = date_sub(
		date_sub(
			date_format(now(), '%y-%m-%d'),
			INTERVAL extract(DAY FROM now()) - 1 DAY
		),
		INTERVAL 1 MONTH
	) ) shangyuetongji
LEFT JOIN (
	SELECT
		kucun.pihao benyuepihao,
		kucun.guige benyueguige,
		kucun.jianshu benyuekucunjianshu,
		kucun.zhongliang benyuekucunzhongliang,
		rukutongji.zhongliang benyuerukuzhongliang,
		rukutongji.jianshu benyuerukujianshu,
		chukutongji.zhongliang benyuechukuzhongliang,
		chukutongji.jianshu benyuechukujianshu,
		rukutongji.riqi benyuerukuriqi,
		chukutongji.riqi benyuechukuqiri
	FROM
		kucun
	LEFT JOIN (
		SELECT
			SUM(zhongliang) AS zhongliang,
			SUM(jianshu) AS jianshu,
			pihao,
			guige,
			date_format(riqi, '%Y%m') riqi
		FROM
			ruku
		GROUP BY
			pihao,
			guige,
			date_format(riqi, '%Y%m')
	) rukutongji ON kucun.pihao = rukutongji.pihao
	AND kucun.guige = rukutongji.guige
	AND date_format(kucun. MONTH, '%Y%m') = rukutongji.riqi
	LEFT JOIN (
		SELECT
			SUM(zhongliang) AS zhongliang,
			SUM(jianshu) AS jianshu,
			pihao,
			guige,
			date_format(riqi, '%Y%m') riqi
		FROM
			chuku
		GROUP BY
			pihao,
			guige,
			date_format(riqi, '%Y%m')
	) chukutongji ON kucun.pihao = chukutongji.pihao
	AND kucun.guige = chukutongji.guige
	AND date_format(kucun. MONTH, '%Y%m') = chukutongji.riqi
	WHERE
		kucun. MONTH = date_sub(
			date_sub(
				date_format(now(), '%y-%m-%d'),
				INTERVAL extract(DAY FROM now()) - 1 DAY
			),
			INTERVAL 0 MONTH
		)
) benrutongji on shangyuetongji.shangyueguige = benrutongji.benyueguige and shangyuetongji.shangyuepihao = benrutongji.benyuepihao
order by shangyuepihao,shangyueguige ";*/
		$sql = "select benyuetongji.pihao,benyuetongji.guige,benyuetongji.jianshu benyuekucunjianshu,benyuetongji.zhongliang benyuekucunzhongliang,
benyuetongji.rukujianshu benyuerukujianshu,benyuetongji.rukuzhongliang benyuerukuzhongliang,
benyuetongji.chukujianshu benyuechukujianshu,benyuetongji.chukuzhongliang benyuechukuzhongliang,
shangyuetongji.jianshu shangyuekucunjianshu,shangyuetongji.zhongliang shangyuekucunzhongliang,
shangyuetongji.rukujianshu shangyuerukujianshu,shangyuetongji.rukuzhongliang shangyuerukuzhongliang,
shangyuetongji.chukujianshu shangyuerukuchukujianshu,shangyuetongji.chukuzhongliang shangyuerukuzhongliang from (SELECT kucun.pihao,kucun.guige,kucun.month,kucun.jianshu,kucun.zhongliang,kucuntongji.rukujianshu,kucuntongji.chukujianshu,kucuntongji.rukuzhongliang,kucuntongji.chukuzhongliang
FROM
	kucun
LEFT JOIN kucuntongji ON kucun.guige = kucuntongji.guige
AND kucun.pihao = kucuntongji.pihao
AND kucun.month = kucuntongji.month
WHERE
	kucun.month >= DATE_ADD(	curdate(),	INTERVAL - DAY (curdate()) + 1 DAY)) benyuetongji 
left join (
SELECT kucun.pihao,kucun.guige,kucun.month,kucun.jianshu,kucun.zhongliang,kucuntongji.rukujianshu,kucuntongji.chukujianshu,kucuntongji.rukuzhongliang,kucuntongji.chukuzhongliang
FROM
	kucun
LEFT JOIN kucuntongji ON kucun.guige = kucuntongji.guige
AND kucun.pihao = kucuntongji.pihao
AND kucun. MONTH = kucuntongji. MONTH
WHERE
	kucun.MONTH < DATE_ADD(	curdate(),	INTERVAL - DAY (curdate()) + 1 DAY))
shangyuetongji on benyuetongji.guige =shangyuetongji.guige 
and benyuetongji.pihao = shangyuetongji.pihao";
	  $qres=mysql_query($sql);
    // 循环取出记录
    echo "<table cellspacing='1' bordercolor='#990000'   cellpadding='1' border='1'>";
    echo "<tr><td colspan='14' align='center'>能德化纤产品（DTY）库存总表</td></tr>";
    echo "<tr><td rowspan='2'>序号</td><td rowspan='2'>批号</td><td rowspan='2'>规格</td><td colspan='2'>上月库存</td><td colspan='2'>本月库存</td><td colspan='2'>本月入库</td><td colspan='2'>本月出库</td><td rowspan='2'>备注</td></tr>";
    echo "<tr><td>件数</td><td>重量</td><td>件数</td><td>重量</td><td>件数</td><td>重量</td><td>件数</td><td>重量</td></tr>";
    
    $num = 1;
    if($qres){
    	  while ($row=mysql_fetch_array($qres))
		    {
		    		echo "<tr><td>".$num."</td>";
		    		echo "<td>".$row['pihao']."</td>";
						echo "<td>".$row['guige']."</td>";
						echo "<td>".$row['shangyuekucunjianshu']."</td>";
						echo "<td>".$row['shangyuekucunzhongliang']."</td>";
						echo "<td>".$row['benyuekucunjianshu']."</td>";
						echo "<td>".$row['benyuekucunzhongliang']."</td>";
						echo "<td>".$row['benyuerukujianshu']."</td>";
						echo "<td>".$row['benyuerukuzhongliang']."</td>";
						echo "<td>".$row['benyuechukujianshu']."</td>";
						echo "<td>".$row['benyuechukuzhongliang']."</td>";
						echo "<td></td></tr>";
						$num = $num+1;
		    }
    }
	mysql_close();
    echo "</table>";
?>