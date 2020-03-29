	
	function init(){
		document.getElementById("userId").focus();
	}
	function checkLogin(){
		var userId=document.getElementById("userId").value;
		var password=document.getElementById("password").value;
	
		if(userId==null||userId==""){
			alert("请输入账号");
			document.getElementById("userId").focus();
			return false;
			
		}
		if(password==null||password==""){
			alert("请输入密码");	
			document.getElementById("password").focus();
			return false;
		}
		
		if(password=="admin"&&userId=="admin"){
			return true;
		}else{
			alert("账号密码错误");	
			return false;
		}
		
	}