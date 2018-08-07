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
   font-size: 1.2em;
}
.content{
   margin: 0px;
   padding: 0px;
   border: 1px solid #87BF23;
   background-color: #eee;
	
	width:100%;
	height:100px;
	font-family:微软雅黑;
	font-size:1.4em;
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
.words{
	font-family:宋体;
	padding:5px;
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
.download{
	color:red;
}
</style>

<script language="javascript" type="text/JavaScript">
/*
function getSelectText()
{
    window.alert("txt");
    var txt = null;
    if (window.getSelection){ // mozilla FF 
		txt = window.getSelection();
    }else if (document.getSelection){
		txt = document.getSelection();
    }else if (document.selection){ //IE
		txt = document.selection.createRange().text;
    }
    return txt;
}*/

function countInstances(mainStr, subStr)
{
        var count = 0;
        var offset = 0;
        do
        {
            offset = mainStr.indexOf(subStr, offset);
            if(offset != -1)
            {
                count++;
                offset += subStr.length;
            }
        }while(offset != -1)
        return count;
}
var sent="";//存原始带有tag的分词句子
var psent = "";//不带空格的原始句子
var segsent = "";//更改后的句子，带空格
var segsent2 = "";//更改后的句子，不带空格，用于检查用户是否改变了句子内容
var url = "";
var seg="";//初始时，用于显示的原句子，带空格

var tags = new Array();
var segword = new Array();
$(function(){
	if($.cookie("back") == null){
		$.cookie("comment", null);
		url="get_sentence.php";//每次只选一个句子出来！
		$.post(
			url, 
			{},
			function (data){
				//window.alert(data);
				var Str = data.split("%%`$$")[0];
				if(Str == "last" || data == '' || Str == ''){
					window.alert("标注工作已全部完成！");
				}else{
					sent += Str;
					psent += data.split("%%`$$")[1];
					//处理sent，去掉所有词性标记，用于显示
					var words = sent.split(" ");
					sent = "";
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
						//sent += slide2 + "_" + slide[slide.length-1] + " ";
						seg += slide2 + "  ";
						tags.push(slide[slide.length-1]);
						segword.push(slide2);
					}
					document.getElementById("text").innerHTML = "<textarea id='content' class='content'>" + seg + "</textarea>";
				}
			}	
		);
	}
	else if($.cookie("back") != null){//从tag页返回
		$.cookie('restart', null);
		//window.alert($.cookie('comment_seg') + "back"+ $.cookie("back") );
		if($.cookie('comment_seg') != null)
			document.getElementById("comment").innerText = $.cookie('comment_seg');
		
		sent = $.cookie('segsent');
		psent =$.cookie('psent');
		//window.alert(sent + " "+ psent);
		//处理sent，去掉所有词性标记，用于显示
		var words = sent.split(" ");
		sent = "";
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
			seg += slide2 + "  ";
			tags.push(slide[slide.length-1]);
			segword.push(slide2);
		}
		document.getElementById("text").innerHTML = "<textarea id='content' class='content'>" + seg + "</textarea>";
		$.cookie('back', null);
	}

	$("#save").click(function(){
		url = "writeseg.php";
		segsent = document.getElementById("content").value;
		var comment = document.getElementById("comment").value;
		$.cookie('comment_seg', comment);

		var words2 = segsent.split(" ");
		Words = new Array();
		var num = 0;
		for(var i = 0; i< words2.length; i++){
			if(words2[i] != ""){
				Words[num] = words2[i];
				num += 1;
			}
		}
				
		Tags = new Array();
		num = 0;
		for (var i=0; i < Words.length ; i++)//annoter修改过的句子
		{
			for (var j=0; j<segword.length ; j++)//原始的句子
			{
				if(Words[i] == segword[j] ){
					Tags[num] = tags[j];
					num += 1;
					break;
				}
			}
			if(j == segword.length){
				Tags[num] = "#";//被改过的词语，tag置空
				num += 1;
			}
		}
		var fsent = Words[0] + "_" + Tags[0];
		segsent2 = Words[0];
		for (var i=1; i < Words.length ; i++){
			fsent += " " + Words[i] + "_" + Tags[i];
			segsent2 += Words[i];
		} 
		
		if(segsent2 != psent){//改变了原始句子
			window.alert("句子内容被改变，不能保存!");
			window.alert(segsent2 + " " + psent);
			document.getElementById("content").innerHTML = seg;
		}
		else{
			$.post(
				url, 
				{psent: psent, segsent: segsent, comment: comment, fsent:fsent},
				function (data){				
					$.cookie('segsent', fsent);//接下来将segsent和tags重新组织，递交给tagging页面
					$.cookie('psent', psent);
					$.cookie('restart', null);
					window.location.href="POSTagging.php";
				}
			);
		}
	});
	
	$("#logout").click(function(){  
		$.cookie('user', null);
		window.location.href="loginc.php";
	});
	
	$("#restart").click(function(){
		$.cookie('comment_seg', null);
		$.cookie('restart', psent);
		window.location.reload(); 
	});
	
	$("#questions").click(function(){
		var win=window.open("attention.html", '_blank');
		win.focus(); 
	});
});

window.onselect = doSomething;
var txt=null;
var start = 0;
var end = 0;

/*var times = countInstances(sent, txt);//查找子串在主串中出现了几次。
var place = sent.indexOf(txt, start);//从start处开始查找txt串*/

function doSomething(e){
	start = e.target.selectionStart;
	end = e.target.selectionEnd;
	txt = e.target.value.substring(start, end);
	//window.alert(start + " " + end + "  "+ txt);

	document.onmousedown = function(e){
		var e = e || window.event;
		if(e.button == "2"){//右键响应，没有任何条件。	
			if(txt==null){
				return;
			}
			var sent = document.getElementById("content").value;
	
			var t=0;
			var txt2 = "";//去掉txt中间的空格
			for (t=0; t<txt.length ; t++)
			{
				if(txt[t] == ' '){
					;	
				}else{
					txt2 += txt[t];
				}						
			}
			//window.alert("txt2" + txt2 + "  " + txt2.length+ sent);
			var sent2 = "";
			for (t=0; t<sent.length ;)//sent在txt前后分别加上空格
			{
				if(t < start){
					sent2 += sent[t];
					t++;
				}else{
					if(start >0){//window.alert("start" + sent[start-1]);
						if(sent[start-1] != ' '){
							sent2 += "  ";//加了2个空格
						}else if(sent[start-1] == ' ' && sent[start-2] != ' '){
							sent2 += " ";//加了1个空格
						}
					}
				
					for(var t2=0; t2<txt2.length; t2++){
						sent2 += txt2[t2];
					}
					t = end;//window.alert("end" + sent[end]);
					if(t <sent.length ){
						if(sent[end] != ' '){
							sent2 += "  ";//加了2个空格
						} else if (sent[end] == ' ' && sent[end+1] != ' '){
							sent2 += " ";//加了1个空格
						}
					}
					
					for(var t2=t; t2<sent.length; t2++){
						sent2 += sent[t2];
					}
					break;
				}
			}
			//window.alert("sent2" + sent2);
			document.getElementById("text").innerHTML = "<textarea id='content' class='content'>" + sent2 + "</textarea>";
			txt=null;//处理完一次分词后，清空选中区
		}
	}
}
//oncontextmenu="xxxx();return false;"
</script>
</head>

<body  oncontextmenu=self.event.returnValue=false>
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
					echo $users. " | ";
				}else{
					echo "<a id='login' href='loginc.php'>登录</a>";
					echo " | ";
					echo "<a href='registerc.php'>注册</a>";
				}
			?>
			<a href="historyc.php" id="history">历史记录</a> | <a href="http://ir.hit.edu.cn/~yjliu/software/quickfind/" id='download' class='download'>例句查询软件下载</a> | <span class='download' id='questions'>常见问题</span> | <a href="revise.php" id="revise">错误修改</a> | <a href="#" id="logout">退出</a>
        </li>
    </ul>
</div>

<p>&nbsp;</p><p>&nbsp;</p>
<p class="words">分词原句：</p>
<div class="code" id="text"> 
	
</div>

<p>&nbsp;</p>
<p class="words">备注:</p>
<div class="code"> 
	<textarea id="comment" class="content2"></textarea> 
</div>

<button id="save" type="button" class="save">保存</button>
<button id="restart" type="button" class="save">重做</button>
<!--系统数据维护，稍等一会，2分钟左右-->
</body>
</html>