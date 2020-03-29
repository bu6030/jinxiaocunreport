<?php
header("Content-type: text/html; charset=utf-8"); 
error_reporting(E_ALL ^ E_DEPRECATED);
include("conn.php"); 

?>
<script type="text/javascript">
	window.onload=function(){
	  setDingzhong();
	}
	function setZhongLiang(){
		var dingzhong = document.getElementById("dingzhong").value;
		var jianshu = document.getElementById("jianshu").value;
		if(dingzhong!=''&&jianshu!=''){
			var zhongliang = accMul(dingzhong,jianshu);
			document.getElementById("zhongliang").value = zhongliang;
			//alert(dingzhong+"=="+jianshu+"=="+zhongliang);
			setJine();
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
	function setJine(){
		var danjia = document.getElementById("danjia").value;
		var zhongliang = document.getElementById("zhongliang").value;
		if(danjia!=''&&zhongliang!=''){
			var jine = accMul(danjia,zhongliang);
			document.getElementById("jine").value = jine;
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
</script>
出库录入
<form action="chukuSubmit.php" method="post" enctype="multipart/form-data">
日期：<input type="text" name="riqi" id="riqi" placeholder="2017-08-01" /> <br/>
机台：<select name="jitai" id="jitai" onchange="setDingzhong()">
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
<option value="绅灵1#">绅灵1#</option>
<option value="绅灵2#">绅灵2#</option>
<option value="伟祥1#">伟祥1#</option>
<option value="盛平1#">盛平1#</option>
</select><br/>
名称：<input type="text" name="mingcheng" id="mingcheng" /> <br/>
规格：<select name="guige" id="guige">
<option value="75D/48F">75D/48F</option>
<option value="75D/36F">75D/36F</option>
<option value="30D/24F">30D/24F</option>
<option value="50D/48F">50D/48F</option>
</select> <br/>
等级：<select name="dengji" id="dengji" onchange="setDingzhong()">
<option value="AA">AA</option>
<option value="A">A</option>
<option value="一等">一等</option>
</select><br/>
数量：<input type="number" name="jianshu" id="jianshu" onkeyUp="this.value=this.value.replace(/[^0-9\.]/g,'')" onchange="setZhongLiang()"/> <br/>
定重：<input type="text" name="dingzhong" id="dingzhong" onkeyUp="this.value=this.value.replace(/[^0-9\.]/g,'')" onchange="setZhongLiang()"/> <br/>
重量：<input type="text" name="zhongliang" id="zhongliang" readOnly="true" onchange="setJine()"/> <br/>
单价：<input type="text" name="danjia" id="danjia" onkeyUp="this.value=this.value.replace(/[^0-9\.]/g,'')" onchange="setJine()"/> <br/>
金额：<input type="text" name="jine" id="jine" readOnly="true"/> <br/>
客户名称：<input type="text" name="kehumingcheng" id="kehumingcheng" /> <br/>
<input type="submit" name="submit" value="提交" />
</form>

