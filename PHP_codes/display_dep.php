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
table td { 
  font-size:1.3em;
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
</style>

<script language="JavaScript" type="text/javascript">
var bgc="#E1E1DF",txc="black";//菜单没有选中的背景色和文字色
var cbgc="darkgray",ctxc="white";//菜单选中的选项背景色和文字色
var tt;

var ph = 50;
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';"
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';"

var Str2 = [];

document.oncontextmenu=function()//鼠标右键
{ 
	var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td    
	line = td.parentElement.rowIndex;
	col = td.cellIndex;//这里是表格的第几行第几列，从0开始
	var txt = td.innerText;
	
}

var maxwords = 65;
var xcoordinate =new Array();
var ycoordinate = 694;
var page = 1;
var recordlen = 0;
var pageline = 100;//每页显示的句子数量，从cookie上复制

var listnum = 1;

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
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';";
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';";
var jflag = new Array();
var fullitems = '';
var chunk = 5;
var shownums = 0;
$(function(){
	$("#lastpageup").hide();
	$("#nextpagedown").hide();//每次都先隐藏上下页
	$("#lastpagedown").hide();
	$("#nextpageup").hide();
	for(var j = 0; j< recordlen; j+= 4){
		jflag[j] = 0;
	}
	
	var url = "get_display_dep.php";
	$.post(
		url, 
		{},
		function (data){
			fullitems = data;
			//window.alert(data);//原句%%`$$句子%%`$$时间%%`$$评论%%`$$标注人员
			Str2 = data.split("%%`$$");
			recordlen = Str2.length-1;//数组的结尾有一个空值
			listnum = 1;
			tablenum = recordlen/chunk;
			
			if(tablenum >pageline){
				$("#lastpageup").show();
				$("#nextpagedown").show();//每次都先隐藏上下页
				$("#lastpagedown").show();
				$("#nextpageup").show();
				shownums = pageline*chunk;
			}else{
				shownums = tablenum*chunk;
			}

			document.getElementById('total').innerHTML = "共<b> " + (recordlen/chunk) + " </b>条记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;左键可以修改句子！可以使用浏览器查找(Ctrl+F)功能哦";
			document.getElementById('pagenum1').innerHTML = "第";
			if(tablenum == 0){
				document.getElementById('pagenum2').innerHTML = 0;
				document.getElementById('pagenum4').innerHTML = "/";
				document.getElementById('pagenum5').innerHTML = 0;
			}else{
				document.getElementById('pagenum2').innerHTML = page;
				document.getElementById('pagenum4').innerHTML = "/";
				document.getElementById('pagenum5').innerHTML = Math.ceil(tablenum/pageline);//对表达式向上取整，floor向下取整	
			}
			document.getElementById('pagenum3').innerHTML = "页";
			var select = "";
			for(var x = 1; x<= Math.ceil(tablenum/pageline); x++){
				select += "<option value=" + x +">" + x;
			}
			document.getElementById("stime").innerHTML = select;

			var sentlen = new Array();
			var heightlist = new Array();
			
			for(var j = 0; j< shownums; j+= chunk){//显示
				var sent_0 = Str2[j];
				var res_sent_1 = Str2[j+1];
				var res_time = Str2[j+2];
				var comment = Str2[j+3];
				var annotername = Str2[j+4];
				
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
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*40 + 240)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" >";

				if(arcnum.length >=2){//contain arcs.
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ annotername +"</td><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(40 * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ wordlist + taglist + "</table>";
				}else{
					var canv ="<tr><th width = 50 >"+ listnum+ "</th><td width = 50 rowspan='3'>"+ annotername +"</td><td width = 50>"+ comment +"</td><td width=90>"+ res_time+ "</td><td >"+ skipsent +"</td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ "</table>";
					jflag[j] = 1; // no arcs.
				}
				var tmps = "";
				tmps = tmptable;
				document.getElementById('table').innerHTML = tmptable;
				listnum += 1;
			}

			for (var i=0; i<62; i++)
			{
				xcoordinate[i] = i * 40 + 20;
			}
			listnum = 1;//
			for(var j = 0; j< shownums; j += chunk){//开始画弧
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
		});
});


function drawTables(begin, total, listnum){
	var listnum_tmp = listnum;
	document.getElementById('table').innerHTML = "";//copy codes.
	var sentlen = new Array();
	var heightlist = new Array();
			
	//window.alert("begin" + begin + " " + (begin+total));
	for(var j = begin; j<(begin + total) ; j+= chunk){//显示
				var sent_0 = Str2[j];
				var res_sent_1 = Str2[j+1];
				var res_time = Str2[j+2];
				var comment = Str2[j+3];
				var annotername = Str2[j+4];
				
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
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*40 + 240)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" ;>";

				if(arcnum.length >=2){
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><th width = 50 rowspan='3'>"+ annotername+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(40 * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ wordlist + taglist + "</table>";
				}else{
					var canv ="<tr><th width = 50 >"+ listnum+ "</th><th width = 50 rowspan='3'>"+ annotername+ "</th><td width = 50>"+ comment +"</td><td width=90>"+ res_time+ "</td><td >"+ skipsent +"</td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ "</table>";
					jflag[j] = 1;
				}
				var tmps = "";
				tmps = tmptable;
				//window.alert(tmptable);
				document.getElementById('table').innerHTML = tmptable;
				listnum += 1;
	}

	for (var i=0; i<62; i++)
			{
				xcoordinate[i] = i * 40 + 20;
			}
			listnum = listnum_tmp;
	for(var j = begin; j<(begin + total) ; j+= chunk){//开始画弧
				if(jflag[j] == 1){
					listnum += 1;
					continue;
				}
				var res_sent = Str2[j+1];
				sent = res_sent.split('\t');//关系
				
				maxwords = sentlen[j];
				ycoordinate = heightlist[j];
				//window.alert(res_sent + ";;" + maxwords+":" + ycoordinate);
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
	tt = document.getElementById("content");//end of copy codes.
}

$(function(){
	$("span").click(function(){//点击上下页
		var c_id = $(this).attr("id");//获取属性
		var tmp1 = document.getElementById("pagenum2").innerHTML;//$("#pagenum").text;
		var tmp = parseInt(tmp1);
		var total = 0;
		var begin = 0;
		if(c_id =="lastpageup" || c_id =="lastpagedown"){
			if(tmp == 1){
				window.alert("已是第一页！");
				return;
			}
			window.alert("上一页，加载需要3s，请稍等！");
			
			document.getElementById("pagenum2").innerHTML = tmp - 1;
			
			begin = pageline*(tmp - 2)*chunk;//copy codes.
			total = pageline*chunk;
			listnum = pageline*(tmp-2)+1;
			drawTables(begin, total, listnum);
			/*
			document.getElementById('table').innerHTML = "";//copy codes.

			var sentlen = new Array();
			var heightlist = new Array();
			
			//window.alert("begin" + begin + " " + (begin+total));
			for(var j = begin; j<(begin + total) ; j+= chunk){//显示
				var sent_0 = Str2[j];
				var res_sent_1 = Str2[j+1];
				var res_time = Str2[j+2];
				var comment = Str2[j+3];

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
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*40 + 240)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(40 * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ wordlist + taglist + "</table>";
				}else{
					var canv ="<tr><th width = 50 >"+ listnum+ "</th><td width = 50>"+ comment +"</td><td width=90>"+ res_time+ "</td><td >"+ skipsent +"</td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ "</table>";
					jflag[j] = 1;
				}
				var tmps = "";
				tmps = tmptable;
				//window.alert(tmptable);
				document.getElementById('table').innerHTML = tmptable;
				listnum += 1;
			}

			for (var i=0; i<62; i++)
			{
				xcoordinate[i] = i * 40 + 20;
			}
			listnum = pageline*(tmp-2)+1;
			for(var j = begin; j<(begin + total) ; j+= chunk){//开始画弧
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
			tt = document.getElementById("content");//end of copy codes.
			*/
		}
		else if(c_id =="nextpageup" || c_id =="nextpagedown"){
			if((pageline * tmp)*chunk >= recordlen) {
				window.alert("已是最后一页！");
				return;//已经是最后一页
			}
			window.alert("下一页，加载需要3s，请稍等！");
			
			document.getElementById("pagenum2").innerHTML = tmp + 1;
			
			if((recordlen - tmp*pageline*chunk) > pageline*chunk)
				total = pageline*chunk;
			else {
				total = (recordlen - tmp*pageline*chunk);
			}
			begin = tmp*pageline*chunk;
			listnum = tmp*pageline+1;
			drawTables(begin, total, listnum);
			/*
			document.getElementById('table').innerHTML = "";//copy codes.

			//window.alert(recordlen + "begin" + begin + " " + (total+begin));
			var sentlen = new Array();
			var heightlist = new Array();
			
			for(var j = begin; j<(begin + total) ; j+= chunk){//显示
				var sent_0 = Str2[j];
				var res_sent_1 = Str2[j+1];
				var res_time = Str2[j+2];
				var comment = Str2[j+3];

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
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*40 + 240)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(40 * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ wordlist + taglist + "</table>";
				}else{
					var canv ="<tr><th width = 50 >"+ listnum+ "</th><td width = 50>"+ comment +"</td><td width=90>"+ res_time+ "</td><td >"+ skipsent +"</td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ "</table>";
					jflag[j] = 1;
				}
				var tmps = "";
				tmps = tmptable;
				document.getElementById('table').innerHTML = tmptable;
				listnum += 1;
			}

			for (var i=0; i<62; i++)
			{
				xcoordinate[i] = i * 40 + 20;
			}

			listnum = tmp*pageline+1;
			for(var j = begin; j<(begin + total) ; j+= chunk){//显示
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
			tt = document.getElementById("content");// end of copy codes.
			*/
		}
    });
});


function change(num){
	var url = "get_history_dep2.php";
	$.post( //get pre-annotate for arcs , for that have been skipped.
		url, 
		{sent:Str2[num]},
		function (data){
			//window.alert(data);
			var dep_sent = Str2[num+1]; // init the dep_sent = res_dep.
			if(jflag[num] == 1){ // no arcs, equals to skip = 1.	
				dep_sent = data;
			}
			var str = Str2[num] + "%%`$$" + dep_sent + "%%`$$" + Str2[num + 3];
			$.cookie("sent_modify", str);
			//window.alert($.cookie('sent_modify'));
			window.location.href="label_dep.php";
		}
	);
}

function changePageLine(){
	var obj=document.getElementById('p-item-num');
	var index=obj.selectedIndex; //序号，取当前选中选项的序号
	pageline = obj.options[index].value;
	
	//window.alert(pageline);
	
	var data = fullitems;
	Str2 = data.split("%%`$$");
	recordlen = Str2.length-1;//数组的结尾有一个空值
	listnum = 1;
	tablenum = recordlen/chunk;

	var shownums = 0;
			
	if(tablenum >pageline){
		$("#lastpageup").show();
		$("#nextpagedown").show();//每次都先隐藏上下页
		$("#lastpagedown").show();
		$("#nextpageup").show();
		shownums = pageline*chunk;
	}else{
		shownums = tablenum*chunk;
	}

	document.getElementById('pagenum1').innerHTML = "第";
	if(tablenum == 0){
		document.getElementById('pagenum2').innerHTML = 0;
		document.getElementById('pagenum4').innerHTML = "/";
		document.getElementById('pagenum5').innerHTML = 0;
	}else{
		document.getElementById('pagenum2').innerHTML = page;
		document.getElementById('pagenum4').innerHTML = "/";
		document.getElementById('pagenum5').innerHTML = Math.ceil(tablenum/pageline);//对表达式向上取整，floor向下取整	
	}
	document.getElementById('pagenum3').innerHTML = "页";
			
	var select = "";
	for(var x = 1; x<= Math.ceil(tablenum/pageline); x++){
		select += "<option value=" + x +">" + x;
	}
	document.getElementById("stime").innerHTML = select;//动态添加页数下拉条的内容

	drawTables(begin, total, listnum);
	/*
	document.getElementById('table').innerHTML = "";//copy code.
	var sentlen = new Array();
	var heightlist = new Array();
	
	for(var j = 0; j< shownums; j+= chunk){//显示
				var sent_0 = Str2[j];
				var res_sent_1 = Str2[j+1];
				var res_time = Str2[j+2];
				var comment = Str2[j+3];

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
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*40 + 240)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){//contain arcs.
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(40 * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ wordlist + taglist + "</table>";
				}else{
					var canv ="<tr><th width = 50 >"+ listnum+ "</th><td width = 50>"+ comment +"</td><td width=90>"+ res_time+ "</td><td >"+ skipsent +"</td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ "</table>";
					jflag[j] = 1; // no arcs.
				}
				var tmps = "";
				tmps = tmptable;
				document.getElementById('table').innerHTML = tmptable;
				listnum += 1;
			}

			for (var i=0; i<62; i++)
			{
				xcoordinate[i] = i * 40 + 20;
			}
			listnum = 1;//
			for(var j = 0; j< shownums; j += chunk){//开始画弧
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
			document.getElementById("content") = '';
			document.getElementById("content") = tmps;
			tt = document.getElementById("content");//end of copy codes.
			*/
}
   
$(function(){
	$("#exit").click(function(){
		$.cookie('user', null);
		window.alert("exit");
		//window.location.href="loginc.php";
	});
	
	$("#search").click(function(){
		$("#lastpageup").show();
		$("#nextpagedown").show();//每次都先隐藏上下页
		$("#lastpagedown").show();
		$("#nextpageup").show();
		
		var obj=document.getElementById('stime');
		var index=obj.selectedIndex; //序号，取当前选中选项的序号
		var pageidx = obj.options[index].value;
		
		//window.alert(pageidx);
		document.getElementById("pagenum2").innerHTML = pageidx;
		
		var total = 0;
		var begin = 0;

		if((recordlen - (pageidx-1)*pageline*chunk) > pageline*chunk)
			total = pageline*chunk;
		else {
			total = (recordlen - (pageidx-1)*pageline*chunk);
		}
		begin = (pageidx-1)*pageline*chunk;
		listnum = (pageidx-1)*pageline+1;
		drawTables(begin, total, listnum);
		/*
		document.getElementById('table').innerHTML = "";//copy codes.

		var sentlen = new Array();
		var heightlist = new Array();
			
		//window.alert("begin" + begin + " " + (begin+total));
		for(var j = begin; j<(begin + total) ; j+= chunk){//显示
				var sent_0 = Str2[j];
				var res_sent_1 = Str2[j+1];
				var res_time = Str2[j+2];
				var comment = Str2[j+3];

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
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*40 + 240)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(40 * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ wordlist + taglist + "</table>";
				}else{
					var canv ="<tr><th width = 50 >"+ listnum+ "</th><td width = 50>"+ comment +"</td><td width=90>"+ res_time+ "</td><td >"+ skipsent +"</td></tr>";
					
					var tmptable = document.getElementById('table').innerHTML;
					tmptable += table + canv+ "</table>";
					jflag[j] = 1;
				}
				var tmps = "";
				tmps = tmptable;
				//window.alert(tmptable);
				document.getElementById('table').innerHTML = tmptable;
				listnum += 1;
		}

		for (var i=0; i<62; i++){
				xcoordinate[i] = i * 40 + 20;
		}
		listnum = pageline*(tmp-2)+1;
		for(var j = begin; j<(begin + total) ; j+= chunk){//开始画弧
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
		tt = document.getElementById("content");//end of copy codes.
		*/
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
        语义依存图在线标注系统
    </p>

    <ul class="userinfo">
        <li>
		<?php  echo $_COOKIE['user'] ." ";?> | <a href="http://ir.hit.edu.cn/demo/ltp/FAQ.htm" id='download' class='download' color='red'>FAQ</a>
        </li>
    </ul>
</div>

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
			<div>&nbsp;每页显示的句子个数：
				<select name="p-item-num" id="p-item-num"  onChange="changePageLine()">
					<option id = 'pnum10' value="10" >10</option>
					<option id = 'pnum50' value='50'>50</option>
					<option id = 'pnum100' value='100' selected="selected">100</option>
					<option id = 'pnum10000' value='10000'>10000</option>
				</select>
				<input type="button" id="pnum-select" value="选择" class="submit-search">
			</div>
			
			<div class="changepage">
				<span id="total" ></span>&nbsp;&nbsp;<span id="lastpageup" class="changepage2">上一页</span>&nbsp;&nbsp;<span id="nextpageup" class="changepage2">下一页</span>&nbsp;&nbsp;<span id="pagenum1"></span>&nbsp;<span id="pagenum2"></span></span><span id="pagenum4"></span><span id="pagenum5"></span><span id="pagenum3">
				<label class="search">
					<select name="stime" id="stime2">
						
				   </select>
					<input type="button" id="search2" value="go" class="submit-search">
				</label>
			</div>

			<div>
				<a href="label_dep.php" class="next-keyword" id="back">新任务</a>
				<span id="total" >	</span>&nbsp;&nbsp;
			</div>
			
			<div style="clear:both" id  = 'table' class='table'></div>
			
		</div>

		<p id='tmp'></p>
		
		<div class="changepage">
			<span id="total" ></span>&nbsp;&nbsp;<span id="lastpagedown" class="changepage2">上一页</span>&nbsp;&nbsp;<span id="nextpagedown" class="changepage2">下一页</span>&nbsp;&nbsp;<span id="pagenum1"></span>&nbsp;<span id="pagenum2"></span></span><span id="pagenum4"></span><span id="pagenum5"></span><span id="pagenum3">
			<label class="search">
				<select name="stime" id="stime">

			   </select>
				<input type="button" id="search" value="go" class="submit-search" >
			</label>
		</div>
		
	</div>	 

</div>

</body>
</html>