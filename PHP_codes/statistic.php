<?php
require("config2.php");
$admin = $_COOKIE['admin'];
/*$a=array(); 
while(count($a)< 2) //小于几就是生成几个不同的随机数
	$a[rand(0, ($listnum-1))]=null; //利用键的唯一性，确保不同的值;从0-$listnum-1的随机数，包含两边
$a=array_keys($a);
echo $listnum . " :  ".$a[0]."  ". $a[1]. '<br>';*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-1.7.2.min.js" type="text/JavaScript"></script>
<script src="js/jquery.cookie.js" type="text/JavaScript"></script>
<style type="text/css">
/* CSS Document */
html {
    font-family: Tahoma;
    font-size: 62.5%;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, input, button, textarea, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {
    margin: 0;
    padding: 0;
}
/*去掉前面的编号*/
ul,ol{
	list-style: none outside none;
}
a {
	color:#FFFFFF;
}
h1, h2, h3, h4, h5, h6 {
    font-size: 100%;
    font-weight: normal;
}

.header {
    background: none repeat scroll 0 0 #333333;
    color: #D4D4D4;
    height: 58px;
    width: 100%;
}
.header a, .header a:hover {
    border: 0 none;
    outline: 0 none;
}
.header a:hover {
    color: #8B8B8B;
}
.associationTag a, .associationTag a:hover {
    border: 0 none;
    outline: 0 none;
}
.associationTag a:hover{
	color: #66CC66;
}
.header li{
	color:#FFFFFF;
}
.header .logo {
    float: left;
    height: 43px;
    line-height: 43px;
    margin: 15px 0 0;
    padding-left: 15px;
    text-align: left;
    width: 440px;
	color:white;
	font-size:1.4em;
}
.header .logo img {
    margin: 3px 0 0 10px;
}
.header .userinfo {
    float: right;
    height: 43px;
    line-height: 43px;
    margin: 15px 0 0;
    padding-right: 15px;
    text-align: right;
    width: 440px;
}
body {
    font-size: 1.2em;
    line-height: 1.333;
	background-color: #E1E1DF;
	/*text-align:center;IE想要让div显示居中*/
}

img{
	border:none;
}
table {
	border-collapse: collapse;
	border:solid #666666;/*#3FA156;*/
	width: 100%;
}
tr, td , th{
	padding: 0.5em 1em;
} 
.sent2{
    line-height: 50px;
	margin-left:25px;
    text-align: left;
	font-size:1.2em;
}
.tag{
	font-size:1.2em;
	margin-top:10px;
	margin-left: 60px;
	font-family:"微软雅黑";
}
.submit-check{
	margin-left:60px;
}

.code{
   margin: 5px;
   padding: 10px;
   border: 1px solid #87BF23;
   background-color: #eee;
   font-size: 1.5em;
}
.tmp{
	clear:both;
	float:left;
	width:30%;
}
.save{
	margin-left:30px;
	line-height: 36px;
    text-align: center;
    width: 50px;
	font-size:1.1em;
	vertical-align:middle ;
}
.rw{
	font-size:1.4em;
}
.rw2{
	margin-left: 60px;
}
.search-selection{
	line-height: 40px;
    margin-left: 60px;
    text-align: left;
    width: 90%;
	font-size:1.2em;
}
.textfield{
	margin-left: 110px;
}

.inputTag {
    background: url("img/arrow.png") no-repeat scroll 278px 10px #FFFFFF;
    border-radius: 5px 5px 5px 5px;
    font-size: 18px;
    padding: 5px 0;
	margin-left:60px;
	margin-top:30px;
    width: 300px;/*输入框长度*/
}
</style>

<script language="javascript" type="text/JavaScript">
$(function(){
	$("#name").keydown(function(e){
		if(e.keyCode==13){
			var val = document.form2.thinkw.value;
			$.post(
				"get_statistic.php", 
				{annoter:val},
				function (data){
					//window.alert(data);//1100%%`$$1200%%`$$juzi,shijian,chargecomment<br>.....%%`$$rate
					var tmp = data.split("%%`$$");
				
					//var str = "已完成标注数目：" + tmp[0]+"<br>准确率为：" +tmp[2] +"<br><br>" + "错误内容为:<br>" + tmp[1];
					var str = "目前已经成标注数目：" + tmp[0]+"<br>"+"本周成标注数目：" + tmp[1]/*+"<br>准确率为：" +tmp[3]*/ +"<br><br>" + "错误内容为:<br>" + tmp[2];
					document.getElementById('result').innerHTML = str;
				},
				"text"
			);
		}
	});

	$("#submit-check").click(function(){
		var val = document.form2.thinkw.value;
		$.post(
			"get_statistic.php", 
			{annoter:val},
			function (data){
				//window.alert(data);//1100%%`$$juzi,shijian,chargecomment<br>.....%%`$$rate
				var tmp = data.split("%%`$$");
				
				var str = "目前已经成标注数目：" + tmp[0]+"<br>"+"本周成标注数目：" + tmp[1]+/*"<br>准确率为：" +tmp[3] +*/"<br><br>错误内容为:<br>" + tmp[2];
				document.getElementById('result').innerHTML = str;
			},
			"text"
		);
	});

	$("#logout").click(function(){  
		$.cookie('admin', null);
		window.location.href="charge.php";
	});
});
</script>

</head>
<body>
	<div class="header">
	<p class="logo" >
        分词词性标注管理系统
    </p>
		<ul class="userinfo" >
			<li id="headuser">
				<?php
					if (isset($_COOKIE["admin"])){//如果有cookie，则将user入session
						$_SESSION['admin'] = $_COOKIE['admin'];
					}	
					$users = $_SESSION['admin'];
					if($users != ""){
						echo $users;
					}
				?> | <a href="#" id="logout">退出</a>
			</li>
		</ul>
	</div>

	<p class='tag'>输入一个标注者ID，查询标注结果！</p>
	<div   id="tt">   
	<form name="form2" id="form2" action="javascript:checkSumbit(); ">
		<input class="inputTag" name="thinkw" id="name" type="text"  value="" onFocus="this.select()" />
		<button type="button"class="save" id="submit-check">提交</button>
	</form>
	</div>

	<div id='result' class = 'search-selection'></div>
</body>
</html>