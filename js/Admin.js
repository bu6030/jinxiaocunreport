	
	
	
	//管理员检测修改密码
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

	//管理员修改信息检测	
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
	//AdminUploadFilesHidden隐藏页面初始化
	function uploadFilesInit(){
		var result=document.getElementById("result").value;
		var errorType=document.getElementById("errorType").value;
		if(result=="1"){
			alert("上传成功");
		}else{
			alert("上传失败,"+errorType);
		}
	}
	
	//AdminUpdateHidden隐藏页面初始化
	function updateHiddenInit(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
	}
	//AdminAddUserHidden隐藏页面初始化
	function addUserHiddenInit(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("添加成功"+result);
		}else{
			alert("添加失败"+result);
		}
	}
	//AdminColUserHidden隐藏页面初始化
	function colUserHiddenInit(){
		parent.C_AdminColUserContent.location.reload();
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
	}	

	//AdminColResourceHidden隐藏页面初始化
	function colResourceHiddenInit(){
		parent.C_AdminColResourceContent.location.reload();
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
	}	
	//AdminAddUserHead.jsp检测用户资料是否填写完整
	function checkAddUser(){
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
	//AdminUploadFilesHead.jsp检测上传资料是否填写完整
	function checkUploadFiles(){
		var resourceName=document.getElementById("resourceName").value;
		var resourceDesc=document.getElementById("resourceDesc").value;
		if(resourceName==null||resourceName==""){	
			alert("请输入资源名称");
			return false;
		}
		if(resourceDesc==null||resourceDesc==""){
			alert("请输入资源描述");
			return false;
		}		
	}
	//AdminColResourceUpdate.jsp检测修改的资料是否填写完整
	function checkResourceUpdate(){
		var resourceName=document.getElementById("resourceName").value;
		var resourceDesc=document.getElementById("resourceDesc").value;
		if(resourceName==null||resourceName==""){	
			alert("请输入资源名称");
			return false;
		}
		if(resourceDesc==null||resourceDesc==""){
			alert("请输入资源描述");
			return false;
		}
	
	}
	//AdminAddNewsHidden隐藏页面初始化
	function addNewsHiddenInit(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("添加成功");
		}else{
			alert("添加失败");
		}
	}
	//AdminColNewsHidden隐藏页面初始化
	function colNewsHiddenInit(){
		parent.C_AdminColNewsContent.location.reload();
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
	}		
	//添加新闻页面初始化fckeditor运用初始化
	function fckeditorInit(){
		var oFCKeditor = new FCKeditor( 'content' ) ;
		var basePath = document.getElementById("basePath").value;
		oFCKeditor.BasePath = basePath+"fckeditor/" ;
		oFCKeditor.ToolbarSet="itcastbbs";
		oFCKeditor.Width="700";
		oFCKeditor.Height="500";
		oFCKeditor.Value="initial";
				
		oFCKeditor.ReplaceTextarea() ;
	}
	
	//检测添加新闻不为空
	function checkAddNews(form) { 
		var newsTitle = document.getElementById("newsTitle").value;
		if(newsTitle==null||newsTitle==""){	
			alert("请输入新闻标题");
			return false;
		}
	    var fck = FCKeditorAPI.GetInstance("content"); 
	    var content = fck.GetXHTML(true); 
	    if (content.replace(/ <(?!img|input|object)[^>]*>|\s+/ig, "") == "") { 
	        alert("新闻内容不能为空!"); 
	        fck.Focus(); 
	        return false; 
    	} 
   	 return true; 
	}

	//AdminColNewsUpdateHidden隐藏页面初始化
	function colNewsUpdateHiddenInit(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
	}	
	//AdminColResourceUpdateHidden隐藏页面初始化
	function colResourceUpdateHiddenInit(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
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
	//AdminSendMessageHidden隐藏页面初始化
	function sendMessageHiddenInit(){
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("发送成功");
		}else{
			alert("发送失败");
		}
	}
	//AdminColCommentsHidden隐藏页面初始化
	function colCommentsHiddenInit(){
		parent.C_AdminColCommentsContent.location.reload();
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("修改成功");
		}else{
			alert("修改失败");
		}
	}
	//AdminColCommentsHidden隐藏页面初始化
	function adminColMessageDeleteHiddenInit(){
		parent.C_AdminColMessageContent.location.reload();
		var result=document.getElementById("result").value;
		if(result=="1"){
			alert("删除成功");
		}else{
			alert("删除失败");
		}
	}
	
	//实现批量删除	，全选
	function selectAll() {
		 var obj = document.form.groupDeleteId;
		 for (i = 0; i < obj.length; i++) {
		  	obj[i].checked = (event.srcElement.checked) ? true : false;
		 }
	}

