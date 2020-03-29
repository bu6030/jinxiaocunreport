	//AdminAddUserHead.jsp检测用户资料是否填写完整
	function checkRegister(){
		var userName=document.getElementById("userName").value;
		var userFirstName=document.getElementById("userFirstName").value;
		var userAge=document.getElementById("userAge").value;		
		var password=document.getElementById("password").value;
		var checkPass=document.getElementById("checkPass").value;		
		if(userName==null||userName==""){	
			alert("请输入账号");
			return false;
		}
		if(userFirstName==null||userFirstName==""){
			alert("请输入姓名");
			return false;
		}
		if(userAge==null||userAge==""){
			alert("请输入年龄");
			return false;
		}
		if(password==null||password==""){
			alert("请输入密码");
			return false;
		}
		if(checkPass==null||checkPass==""){
			alert("请输入确认密码");
			return false;
		}
		if(password!=checkPass){
			alert("两次输入新密码不一致");
			return false;
		}
		
	}	
	//注册隐藏页面初始化
	function registerHiddenInit(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("注册成功");
		}else{
			alert("注册失败");
		}
	}
	//登陆隐藏页面初始化
	function loginHiddenInit(){
		var result=document.getElementById("result").value;
		var path=document.getElementById("path").value;
		parent.main.location.reload();
		if(result=="1"){
			alert("登陆成功");
			parent.window.location.replace(path+"jsp/user/index.jsp"); 
		}else{
			alert("登陆失败");
		}
	}
	//登陆检测
	function checkLogin(){
		var userId=document.getElementById("userId").value;
		var password=document.getElementById("password").value;
		if(userId==null||userId==""){	
			alert("请输入账号");
			return false;
		}
		if(password==null||password==""){
			alert("请输入密码");
			return false;
		}
	}
	//UserUploadFilesHidden隐藏页面初始化
	function uploadFilesInit(){
		var result=document.getElementById("result").value;
		var errorType=document.getElementById("errorType").value;
		if(result=="1"){
			alert("上传成功");
		}else{
			alert("上传失败,"+errorType);
		}
		parent.main.location.reload();
	}
	//添加新闻页面初始化fckeditor运用初始化
	function fckeditorInit(){
		var oFCKeditor = new FCKeditor( 'content' ) ;
		var basePath = document.getElementById("basePath").value;
		oFCKeditor.BasePath = basePath+"fckeditor/" ;
		oFCKeditor.ToolbarSet="itcastbbs";
		oFCKeditor.Width="650";
		oFCKeditor.Height="300";
		oFCKeditor.Value="initial";
				
		oFCKeditor.ReplaceTextarea() ;
	}	
	//检测发送短信息不为空
	function checkSendMessage(form) { 
		var messageTitle = document.getElementById("messageTitle").value;
		if(messageTitle==null||messageTitle==""){	
			alert("请输入短信息标题");
			return false;
		}
	    var fck = FCKeditorAPI.GetInstance("content"); 
	    var content = fck.GetXHTML(true); 
	    if (content.replace(/ <(?!img|input|object)[^>]*>|\s+/ig, "") == "") { 
	        alert("短信息内容不能为空!"); 
	        fck.Focus(); 
	        return false; 
    	} 
   	 return true; 
	}
	//SendMessageHidden隐藏页面初始化
	function sendMessageHidden(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("发送成功");
		}else{
			alert("发送失败");
		}
	}	
	//MessageDeleteHidden隐藏页面初始化
	function messageDeleteHidden(){
		parent.main.location.reload();		
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("删除成功");
		}else{
			alert("删除失败");
		}
	}		
	
	//updateHidden隐藏页面初始化
	function updateHidden(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
	}
	//用户修改信息检测	
	function checkUpdateSelf(){
		var userId=document.getElementById("userId").value;
		var userFirstName=document.getElementById("userFirstName").value;
		var userAge=document.getElementById("userAge").value;		
		if(userId==null||userId==""){	
			alert("请输入账号");
			return false;
		}
		if(userFirstName==null||userFirstName==""){
			alert("请输入姓名");
			return false;
		}
		if(userAge==null||userAge==""){
			alert("请输入年龄");
			return false;
		}
	}	
	//用户检测修改密码
	function checkUpdatePass(){
		var userpass=document.getElementById("userpass").value;
		var oldPass=document.getElementById("oldPass").value;
		var newPass=document.getElementById("newPass").value;
		var checkPass=document.getElementById("checkPass").value;
		if(oldPass==null||oldPass==""){
			alert("请输入原始密码");
			return false;
		}
		if(newPass==null||newPass==""){
			alert("请输入新密码");
			return false;
		}
		if(checkPass==null||checkPass==""){
			alert("请输入确认密码");
			return false;
		}
		if(oldPass!=userpass){
			alert("输入密码错误");
			return false;
		}else if(newPass!=checkPass){
			alert("两次输入新密码不一致");
			return false;
		}else{
			document.getElementById("userpass").value=newPass;
		}
	}		