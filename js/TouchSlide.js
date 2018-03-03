
function indexzhuche(){
		
	jQuery.ajax({
		type	:	"post",
		url		:	"zhuche123.php",
		data	:	{"title1" : title1,"name" : name,"email" : email,"area" : area,"address" : address,"phome" : phome,"comment" : comment,"pass1" : pass1},
		success	: 	function(data){
			if(data == "yes"){
			$("#lyts11").addClass("red1");
            location.href = "ok.php";
			return false;
			}
			if(data == "ndate"){
			$("#lyts11").html("用户名已存在！");
			$("#lyts11").addClass("red1");
		    }
			if(data == "no"){
			$("#lyts11").html("提示问题已被使用！");
			$("#lyts11").addClass("red1");
}
			if(data == "dz"){
			$("#lyts11").html("加密狗已经注册");
			$("#lyts11").addClass("red1");
            }
			if(data == "no1"){
			$("#lyts11").html("错误！");
			$("#lyts11").addClass("red1");
            }
		}
	});
			return false;
	}
