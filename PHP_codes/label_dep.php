<?php
ob_start();
session_start();
require("config2.php");

//setcookie("user", "丁宇");
if (isset($_COOKIE["user"])){//如果定义了$_COOKIE["user"]
	if(isset($_COOKIE['dep_finish']))
		;//如果已经定义过$_COOKIE['dep_finish']，就什么都不做。
	else{
		$sql2 = "select count(*) as dep_complete from dependancy where annoter='". $_COOKIE["user"] ."' and res_sent != '' and skip = 0;";
		//annoter指的是标注人，检索符合条件的记录条数，保存为dep_complete
		mysql_query("SET NAMES 'UTF8'");
		$res22 = mysql_query($sql2);//执行
		while($times2 = mysql_fetch_assoc($res22)){
			setcookie("dep_finish", $times2['dep_complete']);//保存完成的条数？？
			echo $_COOKIE['dep_finish'];//返回当前用户完成的条数？？
		}
	}
}else{//如果没有定义$_COOKIE["user"]
	$url = "index.php"; 
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";//就跳转到登录页面
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
<script src="/js/ArcsDesign.js" type="text/javascript"></script>

<link href="css/whole.css" rel="stylesheet" type="text/css">
<link href="css/rightMenu.css" rel="stylesheet" type="text/css">

<html>
<body oncontextmenu=self.event.returnValue=false>
<div class="header">
	<p class="logo" >
        您已完成<label class='finish' id="finish"> 
        <?php 
			$sql = "select dep_compelete from signup where username = '".$_COOKIE['user']."'";
        	mysql_query("SET NAMES 'UTF8'");
        	$res = mysql_query($sql);
        	$dep_finish = "";
            while ($words = mysql_fetch_assoc($res)){
                $result = $words['dep_compelete'];
            }
        	echo $result;
		?> 
	</label>句标注任务
    </p>
	<ul class="userinfo" >
        <li id="headuser">
			<?php
				echo $_COOKIE['user'];
			?>
			<a href="historyc_dep.php" id="history">历史记录</a> |<!-- <a href="display_dep.php" class='download' target="view_window">浏览全部</a> |--> <a href="search_oneself.php" id='search-words' class='download' target="view_window">查找自己</a> | <a href="search_dep_all.php" id='search-words' class='download' target="view_window">查找全部</a> |<a href="#" id="logout">退出</a>
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
	echo "<div class= 'most'><label><b>标注冠军***\( ^v^ )/*** <label>" . $name . "：&nbsp;&nbsp;" . $max . "</b></div>";
?>

<script type="text/javascript">

function change(tag){
	if(!-[1,]){
		//alert('是IE！')
		tag = tag.split(' ')[0];
	}else{
		tag = tag.split("\t")[0];
	}
	arcs[globlechoose].text = tag;
	arcs[globlechoose].choose = false;
	drawcurve();
}

function signgraph(tag){
	if (!-[1,]){
		//alert('是IE！')
		tag = tag.split(' ')[0];
	} else{
		tag = tag.split("\t")[0];
	}
	var x1idx = arcs[globlechoose].x1idx;
	var x2idx = arcs[globlechoose].x2idx;
	var pretag = arcs[globlechoose].text;
	var w1 = tt.rows.item(0).cells.item(x1idx).innerText;
	var w2 = tt.rows.item(0).cells.item(x2idx).innerText;
	//var w1 = document.getElementById('cell' + x1idx).value;
	//var w2 = document.getElementById('cell' + x2idx).value;
	var strs = "#["+x1idx +":"+x2idx +" | "+ w1 + ':' + w2 +" | "+ pretag  +"]#";
	
	if (arcs[globlechoose].graph == true && tag == 'delgraph'){
		var comment_temp = document.getElementById("graphtmp").innerHTML;
		var temp = comment_temp.split("#[");
		comment_temp = '';
		
		var delidx = -1;
		for (var i=1; i<temp.length; i++){
			var x1= temp[i].split(":")[0];
			var x2 = temp[i].split(":")[1].split(' | ')[0];
			//window.alert(x1 + ', ' + x2 + '.' + x1idx + ',' + x2idx);
			if (x1 == x1idx && x2 == x2idx){
				delidx = i;
				break;
			}
		}
	
		for (var i=1; i<temp.length; i++){
			if (i == delidx){
				continue;
			}
			comment_temp += "#[" + temp[i];
		}
		document.getElementById("graphtmp").innerHTML = comment_temp;
		showoff();
		arcs[globlechoose].graph = false;
		arcs[globlechoose].choose = false;
		drawcurve();
		return;
	}
	else if (arcs[globlechoose].graph == false && tag == 'graph'){
		arcs[globlechoose].graph = true;
		showoff();
		drawcurve();
		if (document.getElementById("graphtmp").innerHTML.indexOf(strs) == -1) //if not contain substr,
			document.getElementById("graphtmp").innerHTML += strs;
	}
	else{
		return;
	}
	
}


var fx=0, fcol = -1;
var sx=0;
var td;
document.oncontextmenu=function(event)/*******js右击弹出菜单***************/
{
	td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td    
	line = td.parentElement.rowIndex;
	col = td.cellIndex;//这里是表格的第几行第几列，从0开始
	var cell_len = tt.rows.item(0).cells.length;  
	/**********************************************************/
	//以下显示右键菜单--arc-realation.
	var x = event.pageX - $("#cc").offset().left;
	var y = event.pageY - $("#cc").offset().top;//x and y are the pixels in the canvas
	
	for (var i=0; i<arcs.length; i++)
	{
		if(arcs[i].has == false)
			continue;
		var tx = arcs[i].xtxt;
		var ty = arcs[i].ytxt;
		if((x-13)<=tx && (y-9)<=ty && (y+10) >=ty &&(x+13)>=tx ) {//为增加使用时的友好性，将上下左右各增加1
			if (segcheck == false){
				arcs[i].choose = true;
				drawcurve();
				globlechoose = i;
				//window.alert(tx +","+ ty + "     |   " + event.clientX + "," + event.clientY);
				setRightMenu(event,'rightMenu1');
				break;
			}
		}
	}
	/***********************************************************/

	if (fcol == col){
		fx = 0;
		sx = 0;
		fcol = -1;
		tt.rows.item(0).cells.item(col).style.background="#E1E1DF";//返回背景色，右键取消选择单元格。
		tt.rows.item(1).cells.item(col).style.background="#E1E1DF";
		return;
	}else if(fcol != col && col >= 0 && col < cell_len){
		if (segcheck == true){//在修改分词状态下，才显示右键菜单。
			pos_g_choose = col;
			setRightMenu(event,'rightMenu2');
		}
	}
	return false;
}
function changetag(tag){
	if(!-[1,]){
		//alert('是IE！')
		tag = tag.split(' ')[0];
	}else{
		tag = tag.split("\t")[0];
	}
	
	tt.rows.item(1).cells.item(pos_g_choose).innerText = tag;
	//window.alert(tt.rows.item(1).cells.item(i).innerText);
}

function changecolumn(tag){//将表格所在列右侧增加一个列，并将该列后面的词语往后挪
	if(!-[1,]){
		//alert('是IE！')
		tag = tag.split(' ')[0];
	}else{
		tag = tag.split("\t")[0];
	}
	
	wordlist="<tr>";
	taglist ='<tr>';
	var cell_len = tt.rows.item(0).cells.length;  
	for (var i = 0; i < cell_len; i++){
		var w = document.getElementById('cell' + i).value;
		var postag= tt.rows.item(1).cells.item(i).innerText;
		
		if (pos_g_choose == i-1 && tag == 'add'){
			//window.alert(postag + ',' + pos_g_choose + ',' + i);
			wordlist += '<td width= ' + CellCont + '  ><div><textarea id="cell' + i + '" value="' + w + '" style="width:39px;height:85px;font-size:17px"></textarea></div></td>';
			taglist += '<td width= ' + CellCont + '  ></td>';
		}
		if (pos_g_choose == i && tag == 'reduce'){
			continue;
		}else{
			if (i > pos_g_choose  && tag == 'add'){
				wordlist += '<td width= ' + CellCont + '  ><div><textarea id="cell' + (i+1) + '" value="' + w + '" style="width:39px;height:85px;font-size:17px">' + w + '</textarea></div></td>';
				taglist  += '<td width= ' + CellCont + '  >' + postag + '</td>';
			}else if (i <= pos_g_choose  && tag == 'add'){
				wordlist += '<td width= ' + CellCont + '  ><div><textarea id="cell' + i + '" value="' + w + '" style="width:39px;height:85px;font-size:17px">' + w + '</textarea></div></td>';
				taglist  += '<td width= ' + CellCont + '  >' + postag + '</td>';
			}
			
			if (i > pos_g_choose  && tag == 'reduce'){
				wordlist += '<td width= ' + CellCont + '  ><div><textarea id="cell' + (i-1) + '" value="' + w + '" style="width:39px;height:85px;font-size:17px">' + w + '</textarea></div></td>';
				taglist  += '<td width= ' + CellCont + '  >' + postag + '</td>';
			}else if (i < pos_g_choose  && tag == 'reduce'){
				wordlist += '<td width= ' + CellCont + '  ><div><textarea id="cell' + i + '" value="' + w + '" style="width:39px;height:85px;font-size:17px">' + w + '</textarea></div></td>';
				taglist  += '<td width= ' + CellCont + '  >' + postag + '</td>';
			}
		}
		
		if (pos_g_choose == cell_len-1 && tag == 'add' && i == cell_len-1){
			//window.alert(postag + ',' + pos_g_choose + ',' + i);
			wordlist += '<td width= ' + CellCont + '  ><div><textarea id="cell' + cell_len + '" value="' + w + '" style="width:39px;height:85px;font-size:17px"></textarea></div></td>';
			taglist += '<td width= ' + CellCont + '  ></td>';
		}
	}
	wordlist += '</tr>';
	taglist  += '</tr>';
	if (tag == 'reduce'){
		tt.style.width = (cell_len-1)*CellWidth;
	}
	tt.innerHTML = wordlist + taglist;
	//表格的删增完成
	
	//弧线对应的删除和移位
	var nx1idx = -1;
	var nx2idx = -1;
	var newidx1=new Array();
	var newidx2=new Array();
	var oldtext=new Array();
	var num = 0;
	if(tag == 'add'){
		for(var j = 0; j<arcs.length; j++){
			if (arcs[j].has == true){
				nx1idx = arcs[j].x1idx;
				nx2idx = arcs[j].x2idx;
				if (arcs[j].x1idx > pos_g_choose){
					nx1idx = arcs[j].x1idx + 1;
					arcs[j].has = false;
				}
				if (arcs[j].x2idx > pos_g_choose){
					nx2idx = arcs[j].x2idx + 1;
					arcs[j].has = false;
				}
				if (arcs[j].has == true)
					continue;
				
				//window.alert(j + ',' +nx1idx + ',' + nx2idx);
				newidx1[num] = nx1idx;
				newidx2[num] = nx2idx;
				oldtext[num] = arcs[j].text;
				num = num + 1;
			}
		}
		
		for (var j=0; j<newidx1.length; j++){
			for(var i=0; i< arcs.length; i++){
				if (arcs[i].x1idx == newidx1[j] && arcs[i].x2idx == newidx2[j]){
						arcs[i].has = true;
						arcs[i].text = oldtext[j];
						break;
				}	
			}
		}
	}
	
	else if(tag == 'reduce'){
		for(var j = 0; j<arcs.length; j++){
			if (arcs[j].has == true){
				if (arcs[j].x1idx == pos_g_choose ||arcs[j].x2idx == pos_g_choose){
					arcs[j].has = false;//删除被删掉的列所对应的所有弧。
				}
				//移动弧，只要弧的一端比被删除的单元格所在的列大，就要移动。
				nx1idx = arcs[j].x1idx;
				nx2idx = arcs[j].x2idx;
				if (arcs[j].x1idx == pos_g_choose || arcs[j].x2idx == pos_g_choose){
					arcs[j].has = false;
					continue;
				}
				if (arcs[j].x1idx > pos_g_choose){
					nx1idx = arcs[j].x1idx - 1;
					arcs[j].has = false;
				}
				if (arcs[j].x2idx > pos_g_choose){
					nx2idx = arcs[j].x2idx - 1;
					arcs[j].has = false;
				}
				
				if (arcs[j].has == true)
					continue;
				newidx1[num] = nx1idx;
				newidx2[num] = nx2idx;
				oldtext[num] = arcs[j].text;
				num = num + 1;
			}
		}
		
		for (var j=0; j<newidx1.length; j++){
			for(var i=0; i< arcs.length; i++){
				if (arcs[i].x1idx == newidx1[j] && arcs[i].x2idx == newidx2[j]){
						arcs[i].has = true;
						arcs[i].text = oldtext[j];
						break;
				}	
			}
		}
	}
	drawcurve();
	
}

function showoff()
{
	$('content').addClass("table2");
}

var comment = '';
var segcheck = false;//false=不在分词模式；true=正在分词模式
var wholesent_form = '';

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

arcs = new Array();

$(function(){
	tt = document.getElementById("content");//开始画弧相关
	
	var canvas_str = '<canvas id="cc" class="canvas" width= ' + canvasWidth + ' height=' + canvasHeight+' style="border:0px solid #ccc;" >	Your browser does not support the HTML5 canvas.</canvas>';
	document.getElementById('canvasdiv').innerHTML = canvas_str;
	var c=document.getElementById("cc");
	
	hb=c.getContext("2d");
	hb.clearRect(0,0, canvasWidth, canvasHeight);//与cover大小一致
	//初始化arcs数组，画弧的所有设置。
	for (var i=0; i<maxwords; i++)
	{
		xcoordinate[i] = i * CellWidth + ArcStartPx;
	}
	for(var j=0; j< maxwords; j++){	
		for (var i = 0; i< maxwords; i++){
			if(i == j)
				continue;
			var delt = Math.abs(xcoordinate[i]- xcoordinate[j])/CellWidth;
			var tmp;
			if (j == 0)
				tmp = new Arcs(j, i, xcoordinate[j], ycoordinate, xcoordinate[i], (xcoordinate[j]+ xcoordinate[i])/2, delt, "NO", true);
			else
				tmp = new Arcs(j, i, xcoordinate[j], ycoordinate, xcoordinate[i], (xcoordinate[j]+ xcoordinate[i])/2, delt, "NO", false);				
			
			arcs.push(tmp);
		}
	}
	//获取数据//每次只选一个句子出来！
	if ($.cookie('sent_modify') == "history")//历史记录跳转过来的
	{
			//window.alert('history cookie' + $.cookie('h_proto_sent'));
			//window.alert('history cookie' + $.cookie('h_dep_sent'));
			var sent_modify_str = $.cookie('h_proto_sent') +$.cookie('h_proto_sent2')+$.cookie('h_proto_sent3') + '%%`$$' + $.cookie('h_dep_sent') + '%%`$$' + $.cookie('h_res_sent');
			$.cookie('h_proto_sent', null);
			$.cookie('h_proto_sent2', null);
			$.cookie('h_dep_sent', null);
			$.cookie('h_res_sent', null)
			var tmp = sent_modify_str.split('%%`$$');
			global_data = sent_modify_str;
			protosent = tmp[0];
			var words = tmp[0].split(' ');//词语
			wordlen = words.length;
			tt.style.width = wordlen*CellWidth;
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
					wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
					taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
					wholesent_form += word;
				}
			}
			wordlist += '</tr>';
			taglist  += '</tr>';
			tt.innerHTML = wordlist + taglist;
			//下面开始画预标注的弧
			if (tmp[1] != "null"){
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
				$.cookie('sent_modify', null);
			}
			if (tmp.length >= 3){
				var fnum = tmp[2].indexOf('#fathers#');
								
				//window.alert(fnum + ',' + cnum);
				var tmpcomment = tmp[2];
				if(fnum != -1)	//含有fathers字符串
					tmpcomment = tmp[2].substring(0,fnum) + tmp[2].substring(fnum+9);
				var cnum = tmpcomment.indexOf('#cross#');
				var tmpcomment2 = tmpcomment;
				//window.alert(tmpcomment2);
				if(cnum != -1)
					tmpcomment2 = tmpcomment.substring(0,cnum) + tmpcomment.substring(cnum+7);	
				var arctag = tmpcomment2.indexOf("#[");
				var tmpcomment3 = tmpcomment2;
				if (arctag != -1){
					tmpcomment3 = tmpcomment2.substring(0, arctag);
				}
				document.getElementById("comment").value = tmpcomment3;
				//window.alert(tmpcomment2 + " " + arctag);
			}
			else
				document.getElementById("comment").value = '';
	}
	else{//标注新句子
	$.post(
		"get_depsent.php", 
		{},
		function (data){
            var len=data.length;
            if(len>1)
            {
                flag=data[len-1];
            	if(flag=='1')
            	{
               		window.alert('此句子是之前跳过（未标注）的句子！');
            	}
            }
            data=data.substring(0,len-1);
			global_data = data;
			var tmp = data.split('%%`$$');//0是词语表格用，1是关系，画弧用
			protosent = tmp[0];
			var words = tmp[0].split(' ');//词语
			wordlen = words.length;
			tt.style.width = wordlen*CellWidth;
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
					wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
					taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
					wholesent_form += word;
				}
			}
			wordlist += '</tr>';
			taglist  += '</tr>';
			tt.innerHTML = wordlist + taglist;
			
			//下面开始画预标注的弧
			if (tmp[1] != ''){
                //window.alert("pre_annotation=" + tmp[1]);
				words = tmp[1].split('\t');//关系
				for(var i = 0; i< words.length; i++){
					$.trim(words[i]);
					//window.alert(words[i] + "hi" + i);
					if(words[i] == '')
						continue;
					var tmp2 = words[i].split('[');
					var f = Number(tmp2[1].split(']')[0]);
					var s = Number(tmp2[2].split(']')[0]);
					//var text = words[i].split(')')[0].split('(')[1];//多个()时会出错
					var tmp3 = words[i].split(')');
					var tmp4='',tmp5=[],text="no";
					if(tmp3.length>= 2){
						tmp4 = tmp3[tmp3.length-2];
						tmp5 = tmp4.split('(');
						if (tmp5.length >=1)	{
							text = tmp5[tmp5.length-1];
						}
					}
					for(var j = 0; j<arcs.length; j++){
						if(xcoordinate[f] == arcs[j].x1 && xcoordinate[s] == arcs[j].x2){
							if (f == 0)	{
								text = "Root";
							}
							arcs[j].text = text;
							arcs[j].has = true;
							break;
						}
					}
				}
			}
			drawcurve();
			
		}
	);
	}
	

	$("#cc").click(function(e){
		showoff();
		arcs[globlechoose].choose = false;
		drawcurve();
	});

	$("#content").click(function(event) {
		td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td    
		line = td.parentElement.rowIndex;
		col = td.cellIndex;//这里是表格的第几行第几列，从0开始
		//window.alert(line + " , " + col + ":  " + xcoordinate[col]);
		
		if(line == 1 || line == 0){//在词性的那行左键
			if(fx == 0){
				tt.rows.item(0).cells.item(col).style.background="#75ef92";
				tt.rows.item(1).cells.item(col).style.background="#75ef92";
				fx = xcoordinate[col];
				fcol = col;
			}else{
				sx = xcoordinate[col];
				var arcid = -1;
				for (var i=0; i<arcs.length; i++)
				{
					if(arcs[i].x1 == fx && arcs[i].x2 == sx){
						arcs[i].has = true;
						arcid = i;
						
						/*if(checkCorss() == false){
							window.alert("依存弧出现交叉！");
							arcs[arcid].has = false;
							fx = 0;
							sx = 0;
							tt.rows.item(0).cells.item(fcol).style.background="#E1E1DF";//返回背景色
							tt.rows.item(1).cells.item(fcol).style.background="#E1E1DF";
							fcol = -1;
							break;
						}*/
						if(col == 0){
							window.alert("Root节点只能有且仅有一条出！弧！");
							arcs[arcid].has = false;
							fx = 0;
							sx = 0;
							tt.rows.item(0).cells.item(fcol).style.background="#E1E1DF";//返回背景色
							tt.rows.item(1).cells.item(fcol).style.background="#E1E1DF";
							fcol = -1;
							break;
						}
						for (var j=0; j<arcs.length; j++)
						{
							if(arcs[j].x2 == fx && arcs[j].x1 == sx){//存在一条反向弧，则在这里直接将其去掉，再画新弧。
								arcs[j].has = false;
								break;
							}
						}
						
						//系统做一些智能标注
						if (fcol == 0){
							arcs[i].text = 'Root';
						}
						var w1 = tt.rows.item(0).cells.item(fcol).innerText;
						var w2 = tt.rows.item(0).cells.item(col).innerText;
						var pos2= tt.rows.item(1).cells.item(col).innerText;
						var punctuation = /，|。|？|！|@|#|￥|%|&|\*|（|）|……|‘|’|”|“|\||；|：|《|》|、|·|~|-|\+|=|——|}|{|】|【/;
						
						if (w2.search(punctuation) != -1){
							arcs[i].text = 'mPunc';
						}	else if (w2 == '的' || w2 == '地' || w2 == '得'){
							arcs[i].text = 'mAux';
						}
						
						if (pos2 == 'P'){
							arcs[i].text = 'mPrep';
						}
						drawcurve();
						fx = 0;
						sx = 0;
						tt.rows.item(0).cells.item(fcol).style.background="#E1E1DF";//返回背景色
						tt.rows.item(1).cells.item(fcol).style.background="#E1E1DF";
						fcol = -1;
						break;
					}
				}
			}
		}
	});
	
	
	$("#cc").dblclick(function(e){//获取双击事件。
		$('content').addClass("table2");
		var x = e.pageX - $("#cc").offset().left;
		var y = e.pageY - $("#cc").offset().top;//x and y are the pixels in the canvas
		//window.alert(x+ "," + y);
		for (var i=0; i<arcs.length; i++)
		{
			if(arcs[i].has == false)
				continue;
			var tx = arcs[i].xtxt;
			var ty = arcs[i].ytxt;
			//window.alert(tx+ " | " + ty);
			if((x-13)<=tx && (y-8)<=ty && (y+8) >=ty &&(x+13)>=tx ) {
				arcs[i].has = false;	
				drawcurve();
				break;
			}
		}//delete one arc.
		
	});


	$("#save").click(function(){
		if (segcheck == true){
			window.alert('请先切换出分词修改状态，否则无法保存！');
			return;
		}
		
		var deplabels = new Array('rTdur','dTdur','Desc','rDesc','dDesc','Tdur','mNeg','Root','Agt', 'Exp', 'Aft', 'Poss', 'Pat', 'Cont', 'Prod', 'Orig', 'Datv', 'Comp', 'Belg', 'Clas', 'Accd', 'Reas', 'Int', 'Cons', 'Mann', 'Tool', 'Matl', 'Stat', 'Sini', 'Sfin', 'Sproc', 'Time', 'Tini', 'Tfin', 'TDur', 'Trang', 'Loc', 'Lini', 'Lfin', 'Lthru', 'Dir', 'Sco', 'Quan', 'Qp', 'Freq', 'Seq', 'Nvar', 'Nini', 'Nfin', 'Feat', 'Host', 'Nmod', 'Tmod', 'rAgt', 'rExp', 'rAft', 'rPoss', 'rPat', 'rCont', 'rProd', 'rOrig', 'rDatv', 'rComp', 'rBelg', 'rClas', 'rAccd', 'rReas', 'rInt', 'rCons', 'rMann', 'rTool', 'rMatl', 'rDir', 'rSco', 'rQuan', 'rQp', 'rFreq', 'rSeq', 'rFeat', 'dAgt', 'dExp', 'dAft', 'dPoss', 'dPat', 'dCont', 'dProd', 'dOrig', 'dDatv', 'dComp', 'dBelg', 'dClas', 'dAccd', 'dReas', 'dInt', 'dCons', 'dMann', 'dTool', 'dMatl', 'dDir', 'dSco', 'dQuan', 'dQp', 'dFreq', 'dSeq', 'dFeat', 'dHost', 'eCoo', 'eSelt', 'eEqu', 'ePrec', 'eSucc', 'eProg', 'eAdvt', 'eCau', 'eResu', 'eInf', 'eCond', 'eSupp', 'eConc', 'eMetd', 'ePurp', 'eAban', 'ePref', 'eSum', 'eRect', 'mConj', 'mAux', 'mPrep', 'mTone', 'mTime', 'mRang', 'mDegr', 'mQuaf', 'mFreq', 'mDir', 'mPars', 'mNeg', 'mMod', 'mPunc', 'mRept', 'mMaj', 'mVain', 'mSepa', 'rStat', 'rSini', 'rSfin', 'rSproc', 'rTini', 'rTfin', 'rTDur', 'rTrang', 'rTime', 'rLoc', 'rLini', 'rLfin', 'rLthru', 'rNvar', 'rNini', 'rNfin', 'dStat', 'dSini', 'dSfin', 'dSproc', 'dTini', 'dTfin', 'dTDur', 'dTrang', 'dTime', 'dLoc', 'dLini', 'dLfin', 'dLthru', 'dNvar', 'dNini', 'dNfin');
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
		
		var sent_forms = '';
		for(var j = 0; j< cell_len; j++){
			var w = tt.rows.item(0).cells.item(j).innerText;
			sent_forms += w;
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
						
						//检查语义标签是否在126个标签当中
						var flagt = false;
						for(var ii=0; ii<deplabels.length; ii++){
							if (text == deplabels[ii]){
								flagt = true;
							}
							
						}
						if (flagt == false){
							window.alert("语义标签出错" + text);
							return;
						}
						
						if (w1 == "")
							continue;
						if (text != ""){
							str += "[" + fs + "]" + w1 + "_[" + ss + "]" + w2 +"(" + text + ")\t"; 
							break;
						}else {
							window.alert("弧标签为空！");
							return;
						}
					}
				}
			}
		}
		
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
		comment += sent;	
		
		var grapharc = document.getElementById("graphtmp").innerHTML;
		if(grapharc != '' && comment.indexOf(grapharc) == -1){//comment不重复记录graph标记弧
			comment += document.getElementById("graphtmp").innerHTML;
		}
		
		if(existing() == false){//检查标注是否完整是否符合要求
			window.alert('标注不完整');
			return;
		}
		
		var tmpnum_fathers = 0;
		if ((comment.indexOf('#[') != -1) && (comment.indexOf(']#') != -1))
			tmpnum_fathers = comment.split("#[").length -1;
		if (father_idx.length != tmpnum_fathers){//comment和grapharc都没有记录弧信息
			//window.alert('存在多入弧节点，但是多入弧特殊标记有误！' + father_idx.length + " | " + tmpnum_fathers);
			//return ;
		}
		//window.alert('comment:' + comment);
		//window.alert(str + ' !!!! ' + newwordpos);
		
		
		var url = "write_dep.php";
		$.post(
			url, 
			{res_sent:str, psent : protosent, skip: "0", 	comment:comment, sent:newwordpos},
			function (data){
				$.cookie('sent_modify', null);
				if (data == "写入成功！")
        		window.location.reload();
			}
			);			
	});

	$('#segok').click(function(){
		if(segcheck == false){
			return;
		}
		tt.style.width = cell_len*CellWidth;
		segcheck = false;
		wordlist="<tr>";
		taglist ='<tr>';
		var cell_len = tt.rows.item(0).cells.length;  
		for (var i = 0; i < cell_len; i++){
			var w = document.getElementById('cell' + i).value;
			var postag= tt.rows.item(1).cells.item(i).innerText;
		
			wordlist += '<td width= ' + CellCont + '  >' + w + '</td>';
			taglist  += '<td width= ' + CellCont + '  >' + postag + '</td>';
		}
		wordlist += '</tr>';
		taglist  += '</tr>';
		tt.style.width = cell_len*CellWidth;
		tt.innerHTML = wordlist + taglist;
	});
	
	$('#startseg').click(function(){
		if(segcheck == true){
			return;
		}
		segcheck = true;
		wordlist="<tr>";
		taglist ='<tr>';
		var cell_len = tt.rows.item(0).cells.length;  
		for (var i = 0; i < cell_len; i++){
			var w =tt.rows.item(0).cells.item(i).innerText;
			var postag= tt.rows.item(1).cells.item(i).innerText;
			wordlist += '<td width= ' + CellCont + '  ><div><textarea id="cell' + i + '" value="' + w + '" style="width:39px;height:85px;font-size:17px">' + w + '</textarea></div></td>';
			taglist  += '<td width= ' + CellCont + '  >' + postag + '</td>';
		}
		wordlist += '</tr>';
		taglist  += '</tr>';
		tt.style.width = cell_len*CellWidth;
		tt.innerHTML = wordlist + taglist;
	});
	
	$("#skip").click(function(){
		var sent = "";
		var name = "id";
		var chkObjs = document.getElementsByName(name);
        for(var j=0; j<chkObjs.length; j++){//获取每个input有多少个radio
			var rwflag = 0;
            if(chkObjs[j].checked){
				if(chkObjs[j].value == 0){//charge result is wrong
					rwflag = 1;
				}
				if(j == 3){
					var sts = "notes"; 
					var cont = document.getElementById(sts).value;
					if(cont == ""){
						window.alert("选择其他请务必填写备注！");
						return;
					}else{
						sent = cont;
					}
				}else{
					if(j == 0){
						sent = "句子太长，无需标注";
					}else if(j == 1){
						sent = "句子无意义";
					}else if(j == 2){
						sent = "暂跳后续补";
					}else {
						var cont = document.getElementById(sts).value;
						if(cont != ""){
							sent = cont;
						}
					}
				}
				break;
            }
		}
		if(rwflag == 0){
			window.alert("请选择跳过理由！");
			return;
		}
		comment = document.getElementById("comment").value;
		comment += sent;
		/*var cross_idx = comment.indexOf('#cross#');
		var fathers_idx = comment.indexOf('#fathers#');
		if (cross_dix > -1){
			comment  = comment.substring(0, cross_dix-1).concat(comment.substring(corss_idx + 7, comment.length()-1));
		}
		if (fathers_idx > -1){
			comment  = comment.substring(0, fathers_dix-1).concat(comment.substring(corss_idx + 9, comment.length()-1));
		}*/
		
		var newwordpos = protosent;
		//window.alert(sent +" | " +protosent);
		var url = "write_dep.php";
		$.post(
			url, 
			{res_sent:sent, psent : protosent, skip: "1", comment:comment, sent:newwordpos},
			function (data){
				$.cookie('sent_modify', null);
				window.location.reload();
			}
		);
	});


	$("#restart").click(function(){
		segcheck = false;
		//获取数据//每次只选一个句子出来！
		var tmp = global_data.split('%%`$$');
		protosent = tmp[0];
		var words = tmp[0].split(' ');//词语
		wordlen = words.length;
		tt.style.width = wordlen*CellWidth;
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
					wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
					taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
				}
		}
		wordlist += '</tr>';
		taglist  += '</tr>';
		tt.innerHTML = wordlist + taglist;
			
		//下面开始画预标注的弧
		for(var j = 0; j<arcs.length; j++){
			arcs[j].has = false;
		}
		
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
				$.cookie('sent_modify', null);
		}
		if (tmp.length >= 3){
				var fnum = tmp[2].indexOf('#fathers#');
				var cnum = tmp[2].indexOf('#cross#');
				var tmpcomment = tmp[2];
				if(fnum != -1)	//含有fathers字符串
					tmpcomment = tmp[2].substring(0,fnum) + tmp[2].substring(fnum+9);
				var tmpcomment2 = tmpcomment;
				if(cnum != -1)
					tmpcomment2 = tmpcomment.substring(0,cnum) + tmpcomment.substring(cnum+7);					
				else
					document.getElementById("comment").value = tmpcomment2;
			}
		else
			document.getElementById("comment").value = '';
			
	});

	$("#logout").click(function(){
		$.cookie('user', null);
		window.location.href="loginc.php";
	});
});



var visited = new Array();
var circleflag;
var father_idx = new Array();


function checkCorss(){
	//var cell_len = tt.rows.item(0).cells.length;  
	//window.alert("cell_len:" + cell_len);
	for (var i = 0; i < arcs.length; i++){
		for(var j=0; j< arcs.length; j++){//右弧
			if (i == j)
				continue;
			if(arcs[i].has == false)
				continue;
			else if(arcs[j].has == false)
				continue;
		
			if(arcs[j].x1 < arcs[i].x2 && arcs[j].x1 > arcs[i].x1){//j.x1在i.x1和i.x2中间
				if(arcs[j].x2 < arcs[i].x1 || arcs[j].x2 > arcs[i].x2){//j.x2在i.x1另一侧或在i.x2另一侧
					//window.alert(arcs[j].x1 +"," +arcs[j].x2 +",    " + arcs[i].x1 +"," + arcs[i].x2);
					return false;
				}
			}
			else if(arcs[j].x2 < arcs[i].x2 && arcs[j].x2 > arcs[i].x1){//j.x2在i.x1和i.x2中间
				if(arcs[j].x1 < arcs[i].x1 || arcs[j].x1 > arcs[i].x2){//j.x1在i.x1另一侧或在i.x2另一侧
					window.alert(arcs[j].x1 +"," +arcs[j].x2 +",    " + arcs[i].x1 +"," + arcs[i].x2);
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



<div id = 'canvasdiv'></div>

<div id='table-content'> <table id="content" class="table" style="table-layout: fixed;word-break:break-all" cellpadding=0 cellspacing=0 border=1></table></div>

<div><panel>&nbsp;</panel><!--<button id="undo" class="undo" type="button">取消选择</button>--></div>

<p class="words2">备注:</p>
<div class="code"> 
<p>&nbsp;</p>
	<textarea id="comment" class="content2" ></textarea> 
</div>

<button id="save" type="button" class="save">保存</button>
<button id="restart" type="button" class="save">重做</button>
<button id="startseg" type="button" class="save">切换修改分词</button>
<button id="segok" type="button" class="save">分词修改完毕</button>

<p class='search-selection' id='search-selection' >
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
	
		<li class='rightMenufont'>n系列：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>n	普通名词</li>
				<li onclick='javascript:changetag(this.innerText);'>nh	人名</li>
				<li onclick='javascript:changetag(this.innerText);'>ni	机构名</li>
                <li onclick='javascript:changetag(this.innerText);'>ns	地名（例如：北京）</li>
                <li onclick='javascript:changetag(this.innerText);'>nl	地点名词（例如：城郊）</li>
                <li onclick='javascript:changetag(this.innerText);'>nd	方位名词（例如：右侧）</li>
                <li onclick='javascript:changetag(this.innerText);'>nt	时间名词</li>
                <li onclick='javascript:changetag(this.innerText);'>nz	其他专有名词</li>
			</ul>
		</li>
		
		<li class='rightMenufont'>语素类：
			<ul>
				<li onclick='javascript:changetag(this.innerText);'>g	语素（例如：甥）</li>
				<li onclick='javascript:changetag(this.innerText);'>h	前缀</li>
				<li onclick='javascript:changetag(this.innerText);'>k	后缀</li>
				<li onclick='javascript:changetag(this.innerText);'>x	非成词语素（例如：葡）</li>
			</ul>
		</li>

		<li onclick='javascript:changetag(this.innerText);'>v	动词</li>
		<li onclick='javascript:changetag(this.innerText);'>a	形容词</li>
		<li onclick='javascript:changetag(this.innerText);'>d	副词</li>
		<li onclick='javascript:changetag(this.innerText);'>m	数词</li>
		<li onclick='javascript:changetag(this.innerText);'>p	介词</li>
		<li onclick='javascript:changetag(this.innerText);'>c	连词</li>
		<li onclick='javascript:changetag(this.innerText);'>b	区别词</li>
		<li onclick='javascript:changetag(this.innerText);'>o	拟声词</li>
		<li onclick='javascript:changetag(this.innerText);'>q	量词</li>
		<li onclick='javascript:changetag(this.innerText);'>r	代词</li>
		<li onclick='javascript:changetag(this.innerText);'>u	助词</li>
		<li onclick='javascript:changetag(this.innerText);'>e	叹词</li>
		<li onclick='javascript:changetag(this.innerText);'>j	缩略词</li>
		<li onclick='javascript:changetag(this.innerText);'>i	成语俗语</li>
		<li onclick='javascript:changetag(this.innerText);'>ws	外来词</li>
		<li onclick='javascript:changetag(this.innerText);'>wp	标点符号</li>
	</ul>
</div>



<div class="rightMenu"  id="rightMenu1" style="display:none" >
    <ul>
		<li class='rightMenufont'>语义周边角色：
			<ul>
				<li >主体角色：
					<ul>
						<li onclick='javascript:change(this.innerText);'>Agt	施事</li>
						<li onclick='javascript:change(this.innerText);'>Aft	感事</li>
						<li onclick='javascript:change(this.innerText);'>Exp	当事</li>
						<li onclick='javascript:change(this.innerText);'>Poss	领事</li>
					</ul>
				</li>	
				<li >客体角色：
					<ul>
						<li onclick='javascript:change(this.innerText);'>Pat	受事</li>
						<li onclick='javascript:change(this.innerText);'>Cont	客事</li>
						<li onclick='javascript:change(this.innerText);'>Prod	成事</li>
						<li onclick='javascript:change(this.innerText);'>Cons	结局</li>
						<li onclick='javascript:change(this.innerText);'>Datv	涉事</li>
						<li onclick='javascript:change(this.innerText);'>Orig	源事</li>
						<li onclick='javascript:change(this.innerText);'>Comp	比较</li>
						<li onclick='javascript:change(this.innerText);'>Clas	类事</li>
						<li onclick='javascript:change(this.innerText);'>Belg	属事</li>
					</ul>
				</li>
				<li >情境角色1：
					<ul>
						<li onclick='javascript:change(this.innerText);'>Mann	方式</li>
						<li onclick='javascript:change(this.innerText);'>Accd	依据</li>
						<li onclick='javascript:change(this.innerText);'>Reas	缘故</li>
						<li onclick='javascript:change(this.innerText);'>Int	意图</li>
						<li onclick='javascript:change(this.innerText);'>Mann	方式</li>
						<li onclick='javascript:change(this.innerText);'>Tool	工具</li>
						<li onclick='javascript:change(this.innerText);'>Matl	材料</li>
						<li onclick='javascript:change(this.innerText);'>Sco	范围</li>
					</ul>
				</li>
				<li >情境角色2：
					<ul>
						<li onclick='javascript:change(this.innerText);'>Time	时间</li>
						<li onclick='javascript:change(this.innerText);'>Tini	时间起点</li>
						<li onclick='javascript:change(this.innerText);'>Tfin	时间终点</li>
						<li onclick='javascript:change(this.innerText);'>Tdur	时段</li>
						<li onclick='javascript:change(this.innerText);'>Trang	时距</li>
						<li onclick='javascript:change(this.innerText);'>Loc	空间</li>
						<li onclick='javascript:change(this.innerText);'>Lini	原处所</li>
						<li onclick='javascript:change(this.innerText);'>Lfin	终处所</li>
						<li onclick='javascript:change(this.innerText);'>Lthru	通过处所</li>
						<li onclick='javascript:change(this.innerText);'>Dir	趋向</li>
					</ul>
				</li>
				<li >情境角色3：
					<ul>
						<li onclick='javascript:change(this.innerText);'>Quan	数量</li>
						<li onclick='javascript:change(this.innerText);'>Qp	数量短语</li>
						<li onclick='javascript:change(this.innerText);'>Nini	起始量</li>
						<li onclick='javascript:change(this.innerText);'>Nfin	终止量</li>
						<li onclick='javascript:change(this.innerText);'>Freq	频率</li>
						<li onclick='javascript:change(this.innerText);'>Seq	顺序</li>
						<li onclick='javascript:change(this.innerText);'>Nvar	变化量</li>
						<li onclick='javascript:change(this.innerText);'>Desc	描写</li>
						<li onclick='javascript:change(this.innerText);'>Host	宿主</li>
						<li onclick='javascript:change(this.innerText);'>Nmod	名称修饰语</li>
						<li onclick='javascript:change(this.innerText);'>Tmod	时间修饰语</li>
						<li onclick='javascript:change(this.innerText);'>Stat	状态</li>
						<li onclick='javascript:change(this.innerText);'>Sini	起始状态</li>
						<li onclick='javascript:change(this.innerText);'>Sfin	终止状态</li>
						<li onclick='javascript:change(this.innerText);'>Sproc	历经状态</li>
					</ul>	
				</li>	
			</ul>
		</li>
		<li class='rightMenufont'>语义结构关系：
			<ul>
				<li >反关系1：
					<ul>
						<li onclick='javascript:change(this.innerText);'>rAgt	反施事</li>
						<li onclick='javascript:change(this.innerText);'>rAft	反感事</li>
						<li onclick='javascript:change(this.innerText);'>rExp	反当事</li>
						<li onclick='javascript:change(this.innerText);'>rPoss	反领事</li>
						<li onclick='javascript:change(this.innerText);'>rPat	反受事</li>
						<li onclick='javascript:change(this.innerText);'>rCont	反客事</li>
						<li onclick='javascript:change(this.innerText);'>rProd	反成事</li>
						<li onclick='javascript:change(this.innerText);'>rCons	反结局</li>
						<li onclick='javascript:change(this.innerText);'>rDatv	反涉事</li>
						<li onclick='javascript:change(this.innerText);'>rOrig	反源事</li>
						<li onclick='javascript:change(this.innerText);'>rComp	反比较</li>
						<li onclick='javascript:change(this.innerText);'>rClas	反类事</li>
						<li onclick='javascript:change(this.innerText);'>rBelg	反属事</li>
					</ul>
				</li>
				<li>反关系2：
					<ul>
						<li onclick='javascript:change(this.innerText);'>rMann	反方式</li>
						<li onclick='javascript:change(this.innerText);'>rAccd	反依据</li>
						<li onclick='javascript:change(this.innerText);'>rReas	反缘故</li>
						<li onclick='javascript:change(this.innerText);'>rInt	反意图</li>
						<li onclick='javascript:change(this.innerText);'>rMann	反方式</li>
						<li onclick='javascript:change(this.innerText);'>rTool	反工具</li>
						<li onclick='javascript:change(this.innerText);'>rMatl	反材料</li>
						<li onclick='javascript:change(this.innerText);'>rSco	反范围</li>
					</ul>
				</li>
				<li>反关系3：
					<ul>
						<li onclick='javascript:change(this.innerText);'>rTime	反时间</li>
						<li onclick='javascript:change(this.innerText);'>rTini	反时间起点</li>
						<li onclick='javascript:change(this.innerText);'>rTfin	反时间终点</li>
						<li onclick='javascript:change(this.innerText);'>rTdur	反时段</li>
						<li onclick='javascript:change(this.innerText);'>rTrang	反时距</li>
						<li onclick='javascript:change(this.innerText);'>rLoc	反空间</li>
						<li onclick='javascript:change(this.innerText);'>rLini	反原处所</li>
						<li onclick='javascript:change(this.innerText);'>rLfin	反终处所</li>
						<li onclick='javascript:change(this.innerText);'>rLthru	反通过处所</li>
						<li onclick='javascript:change(this.innerText);'>rDir	反趋向</li>
					</ul>
				</li>
				<li>反关系4：
					<ul>
						<li onclick='javascript:change(this.innerText);'>rQuan	反数量</li>
						<li onclick='javascript:change(this.innerText);'>rQp	反数量短语</li>
						<li onclick='javascript:change(this.innerText);'>rNini	反起始量</li>
						<li onclick='javascript:change(this.innerText);'>rNfin	反终止量</li>
						<li onclick='javascript:change(this.innerText);'>rFreq	反频率</li>
						<li onclick='javascript:change(this.innerText);'>rSeq	反顺序</li>
						<li onclick='javascript:change(this.innerText);'>rNvar	反变化量</li>
						<li onclick='javascript:change(this.innerText);'>rDesc	反描写</li>
						<li onclick='javascript:change(this.innerText);'>rHost	反宿主</li>
						<li onclick='javascript:change(this.innerText);'>rNmod	反名称修饰语</li>
						<li onclick='javascript:change(this.innerText);'>rTmod	反时间修饰语</li>
						<li onclick='javascript:change(this.innerText);'>rStat	反状态</li>
						<li onclick='javascript:change(this.innerText);'>rSini	反起始状态</li>
						<li onclick='javascript:change(this.innerText);'>rSfin	反终止状态</li>
						<li onclick='javascript:change(this.innerText);'>rSproc	反历经状态</li>
					</ul>
				</li>		
				<li >嵌套事件关系1：
					<ul>
						<li onclick='javascript:change(this.innerText);'>dAgt	嵌套施事</li>
						<li onclick='javascript:change(this.innerText);'>dAft	嵌套感事</li>
						<li onclick='javascript:change(this.innerText);'>dExp	嵌套当事</li>
						<li onclick='javascript:change(this.innerText);'>dPoss	嵌套领事</li>
						<li onclick='javascript:change(this.innerText);'>dPat	嵌套受事</li>
						<li onclick='javascript:change(this.innerText);'>dCont	嵌套客事</li>
						<li onclick='javascript:change(this.innerText);'>dProd	嵌套成事</li>
						<li onclick='javascript:change(this.innerText);'>dCons	嵌套结局</li>
						<li onclick='javascript:change(this.innerText);'>dDatv	嵌套涉事</li>
						<li onclick='javascript:change(this.innerText);'>dOrig	嵌套源事</li>
						<li onclick='javascript:change(this.innerText);'>dComp	嵌套比较</li>
						<li onclick='javascript:change(this.innerText);'>dClas	嵌套类事</li>
						<li onclick='javascript:change(this.innerText);'>dBelg	嵌套属事</li>
					</ul>
				</li>
				<li >嵌套事件关系2：
					<ul>
						<li onclick='javascript:change(this.innerText);'>dMann	嵌套方式</li>
						<li onclick='javascript:change(this.innerText);'>dAccd	嵌套依据</li>
						<li onclick='javascript:change(this.innerText);'>dReas	嵌套缘故</li>
						<li onclick='javascript:change(this.innerText);'>dInt	嵌套意图</li>
						<li onclick='javascript:change(this.innerText);'>dMann	嵌套方式</li>
						<li onclick='javascript:change(this.innerText);'>dTool	嵌套工具</li>
						<li onclick='javascript:change(this.innerText);'>dMatl	嵌套材料</li>
						<li onclick='javascript:change(this.innerText);'>dSco	嵌套范围</li>
					</ul>
				</li>
				<li >嵌套事件关系3：
					<ul>
						<li onclick='javascript:change(this.innerText);'>dTime	嵌套时间</li>
						<li onclick='javascript:change(this.innerText);'>dTini	嵌套时间起点</li>
						<li onclick='javascript:change(this.innerText);'>dTfin	嵌套时间终点</li>
						<li onclick='javascript:change(this.innerText);'>dTdur	嵌套时段</li>
						<li onclick='javascript:change(this.innerText);'>dTrang	嵌套时距</li>
						<li onclick='javascript:change(this.innerText);'>dLoc	嵌套空间</li>
						<li onclick='javascript:change(this.innerText);'>dLini	嵌套原处所</li>
						<li onclick='javascript:change(this.innerText);'>dLfin	嵌套终处所</li>
						<li onclick='javascript:change(this.innerText);'>dLthru	嵌套通过处所</li>
						<li onclick='javascript:change(this.innerText);'>dDir	嵌套趋向</li>
					</ul>
				</li>
				<li >嵌套事件关系4：
					<ul>
						<li onclick='javascript:change(this.innerText);'>dQuan	嵌套数量</li>
						<li onclick='javascript:change(this.innerText);'>dQp	嵌套数量短语</li>
						<li onclick='javascript:change(this.innerText);'>dNini	嵌套起始量</li>
						<li onclick='javascript:change(this.innerText);'>dNfin	嵌套终止量</li>
						<li onclick='javascript:change(this.innerText);'>dFreq	嵌套频率</li>
						<li onclick='javascript:change(this.innerText);'>dSeq	嵌套顺序</li>
						<li onclick='javascript:change(this.innerText);'>dNvar	嵌套变化量</li>
						<li onclick='javascript:change(this.innerText);'>dDesc	嵌套描写</li>
						<li onclick='javascript:change(this.innerText);'>dHost	嵌套宿主</li>
						<li onclick='javascript:change(this.innerText);'>dNmod	嵌套名称修饰语</li>
						<li onclick='javascript:change(this.innerText);'>dTmod	嵌套时间修饰语</li>
						<li onclick='javascript:change(this.innerText);'>dStat	嵌套状态</li>
						<li onclick='javascript:change(this.innerText);'>dSini	嵌套起始状态</li>
						<li onclick='javascript:change(this.innerText);'>dSfin	嵌套终止状态</li>
						<li onclick='javascript:change(this.innerText);'>dSproc	嵌套历经状态</li>
					</ul>
				</li>
        		<li >事件关系1：
					<ul>
						<li onclick='javascript:change(this.innerText);'>eCoo	并列</li>
						<li onclick='javascript:change(this.innerText);'>eEqu	等同</li>
						<li onclick='javascript:change(this.innerText);'>eRect	分叙</li>
						<li onclick='javascript:change(this.innerText);'>eSelt	选择</li>
						<li onclick='javascript:change(this.innerText);'>eAban	割舍</li>
						<li onclick='javascript:change(this.innerText);'>ePref	选取</li>
					</ul>
        		</li>
				<li >事件关系2：
					<ul>
						<li onclick='javascript:change(this.innerText);'>ePrec	先行</li>
						<li onclick='javascript:change(this.innerText);'>eCau	原因</li>
						<li onclick='javascript:change(this.innerText);'>eCond	条件</li>
						<li onclick='javascript:change(this.innerText);'>eSupp	假设</li>
						<li onclick='javascript:change(this.innerText);'>eMetd	手段</li>
						<li onclick='javascript:change(this.innerText);'>eConc	让步</li>
					</ul>
				</li>
        		<li>事件关系3：
        			<ul>
						<li onclick='javascript:change(this.innerText);'>eSucc	后继</li>
						<li onclick='javascript:change(this.innerText);'>eProg	递进</li>
						<li onclick='javascript:change(this.innerText);'>ePurp	目的</li>
						<li onclick='javascript:change(this.innerText);'>eResu	结果</li>
						<li onclick='javascript:change(this.innerText);'>eInf	推论</li>
						<li onclick='javascript:change(this.innerText);'>eSum	总括</li>
						<li onclick='javascript:change(this.innerText);'>eAdvt	转折</li>
					</ul>
				</li>
			</ul>
		</li>	
		<li class='rightMenufont'>语义依附标记：
			<ul>
				<li >标点标记：
					<ul>
						<li onclick='javascript:change(this.innerText);'>mPunc	标点标记</li>
					</ul>
				</li>
				<li >依附标记1：
					<ul>
						<li onclick='javascript:change(this.innerText);'>mNeg	否定标记</li>
						<li onclick='javascript:change(this.innerText);'>mConj	连词标记</li>
						<li onclick='javascript:change(this.innerText);'>mPrep	介词标记</li>
						<li onclick='javascript:change(this.innerText);'>mAux	的字标记</li>
						<li onclick='javascript:change(this.innerText);'>mTone	语气标记</li>
						<li onclick='javascript:change(this.innerText);'>mTime	时间标记</li>
						<li onclick='javascript:change(this.innerText);'>mRang	范围标记</li>
						<li onclick='javascript:change(this.innerText);'>mMod	情态标记</li>
					</ul>
        		</li>
        		<li >依附标记2：
					<ul>
						<li onclick='javascript:change(this.innerText);'>mFreq	频率标记</li>
						<li onclick='javascript:change(this.innerText);'>mDegr	程度标记</li>
						<li onclick='javascript:change(this.innerText);'>mDir	趋向标记</li>
						<li onclick='javascript:change(this.innerText);'>mMaj	多数标记</li>
						<li onclick='javascript:change(this.innerText);'>mPars	插入语标记</li>
						<li onclick='javascript:change(this.innerText);'>mSepa	离合标记</li>
						<li onclick='javascript:change(this.innerText);'>mVain	实词虚化标记</li>
						<li onclick='javascript:change(this.innerText);'>mRept	重复标记</li>
					</ul>
        		</li>	
			</ul>
		</li>
		
		<li onclick='javascript:change(this.innerText);'>Root	root</li>
		<li onclick='javascript:signgraph(this.innerText);'>graph	树之外的弧</li>
		<li onclick='javascript:signgraph(this.innerText);'>delgraph	删除标记</li>
	</ul>
</div>
<p id='graphtmp'></p>


</body>
</html>