function indexLogin(){
		var l_name = $.trim($("#l_name").val());
		if(l_name == null || l_name == ""){
			$("#lyts11").html("请输入用户名");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var l_pass = $.trim($("#l_pass").val());
		if(l_pass == null || l_pass == ""){
			$("#lyts11").html("请输入密码");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
	jQuery.ajax({
		type	:	"post",
		url		:	"login123.php",
		data	:	{"l_name" : l_name,"l_pass" : l_pass},
		success	: 	function(data){
			if(data == "yes"){
			$("#lyts11").html("登录成功，正在跳转中……");
			$("#lyts11").addClass("red1");
            location.href = "index.php";
			return false;
			}
			if(data == "ndate"){
			$("#lyts11").html("您的帐号已过期，请联系您的服务商！");
			$("#lyts11").addClass("red1");
		    }
			if(data == "no"){
			$("#lyts11").html("您的用户名或密码有误，请重新输入！");
			$("#lyts11").addClass("red1");
            }
		}
	});
			return false;
	}
function indexLogin1(){
		var l_ID = $.trim($("#l_ID").val());
		var l_pass = $.trim($("#l_pass").val());
		if(l_pass == null || l_pass == ""){
			$("#lyts11").html("请输入新密码");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var l_pass1 = $.trim($("#l_pass1").val());
		if(l_pass1 == null || l_pass1 == ""){
			$("#lyts11").html("请输入确认密码");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		if(l_pass != l_pass1){
			$("#lyts11").html("两次密码不一致，请重新输入");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
	jQuery.ajax({
		type	:	"post",
		url		:	"xiugan123.php",
		data	:	{"l_ID" : l_ID,"l_pass" : l_pass},
		success	: 	function(data){
			if(data == "yes"){
			$("#lyts11").html("修改成功");
			$("#lyts11").addClass("red1");
            location.href = "index.php";
			return false;
			}else{
			$("#lyts11").html("操作有误！");
			$("#lyts11").addClass("red1");
            }
		}
	});
			return false;
	}
function indexzhuche(){
		var title1 = $.trim($("#title1").val());
		if(title1 == null || title1 == ""){
			$("#lyts11").html("请输入用户名!");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var name = $.trim($("#name").val());
		if(name == null || name == ""){
			$("#lyts11").html("请输入经销商");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var email = $.trim($("#email").val());
		if(email == null || email == ""){
			$("#lyts11").html("请输入姓名");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var area = $.trim($("#area").val());
		if(area == null || area == ""){
			$("#lyts11").html("请输入qq号");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var address = $.trim($("#address").val());
		if(address == null || address == ""){
			$("#lyts11").html("请输入地址");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var phome = $.trim($("#phome").val());
		if(phome == null || phome == ""){
			$("#lyts11").html("请输入电话");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var comment = $.trim($("#comment").val());
		if(comment == null || comment == ""){
			$("#lyts11").html("请输入系列号");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var pass1 = $.trim($("#pass1").val());
		if(pass1 == null || pass1 == ""){
			$("#lyts11").html("请输入密码");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		var pass2 = $.trim($("#pass2").val());
		if(pass2 == null || pass2 == ""){
			$("#lyts11").html("请再次输入密码");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}
		if(pass1 != pass2){
			$("#lyts11").html("两次密码不致，请重新输入！");
			$("#lyts11").addClass("red1");
			return false;
		}else{
			$("#lyts11").html("");
			$("#lyts11").removeClass("red1");
		}

	jQuery.ajax({
		type	:	"post",
		url		:	"zhuche123.php",
		data	:	{"title1" : title1,"name" : name,"email" : email,"area" : area,"address" : address,"phome" : phome,"comment" : comment,"pass1" : pass1},
		success	: 	function(data){
			if(data == "yes"){
			$("#lyts11").html("注册成功，请联系服务商为您正试开通……");
			$("#lyts11").addClass("red1");
            location.href = "index.php";
			return false;
			}
			if(data == "ndate"){
			$("#lyts11").html("用户名已存在！");
			$("#lyts11").addClass("red1");
		    }
			if(data == "no"){
			$("#lyts11").html("系列号已被使用！");
			$("#lyts11").addClass("red1");
            }
			if(data == "no1"){
			$("#lyts11").html("操作有误，请稍候再试！");
			$("#lyts11").addClass("red1");
            }
		}
	});
			return false;
	}
