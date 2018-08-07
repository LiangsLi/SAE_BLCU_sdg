<?php
	require("config2.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="js/jquery-1.7.2.min.js" type="text/JavaScript"></script>
<script src="js/jquery.cookie.js" type="text/JavaScript"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>semanticannotate
<?php 
if (isset($_COOKIE["user"])){//如果有cookie，则将user入session
	;
}else{
	$url = "index.php"; 
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>"; 
}
?></title>
<style type="text/css">
/* CSS Document */
html {
    font-family: Tahoma;
    font-size: 62.5%;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, 

s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, input, button, textarea, table, caption, 

tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, figcaption, figure, footer, header, hgroup, menu, nav, section, summary, time, mark, audio, video {
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
	width:90%;
	position:relative;
}

.content .mainContent{
	margin:0 auto;
	width:470px;
	/*background: #009900;*/
}
.content .login-center{
	background:#66CC66;
	margin:0 auto;
	width:350px;
}
.content .login-center-reger{
	background:#66CC66;
	margin:0 auto;
	width:470px;
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
img{
	border:none;
}


.sweetheart{//心有灵犀按钮
	height: 25px;
	border: 0px solid #528641;
	background: #990000; 
	position: absolute;
	bottom: 5px; 
	right: 120px;
	text-align: center;
	padding-top: 5px;
	color: #CCCCCC;
	font-family: "华文楷体";
	font-weight: bold;
	font-size: 16px;
    z-index:2008;
}

.backgroundPopup{
    display: none;
    position: fixed;
    _position: absolute;
    height: 100%;
    width: 100%;
    background: #CCCCCC;//非弹窗区域的背景色
    border: 1px solid #cecece;
    z-index: 1;
}
.popupContact a:hover{
	color:#8B8B8B;
}
.popupContact{
    display: none;
    position: fixed;
    _position: absolute;
    height: 220px;
    width: 300px;
    background:#666666;
    border: 4px solid #66CC66;
    z-index: 2;
    padding: 12px;
    font-size: 13px;
}   
.popupContact h1{
    text-align: left;
    color: #990000;
    font-size: 20px;
    font-weight: 700;
    border-bottom: 1px dotted #D3D3D3;//h1下方一条虚线
    padding-bottom: 2px;
    margin-bottom: 20px;
}
.popupContactClose{
    font-size: 14px;
    line-height: 14px;
    right: 6px;
    top: 4px;
    position: absolute;
    color: white;
    font-weight: 700;
    display: block;
}
.newtip{
	padding-bottom:5px;
	padding-top:5px;
	padding-left:3px;
	padding-right:3px;
}
.newtip1{
	padding-top:0px;
	padding-left:3px;
	padding-right:3px;
}
.virtual_body {
    width:100%;
    height:100%;
    overflow-y: auto;
    overflow-x: auto;
}
.sweetheart a{
	TEXT-DECORATION:none;//这句去掉a超链接的下滑线
}

.history{
    clear: both;
    width: 90%;
	margin-left:0px;
	margin-top:0px;
	/*background:#009988;*/
	/*filter：alpha(opacity=0,finishopacity=100,style=1,startx=0,starty=85,finishx=150,finishy=85);*/
}
.search{
	float:left;
}


.submit-search{
	background: none repeat scroll 0 0 #3FA156;
    border: 0px solid #528641;
    border-radius: 3px 3px 3px 3px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 12px;
    font-weight: bold;
    padding: 4px 10px;
	margin-top:5px;
	margin-left:8px;
}

.next-keyword{
	float:right;
	margin-right:85px;
	margin-top:2px;
	font-family:"华文彩云";/*, "华文行楷", "华文隶书", "华文新魏", "幼圆";*/
	font-size:20px;
	font-weight:bold;
	color:#990000;
}

.changepage{
	float:right;
	margin-right:80px;
}
.history a, .history a:hover {
    border: 0 none;
    outline: 0 none;
}
.history a:hover{
	color: #66CC66;
}
.changepage2{
    background: none repeat scroll 0 0 #3FA156;
    border: 0px solid #528641;
    border-radius: 2px 2px 2px 2px;
    color: #FFFFFF;
    cursor: pointer;
    font-size: 12px;
    font-weight: bold;
    padding: 5px 5px;
	margin-bottom:3px;
}
.search-selection{
	padding-bottom: 5px;
}

.ffiveList{
	/*background-color:#66CC66;*/
	margin-top:0px;
	margin-bottom:5px;
	padding-bottom:5px;
	padding-top:5px;
	padding-left:5px;
	padding-right:5px;
	
	line-height:30px;
	font-size:1.4em;
	font-family:"新宋体";
}

.table{
	margin-left:8px;
}
</style>

<script language="JavaScript" type="text/javascript">
var listnum = 1;
//murl是菜单对应的操作，可以任意//javascript代码但是要注意不要在里面输入\"，只能用'
var ph=8,mwidth=310;//每条选项的高度,菜单的总宽度

var tt;
function change(){
	//window.alert("click");
}
var ph = 50;
var bgc="#E1E1DF",txc="black";//菜单没有选中的背景色和文字色
var cbgc="darkgray",ctxc="white";//菜单选中的选项背景色和文字色
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';"
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';"
var page = 1;
var Str = [];
var Str2 = [];
var recordlen = 0;
var pageline = 10;//每页显示10个
document.oncontextmenu=function()//鼠标右键
{ 
	var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td    
	line = td.parentElement.rowIndex;
	col = td.cellIndex;//这里是表格的第几行第几列，从0开始
	var txt = td.innerText;
	/*for(var i= 0; i < tt.rows.length; i++){
		if (i == line)
		{
			for(var j = 0; j<)
		}
		window.alert(txt);
	}*/
	change2space(txt);
}

$(function(){
	var url = "get_history.php";
	$.post(
		url, 
		{},
		function (data){//带tagsent%%`$$comment的形式的句子%%`$$tagtime
			//window.alert(data);//读取用户所有句子
			Str2 = data.split("%%`$$");
			recordlen = Str2.length-1;//数组的结尾有一个空值
			var li = 0;
			document.getElementById('total').innerHTML = "共<b> " + (recordlen/3) + " </b>条记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;右键可以修改句子！可以使用浏览器查找(Ctrl+F)功能哦";
			//window.alert(data);
			var h="<table id='content' width=98% height="+ (recordlen/3)*ph + "px cellpadding='0'  cellspacing='0' border='1'>";
			for(var i = 0; i< recordlen; i+= 3){//将分隔符‘_’变成'/'
				var sent = Str2[i];
				var words = sent.split(" ");
				sent = "";
				for(var j = 0; j < words.length; j++){//对原句进行把'_'变成'/'
					if(words[j] == "")
						continue;
					var slide = words[j].split("_");
					var slide2 = "";
					if(slide[0] != ""){
						slide2 = slide[0];
					}else{
						slide2 = '';
					}
					for(var k =1; k<slide.length-1; k++){
						if(slide[k] == ""){
							slide2 += "_";
						}else{
							slide2 += "_" + slide[k];
						}
					}
					sent +=  slide2 + "/" + slide[slide.length-1] + " ";
				}
				Str[li] = sent;
				li += 1;

				h+="<tr align='left' height=" + ph + " ><td style='font-size:10pt;' width= '50' align='center'>" + listnum +"</td><td style='font-size:10pt;' onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change(this);>"+sent+"</td><td style='font-size:10pt;' width='100' align='center'>"+Str2[i+1]+"</td><td style='font-size:10pt;' width='90'>"+Str2[i+2]+"</td></tr>";
				
				listnum += 1;
			}
			//window.alert(h);
			document.getElementById('table').innerHTML = h;
			document.getElementById("content");
		}
	);
});

function change2space(sent){//'/'线变'_'
	var words = sent.split(" ");
	sent = "";
	for(var i = 0; i < words.length; i++){//对原句进行把'/'变成'_'
		if(words[i] == "")
			continue;
		var slide = words[i].split("/");
		var slide2 = "";
		if(slide[0] != ''){
			slide2 = slide[0];
		}else{
			slide2 = '';
		}
		for(var j =1; j<slide.length-1; j++){
			if(slide[j] == ""){
				slide2 += "/";
			}else{
				slide2 += "/" + slide[j];
			}
		}
		sent += slide2 + "_" + slide[slide.length-1] + " ";
	}
	$.cookie("modify", sent);
	window.location.href="WSegmentation_modify.php";
}

$(function(){
	$("#exit").click(function(){
		$.cookie('user', null);
		window.location.href="loginc.php";
	});
});
</script>
</head>

<body oncontextmenu=self.event.returnValue=false>
<div class="header">
    <p class="logo" >
        <!--您已完成<label class='finish' id="finish"><?php echo "<b>".$_COOKIE["finish"]."</b>"; ?></label>句标注任务-->分词词性标注在线系统
    </p>

    <ul class="userinfo">
        <li>
		<?php  echo $_COOKIE['user'] ." ";?> | <a href="#" id="exit">[退出]</a>
        </li>
    </ul>
</div>

<div class="outside">
	<div class="content-top">&nbsp;
		<div class="note">
	
		</div>
	</div>
	<div class="outside">
	<div class="content-top">&nbsp;
		<div class="note">
	
		</div>
	</div>
	<div class="content2">
		<div class="history2">
			<div>&nbsp;</div>
			
			<div>
				<a href="WSegmentation.php" class="next-keyword" id="back">新任务</a>
				<span id="total" >	</span>&nbsp;&nbsp;
			</div>
			
			<div style="clear:both" id  = 'table' class='table'>
			</div>
			
		</div>
	</div>	 
</div>
</div>
</div>

</body>
</html>