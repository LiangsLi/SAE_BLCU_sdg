<?php
ob_start();
session_start();
require("config2.php");

//setcookie("user", "丁宇");
if (isset($_COOKIE["user"])){//此处为页面第一次获取'finish'cookie
	if(isset($_COOKIE['dep_finish']))
		;
	else{
		$sql2 = "select count(*) as dep_complete from dependancy where annoter='". $_COOKIE["user"] ."' and res_sent != '' and skip = 0;";
		mysql_query("SET NAMES 'UTF8'");
		$res22 = mysql_query($sql2);
		while($times2 = mysql_fetch_assoc($res22)){
			setcookie("dep_finish", $times2['dep_complete']);
			echo $_COOKIE['dep_finish'];
		}
	}
}else{
	$url = "index.php"; 
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>"; 
}
?>

<!DOCTYPE>
<html>
<head>
<meta charset="utf-8" />
<title>semanticannotate</title>
<script src="js/jquery-1.7.2.min.js" type="text/JavaScript"></script>
<script src="js/jquery.cookie.js" type="text/JavaScript"></script>
<script src="js/drawcurve.js" type="text/JavaScript"></script>
<script src="/js/rightMenu.js" type="text/javascript"></script>

<link href="css/whole.css" rel="stylesheet" type="text/css">
<link href="css/rightMenu.css" rel="stylesheet" type="text/css">

<html>
<body oncontextmenu=self.event.returnValue=false>
<div class="header">
	<p class="logo" >
        您已完成<label class='finish' id="finish"> <?php 
													echo $_COOKIE['dep_finish'];
												?> </label>句标注任务
    </p>
	<ul class="userinfo" >
        <li id="headuser">
			<?php
				echo $_COOKIE['user'];
			?>
			<a href="historyc_dep.php" id="history">历史记录</a> | <a href="display_dep.php" class='download' target="view_window">浏览全部</a> | <a href="getDataFromDatabase.php" id='search-words' class='download' target="view_window">查找</a> | <a href="search_dep_all.php" id='search-words' class='download' target="view_window">查找全部</a> |<a href="#" id="logout">退出</a>
        </li>
    </ul>
</div>
<?php
	$sql2 = "select dep_compelete, username from signup";
	mysql_query("SET NAMES 'UTF8'");
	$res22 = mysql_query($sql2);
	$max = 0;
	$name = '';
	while($times2 = mysql_fetch_assoc($res22)){
		if($max <$times2['dep_compelete']){
			$max = $times2['dep_compelete'];
			$name = $times2['username'];
			//echo $name . "l<br>";
		}
	}
	echo "<div class= 'most'><label><b>标注冠军***\( ^v^ )/*** <label>" . $name . "：&nbsp;&nbsp;" . $max . "&nbsp;&nbsp;***\( ^v^ )/***</b></div>";
?>

<canvas id="cc" class='canvas' width='3000' height="700" style="border:0px solid #ccc;" > Your browser dosen't support the HTML5 
canvas.</canvas>

<script type="text/javascript">




var fx=0, fcol = -1;
var sx=0;
var td;

var maxwords = 65;
var xcoordinate =new Array();
var ycoordinate = 694;
var comment = '';
var segcheck = false;//false=不在分词模式；true=正在分词模式

var Arcs = function(x1idx, x2idx, x1, ycoordinate, x2, xtxt, delt, text){
	this.x1idx = x1idx;
	this.x2idx = x2idx;
	this.x1 = x1;
	this.y1 = ycoordinate;
	this.x = x1;
	this.y = ycoordinate-(20-0.15*delt)*delt;
	this.xx = x2;
	this.yy = ycoordinate-(20-0.15*delt)*delt;
	this.x2 = x2;
	this.y2 = ycoordinate;
	this.ytxt = (5 + ycoordinate)-(delt-delt*delt*0.0075)*15;
	this.xtxt = xtxt;
	this.text = text;
	this.choose = false;//判断该弧是否是用户点击的弧
	this.graph = false;
	this.has = false;
};

arcs = new Array();
var tt;
var hb;
var globlechoose = -1;
var pos_g_choose = -1;
var pixel = new Array();
var wordlen;
var protosent = "";
var wordlist='';
var taglist='';

var global_data = '';


$(function(){
	tt = document.getElementById("content");//开始画弧相关
	
	for (var i=0; i<maxwords; i++)
	{
		xcoordinate[i] = i * 40 + 20;
	}
	
	for(var j=0; j< maxwords; j++){	
		for (var i = 0; i< maxwords; i++){
			if(i == j)
				continue;
			var delt = Math.abs(xcoordinate[i]- xcoordinate[j])/40;
			var tmp = new Arcs(j, i, xcoordinate[j], ycoordinate, xcoordinate[i], (xcoordinate[j]+ xcoordinate[i])/2, delt, "NO");
			arcs.push(tmp);
		}
	}
	var c=document.getElementById("cc");
	hb=c.getContext("2d");

	//获取数据//每次选全部句子
	$.post(
		"get_depsent_check_cross_fathers.php", 
		{},
		function (data){//'sent'. "%%`$$" .'res_sent' . "%%`$$" . 'comment'
			//window.alert(data);
			var sentmp = data.split('!!~~!!');
			for(var onesent = 1; onesent < sentmp.length; onesent++)
			{
				var tmp = sentmp[onesent].split('%%`$$');
				protosent = tmp[0];
				var words = tmp[0].split(' ');//词语
				wordlen = words.length;
				tt.style.width = wordlen*40;
				wordlist="<tr>";
				taglist ='<tr>';
			
				
				for (var i = 0; i< words.length; i++)
				{
					var slide = words[i].split(']')[1].split("/");//查找最后一个'/'；word\tag，word当中可能有\
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
					var word = slide2;
					var tag = slide[slide.length-1];
					if(words[i] != ''){
						wordlist += '<td width="40" >' + word + '</td>';
						taglist  += '<td width="40" >' + tag + '</td>';
					}
				}
				wordlist += '</tr>';
				taglist  += '</tr>';
				tt.innerHTML = wordlist + taglist;
				
				for (var i = 0; i< arcs.length; i++){
					if(arcs[i].has == true){
						arcs[i].has = false;
						arcs[i].choose = false;//判断该弧是否是用户点击的弧
						arcs[i].graph = false;
						arcs[i].text = '';
					}
				}
				drawcurve();
				//下面开始画预标注的弧
				if (tmp[1] != ""){
					words = tmp[1].split('\t');//关系
					for(var i = 0; i< words.length; i++){
					if(words[i] == '')
						continue;
					var tmp2 = words[i].split('[');
					var f = Number(tmp2[1].split(']')[0]);
					var s = Number(tmp2[2].split(']')[0]);
				
					var tmp3 = words[i].split(')');
					var tmp4 = tmp3[tmp3.length-2];
					var tmp5 = tmp4.split('(');
					var text = tmp5[tmp5.length-1];
					for(var j = 0; j<arcs.length; j++){
						if(xcoordinate[f] == arcs[j].x1 && xcoordinate[s] == arcs[j].x2){
							arcs[j].text = text;
							arcs[j].has = true;
							break;
						}
					}
				}
				
				drawcurve();
			}
			
			document.getElementById("comment").value = tmp[2];
			
			
			//下面开始检查并保存
			father_idx.length = 0;//清空该数组
			var sent = "";
			var str = "";
			var cell_len = tt.rows.item(0).cells.length;  
			for(var i = 0; i< cell_len; i++){
				pixel[i] = new Array();
				for (var j=0; j< cell_len; j++)
				{
					pixel[i][j] = 0;
				}
			}
			
			for(var i = 0; i<arcs.length; i++){//在这里将弧与词语中table的cell的下标对应上
				if(arcs[i].has == true){
					var fs = -1;
					var ss = -1;
					for(var j = 0; j< cell_len; j++){
						if(j == arcs[i].x1idx){
							fs = j;
						}else if(j == arcs[i].x2idx){
							ss = j;
						}
						if(fs != -1 && ss != -1){
							pixel[fs][ss] = 1;
							var w1 = tt.rows.item(0).cells.item(fs).innerText;//获取单元格词语
							var w2 = tt.rows.item(0).cells.item(ss).innerText;
							var text = arcs[i].text;
							if (w1 == "")
								continue;
							if (text != ""){
								str += "\t[" + fs + "]" + w1 + "_[" + ss + "]" + w2 +"(" + text + ")"; 
								break;
							}else {
								window.alert("弧标签为空！");
								return;
							}
						}
					}
				}
			}
			str = str.substring(1);
			
			var w = tt.rows.item(0).cells.item(0).innerText;
			var postag= tt.rows.item(1).cells.item(0).innerText;
			var newwordpos = '[0]' + w + '/' + postag;
			for (var i = 1; i < cell_len; i++){
				var w = tt.rows.item(0).cells.item(i).innerText;
				var postag= tt.rows.item(1).cells.item(i).innerText;
				if(w == '' || postag == ''){
					window.alert('存在为空的词语或词性，请检查！');
					return;
				}
				newwordpos += ' [' + i + ']' + w + '/' + postag;
			}
			
			
			comment = document.getElementById("comment").value;
			
			var grapharc = document.getElementById("graphtmp").innerHTML;
			if(grapharc != '' && comment.indexOf(grapharc) == -1){//comment不重复记录graph标记弧
				comment += document.getElementById("graphtmp").innerHTML;
			}
			
			if(existing() == false){//检查标注是否完整是否符合要求
				window.alert('标注不完整');
				return;
			}
			
			/*if (comment.indexOf('#fathers#') != -1){//14-3-13,有fathers就一定要有标记弧出现
				if(comment.indexOf('#[') == -1 || comment.indexOf(']#') == -1){
					if (grapharc == ''){//comment和grapharc都没有记录弧信息
						window.alert('存在多入弧节点，但是没有对多入弧进行特殊标记！' + comment);
						return false;
					}
				}
			}*/
			var tmpnum_fathers = 0;
			if ((comment.indexOf('#[') != -1) && (comment.indexOf(']#') != -1))
				tmpnum_fathers = comment.split("#[").length -1;
			if (father_idx.length != tmpnum_fathers){//comment和grapharc都没有记录弧信息
				window.alert('存在多入弧节点，但是多入弧特殊标记有误！' + father_idx.length + " | " + tmpnum_fathers);
				return ;
			}
			if (comment != tmp[2]){
				window.alert(comment + " , " + tmp[2] + "请检查，评论内容有变化");
				return ;
			}
			if (str != tmp[1]){
				window.alert(str + ",,,,,,,,,,,,,,,,,," + tmp[1] + "请检查，标注结果有变化");
				return ;
			}
			//window.alert(str + ' ~~~ !!!!!' + comment);
			
			var url = "write_dep_check_cross_fathers.php";
			$.post(
				url, 
				{res_sent:str, psent : protosent, skip: "0", comment:comment},
				function (data){
					//window.alert(data);
					//window.location.reload();
					//window.location.href="label_dep.php";
				}
			);
			//window.alert("hello");
		}
	});
});



var visited = new Array();
var circleflag;

function checkCorss(){
	var cell_len = tt.rows.item(0).cells.length;  
	for (var i = 0; i < cell_len; i++){
		for(var j=0; j< cell_len; j++){//右弧
			if (i == j)
				continue;
			if((arcs[i].has == false) || (arcs[j].has == false))
				continue;
			if(arcs[j].x1 < arcs[i].x2 && arcs[j].x1 > arcs[i].x1){//j.x1在i.x1和i.x2中间
				if(arcs[j].x2 < arcs[i].x1 || arcs[j].x2 > arcs[i].x2){//j.x2在i.x1另一侧或在i.x2另一侧
					//window.alert(arcs[j].x1 +"," +arcs[j].x2 +",    " + arcs[i].x1 +"," + arcs[i].x2);
					return false;
				}
			}
			else if(arcs[j].x2 < arcs[i].x2 && arcs[j].x2 > arcs[i].x1){//j.x2在i.x1和i.x2中间
				if(arcs[j].x1 < arcs[i].x1 || arcs[j].x1 > arcs[i].x2){//j.x1在i.x1另一侧或在i.x2另一侧
					//window.alert(arcs[j].x1 +"," +arcs[j].x2 +",    " + arcs[i].x1 +"," + arcs[i].x2);
					return false;
				}
			}//左弧
			else if(arcs[j].x1 < arcs[i].x1 && arcs[j].x1 > arcs[i].x2){//j.x1在i.x1和i.x2中间
				if(arcs[j].x2 < arcs[i].x2 || arcs[j].x2 > arcs[i].x1){//j.x2在i.x1另一侧或在i.x2另一侧
					//window.alert(arcs[j].x1 +"," +arcs[j].x2 +",    " + arcs[i].x1 +"," + arcs[i].x2);
					return false;
				}
			}
			else if(arcs[j].x1 < arcs[i].x1 && arcs[j].x1 > arcs[i].x2){//j.x2在i.x1和i.x2中间
				if(arcs[j].x1 < arcs[i].x2 || arcs[j].x1 > arcs[i].x1){//j.x1在i.x1另一侧或在i.x2另一侧
					//window.alert(arcs[j].x1 +"," +arcs[j].x2 +",    " + arcs[i].x1 +"," + arcs[i].x2);
					return false;
				}
			}
		}
	}
	return true;
}
var father_idx = new Array();

function checkInarcs(){//无环并检查fathers是否存在
	var cell_len = tt.rows.item(0).cells.length;  
	var inarc = new Array();
	for (var i=0 ; i< cell_len; i++)
	{
		inarc[i] = 0;
	}
	var tmp = "";
	for(var i = 0; i< cell_len; i++){
		for (var j=0; j< cell_len; j++)
		{
			if(pixel[i][j] == 1){
				inarc[j] += 1;
				tmp += i + " , " + j + "<br>";
			}
		}
	}
	var innum = 0;
	var wflag = 0;
	for (var i=0 ; i< cell_len; i++)
	{
		if(inarc[i] > 0){
			innum += 1;
		}
		if(inarc[i] > 1){
			for(var k=1; k< inarc[i] ; k++)
				father_idx.push(i);
		}
		if(inarc[i] > 1 && wflag == 0){
			wflag = 1;
			if (comment.indexOf('#fathers#') <0)//查找不到fathers字符串
				comment += ' #fathers#';
		}
	}
	if(innum < cell_len-1){
		window.alert("除Root之外的每个节点需要有入弧！不满足，请继续！" + innum + ": "+ cell_len);
		return false;
	}
	//document.getElementById('tmp').innerHTML = tmp;
	return true;
}

function checkComplete(){
	for (var i=0; i<arcs.length; i++){
		if(arcs[i].has == true){
			if(arcs[i].text == "NO"){
				window.alert('依存弧标记不完整，有NO标记！');
				return false;
			}
		}
	}
	return true;
}

function existing(){
	var cell_len = tt.rows.item(0).cells.length;  
	if(checkInarcs()== false){
		return false;
	}
	if(checkComplete() == false){
		return false;
	}
	if(checkCorss() == false){
		//window.alert("依存弧出现交叉！请继续");
		if (comment.indexOf('#cross#') <0)
			comment += ' #cross#';
	}
	for (var i = 0; i<cell_len; i++)
	{
		 visited[i] = 0;
	}
	
	circleflag = 0;//以下检查弧无环，深搜
	for(var i = 0; i<cell_len; i++){
		if(circleflag == 1 ){
			window.alert("依存弧存在闭环！请继续");
			return false;
		}
		checkcircle(i);
	}
	
	return true;
}


function checkcircle(num){
	var cell_len = tt.rows.item(0).cells.length;  
	visited[num] = 2;
	if(circleflag == 1){//标记为有环，退出
		visited[num] = 1;
		return false;	
	}

	for(var i = 0; i< cell_len; i++){
		if(pixel[num][i] == 1){
			if (visited[i] == 2)
			{
				circleflag = 1;
				return false;	
			}else if(visited[i] == 0){
				checkcircle(i);
			}
		}
	}
	visited[num] = 1; //访问过，但是该节点不在当前的访问路径上
	return true;
}
</script>


<div id='table-content'> <table id="content" class="table" style="table-layout: fixed;word-break:break-all" cellpadding=0 cellspacing=0 border=1></table></div>

<div><panel>&nbsp;</panel><!--<button id="undo" class="undo" type="button">取消选择</button>--></div>

<p>&nbsp;</p>
<p class="words2">备注:</p>
<div class="code"> 
	<textarea id="comment" class="content2" ></textarea> 
</div>

<button id="save" type="button" class="save">保存</button>
<button id="restart" type="button" class="save">重做</button>
<button id="startseg" type="button" class="save">切换修改分词</button>
<button id="segok" type="button" class="save">分词修改完毕</button>

<p class='search-selection' id='search-selection' >
	<input id='id' type='radio' name='id' value='0' ><panel>&nbsp;分词错误&nbsp;&nbsp;&nbsp;</panel>
	<input id='id' type='radio' name='id' value='0' ><panel>&nbsp;句子过长&nbsp;&nbsp;&nbsp;</panel>
	<input id='id' type='radio' name='id' value='0' ><panel>&nbsp;句子无意义&nbsp;&nbsp;&nbsp;</panel>
	<input id='id' type='radio' name='id' value='0' ><panel>&nbsp;暂跳后续补&nbsp;&nbsp;&nbsp;</panel>
	<input id='id' type='radio' name='id' value='0' ><panel>&nbsp;其他&nbsp;&nbsp;&nbsp;</panel>
	<form name='form1' id='form' method='post' action=''><panel>&nbsp;&nbsp;跳过理由</panel>
		<input class='textfield2' type='text' id='notes'  value='' /> 
	</form>
</p>

<button id="skip" type="button" class="save">跳过</button>


<div class="rightMenu"  id="rightMenu2" style="display:none" >
	<ul>
		<li onclick='javascript:changecolumn(this.innerText);'>add	右侧增加一列</li>
		<li onclick='javascript:changecolumn(this.innerText);'>reduce	删除当前列</li>

		<li class='rightMenufont'>V系列：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>VA	形动词</li>
				<li onclick='javascript:changetag(this.innerText);'>VC	是为</li>
				<li onclick='javascript:changetag(this.innerText);'>VE	有,没有,无</li>
				<li onclick='javascript:changetag(this.innerText);'>VV	动词</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>N系列：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>NR	专名</li>
				<li onclick='javascript:changetag(this.innerText);'>NT	时间名词</li>
				<li onclick='javascript:changetag(this.innerText);'>NN	名词</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>的地得：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>DEC	的</li>
				<li onclick='javascript:changetag(this.innerText);'>DEG	的</li>
				<li onclick='javascript:changetag(this.innerText);'>DER	得</li>
				<li onclick='javascript:changetag(this.innerText);'>DEV	地</li>
			</ul>
		</li>
		<li class='rightMenufont'>连词：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>CC	并列连词</li>
				<li onclick='javascript:changetag(this.innerText);'>CS	连词</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>数词：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>CD	基础词</li>
				<li onclick='javascript:changetag(this.innerText);'>OD	序数词</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>被字：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>LB	被叫给为</li>
				<li onclick='javascript:changetag(this.innerText);'>SB	被无施事</li>
			</ul>
		</li>
		<li onclick='javascript:changetag(this.innerText);'>JJ	形容词</li>
		<li onclick='javascript:changetag(this.innerText);'>LC	地理位置</li>
		<li onclick='javascript:changetag(this.innerText);'>PN	代词</li>
		<li onclick='javascript:changetag(this.innerText);'>DT	限定词</li>
		<li onclick='javascript:changetag(this.innerText);'>M	量词</li>
		<li onclick='javascript:changetag(this.innerText);'>AD	副词</li>
		<li onclick='javascript:changetag(this.innerText);'>P	介词</li>
		<li onclick='javascript:changetag(this.innerText);'>AS	着了过的</li>
		<li onclick='javascript:changetag(this.innerText);'>ETC	等</li>
		<li onclick='javascript:changetag(this.innerText);'>MSP	所为以来</li>
		<li onclick='javascript:changetag(this.innerText);'>BA	把将</li>
		<li onclick='javascript:changetag(this.innerText);'>FW	外文</li>
		<li onclick='javascript:changetag(this.innerText);'>PU	标点</li>
		<li onclick='javascript:changetag(this.innerText);'>ON	拟声词</li>
		<li onclick='javascript:changetag(this.innerText);'>IJ	感叹词,插入语</li>
		<li onclick='javascript:changetag(this.innerText);'>SP	句末语气</li>
		<li onclick='javascript:changetag(this.innerText);'>VN	动名词</li>
		<li onclick='javascript:changetag(this.innerText);'>AN	形容词名词</li>
	</ul>
</div>



<div class="rightMenu"  id="rightMenu1" style="display:none" >
    <ul>
        <li class='rightMenufont'>周边角色：
			<ul>
				<li >主体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>Agt	施事角色</li>
						<li onclick='javascript:change(this.innerText);'>Exp	当事角色</li>
						<li onclick='javascript:change(this.innerText);'>Aft	感事角色</li>
						<li onclick='javascript:change(this.innerText);'>Poss	领事角色</li>
        			</ul>
        		</li>
				
				<li >客体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>Pat	受事角色</li>
						<li onclick='javascript:change(this.innerText);'>Cont	客事角色</li>
						<li onclick='javascript:change(this.innerText);'>Prod	成事角色</li>
						<li onclick='javascript:change(this.innerText);'>Orig	源事角色</li>
						<li onclick='javascript:change(this.innerText);'>Datv	涉事角色</li>
        			</ul>
        		</li>
				
				<li >系体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>Belg	属事角色</li>
						<li onclick='javascript:change(this.innerText);'>Clas	类事角色</li>
						<li onclick='javascript:change(this.innerText);'>Accd	依据角色</li>
        			</ul>
        		</li>
				
				<li >情由角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>Reas	缘故角色</li>
						<li onclick='javascript:change(this.innerText);'>Int	意图角色</li>
						<li onclick='javascript:change(this.innerText);'>Cons	结局角色</li>
						
        			</ul>
        		</li>
				
				<li >状况角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>Mann	方式角色</li>
						<li onclick='javascript:change(this.innerText);'>Tool	工具角色</li>
						<li onclick='javascript:change(this.innerText);'>Matl	材料角色</li>
        			</ul>
        		</li>
				
				<li >时空角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>Time	时间角色</li>
						<li onclick='javascript:change(this.innerText);'>Loc	空间角色</li>
						<li onclick='javascript:change(this.innerText);'>Proc	历程角色</li>
						<li onclick='javascript:change(this.innerText);'>Dir	趋向角色</li>
						<li onclick='javascript:change(this.innerText);'>Sco	范围角色</li>
        			</ul>
        		</li>
				
				<li >度量角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>Quan	数量角色</li>
						<li onclick='javascript:change(this.innerText);'>Freq	频率角色</li>
						<li onclick='javascript:change(this.innerText);'>Seq	顺序角色</li>
        			</ul>
        		</li>
				
				<li >其他角色：
					<ul>
        				<li onclick='javascript:change(this.innerText);'>Feat	描写角色</li>
						<li onclick='javascript:change(this.innerText);'>Host	宿主角色</li>
						<li onclick='javascript:change(this.innerText);'>Nmod	名字修饰角色</li>
						<li onclick='javascript:change(this.innerText);'>Tmod	时间修饰角色</li>
        			</ul>
				</li>
        	</ul>
        </li>
		<li class='rightMenufont'>反关系角色：
			<ul>
				<li >主体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>rAgt	反施事</li>
						<li onclick='javascript:change(this.innerText);'>rExp	反当事</li>
						<li onclick='javascript:change(this.innerText);'>rAft	反感事</li>
						<li onclick='javascript:change(this.innerText);'>rPoss	反领事</li>
        			</ul>
        		</li>
				
				<li >客体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>rPat	反受事</li>
						<li onclick='javascript:change(this.innerText);'>rCont	反客事</li>
						<li onclick='javascript:change(this.innerText);'>rProd	反成事</li>
						<li onclick='javascript:change(this.innerText);'>rOrig	反源事</li>
						<li onclick='javascript:change(this.innerText);'>rDatv	反涉事</li>
        			</ul>
        		</li>
				
				<li >系体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>rBelg	反属事</li>
						<li onclick='javascript:change(this.innerText);'>rClas	反类事</li>
						<li onclick='javascript:change(this.innerText);'>rAccd	反依据</li>
        			</ul>
        		</li>
				
				<li >情由角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>rReas	反缘故</li>
						<li onclick='javascript:change(this.innerText);'>rInt	反意图</li>
						<li onclick='javascript:change(this.innerText);'>rCons	反结局</li>
        			</ul>
        		</li>
				
				<li >状况角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>rMann	反方式</li>
						<li onclick='javascript:change(this.innerText);'>rTool	反工具</li>
						<li onclick='javascript:change(this.innerText);'>rMatl	反材料</li>
        			</ul>
        		</li>
				
				<li >时空角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>rTime	反时间</li>
						<li onclick='javascript:change(this.innerText);'>rLoc	反空间</li>
						<li onclick='javascript:change(this.innerText);'>rProc	反历程</li>
						<li onclick='javascript:change(this.innerText);'>rDir	反趋向</li>
						<li onclick='javascript:change(this.innerText);'>rSco	反范围</li>
        			</ul>
        		</li>
				
				<li >度量角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>rQuan	反数量</li>
						<li onclick='javascript:change(this.innerText);'>rFreq	反频率</li>
						<li onclick='javascript:change(this.innerText);'>rSeq	反顺序</li>
        			</ul>
        		</li>
				
				<li >其他角色：
					<ul>
        				<li onclick='javascript:change(this.innerText);'>rFeat	反描写</li>
        			</ul>
				</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>嵌套关系角色：
			<ul>
				<li >主体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>dAgt	嵌套施事</li>
						<li onclick='javascript:change(this.innerText);'>dExp	嵌套当事</li>
						<li onclick='javascript:change(this.innerText);'>dAft	嵌套感事</li>
						<li onclick='javascript:change(this.innerText);'>dPoss	嵌套领事</li>
        			</ul>
        		</li>
				
				<li >客体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>dPat	嵌套受事</li>
						<li onclick='javascript:change(this.innerText);'>dCont	嵌套客事</li>
						<li onclick='javascript:change(this.innerText);'>dProd	嵌套成事</li>
						<li onclick='javascript:change(this.innerText);'>dOrig	嵌套源事</li>
						<li onclick='javascript:change(this.innerText);'>dDatv	嵌套涉事</li>
        			</ul>
        		</li>
				
				<li >系体角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>dBelg	嵌套属事</li>
						<li onclick='javascript:change(this.innerText);'>dClas	嵌套类事</li>
						<li onclick='javascript:change(this.innerText);'>dAccd	嵌套依据</li>
        			</ul>
        		</li>
				
				<li >情由角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>dReas	嵌套缘故</li>
						<li onclick='javascript:change(this.innerText);'>dInt	嵌套意图</li>
						<li onclick='javascript:change(this.innerText);'>dCons	嵌套结局</li>
        			</ul>
        		</li>
				
				<li >状况角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>dMann	嵌套方式</li>
						<li onclick='javascript:change(this.innerText);'>dTool	嵌套工具</li>
						<li onclick='javascript:change(this.innerText);'>dMatl	嵌套材料</li>
        			</ul>
        		</li>
				
				<li >时空角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>dTime	嵌套时间</li>
						<li onclick='javascript:change(this.innerText);'>dLoc	嵌套空间</li>
						<li onclick='javascript:change(this.innerText);'>dProc	嵌套历程</li>
						<li onclick='javascript:change(this.innerText);'>dDir	嵌套趋向</li>
						<li onclick='javascript:change(this.innerText);'>dSco	嵌套范围</li>
        			</ul>
        		</li>
				
				<li >度量角色：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>dQuan	嵌套数量</li>
						<li onclick='javascript:change(this.innerText);'>dFreq	嵌套频率</li>
						<li onclick='javascript:change(this.innerText);'>dSeq	嵌套顺序</li>
        			</ul>
        		</li>
				
				<li >其他角色：
					<ul>
        				<li onclick='javascript:change(this.innerText);'>dFeat	嵌套描写</li>
						<li onclick='javascript:change(this.innerText);'>dHost	嵌套宿主</li>
        			</ul>
				</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>事件关系角色：
			<ul>
				<li onclick='javascript:change(this.innerText);'>eCoo	并列关系</li>
				<li onclick='javascript:change(this.innerText);'>eSelt	选择关系</li>
				<li onclick='javascript:change(this.innerText);'>eEqu	等同关系</li>
				<li >接续关系：
        			<ul>
        				<li onclick='javascript:change(this.innerText);'>ePrec	先行</li>
						<li onclick='javascript:change(this.innerText);'>eSucc	顺承</li>
						<li onclick='javascript:change(this.innerText);'>eProg	递进</li>
						<li onclick='javascript:change(this.innerText);'>eAdvt	转折</li>
						<li onclick='javascript:change(this.innerText);'>eCau	原因</li>
						<li onclick='javascript:change(this.innerText);'>eResu	结果</li>
						<li onclick='javascript:change(this.innerText);'>eInf	推论</li>
						<li onclick='javascript:change(this.innerText);'>eCond	条件</li>
						<li onclick='javascript:change(this.innerText);'>eSupp	假设</li>
						<li onclick='javascript:change(this.innerText);'>eConc	让步</li>
						<li onclick='javascript:change(this.innerText);'>eMetd	手段</li>
						<li onclick='javascript:change(this.innerText);'>ePurp	目的</li>
						<li onclick='javascript:change(this.innerText);'>eAban	割舍</li>
						<li onclick='javascript:change(this.innerText);'>ePref	选取</li>
						<li onclick='javascript:change(this.innerText);'>eSum	总括</li>
						<li onclick='javascript:change(this.innerText);'>eRect	分叙</li>
        			</ul>
        		</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>语义依附标记：
			<ul>
			<li onclick='javascript:change(this.innerText);'>mConj	连词标记</li>
			<li onclick='javascript:change(this.innerText);'>mAux	的字标记</li>
			<li onclick='javascript:change(this.innerText);'>mPrep	介词标记</li>
			<li onclick='javascript:change(this.innerText);'>mTone	语气标记</li>
			<li onclick='javascript:change(this.innerText);'>mTime	时间标记</li>
			<li onclick='javascript:change(this.innerText);'>mRang	范围标记</li>
			<li onclick='javascript:change(this.innerText);'>mDegr	程度标记</li>
			<li onclick='javascript:change(this.innerText);'>mQuaf	量词标记</li>
			<li onclick='javascript:change(this.innerText);'>mFreq	频率标记</li>
			<li onclick='javascript:change(this.innerText);'>mDir	趋向标记</li>
			<li onclick='javascript:change(this.innerText);'>mPars	插入语标记</li>
			<li onclick='javascript:change(this.innerText);'>mNeg	否定标记</li>
			<li onclick='javascript:change(this.innerText);'>mMod	情态标记</li>
			<li onclick='javascript:change(this.innerText);'>mPunc	标点标记</li>
			<li onclick='javascript:change(this.innerText);'>mRept	重复标记</li>
			<li onclick='javascript:change(this.innerText);'>mMaj	多数标记</li>	
			</ul>
		</li>
		<li onclick='javascript:change(this.innerText);'>Null	无标记</li>
		<li onclick='javascript:change(this.innerText);'>Root	root</li>
		<li onclick='javascript:signgraph(this.innerText);'>graph	树之外的弧</li>
		<li onclick='javascript:signgraph(this.innerText);'>delgraph	删除标记</li>
	</ul>
</div>
<p id='graphtmp'></p>


</body>
</html>