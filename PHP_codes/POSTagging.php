<?php
session_start();
if (isset($_COOKIE["user"])){//如果有cookie，则将user入session
	;
}else{
	$url = "index.php"; 
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>"; 
}
?>
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

ul,ol{
	list-style: none outside none;
}
a {
	color:#FFFFFF;
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
    background-color: #E1E1DF;
}
.code{
   margin: 5px;
   padding: 10px;
   border: 1px solid #87BF23;
   background-color: #eee;
   font-size: 1.5em;
}
.content2{
   margin: 0px;
   padding: 0px;
   border: 1px solid #87BF23;
   background-color: #ffffff;
	
	width:100%;
	height:60px;
	font-family:宋体;
	font-size:1.2em;
}
.save{
    line-height: 50px;
    margin: 15px 0 0;
    padding-left: 15px;
    text-align: center;
    width: 440px;
	font-size:1.2em;
}
.words{
	font-family:宋体;
	padding:5px;
	font-size:1.2em;
}
.bgcl{
	background:"#75ef92";
}
.bkcl{
	background:"#eee";
}
.download{
	color:red;
}
</style>

<script language="javascript" type="text/JavaScript">
var sent = null;
var maxcol = 20;
var tt;
var numw = 0;
var firstword = new Array();

$(function(){
	if($.cookie('comment_tag') != null){
		document.getElementById("comment").innerText = $.cookie('comment_tag');
	}
	tt = document.getElementById("content");
	var line1 = 0;
	var line2 = 1;
	var col = 0;
	sent = $.cookie('segsent');
	//处理sent，去掉所有词性标记，用于显示
	var words = sent.split(" ");
	sent = "";
	var col_last = 0;
	for(var i = 0; i < words.length; i++){
		if(words[i] == "")
			continue;
		var slide = words[i].split("_");
		var slide2 = "";
		if(slide[0] != ""){
			slide2 = slide[0];
		}else{
			slide2 = '';
		}
		for(var j =1; j<slide.length-1; j++){
			if(slide[j] == ""){
				slide2 += "_";
			}else{
				slide2 += "_" + slide[j];
			}
		}
		if(col >=maxcol){
			line1 += 3;
			line2 += 3;
			col = 0;
		}
		tt.rows.item(line1).cells.item(col).innerText = slide2;
		tt.rows.item(line2).cells.item(col).innerText = slide[slide.length-1];		
		col += 1;
		numw += 1;
		firstword.push( slide2);
	}

	$("#save").click(function(){
		//有时词语会变成词性，故这里重置所有词语
		col = 0;
		var line = 0;
		for(var i = 0; i < firstword.length; i++){
			if(col >=maxcol){
				line += 3;
				col = 0;
			}
			tt.rows.item(line).cells.item(col).innerText = firstword[i];
			col += 1;
		}

		var w = new Array();
		var t = new Array();
		
		if(line1 == 9){
			for(var j=0; j<20; j++)
			{
				w.push(tt.rows.item(0).cells.item(j).innerText);
				t.push(tt.rows.item(1).cells.item(j).innerText);
			}
			for(var j=0; j<20; j++)
			{
				w.push(tt.rows.item(3).cells.item(j).innerText);
				t.push(tt.rows.item(4).cells.item(j).innerText);
			}
			for(var j=0; j<20; j++)
			{
				w.push(tt.rows.item(6).cells.item(j).innerText);
				t.push(tt.rows.item(7).cells.item(j).innerText);
			}

			for(var j=0; j<col; j++)
			{
				w.push(tt.rows.item(9).cells.item(j).innerText);
				t.push(tt.rows.item(10).cells.item(j).innerText);
			}
		}
		else if(line1 == 6){
			for(var j=0; j<20; j++)
			{
				w.push(tt.rows.item(0).cells.item(j).innerText);
				t.push(tt.rows.item(1).cells.item(j).innerText);
			}
			for(var j=0; j<20; j++)
			{
				w.push(tt.rows.item(3).cells.item(j).innerText);
				t.push(tt.rows.item(4).cells.item(j).innerText);
			}
			for(var j=0; j<col; j++)
			{
				w.push(tt.rows.item(6).cells.item(j).innerText);
				t.push(tt.rows.item(7).cells.item(j).innerText);
			}
		}
		else if(line1 == 3){
			for(var j=0; j<20; j++)
			{
				w.push(tt.rows.item(0).cells.item(j).innerText);
				t.push(tt.rows.item(1).cells.item(j).innerText);
			}
			
			for(var j=0; j<col; j++)
			{
				w.push(tt.rows.item(3).cells.item(j).innerText);
				t.push(tt.rows.item(4).cells.item(j).innerText);
			}
		}
		else if(line1 == 0){
			for(var j=0; j<col; j++)
			{
				w.push(tt.rows.item(0).cells.item(j).innerText);
				t.push(tt.rows.item(1).cells.item(j).innerText);
			}
		}
		var fsent = w[0] + "_" + t[0];
		var sentpp = w[0];
		for (var i = 1; i < w.length ; i++)
		{
			if(t[i] == "#"){
				window.alert("词性标注不完整，请继续！");
				return;
			}
			sentpp += w[i];
			fsent += " " + w[i] + "_" + t[i];
		}
		var comment = document.getElementById("comment").value;
		$.cookie('comment_tag', comment);
		var psent = $.cookie('psent');
		if(sentpp != psent){//词性标注的句子和原来句子不一样了
			//window.alert(psent +"later:" +sentpp);
			comment += "|Tagging句子被改变";
		}
		//window.alert($.cookie('user') + " %%`$$ " + psent + " %%`$$ " + fsent + " %%`$$ " + comment);
		var url = "writetags.php";
		$.post(
			url, 
			{psent: psent, fsent: fsent, comment:comment},
			function (data){
				//window.alert(data);
				//完成一个句子，更新页面显示,finish更新在"writetags.php"中进行
				//window.alert($.cookie("finish"));
				//window.alert(data);//写入tagsent成功
				$.cookie('back', null);
				$.cookie('comment_tag', null);
				$.cookie("comment_tag_modify", null);
				$.cookie('comment_seg', null);
				$.cookie('comment_seg_modify', null);
				window.location.href = "WSegmentation.php";
			}
		);
	});

	$("#logout").click(function(){  
		$.cookie('user', null);
		$.cookie('uid', null);
		window.location.href="loginc.php";
	});

	$("#back").click(function(){  
		$.cookie('back', 1);
		var comment = document.getElementById("comment").value;
		$.cookie('comment_tag', comment);
		window.location.href="WSegmentation.php";
	});

	/*tt.rows.item(line).cells.item(col).onclick=function(){
		window.alert('hello');
		this.style.background="#eee";
	}*/

	$("#questions").click(function(){
		var win=window.open("attention.html", '_blank');
		win.focus(); 
	});
});

var mname=new Array(//mname是菜单对应的名称，数组的个数必须与下面murl对应
	"v	动词",		"n	名词",		"r	代词",
	"a	形容词",    "an	名形词",	"p	介词", 
	"d	副词",		"vn	名动词",	"u	助词" ,
	"vd	副动词",	"nr	人名",		"c	连词",
	"ad	副形词",	"ns	地名",		"i	成语",	
	"m	数词",   	"nz	其他专名",	"l	习用语",
	"q	量词",		"nt	机构团体",	"y	语气词",
	"Mq	数量词", 	"nx	非汉字串",	"e	叹词",
	"t	时间词",	"h	前接成分",	"z	状态词",
	"f	方位词",    "k	后接成分",	"o	拟声词" ,
	"s	处所词",	"b	区别词",	"w	标点符号",
	"Ng	名语素",	"Bg	区别语素",	"j	简称略语", 
	"Ag	形语素",	"Vg	动语素",	"x	非语素字",	
	"Dg	副语素" ,   "Rg	代语素" );

var murl=new Array(
	"change('v');",	    "change('n');",		"change('r');",	
	"change('a');",		"change('an');",	"change('p');",
	"change('d');",		"change('vn');",	"change('u');",
	"change('vd');",	"change('nr');",	"change('c');",
	"change('ad');",	"change('ns');",	"change('i');",
	"change('m');",		"change('nz');",	"change('l');",
	"change('q');",		"change('nt');",	"change('y');",
	"change('Mq');",	"change('nx')",		"change('e');",
	"change('t');",		"change('h');",		"change('z');",
	"change('f');",		"change('k');",		"change('o');",
	"change('s');",		"change('b');",		"change('w');",
	"change('Ng');",	"change('Bg');",	"change('j');",
	"change('Ag');",	"change('Vg');",	"change('x');",
	"change('Dg');",	"change('Rg');"      
);//41

function change(tag){
	var tab = document.getElementById("content");
	//window.alert("原句内容" + tab.rows.item(line).cells.item(col).innerText);
	if(tab.rows.item(line).cells.item(col).innerText != ""){
		tab.rows.item(line).cells.item(col).innerText = tag;
	}
	tt.rows.item(line).cells.item(col).style.background="#eee";
	//var rows = tab.rows.length ; //表格行数     
	//var cells = tab.rows.item(0).cells.length ; //表格列数   
}

//murl是菜单对应的操作，可以任意//javascript代码但是要注意不要在里面输入\"，只能用'
var ph=8,mwidth=310;//每条选项的高度,菜单的总宽度
var bgc="#eee",txc="black";//菜单没有选中的背景色和文字色
var cbgc="darkgray",ctxc="white";//菜单选中的选项背景色和文字色

/****************以下代码请不要修改******************/
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';"
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';"
var line = 0;
var col = 0;
document.oncontextmenu=function()//鼠标右键
{ 
	var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td    
	line = td.parentElement.rowIndex;
	col = td.cellIndex;//这里是表格的第几行第几列，从0开始
	var txt = td.innerText;

	if((line == 1) && (numw >= (col + 1))){
		tt.rows.item(line).cells.item(col).style.background="#75ef92";
		mlay.style.display="";
		mlay.style.pixelTop = event.clientY ;
		mlay.style.pixelLeft = event.clientX ;
		if(screen.width - event.clientX < 310){
			mlay.style.pixelLeft = event.clientX - 310;
		}
		if(screen.height - event.clientY < 600){
			mlay.style.pixelTop = screen.height - 600 ;
		}
	}else if((line == 4) && (numw >= (20 +col + 1))){
		tt.rows.item(line).cells.item(col).style.background="#75ef92";
		mlay.style.display="";		
		mlay.style.pixelTop = event.clientY ;
		mlay.style.pixelLeft = event.clientX ;
		if(screen.width - event.clientX < 310){
			mlay.style.pixelLeft = event.clientX - 310;
		}
		if(screen.height - event.clientY < 600){
			mlay.style.pixelTop = screen.height - 600 ;
		}
	}else if((line == 7) && (numw >= (40 + col + 1))){
		tt.rows.item(line).cells.item(col).style.background="#75ef92";
		mlay.style.display="";		
		mlay.style.pixelTop = event.clientY ;
		mlay.style.pixelLeft = event.clientX ;
		if(screen.width - event.clientX < 310){
			mlay.style.pixelLeft = event.clientX - 310;
		}
		if(screen.height - event.clientY < 600){
			mlay.style.pixelTop = screen.height - 600 ;
		}
	}else if((line == 10) && (numw >=(60 + col + 1))){
		tt.rows.item(line).cells.item(col).style.background="#75ef92";
		mlay.style.display="";		
		mlay.style.pixelTop = event.clientY ;
		mlay.style.pixelLeft = event.clientX ;
		if(screen.width - event.clientX < 310){
			mlay.style.pixelLeft = event.clientX - 310;
		}
		if(screen.height - event.clientY < 600){
			mlay.style.pixelTop = screen.height - 600 ;
		}
		//window.alert(event.clientX + "  " + event.clientY);
	}

	//window.alert(line + "行，列" + col);
	return false;//要有这句才能屏蔽原来的菜单
}

function showoff()
{
	mlay.style.display="none";
}

function fresh()
{
	 mlay.style.background=bgc;
	 mlay.style.color=txc;
	 mlay.style.width=mwidth;
	 mlay.style.height=mname.length*ph;
	 var h="<table width=90% height="+mname.length*ph+"px cellpadding='0'  cellspacing='0' border='1'>";
	 var i=0;
	 var lens = 0;
	 if(mname.length %2 == 1){
		lens = (mname.length-1)/2;
	 }else {
		lens = mname.length/2;
	 }

	 for(i=0;i<mname.length-2;i++)
	 {
		h+="<tr align='left' height="+ph+" ><td style='font-size:10pt;' onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=\""+murl[i]+"\">"+mname[i]+"</td><td style='font-size:10pt;'  onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=\""+murl[i+1]+"\">"+mname[i+1]+"</td><td style='font-size:10pt;'  onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=\""+murl[i+2]+"\">"+mname[i+2]+"</td></tr>";
		i++;
		i++;
	 }
	 
	 h+="<tr align='left' height=" + ph + "><td style='font-size:10pt;' onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=\""+murl[mname.length-2]+"\">"+mname[mname.length-2]+"</td><td style='font-size:10pt;' onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=\""+murl[mname.length-1]+"\">"+mname[mname.length-1]+"</td></tr>";
	
	 h+="</table>";
	 mlay.innerHTML=h;
}//onMouseover=this.style.background='#75ef92' onMouseout=this.style.background='#eee'
</script>
</head>

<body  onClick="showoff();" onload="fresh();">
<div class="header">
	<p class="logo" >
        您已完成<label class='finish' id="finish"><?php echo " <b>".$_COOKIE["finish"]."</b> "; ?></label>句标注任务
    </p>
	<ul class="userinfo" >
        <li id="headuser">
			<?php
				if (isset($_COOKIE["user"])){//如果有cookie，则将user入session
					$_SESSION['users'] = $_COOKIE['user'];
				}	
				$users = $_SESSION['users'];
			    if($users != ""){
					echo $users ." | <span class='download' id='questions'>常见问题</span>";
				}else{
					echo "<a id='login' href='loginc.php'>登录</a>";
					echo " | ";
					echo "<a href='registerc.php'>注册</a>";
				}
			?>
        </li>
    </ul>
</div>
<div></div>

<p>&nbsp;</p><p>&nbsp;</p>
<p class="words">词性标注原句：</p>

<div class="code" > 
	<table id="content" class="content" width="70%" border="0" bordercolor="white" cellspacing="0" >
	<!--onclick="doclick()"-->
		<TR><TH > </TH><TH ></TH><TH></TH><TH></TH><TH></TH><TH></TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH></TR>
		<TR><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH></TR>

		<TR><TH> </TH><TH></TH><TH></TH><TH></TH><TH></TH><TH></TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH></TR>
		<TR><TH> </TH><TH></TH><TH></TH><TH></TH><TH></TH><TH></TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH></TR>

		<TR><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH></TR>
		<TR><TH> </TH><TH></TH><TH></TH><TH></TH><TH></TH><TH></TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH></TR>

		<TR><TH> </TH><TH></TH><TH></TH><TH></TH><TH></TH><TH></TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH></TR>
		<TR><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH></TR>

		<TR><TH> </TH><TH></TH><TH></TH><TH></TH><TH></TH><TH></TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH></TR>
		<TR><TH> </TH><TH></TH><TH></TH><TH></TH><TH></TH><TH></TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH><TH> </TH></TR>
		<TR><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'></TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH><TH onclick=this.style.background='#eee'> </TH></TR>
    </table>
</div>

<p>&nbsp;</p>
<p class="words">备注:</p>
<div class="code"> 
	<textarea id="comment" class="content2"></textarea> 
</div>

<button id="save" class="save" type="button">保存</button>
<button id="back" class="save" type="button">返回</button>
<div id="mlay" style="position:absolute;display:none;cursor:default;"></div>


</body>
</html>