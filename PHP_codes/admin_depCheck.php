<?php
	require("config2.php");
	$admin = $_COOKIE['admin'];
	$completes = 0;
	$sql = "SELECT sum(dep_compelete) as total from signup";
	mysql_query("SET NAMES 'UTF8'");
	$res2 = mysql_query($sql);
	while($times3 = mysql_fetch_assoc($res2)){
		$completes = $times3['total'];
	}

	$adminum = 0;//查询已经检查完的数目
	$sql11 = "SELECT count(*) as total from dep_charge where adminname='". $admin . "' and chargetime !=''";
	mysql_query("SET NAMES 'UTF8'");
	$res211 = mysql_query($sql11);
	while($times311 = mysql_fetch_assoc($res211)){
		$admminum = $times311['total'];
	}
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
table td { 
  font-size:1.3em;
}
.tag{
	font-size:1.2em;
	margin-top:10px;
	margin-left: 25px;
	font-family:"微软雅黑";
	text-align:center;
}
.save{
	margin-top:20px;
	margin-left:150px;
	line-height: 50px;
    text-align: center;
    width: 440px;
	font-size:1.3em;
	vertical-align:middle ;
}
</style>

<script language="JavaScript" type="text/javascript">
var bgc="#E1E1DF",txc="black";//菜单没有选中的背景色和文字色
var cbgc="darkgray",ctxc="white";//菜单选中的选项背景色和文字色
var tt;

var ph = 50;
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';"
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';"

var Str2 = [], Str3 = [];
var recordlen = 0;

document.oncontextmenu=function()//鼠标右键
{ 
	var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td    
	line = td.parentElement.rowIndex;
	col = td.cellIndex;//这里是表格的第几行第几列，从0开始
	var txt = td.innerText;
	
}

var maxwords = 65;
var xcoordinate =new Array();
var ycoordinate = 494;

var Arcs = function(x1, ycoordinate, x2, xtxt, delt, text){
	this.x1 = x1;
	this.y1 = ycoordinate;
	this.x = x1;
	this.y = ycoordinate-(20-0.15*delt)*delt;
	this.xx = x2;
	this.yy = ycoordinate-(20-0.15*delt)*delt;
	this.x2 = x2;
	this.y2 = ycoordinate;
	this.ytxt = (5+ycoordinate)-(delt-delt*delt*0.0075)*15;
	this.xtxt = xtxt;
	this.text = text;
	this.choose = false;//判断该弧是否是用户点击的弧
	this.has = false;
};
arcs = new Array();
var tt;
var tablenum = 0;

var bgc="#E1E1DF",txc="black";//菜单没有选中的背景色和文字色
var cbgc="darkgray",ctxc="white";//菜单选中的选项背景色和文字色
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';"
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';"
var jflag = new Array();

$(function(){
	for(var j = 0; j< recordlen; j+= 4){
		jflag[j] = 0;
	}
	
	var url = "get_admin_depCheck.php";
	$.post(
		url, 
		{},
		function (data){
			window.alert("hello" + data);//原句%%`$$句子%%`$$时间%%`$$原句%%`$$句子%%`$$时间
			Str2 = data.split("%%`$$");
			recordlen = Str2.length-1;//数组的结尾有一个空值
			var listnum = 1;
			tablenum = recordlen/4;

			document.getElementById('total').innerHTML = "共<b> " + (recordlen/4) + " </b>条记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			var sentlen = new Array();
			var heightlist = new Array();
			
			for(var j = 0; j< recordlen; j+= 4){//显示
				var sent_0 = Str2[j];
				var res_sent_1 = Str2[j+1];
				var res_time = Str2[j+2];
				var comment = Str2[j+3];
				//window.alert(" 1 " + sent_0 +" 2 " +res_sent_1 + " 3 " + res_time + " 4 " + comment);
				var wordlist="<tr>";
				var taglist ="<tr>";
				var skipsent = "";

				var numtmp = 0;
				var sent = sent_0.split(' ');
				//window.alert("sent" + sent_0 + "j:  " + j + "sentlength" + sent.length);
				for (var i = 0; i < sent.length; i++)
				{
					var slide = sent[i].split(']')[1].split("/");//查找最后一个'/'；word\tag，word当中可能有\
					var slide2 = "";
					if(slide[0] != ""){
						slide2 = slide[0];
					}else{
						slide2 = '';
					}
					for(var jj =1; jj<slide.length-1; jj++){
						if(slide[jj] == ""){
							slide2 += "/";
						}else{
							slide2 += "/" + slide[jj];
						}
					}
					var word = slide2;
					var tag = slide[slide.length-1];
					if(sent[i] != ''){
						wordlist += '<td width=40 >' + word + '</td>';
						taglist  += '<td width=40 >' + tag + '</td>';
						skipsent += word;
						numtmp += 1;
					}
				}
				maxwords = numtmp;
				sentlen[j] = maxwords;
				var height=0;
				if(maxwords <=6){
					height = 95;
				}else if(maxwords <= 16){
					height = 225;
				}else if(maxwords <= 26){
					height = 325;
				}else if(maxwords <= 36){
					height = 405;
				}else if(maxwords <= 46){
					height = 465;
				}else {
					height = 600;
				}
				heightlist[j] = height-5;
				wordlist += '</tr>';
				taglist  += '</tr>';
				var arcnum = res_sent_1.split('\t');//关系
				var name = "select" +listnum;
				var table = "<table id='content" + listnum+ "' class='words' width='"+(maxwords*40 + 190 + 180)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 >";

				if(arcnum.length >=2){
					var canv ="<tr><td width = '180' rowspan='3'><input id='" + sent_0 + "' type='radio' name='" + name + "' value='0'><panel>&nbsp;&nbsp;&nbsp;w&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</panel><input id='" + sent_0 + "' type='radio' name='" + name + "' value='1' >&nbsp;&nbsp;&nbsp;&nbsp;r&nbsp;<br><form name='form1' id='form"+ listnum +"' method='post' action=''> <label class='textfield'>error comment：</label> <input class='textfield2' type='text' id='notes"+ listnum +"'  value='' onfocus='this.select()'/> </form></td><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(40 * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ wordlist + taglist + "</table>";
				}else{
					var canv ="<tr><td width = '180' rowspan='3'><input id='" + sent_0 + "' type='radio' name='" + name + "' value='0' disabled = 'true'><panel>&nbsp;&nbsp;&nbsp;w&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</panel><input id='" + sent_0 + "' type='radio' name='" + name + "' value='1' checked='true' >&nbsp;&nbsp;&nbsp;&nbsp;r&nbsp;<br><form name='form1' id='form"+ listnum +"' method='post' action=''> <label class='textfield'>error comment：</label> <input class='textfield2' type='text' id='notes"+ listnum +"'  value='' onfocus='this.select()'/> </form></td><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50>"+ comment +"</td><td width=90>"+ res_time+ "</td><td >"+ skipsent +"</td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ "</table>";
					jflag[j] = 1;
				}
				var tmps = "";
				tmps = tmptable;
				document.getElementById('table').innerHTML = tmptable;
				listnum += 1;
			}

			for (var i=0; i<65; i++)
			{
				xcoordinate[i] = i * 40 + 20;
			}
			listnum = 1;//
			for(var j = 0; j< recordlen; j += 4){//开始画弧
				if(jflag[j] == 1){
					listnum += 1;
					continue;
				}
				var res_sent = Str2[j+1];
				sent = res_sent.split('\t');//关系
				
				maxwords = sentlen[j];
				ycoordinate = heightlist[j];
				//window.alert(maxwords+":" + ycoordinate);
				arcs.splice(0,arcs.length);//删除从0开始的length长的元素
				for(var k=0; k< maxwords; k++){	
					for (var i = 0; i< maxwords; i++){
						if(i == k)
							continue;
						var delt = Math.abs(xcoordinate[i]- xcoordinate[k])/40;
						var tmp = new Arcs(xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[i])/2, delt, "NO");
						arcs.push(tmp);
					}
				}
				for (var i=0; i<arcs.length; i++)
				{
					arcs[i].has = false;
				}
				var c=document.getElementById("cc" + listnum);
				hb=c.getContext("2d");

				//window.alert(res_sent + " : " + sent.length + "maxwords:" + maxwords);
				//var tmps = "";
				for(var i = 0; i< sent.length; i++){
					if(sent[i] == '')
						continue;
					var tmp2 = sent[i].split('[');
					var f = Number(tmp2[1].split(']')[0]);
					var s = Number(tmp2[2].split(']')[0]);
		
					var tmp3 = sent[i].split(')');
					var tmp4 = tmp3[tmp3.length-2];
					var tmp5 = tmp4.split('(');
					var text = tmp5[tmp5.length-1];
					for(var k = 0; k<arcs.length; k++){
						if(xcoordinate[f] == arcs[k].x1 && xcoordinate[s] == arcs[k].x2){
							arcs[k].text = text;
							arcs[k].has = true;
							//window.alert(f + " | " + s + " (" + text +")" + k +"::"+ xcoordinate[f] + "," + xcoordinate[s]);
							//tmps += xcoordinate[f] + "," + xcoordinate[s]+ "<br>";
							break;
						}
					}
				}
				drawcurve("cc" + listnum, 40 * maxwords, height);
				listnum += 1;
			}
			document.getElementById("content") = tmps;
			tt = document.getElementById("content");
		}
	);

	$("#submit-check2").click(function(){
		if(($.cookie("admin") != "admin1") &&( $.cookie("admin") != "admin2") && ($.cookie("admin")!="admin3")  && ($.cookie("admin") != "admin4") && ($.cookie("admin") != "admin5")){
			window.alert("您不是管理员，无权提交！");
			return ;
		}
		var sent = "";
		var getCK=document.getElementsByTagName('input');   
		var num = 0;
		//window.alert(getCK.length);
		for(var i=1;i<=getCK.length/3;i++)   //获取多少个input标签
		{   
			var name = "select" + i;
			//window.alert(name + "," + document.getElementsByName(name).length);
			var chkObjs = document.getElementsByName(name);
            for(var j=0; j<chkObjs.length; j++){//获取每个input有多少个radio
				var rwflag = 0;
				//window.alert(chkObjs[j].checked + "check");
                if(chkObjs[j].checked){
					num += 1;
					if(chkObjs[j].value == 0)//charge result is wrong
					{
						rwflag = 1;
					}
					var sts = "notes" + String(i);
					sent += chkObjs[j].id + "%%`$$" + document.getElementById(sts).value + "%%`$$" + rwflag + "%%`$$";//comment=null
                }//去掉词性，获取sent项
            }
		}

		if(num == getCK.length/3){
			//window.alert(sent);
			var url="write_depCharge.php";//提交
			$.post(
				url, 
				{sent: sent},
				function (data){
					//window.alert(data);
					document.getElementById('tmp').innerHTML = data;
					window.location.href="admin_depNew.php";
				}
			);		
		}else{
			window.alert(num + "仍有未被处理的句子，请继续！" + getCK.length/2);
			return;
		}
	});

});


$(function(){
	$("#logout").click(function(){
		$.cookie('admin', null);
		window.location.href="charge.php";
	});
});


function drawcurve(canvas_num, width, height){
	hb.lineWidth = 1;//控制线的宽度
	hb.clearRect(0,0, width, height);

	for (var i=0; i<arcs.length; i++)
	{
		if(arcs[i].has == true){//有这条线就画出来
			hb.beginPath();
			
			if(arcs[i].x1 < arcs[i].x2){//to right
				hb.moveTo(arcs[i].x1+10, arcs[i].y1 + 3);
				hb.bezierCurveTo(arcs[i].x + 10, arcs[i].y, arcs[i].xx, arcs[i].yy, arcs[i].x2, arcs[i].y2);
				if(arcs[i].choose == true){
					hb.strokeStyle = "rgb(255,0,0)";//红色
					hb.fillStyle = "rgb(255,0 , 0)";
				}else{
					hb.fillStyle="blue";
					hb.strokeStyle = "blue";//黑色
				}
				hb.stroke();
				hb.save();
				hb.closePath();
				hb.beginPath();
				//画箭头
				hb.translate(arcs[i].x2, arcs[i].y2);
				
				hb.rotate(1.5);//left->right
				
				hb.lineTo(-5,-5); 
				hb.lineTo(5,0); 
				hb.lineTo(-5,5); 
				hb.lineTo(0,0); 
				hb.fill();
				hb.restore();   
				var vancas = document.getElementById(canvas_num).getContext("2d");//原点归为
				hb = vancas;
				arcs[i].xtxt = (arcs[i].x + 10 +arcs[i].x2)/2;//更改弧线中心，及tag所在位置
				hb.translate(arcs[i].xtxt-10, arcs[i].ytxt-7);
				hb.fillStyle = "#E1E1DF";
				hb.fillRect(0, 0, 20, 10);
				//if(arcs[i].choose == true){
					hb.fillStyle = "rgb(255,0 , 0)";
				/*}else{
					hb.fillStyle="black";
				}*/
				hb.translate(10, 7);
				hb.textAlign = 'center';
				hb.font="14.5px serif";
				hb.fillText(arcs[i].text,0,0);
				hb.restore();
				hb.translate((-1)*arcs[i].xtxt, (-1)*arcs[i].ytxt);
				hb.closePath();
			}
			else{//to left
				hb.moveTo(arcs[i].x1-10, arcs[i].y1+3);
				hb.bezierCurveTo(arcs[i].x - 10, arcs[i].y, arcs[i].xx, arcs[i].yy, arcs[i].x2, arcs[i].y2);
				if(arcs[i].choose == true){
					hb.strokeStyle = "rgb(255,0,0)";//红色
					hb.fillStyle = "rgb(255,0 , 0)";
				}else{
					hb.fillStyle="blue";
					hb.strokeStyle = "blue";//黑色
				}
				hb.stroke();
				hb.save();
				hb.closePath();
				hb.beginPath();
				//画箭头
				hb.translate(arcs[i].x2, arcs[i].y2);
				
				hb.rotate(1.6);//arrow is from right <- left
				hb.lineTo(-5,-5); 
				hb.lineTo(5,0); 
				hb.lineTo(-5,5); 
				hb.lineTo(0,0); 
				hb.fill();
				hb.restore();   
				var vancas = document.getElementById(canvas_num).getContext("2d");//原点归为
				hb = vancas;
				arcs[i].xtxt = (arcs[i].x - 10 +arcs[i].x2)/2;//更改弧线中心，及tag所在位置
				hb.translate(arcs[i].xtxt-10, arcs[i].ytxt-7);
				hb.fillStyle = "#E1E1DF";//E1E1DF
				hb.fillRect(0, 0, 20, 10);
				hb.fillStyle = "rgb(255,0 , 0)";
				
				hb.translate(10, 7);
				hb.textAlign = 'center';
				hb.font="14.5px serif";
				hb.fillText(arcs[i].text,0,0);
				hb.restore();
				hb.translate((-1)*arcs[i].xtxt, (-1)*arcs[i].ytxt);
				hb.closePath();
			}
		}
	}
}

</script>
</head>

<body oncontextmenu=self.event.returnValue=false>
	<div class="header">
		<p class="logo" >
			依存句法标注管理系统
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
				?> | <span class='tag'>已经检查<?php echo $admminum;?>句</span> | <a href="#" id="logout">退出</a>
			</li>
		</ul>
	</div>

	<p class='tag'>随机抽取一些最近标注过的句子给您review！</p><p class='tag'>已经完成标注<?php echo $completes;?>句</p>

<div class="outside">
	<div class="content-top">&nbsp;
		<div class="note">
	
		</div>
	</div>

	<div class="content-top">&nbsp;
		<div class="note">
	
		</div>
	</div>
	<div class="content2">
		<div class="history2">
			<div>&nbsp;</div>
			
			<div>
				<span class='tag' id="total" >	</span>&nbsp;&nbsp;
			</div>
			
			<div style="clear:both" id  = 'table' class='table'></div>
			
		</div>
		<p id='tmp'></p>
	</div>	 

	<button type="button"class="save" id="submit-check2">确认提交</button>
</div>

</body>
</html>