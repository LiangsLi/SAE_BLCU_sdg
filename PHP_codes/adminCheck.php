<?php
require("config2.php");
date_default_timezone_set('PRC');//设置北京时间
$dates = date('Y-m-d G:i:s');
$admin = $_COOKIE['admin'];

$result = array();
$num = 0;
if(($admin == "admin1") ||( $admin == "admin2") || ($admin == "admin3")|| ($admin == "admin4") || ($admin == "admin5")){
	$sql0 = "select * from charge where adminname = '". $admin ."' and chargetime = '' limit 5;";
	$res0 = mysql_query($sql0);
	while($ts = mysql_fetch_assoc($res0)){
			$sent = $ts['tagsent'];
			$buffer = trim($sent);//删掉开头结尾的空格	
			$words = explode(" ", $buffer);
			$sent = "";
			for($i = 0; $i < count($words); $i++){//对原句进行把'_'变成'/'
				$slide = explode("_", $words[$i]);
				if($slide[0] != ""){
					$slide2 = $slide[0];
				}else{
					$slide2 = '';
				}
				for($j =1; $j<count($slide)-1; $j++){
					if($slide[$j] == ""){
						$slide2 .= "_";
					}else{
						$slide2 .= "_" . $slide[$j];
					}
				}
				$sent .=  $slide2 ."/" . $slide[(count($slide)-1)]. "  ";
			}

			$result[$num] = $sent;
			$num += 1;
			$unp_flag = 1;
	}
	if($unp_flag == 0){
		$sqls = "select * from signup where complete >10;";
		mysql_query("SET NAMES 'UTF8'");
		$ress = mysql_query($sqls);
		while($ts = mysql_fetch_assoc($ress)){
			$rands = rand(2160, 86400*4);
			$sqlquery = "SELECT * FROM `fillout` where UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(tagtime)<=". $rands ." and annoter ='".$ts['username']."' and sent not in (select sent from charge)  limit 1;";//order by tagtime desc查询太多行，数据库查询会出错
			//$sqlquery = "select * from fillout where annoter = '滕立坤' and tagtime != '' order by tagtime desc limit 15";
			//查找一天之内的内容86400s
			mysql_query("SET NAMES 'UTF8'");
			$res5 = mysql_query($sqlquery);
			while($times = mysql_fetch_assoc($res5)){
				if($times['tagsent'] == "")
					break;			
				
				$times['sent'] = str_replace("\\", "\\\\", $times['sent']);
				$times['sent'] = str_replace("'", "\'", $times['sent']);

				$times['tagsent'] = str_replace("\\", "\\\\", $times['tagsent']);
				$times['tagsent'] = str_replace("'", "\'", $times['tagsent']);

				$times['comment'] = str_replace("\\", "\\\\", $times['comment']);
				$times['comment'] = str_replace("'", "\'", $times['comment']);

				$sqlquery2 = "insert into charge values('".$times['sent']."','".$times['tagsent']. "','".$ts['username']. "','".$times['tagtime']. "','". $times['comment']. "','',0,'" . $admin . "' , '')";
				mysql_query("SET NAMES 'UTF8'");
				mysql_query($sqlquery2);
				
				$sent = $times['tagsent'];
				$buffer = trim($sent);//删掉开头结尾的空格	
				$words = explode(" ", $buffer);
				$sent = "";
				for($i = 0; $i < count($words); $i++){//对原句进行把'_'变成'/'
					$slide = explode("_", $words[$i]);
					if($slide[0] != ""){
						$slide2 = $slide[0];
					}else{
						$slide2 = '';
					}
					for($j =1; $j<count($slide)-1; $j++){
						if($slide[$j] == ""){
							$slide2 .= "_";
						}else{
							$slide2 .= "_" . $slide[$j];
						}
					}
					$sent .=  $slide2 ."/" . $slide[(count($slide)-1)]. "  ";
				}
				
				$result[$num] = $sent;
				$num += 1;
			}
		}
	}
	$completes = 0;
	$sql = "SELECT sum(complete) as total from signup";
	mysql_query("SET NAMES 'UTF8'");
	$res2 = mysql_query($sql);
	while($times3 = mysql_fetch_assoc($res2)){
		$completes = $times3['total'];
	}

	$adminum = 0;//查询已经检查完的数目
	$sql11 = "SELECT count(*) as total from charge where adminname='". $admin . "' and chargetime !=''";
	mysql_query("SET NAMES 'UTF8'");
	$res211 = mysql_query($sql11);
	while($times311 = mysql_fetch_assoc($res211)){
		$admminum = $times311['total'];
	}
}
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
.sent2{
    line-height: 50px;
	margin-left:25px;
    text-align: left;
	font-size:1.2em;
}
.tag{
	font-size:1.2em;
	margin-top:10px;
	margin-left: 25px;
	font-family:"微软雅黑";
	text-align:center;
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
	margin-top:20px;
	margin-left:150px;
	line-height: 50px;
    text-align: center;
    width: 440px;
	font-size:1.3em;
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
</style>

<script language="javascript" type="text/JavaScript">
$(function(){
	$("#logout").click(function(){  
		$.cookie('admin', null);
		window.location.href="charge.php";
	});

	$("#submit-check").click(function(){
		//window.alert($.cookie('admin'));
		if(($.cookie("admin") != "admin1") &&( $.cookie("admin") != "admin2") && ($.cookie("admin")!="admin3")  && ($.cookie("admin") != "admin4") && ($.cookie("admin") != "admin5")){
			window.alert("您不是管理员，无权提交！");
			return ;
		}
		var sent = "";
		var getCK=document.getElementsByTagName('input');   
		var num = 0;
		for(var i=0;i<getCK.length/3;i++)   //获取多少个input标签
		{   
			var name = "select" + i;
			//window.alert(name + "," + document.getElementsByName(name).length);
			var chkObjs = document.getElementsByName(name);
            for(var j=0; j<chkObjs.length; j++){//获取每个input有多少个radio
				var rwflag = 0;
                if(chkObjs[j].checked){
					num += 1;
					if(chkObjs[j].value == 0)//charge result is wrong
					{
						rwflag = 1;
					}
					var sts = "notes" + String(i); 
					//window.alert("sts: " + sts + " |" + document.getElementById(sts).value);

					sent += change2space(chkObjs[j].id) + "%%`$$" + document.getElementById(sts).value + "%%`$$" + rwflag + "%%`$$";
                }//去掉词性，获取sent项
            }
			
		}
		if(num == getCK.length/3){
			window.alert(sent);
			var url="write_charge.php";//提交
			$.post(
				url, 
				{sent: sent},
				function (data){
					//window.alert("提交成功！");
					window.alert(data);
					window.location.href="adminNew.php";
				}
			);		
		}else{
			window.alert("仍有未被处理的句子，请继续！");
			return;
		}
	});
});

function change2space(sent){//'/'线变'_'
	var words = sent.split(" ");
	sent = "";
	for(var i = 0; i < words.length; i++){
		if(words[i] == "")
			continue;
		var slide = words[i].split("/");
		var slide2 = "";
		if(slide[0] != ""){
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
		sent += slide2;
	}
	return sent;
}
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
				?> | <span class='tag'>已经检查<?php echo $admminum;?>句</span> | <a href="#" id="logout">退出</a>
			</li>
		</ul>
	</div>

<p class='tag'>随机抽取一些最近标注过的句子给您review！</p><p class='tag'>已经完成标注<?php echo $completes;?>句</p>
<div   id="tt">   
  <form id="box" method="POST" action=""> 
	<p class='rw2'> <span class="rw"><b>错</b></span>&nbsp;&nbsp;<span class= "rw"><b>对</b></span></p>
	<?php
	if(($admin == "admin1") ||( $admin == "admin2") || ($admin == "admin3")|| ($admin == "admin4") || ($admin == "admin5")){
		if($num == 0){
			echo "暂无数据需要检查！";
		}
		for($i=0; $i<$num; $i++){//radio是按name分组
			$name = "select" . $i;
			echo "<p class='search-selection' id='search-selection' >
							<input id='".$result[$i]."' type='radio' name='".$name."' value='0' ><panel>&nbsp;&nbsp;&nbsp;</panel>
							<input id='".$result[$i]."' type='radio' name='".$name."' value='1' >&nbsp;&nbsp;&nbsp;" . $result[$i] . "<br><form name='form1' id='form". $i ."' method='post' action=''> <label class='textfield'>error comment：</label> <input class='textfield2' type='text' id='notes". $i ."'  value='' onfocus='this.select()'/> </form></p>";
		}
	}else{
		echo "您不是管理员，不能使用该页面！";
	}
	?>
  </form>
  <button type="button"class="save" id="submit-check">确认提交</button>
</div>
</body>
</html>