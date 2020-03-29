<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 
$id = $_GET['id'];
$sql = "select * from ruku where id = ".$id;
$qres=mysql_query($sql);
if($qres){
	while ($row=mysql_fetch_array($qres)){
		$riqi = $row['riqi'];
		$jitai = $row['jitai'];
		$mingcheng = $row['mingcheng'];
		$guige = $row['guige'];
		$dengji = $row['dengji'];
		$jianshu = $row['jianshu'];
		$dingzhong = $row['dingzhong'];
		$zhongliang = $row['zhongliang'];
	}
}
?>
<script type="text/javascript">
	window.onload=function(){
		if(dengji!='AA'){
			document.getElementById("dingzhong").readOnly=true;
			document.getElementById("zhongliang").readOnly=false;
		}else{
			document.getElementById("dingzhong").readOnly=false;
			document.getElementById("zhongliang").readOnly=true;
		}
	}
	function setDingzhong(){
		var dengji = document.getElementById("dengji").value;
		if(dengji!='AA'){
			document.getElementById("dingzhong").value="";
			document.getElementById("zhongliang").value="";
			document.getElementById("dingzhong").readOnly=true;
			document.getElementById("zhongliang").readOnly=false;
		}else{
			document.getElementById("dingzhong").readOnly=false;
			document.getElementById("zhongliang").readOnly=true;
		}
	}
	function setZhongLiang(){
		var dingzhong = document.getElementById("dingzhong").value;
		var jianshu = document.getElementById("jianshu").value;
		if(dingzhong!=''&&jianshu!=''){

			var zhongliang = accMul(dingzhong,jianshu);
			document.getElementById("zhongliang").value = zhongliang;
			//alert(dingzhong+"=="+jianshu+"=="+zhongliang);
		}
	}
	function accMul(arg1,arg2){    
		var m=0,s1=arg1.toString(),  
		s2=arg2.toString();    
		try{  
		m+=s1.split(".")[1].length}catch(e){}    
		try{  
		m+=s2.split(".")[1].length}catch(e){}    
		return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
	}
	function onlyNum(obj){ 
		//先把非数字的都替换掉，除了数字和.
		obj.value = obj.value.replace("/[^/d.]/g","");
		//必须保证第一个为数字而不是.
		obj.value = obj.value.replace("/^/./g","");
		//保证只有出现一个.而没有多个.
		obj.value = obj.value.replace("//.{2,}/g",".");
		//保证.只出现一次，而不能出现两次以上
		obj.value = obj.value.replace(".","$#$").replace("//./g,").replace("$#$",".");
	}
</script>
入库录入
<form action="updateRukuSubmit.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" id="id" value ="<?php echo $id ?>" />
	<input type="hidden" name="oldRiqi" id="oldRiqi" value ="<?php echo $riqi ?>" />
	<input type="hidden" name="oldJitai" id="oldJitai" value ="<?php echo $jitai ?>" />
	<input type="hidden" name="oldMingcheng" id="oldMingcheng" value ="<?php echo $mingcheng ?>" />
	<input type="hidden" name="oldDengji" id="oldDengji" value ="<?php echo $dengji ?>" />
	<input type="hidden" name="oldGuige" id="oldGuige" value ="<?php echo $guige ?>" />
	<input type="hidden" name="oldJianshu" id="oldJianshu" value ="<?php echo $jianshu ?>" />
	<input type="hidden" name="oldDingzhong" id="oldDingzhong" value ="<?php echo $dingzhong ?>" />
	<input type="hidden" name="oldZhongliang" id="oldZhongliang" value ="<?php echo $zhongliang ?>" />
日期：<input type="text" name="riqi" id="riqi" placeholder="2017-08-01" value ="<?php echo $riqi ?>"/> <br/>
机台：<select name="jitai" id="jitai" onchange="setDingzhong()">
<?php if($jitai=="1#"){ ?><option value="1#" selected = "selected">1#</option><?php }else{?><option value="1#">1#</option><?php }?>
<?php if($jitai=="2#"){ ?><option value="2#" selected = "selected">2#</option><?php }else{?><option value="2#">2#</option><?php }?>
<?php if($jitai=="3#"){ ?><option value="3#" selected = "selected">3#</option><?php }else{?><option value="3#">3#</option><?php }?>
<?php if($jitai=="4#"){ ?><option value="4#" selected = "selected">4#</option><?php }else{?><option value="4#">4#</option><?php }?>
<?php if($jitai=="5#"){ ?><option value="5#" selected = "selected">5#</option><?php }else{?><option value="5#">5#</option><?php }?>
<?php if($jitai=="6#"){ ?><option value="6#" selected = "selected">6#</option><?php }else{?><option value="6#">6#</option><?php }?>
<?php if($jitai=="7#"){ ?><option value="7#" selected = "selected">7#</option><?php }else{?><option value="7#">7#</option><?php }?>
<?php if($jitai=="8#"){ ?><option value="8#" selected = "selected">8#</option><?php }else{?><option value="8#">8#</option><?php }?>
<?php if($jitai=="9#"){ ?><option value="9#" selected = "selected">9#</option><?php }else{?><option value="9#">9#</option><?php }?>
<?php if($jitai=="10#"){ ?><option value="10#" selected = "selected">10#</option><?php }else{?><option value="10#">10#</option><?php }?>
<?php if($jitai=="11#"){ ?><option value="11#" selected = "selected">11#</option><?php }else{?><option value="11#">11#</option><?php }?>
<?php if($jitai=="12#"){ ?><option value="12#" selected = "selected">12#</option><?php }else{?><option value="12#">12#</option><?php }?>
<?php if($jitai=="13#"){ ?><option value="13#" selected = "selected">13#</option><?php }else{?><option value="13#">13#</option><?php }?>
<?php if($jitai=="绅灵1#"){ ?><option value="绅灵1#">绅灵1#</option><?php }else{?><option value="绅灵1#">绅灵1#</option><?php }?>
<?php if($jitai=="绅灵2#"){ ?><option value="绅灵2#">绅灵2#</option><?php }else{?><option value="绅灵2#">绅灵2#</option><?php }?>
<?php if($jitai=="伟祥1#"){ ?><option value="伟祥1#">伟祥1#</option><?php }else{?><option value="伟祥1#">伟祥1#</option><?php }?>
<?php if($jitai=="盛平1#"){ ?><option value="盛平1#">盛平1#</option><?php }else{?><option value="盛平1#">盛平1#</option><?php }?>
</select><br/>
名称：<input type="text" name="mingcheng" id="mingcheng" value ="<?php echo $mingcheng ?>"/> <br/>
规格：<select name="guige" id="guige">
<?php if($guige=="75D/48F"){ ?><option value="75D/48F" selected = "selected">75D/48F</option><?php }else{?><option value="75D/48F">75D/48F</option><?php }?>
<?php if($guige=="75D/36F"){ ?><option value="75D/36F" selected = "selected">75D/36F</option><?php }else{?><option value="75D/36F">75D/36F</option><?php }?>
<?php if($guige=="30D/24F"){ ?><option value="30D/24F" selected = "selected">30D/24F</option><?php }else{?><option value="30D/24F">30D/24F</option><?php }?>
<?php if($guige=="50D/48F"){ ?><option value="50D/48F" selected = "selected">50D/48F</option><?php }else{?><option value="50D/48F">50D/48F</option><?php }?>
</select> <br/>
等级：<select name="dengji" id="dengji" onchange="setDingzhong()">
<?php if($dengji=="AA"){ ?><option value="AA" selected = "selected">AA</option><?php }else{?><option value="AA">AA</option><?php }?>
<?php if($dengji=="A"){ ?><option value="A" selected = "selected">A</option><?php }else{?><option value="A">A</option><?php }?>
<?php if($dengji=="一等"){ ?><option value="一等" selected = "selected">一等</option><?php }else{?><option value="一等">一等</option><?php }?>
</select><br/>
数量：<input type="number" name="jianshu" id="jianshu" value ="<?php echo $jianshu ?>" onkeyUp="this.value=this.value.replace(/[^0-9\.]/g,'')" onchange="setZhongLiang()"/> <br/>
定重：<input type="text" name="dingzhong" id="dingzhong" value ="<?php echo $dingzhong ?>" onkeyUp="this.value=this.value.replace(/[^0-9\.]/g,'')" onchange="setZhongLiang()"/> <br/>
重量：<input type="text" name="zhongliang" id="zhongliang" value ="<?php echo $zhongliang ?>" readOnly="true"/> <br/>
<input type="submit" name="submit" value="提交" />
</form>