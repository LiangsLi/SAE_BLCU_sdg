<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery-1.7.2.min.js" type="text/JavaScript"></script>
<script src="js/jquery.cookie.js" type="text/JavaScript"></script>
<title>semanticannotate</title>
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
    width: 220px;
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
	/*text-align:center;IE想要让div显示居中*/
}
.bg_body {
    background-color: #E1E1DF;
}

.outside{
	margin-top:0px;
	height:900px;
	width:100%;
	background-image:url("img/background_1.jpg");	
	background-repeat:no-repeat;
	background-attachment:scroll;
	background-position:center;
}
.footer {
    clear: both;
    color: #999999;
    height: 42px;
    line-height:42px;
    text-align:center;
    width: 100%;
}
.footer span {
    padding-right: 10px;
}

.outside .content{
	margin:0 auto;
	width:480px;
	position:relative;
}

.content .mainContent{
	margin:0 auto;
	width:470px;
	/*background: #009900;*/
}
.content .login-center{
	/*background:#66CC66;*/
	margin:0 auto;
	margin-top: 50px;
	width:350px;
}
.content .login-center-reger{
	/*background:#66CC66;*/
	margin:0 auto;
	margin-top: 50px;
	width:430px;
}
.outside .content-top{
	width:100%;
	margin:0 auto;
	background:url("img/black2.jpg") repeat-x;
	/*background-color:#CC6666;*/
}
.content-top .note{
	margin-left:15px;
}
.content-top .note p{
	padding-left:5px;
	padding-right:10px;
	padding-top:5px;
	padding-bottom:10px;
	line-height:24px;
	color:white;/*#E1E1DF;*/
	font-family: "华文新魏", "幼圆","华文彩云","华文行楷","华文隶书";
	font-size:19px;
	margin-left:70px;
}
.note h3{
	color: #8ECCC0;
    font-size: 25px;
	font-family:"Microsoft YaHei";
	font-weight:bold;
    margin-top: 7px;
	margin-left:110px;
}

.mainContent .keyword{
	background:#4DB361;
	width:300px;/*背景色宽度是300px*/
	color:#333333;
	margin-top: 55px;/*整体上提*/
	margin-left: 28px;
	height:70px;
	-moz-opacity:0.2; 
	filter:alpha(opacity=20);
	position:relative;
}

.keyword .keyword-output {
	float:left;
	padding-top:18px;
	padding-left:10px;
	font-family:"华文行楷";
    font-size: 30px;
	color:#000000;
	filter:alpha(opacity=100);
}
.result-final{
	width:230px;/*背景色宽度是300px*/
	background-color:#66CC66;
	margin-top: 5px;
	margin-left: 0px;/*绿色背景左对齐*/
	height:55px;
	/*-moz-opacity:0.2; 
	filter:alpha(opacity=20);*/
	position:relative;
}

.result-final .result-output {
	float:left;
	padding-top:18px;
	padding-left:10px;
	font-family:"华文行楷";
    font-size: 18px;
	color:#000000;
	filter:alpha(opacity=60);
}

.keyword .thinkt{
	float:right;
	padding-right:0px;
	padding-top:10px;
	padding-left:20px;
	padding-bottom:20px;
	font-family:Georgia, "Times New Roman", Times, serif;
	font-size:20px;
	color:#990000;
	margin-right:30px;
}

.mainContent .associationTag {
    clear: both;
    float: left;
    width: 460px;/*对这个词没感觉？换一个*/
	margin-left:25px;
	margin-top:5px;
	/*background:#555555;
	filter：alpha(opacity=0,finishopacity=100,style=1,startx=0,starty=85,finishx=150,finishy=85);*/
}

.associationTag .inputTag {
	float:left;
    background: url("arrow.png") no-repeat scroll 278px 10px #FFFFFF;
    border-radius: 5px 5px 5px 5px;
    font-size: 18px;
    padding: 5px 0;
    width: 300px;/*输入框长度*/
}
.associationTag .next-keyword{
	float:right;
	margin-right:55px;
	margin-top:6px;
	font-family:"华文彩云";/*, "华文行楷", "华文隶书", "华文新魏", "幼圆";*/
	font-size:20px;
	font-weight:bold;
	color:#990000;
	/*background:#777777;*/
}
.input_arrow {
    background: url("img/small-arrow.png") no-repeat scroll 0 0 transparent;
    margin-top:74px;
	margin-left: 10px;/*这两个值调节箭头的位置*/
    width: 12px;
	height: 7px;
	position:relative;/*很重要，箭头保证在三个浏览器上都能正确显示，若是absulate则IE不好使*/
}
.ltag_list{
	float:left;
	/*background-color:#66CC66;*/
	margin-left:3px;
	margin-top:10px;
	width:150px;
	filter();
}
.rtag_list{
	float:right;
	/*background:#66CC69;*/
	margin-top:10px;
	margin-right:140px;
	width:150px;
}

.bfiveTag{
	/*background-color:#8ECCC0;*/
	margin-top:15px;
	margin-bottom:15px;
	margin-right:5px;
	margin-left:5px;
	padding-left:10px;
	text-align:left;
}
.lastfTag{
	/*background-color:#8ECCC0;*/
	margin-top:15px;
	margin-bottom:15px;
	margin-right:5px;
	padding-left:10px;
	text-align:left;
}
.bfiveTag panel, .lastfTag panel{
	font-size:18px;

}
.ffileList panel{font-size:18px;}


.login-center .item , .login-center-reger .item{
    margin: 10px 0;
}
.login-center .item label ,.login-center-reger .item label{
    display: inline-block;
    font-size: 14px;
    line-height: 30px;
    margin-right: 15px;
    text-align: right;
    vertical-align: baseline;
    width: 60px;
}
.login-input{
	backgound:#000;
	border: 1px solid #C9C9C9;
    border-radius: 3px 3px 3px 3px;
    font-size: 14px;
    height: 18px;/*输入框的高度*/
    padding: 5px;
	padding-bottom:0px;
	margin-top:5px;
	margin-bottom:0px;
    vertical-align: middle;
    width: 200px;
}
.login-input2{
	backgound:#000;
	border: 1px solid #C9C9C9;
    border-radius: 3px 3px 3px 3px;
    font-size: 14px;
    height: 18px;/*输入框的高度*/
    padding: 5px;
	padding-bottom:0px;
	margin-top:5px;
	margin-bottom:0px;
    vertical-align: middle;
    width: 200px;
	color:gray;
}
.login-inpur:focus{
	border: 2px solid #A9A9A9;
}
.item a{
    cursor: pointer;
    display: inline;
    font-size: 12px;
    margin: 100px;
    text-align: left;
    width: 200px;
}
.item p{
    cursor: pointer;
    display: inline;
    font-size: 12px;
    margin-right: 10px;
    text-align: left;
}
.next-word{
	float:left;
	background: none repeat scroll 0 0 #3FA156;
    border: 0px;
    border-radius: 5px 5px 5px 5px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    padding: 6px 16px;
	margin-left:25px;
	margin-top:27px;
}
.game-over{
	float:right;
	margin-right:190px;
	margin-top:27px;
	background: none repeat scroll 0 0 #666666;
    border: 0px;
    border-radius: 5px 5px 5px 5px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    padding: 6px 16px;
}
.login-submit {
    background: none repeat scroll 0 0 #3FA156;
    border: 0px solid #528641;
    border-radius: 3px 3px 3px 3px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    padding: 10px 16px;
}
.name-test{
	margin-top:7px;
	margin-right:20px;
	float:right;
	background: none repeat scroll 0 0 #3FA156;
    border: 0px;
    border-radius: 3px 3px 3px 3px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 12px;
    padding-left: 0px;
	padding-right:0px;
	padding-bottom:3px;
	padding-top:3px;
}
.result_list{
	/*background-color:#66CC99;*/
	margin-top:5px;
}

.ffiveList{
	/*background-color:#66CC66;*/
	margin-top:0px;
	margin-bottom:5px;
	padding-bottom:5px;
	padding-top:5px;
	padding-left:5px;
	padding-right:5px;
	font-size:13px;
	font-family:"新宋体";
}

#res_before{
	font-size:17px;
	font-family:"华文楷体";
	font-weight:bold;
}
.scroll_tip{
	position:relative;/*很重要，箭头保证在三个浏览器上都能正确显示，若是absulate则IE不好使*/
	margin-left:325px;/*框的位置*/
	margin-top:38px;
	clip:rect(0 150 150 0);
	width:150px;
	background-color:seashell;
	visibility:hidden;
}
.nouse{
	text-align:left;
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
</style>
<script language="javascript" type="text/JavaScript">
$(function(){
	$("#username").one('click',function(){/*只第一次绑定一次*/
			$(this).val("");
			$(this).css("color","black");
		}	
	);
});

function createXMLHttp(){
	var request;
	var browser=navigator.appName;
	if(browser=="Microsoft Internet Explorer"){
		request=new ActiveXObject("Microsoft.XMLHttp");
		return request;
	}else{
		request=new XMLHttpRequest();
		return request;
	}
}
var xhr = createXMLHttp();	
function names(){
	//window.alert(document.getElementById("username").value.length);
	var strs = "users=" + document.getElementById("username").value;
	var val = document.getElementById("username").value;
	var punctuation = /，|。|？|！|@|#|￥|%|&|\*|（|）|……|‘|’|”|“|\||；|：|《|》|、|·|~|-|\+|=|——|}|{|】|【/;
	var pun =/\.|,|\?|<|>|\/|;|:|\'|\"|\[|\]|\||\\|\*|\^|\$|@|!|`|~/;
	if(val.search(punctuation) != -1 || val.search(pun) != -1){
			document.getElementById("nouse").innerHTML = "用户名只能是汉字、数字、字母呦~~~";
			document.login.username.select();
			document.login.username.focus();
			return;
	}
	//window.alert(strs);
	var url = "nameCheck.php";
	xhr.open("POST",url, true);
	xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xhr.send(strs);
	xhr.onreadystatechange=getHello2;
}
var flag = 0;
function getHello2(){
    window.alert(xhr.readyState);
	if(xhr.readyState==4){
		var helloStr = xhr.responseText;
        window.alert(helloStr);
		if(helloStr.indexOf('用户名可用！') != -1){
			flag = 1;
		}
		document.getElementById("nouse").innerHTML = helloStr;
	}
}
$(function(){
	$("#submit").click(function(){
		if(flag == 1){
			var user = document.getElementById("username").value;
			$.cookie('user', user);
			$.cookie('uid', '0');
			//window.alert($.cookie('user') + " " + $.cookie('uid'));
		}
	});
});
</script>
</head>
<body class="bg_body">
<div class="header">
    <a href="http://blcusdg.applinzi.com" class="logo" target="_top" title="首页" alt="首页">
        <img src="img/words.jpg" />
    </a>
    <ul class="userinfo">
        <li>
        <a href="loginc.php">登陆</a>
        </li>
    </ul>
</div>
<div class="outside">
	<div class="content-top">&nbsp;
		<div class="note">

		</div>
	</div>
	<div class="content">
	<div class="login-center-reger">
		<form id="login" name="login" action="register.php" method="post">
				<div class="item"><label>用户名</label><input type="text" id="username" name="username" class="login-input2" value="汉字或英文，最多14个字符" maxlength="14" tabindex="1"/>
													<!--<button class="name-test" onclick="nametest();" value="检查用户名是否可用" tabindex="2">-->
													<input type="button" class="name-test" name="check2" value="检查用户名是否可用" tabindex="2" onclick="names();" />
				</div>
				<div class="item"><label>密码</label><input type="password" id="password" name="password" class="login-input" maxlength="60" tabindex="3" value=""/></div>
				<div class="item"><label>确认密码</label><input type="password" id="password2" name="password2" 
											class="login-input" maxlength="60" tabindex="4" value=""/></div>
				<div class="item">
					<label>&nbsp;</label><p id="nouse">&nbsp;</p>
				</div>
				<div class="item"><label>&nbsp;</label>
					<input type="submit" value="提交" name="submit" id="submit" class="login-submit" tabindex="5" />
				</div>
		</form>
		</div>
	</div>	 
</div>

<div class="footer">
	<span>&copy; 2012－2012 ,semanticannotate.sinaapp.com all rights reserved</span>
</div>
</body>
</html>