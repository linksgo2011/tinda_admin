<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="js/jquery.p.js"></script>
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
	function register1(){
		var cxpinp = document.getElementById("#cxpinp");
		var cxchoux = document.getElementById("#cxchoux");
		var cxnianf = document.getElementById("#cxnianf");
		var cxchoujm = document.getElementById("#cxchoujm");
		var pass1 = document.getElementById("#password");
		var pass2 = document.getElementById("#password1");
        //PINpass.innerHTML = 'abcdefghigk';
	jQuery.ajax({
		type	:	"post",
		url		:	"td_admin/zhwpass.php",
		data	:	{"cxpinp" : cxpinp,"cxchoux" : cxchoux,"cxnianf" : cxnianf,"cxchoujm" : cxchoujm,"pass1" : pass1,"pass2" : pass2},
		success	: 	function(data){
			if(data == "no"){
			//lyts11.innerHTML = "查询中...";
			document.getElementById("lyts11").value="查询中...";
			setTimeout("zhwpasscx()",10000);
			return false;
			}else{
			document.getElementById("lyts11").value=data;
		    }
		}
	});
////////////////////////////////////////////////////////////////
			return false;
}
</script>
  密1<input name="password" type="text" id="password" value="">
  密2<input type="text" name="password1" id="password1">
  品牌<input type="text" name="cxpinp" id="cxpinp">
  车型<input type="text" name="cxchoux" id="cxchoux">
  年份<input type="text" name="cxnianf" id="cxnianf">
  车架<input type="text" name="cxchoujm" id="cxchoujm">
  <input type="text" name="lyts11" id="lyts11">
<input type="button" onclick="register1()" value="输入"/>
