<?php
	require("config2.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="js/jquery-1.7.2.min.js" type="text/JavaScript"></script>
<script src="js/jquery.cookie.js" type="text/JavaScript"></script>
<script src="/js/ArcsDesign.js" type="text/javascript"></script>

<link href="css/history.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>semanticannotate
<?php 
if (isset($_COOKIE["user"])){//如果有cookie，则将user入session
	;
}else{
	$url = "index.php"; 
	echo "<script language='javascript' type='text/javascript'>";
	echo "window.location.href='$url'";
	echo "</script>"; //如果没有定义$_COOKIE["user"]就跳转到登录首页
}
?></title>
<style type="text/css">

</style>

<script language="JavaScript" type="text/javascript">
var bgc="#E1E1DF",txc="black";//菜单没有选中的背景色和文字色
var cbgc="darkgray",ctxc="white";//菜单选中的选项背景色和文字色
var tt;

var ph = 50;
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';"
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';"

var Str2 = [], Str3 = [];

document.oncontextmenu=function()//鼠标右键
{ 
	var td = event.srcElement; // 通过event.srcElement 获取激活事件的对象 td    
	line = td.parentElement.rowIndex;
	col = td.cellIndex;//这里是表格的第几行第几列，从0开始
	var txt = td.innerText;
	
}

var page = 1;
var recordlen = 0;
var listnum = 1;

arcs = new Array();
var tt;
var tablenum = 0;

var bgc="#E1E1DF",txc="black";//菜单没有选中的背景色和文字色
var cbgc="darkgray",ctxc="white";//菜单选中的选项背景色和文字色
var mover="this.style.background='"+cbgc+"';this.style.color='"+ctxc+"';";
var mout="this.style.background='"+bgc+"';this.style.color='"+txc+"';";
var jflag = new Array();
var fullitems = '';

$(function(){
	$("#lastpageup").hide();
	$("#nextpagedown").hide();//每次都先隐藏上下页
	$("#lastpagedown").hide();
	$("#nextpageup").hide();
	for(var j = 0; j< recordlen; j+= 4){
		jflag[j] = 0;
	}
	
	var url = "get_history_dep.php";
	$.post(
		url, //获取历史记录
		{},
		function (data){
			fullitems = data;
			//window.alert(data);//原句%%`$$句子%%`$$时间%%`$$评论%%`$$原句%%`$$句子%%`$$时间%%`$$评论
			Str2 = data.split("%%`$$");
			recordlen = Str2.length-1;//数组的结尾有一个空值
			listnum = 1;
			tablenum = recordlen/4;

			var shownums = 0;
			
			if(tablenum >pageline){
				$("#lastpageup").show();
				$("#nextpagedown").show();//每次都先隐藏上下页
				$("#lastpagedown").show();
				$("#nextpageup").show();
				shownums = pageline*4;
			}else{
				shownums = tablenum*4;
			}

			document.getElementById('total').innerHTML = "共<b> " + (recordlen/4) + " </b>条记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;左键可以修改句子！可以使用浏览器查找(Ctrl+F)功能哦";
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
			
			for(var j = 0; j< shownums; j+= 4){//显示
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
						wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
						taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
						skipsent += word;
						numtmp += 1;
					}
				}
				maxwords = numtmp;
				sentlen[j] = maxwords;
				var height=0;
				if(maxwords <=6){
					height = 155;
				}else if(maxwords > 6){
					height = 14 * maxwords + 34;
				}
				heightlist[j] = height-5;
				wordlist += '</tr>';
				taglist  += '</tr>';
				var arcnum = res_sent_1.split('\t');//关系
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*CellWidth + canvasStartPxinTabal)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){//contain arcs.
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(CellWidth * maxwords)+"' height='"+height+"' style='border:0px solid #666;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
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

			listnum = 1;
			for(var j = 0; j< shownums; j += 4){//开始画弧
				if(jflag[j] == 1){
					listnum += 1;
					continue;
				}
				var res_sent = Str2[j+1];
				sent = res_sent.split('\t');//关系
				
				maxwords = sentlen[j];
				ycoordinate = heightlist[j];
				//window.alert(maxwords+":" + ycoordinate);
				
				for (var i=0; i<maxwords; i++)
				{
					xcoordinate[i] = i * CellWidth + ArcStartPx;
				}
				arcs.splice(0,arcs.length);//删除从0开始的length长的元素
				for(var k=0; k< maxwords; k++){	
					for (var i = 0; i< maxwords; i++){
						if(i == k)
							continue;
						var delt = Math.abs(xcoordinate[i]- xcoordinate[k])/CellWidth;
						if (k == 0)
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", true);
						else
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", false);				
						arcs.push(tmp);
					}
				}
				//window.alert("arclength:" + arcs.length);

				for (var i=0; i<arcs.length; i++)
				{
					arcs[i].has = false;
				}	
				var c=document.getElementById("cc" + listnum);
				hb=c.getContext("2d");
				//window.alert(res_sent + " : " + sent.length + "maxwords:" + maxwords);
				var tmps = 0;
				for(var i = 0; i< sent.length; i++){
					if(sent[i] == '')
						continue;
					var tmp2 = sent[i].split('[');
					var f = Number(tmp2[1].split(']')[0]);
					var s = Number(tmp2[2].split(']')[0]);
					//window.alert("f:" + f + " " + "s:" + s+"|" + xcoordinate[f] +" , " + xcoordinate[s]);
					var tmp3 = sent[i].split(')');
					var tmp4 = tmp3[tmp3.length-2];
					var tmp5 = tmp4.split('(');
					var text = tmp5[tmp5.length-1];
					for(var k = 0; k<arcs.length; k++){
						//window.alert(arcs[k].x1 + " () " + arcs[k].x2);
						if(xcoordinate[f] == arcs[k].x1 && xcoordinate[s] == arcs[k].x2){
							arcs[k].text = text;
							arcs[k].has = true;
							tmps += 1;
							break;
						}
					}
				}
				drawcurve("cc" + listnum, CellWidth * maxwords, height);
				listnum += 1;
			}
			document.getElementById("content") = tmps;
			tt = document.getElementById("content");
		});
});


$(function(){
	$("span").click(function(){//点击上下页
		var c_id = $(this).attr("id");//获取属性
		var total = 0;
		var begin = 0;
		var tmp1 = document.getElementById("pagenum2").innerHTML;//$("#pagenum").text;
		var tmp = parseInt(tmp1);
		
		if(c_id =="lastpageup" || c_id =="lastpagedown"){
			if(tmp == 1){
				window.alert("已是第一页！");
				return;
			}
			window.alert("上一页，加载需要3s，请稍等！");
			document.getElementById("pagenum2").innerHTML = tmp - 1;
			begin = pageline*(tmp - 2)*4;
			total = pageline*4;
			listnum = pageline*(tmp-2)+1;

			document.getElementById('table').innerHTML = "";

			var sentlen = new Array();
			var heightlist = new Array();
			
			//window.alert("begin" + begin + " " + (begin+total));
			for(var j = begin; j<(begin + total) ; j+= 4){//显示
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
						wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
						taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
						skipsent += word;
						numtmp += 1;
					}
				}
				maxwords = numtmp;
				sentlen[j] = maxwords;
				var height=0;
				if(maxwords <=6){
					height = 95;
				}else if(maxwords > 6){
					height = 12 * maxwords + 34;
				}
				heightlist[j] = height-5;
				wordlist += '</tr>';
				taglist  += '</tr>';
				var arcnum = res_sent_1.split('\t');//关系
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*CellWidth + canvasStartPxinTabal)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(CellWidth * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
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

			
			listnum = pageline*(tmp-2)+1;
			for(var j = begin; j<(begin + total) ; j+= 4){//开始画弧
				if(jflag[j] == 1){
					listnum += 1;
					continue;
				}
				var res_sent = Str2[j+1];
				sent = res_sent.split('\t');//关系
				
				maxwords = sentlen[j];
				ycoordinate = heightlist[j];
				for (var i=0; i<maxwords; i++)
				{
					xcoordinate[i] = i * CellWidth + ArcStartPx;
				}
				//window.alert(maxwords+":" + ycoordinate);
				arcs.splice(0,arcs.length);//删除从0开始的length长的元素
				for(var k=0; k< maxwords; k++){	
					for (var i = 0; i< maxwords; i++){
						if(i == k)
							continue;
						var delt = Math.abs(xcoordinate[i]- xcoordinate[k])/CellWidth;
						if (k == 0)
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", true);
						else
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", false);				
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
				drawcurve("cc" + listnum, CellWidth * maxwords, height);
				listnum += 1;
			}
			document.getElementById("content") = tmps;
			tt = document.getElementById("content");
		}
		else if(c_id =="nextpageup" || c_id =="nextpagedown"){
			if((pageline * tmp)*4 >= recordlen) {
				window.alert("已是最后一页！");
				return;//已经是最后一页
			}
			window.alert("下一页，加载需要3s，请稍等！");
			document.getElementById("pagenum2").innerHTML = tmp + 1;
			if((recordlen - tmp*pageline*4) > pageline*4)
				total = pageline*4;
			else {
				total = (recordlen - tmp*pageline*4);
			}
			begin = tmp*pageline*4;

			listnum = tmp*pageline+1;
			
			
			document.getElementById('table').innerHTML = "";

			//window.alert(recordlen + "begin" + begin + " " + (total+begin));
			var sentlen = new Array();
			var heightlist = new Array();
			
			for(var j = begin; j<(begin + total) ; j+= 4){//显示
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
						wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
						taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
						skipsent += word;
						numtmp += 1;
					}
				}
				maxwords = numtmp;
				sentlen[j] = maxwords;
				var height=0;
				if(maxwords <=6){
					height = 95;
				}else if(maxwords > 6){
					height = 12 * maxwords + 34;
				}
				heightlist[j] = height-5;
				wordlist += '</tr>';
				taglist  += '</tr>';
				var arcnum = res_sent_1.split('\t');//关系
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*CellWidth + canvasStartPxinTabal)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(CellWidth * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
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

			listnum = tmp*pageline+1;
			for(var j = begin; j<(begin + total) ; j+= 4){//显示
				if(jflag[j] == 1){
					listnum += 1;
					continue;
				}
				var res_sent = Str2[j+1];
				sent = res_sent.split('\t');//关系
				
				maxwords = sentlen[j];
				ycoordinate = heightlist[j];
				
				for (var i=0; i<maxwords; i++)
				{
					xcoordinate[i] = i * CellWidth + ArcStartPx;
				}
				//window.alert(maxwords+":" + ycoordinate);
				arcs.splice(0,arcs.length);//删除从0开始的length长的元素
				for(var k=0; k< maxwords; k++){	
					for (var i = 0; i< maxwords; i++){
						if(i == k)
							continue;
						var delt = Math.abs(xcoordinate[i]- xcoordinate[k])/CellWidth;
						if (k == 0)
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", true);
						else
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", false);				
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
				drawcurve("cc" + listnum, CellWidth * maxwords, height);
				listnum += 1;
			}
			document.getElementById("content") = tmps;
			tt = document.getElementById("content");
		}
		//window.alert(begin + "," + total);
    });
});


function change(num){
	var url = "get_history_dep2.php";
    //window.alert(num+Str2[num]);
	$.post( //get pre-annotate for arcs , for that have been skipped.
		url, 
		{sent:Str2[num]},
		function (data){
            //window.alert(Str2[num+1]);
			var tmp_res = Str2[num+1].split('\t');
			var dep_sent = '';
			if (tmp_res.length >3) {
				for(var i=0; i<tmp_res.length; i++)
				{
					var tmp2 = tmp_res[i].split('[');
					var f = tmp2[1].split(']')[0];
					var s = tmp2[2].split(']')[0];
					var rel = tmp_res[i].split('(')[1];
					dep_sent += '[' + f + ']_[' + s + '](' + rel + '\t';
				}
			}
			dep_sent = $.trim(dep_sent);
			if(jflag[num] == 1){ // no arcs, equals to skip = 1.	
				dep_sent = data;
			}
			var str = Str2[num] + "%%`$$" + dep_sent + "%%`$$" + Str2[num + 3];
			$.cookie("sent_modify", "history");
			//$.cookie("h_proto_sent", Str2[num]);
			$.cookie("h_proto_sent", Str2[num].substring(0, Str2[num].length/3));
			$.cookie("h_proto_sent2", Str2[num].substring(Str2[num].length/3, 2* Str2[num].length/3));
			$.cookie("h_proto_sent3", Str2[num].substring(2*Str2[num].length/3, Str2[num].length))

			$.cookie("h_dep_sent", dep_sent);  // res_sent
			$.cookie("h_res_sent", Str2[num+3]); // comment
			//window.alert("cookie"+$.cookie('h_proto_sent'));
			//window.alert("cookie"+$.cookie('h_proto_sent3'));
			//window.alert("str=" + str);
			//window.location.href="label_dep.php";
			window.open("label_dep.php");
		}
	);
}

function changePageLine(){
	var obj=document.getElementById('p-item-num');
	var index=obj.selectedIndex; //序号，取当前选中选项的序号
	pageline = obj.options[index].value;
	
	window.alert(pageline);
	
		var data = fullitems;
		Str2 = data.split("%%`$$");
			recordlen = Str2.length-1;//数组的结尾有一个空值
			listnum = 1;
			tablenum = recordlen/4;

			var shownums = 0;
			
			if(tablenum >pageline){
				$("#lastpageup").show();
				$("#nextpagedown").show();//每次都先隐藏上下页
				$("#lastpagedown").show();
				$("#nextpageup").show();
				shownums = pageline*4;
			}else{
				shownums = tablenum*4;
			}

			document.getElementById('total').innerHTML = "共<b> " + (recordlen/4) + " </b>条记录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;左键可以修改句子！可以使用浏览器查找(Ctrl+F)功能哦";
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

			document.getElementById('table').innerHTML = "";
			var sentlen = new Array();
			var heightlist = new Array();
			
			for(var j = 0; j< shownums; j+= 4){//显示
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
						wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
						taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
						skipsent += word;
						numtmp += 1;
					}
				}
				maxwords = numtmp;
				sentlen[j] = maxwords;
				var height=0;
				if(maxwords <=6){
					height = 95;
				}else if(maxwords > 6){
					height = 12 * maxwords + 34;
				}
				heightlist[j] = height-5;
				wordlist += '</tr>';
				taglist  += '</tr>';
				var arcnum = res_sent_1.split('\t');//关系
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*CellWidth + canvasStartPxinTabal)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){//contain arcs.
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(CellWidth * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
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

			listnum = 1;//
			for(var j = 0; j< shownums; j += 4){//开始画弧
				if(jflag[j] == 1){
					listnum += 1;
					continue;
				}
				var res_sent = Str2[j+1];
				sent = res_sent.split('\t');//关系
				
				maxwords = sentlen[j];
				ycoordinate = heightlist[j];
				
				for (var i=0; i<maxwords; i++)
				{
					xcoordinate[i] = i * CellWidth + ArcStartPx;
				}
				//window.alert(maxwords+":" + ycoordinate);
				arcs.splice(0,arcs.length);//删除从0开始的length长的元素
				for(var k=0; k< maxwords; k++){	
					for (var i = 0; i< maxwords; i++){
						if(i == k)
							continue;
						var delt = Math.abs(xcoordinate[i]- xcoordinate[k])/CellWidth;
						if (k == 0)
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", true);
						else
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", false);				
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
				drawcurve("cc" + listnum, CellWidth * maxwords, height);
				listnum += 1;
			}
			document.getElementById("content") = '';
			document.getElementById("content") = tmps;
			tt = document.getElementById("content");
}
   
$(function(){
	$("#exit").click(function(){
		$.cookie('user', null);
		window.alert("exit");
		//window.location.href="loginc.php";
	});
	
	$("#search").click(function(){
		/*$("#lastpageup").hide();
		$("#nextpagedown").hide();//每次都先隐藏上下页
		$("#lastpagedown").hide();
		$("#nextpageup").hide();*/
		
		var obj=document.getElementById('stime');
		var index=obj.selectedIndex; //序号，取当前选中选项的序号
		var pageidx = obj.options[index].value;
		
		//window.alert(pageidx);
		
		var total = 0;
		var begin = 0;
		
		document.getElementById("pagenum2").innerHTML = pageidx;
		if((recordlen - (pageidx-1)*pageline*4) > pageline*4)
			total = pageline*4;
		else {
			total = (recordlen - (pageidx-1)*pageline*4);
		}
		begin = (pageidx-1)*pageline*4;
		listnum = (pageidx-1)*pageline+1;
		document.getElementById('table').innerHTML = "";

		var sentlen = new Array();
		var heightlist = new Array();
			
		//window.alert("begin" + begin + " " + (begin+total));
		for(var j = begin; j<(begin + total) ; j+= 4){//显示
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
						wordlist += '<td width= ' + CellCont + '  >' + word + '</td>';
						taglist  += '<td width= ' + CellCont + '  >' + tag + '</td>';
						skipsent += word;
						numtmp += 1;
					}
				}
				maxwords = numtmp;
				sentlen[j] = maxwords;
				var height=0;
				if(maxwords <=6){
					height = 95;
				}else if(maxwords > 6){
					height = 12 * maxwords + 34;
				}
				heightlist[j] = height-5;
				wordlist += '</tr>';
				taglist  += '</tr>';
				var arcnum = res_sent_1.split('\t');//关系
				
				var table = "<table id='content"+listnum+"' class='words' width='"+(maxwords*CellWidth + canvasStartPxinTabal)+"' style='table-layout: fixed;word-break:break-all' cellpadding=0 cellspacing=0 border=1 onMouseover=\""+mover+"\" onMouseout=\""+mout+"\" onclick=change("+ j +");>";

				if(arcnum.length >=2){
					var canv ="<tr><th width = 50 rowspan='3'>"+ listnum+ "</th><td width = 50 rowspan='3'>"+ comment +"</td><td rowspan='3' width=90>"+ res_time+ "</td><td colspan='"+ maxwords +"'><canvas id='cc" + listnum +"' class='canvas' width='"+(CellWidth * maxwords)+"' height='"+height+"' style='border:0px solid #888;' > Your browser dosen't support the HTML5 canvas.</canvas></td></tr>";
					
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

		
		listnum = (pageidx-1)*pageline+1;
		for(var j = begin; j<(begin + total) ; j+= 4){//开始画弧
				if(jflag[j] == 1){
					listnum += 1;
					continue;
				}
				var res_sent = Str2[j+1];
				sent = res_sent.split('\t');//关系
				
				maxwords = sentlen[j];
				ycoordinate = heightlist[j];
				for (var i=0; i<maxwords; i++){
					xcoordinate[i] = i * CellWidth + ArcStartPx;
				}
				//window.alert(maxwords+":" + ycoordinate);
				arcs.splice(0,arcs.length);//删除从0开始的length长的元素
				for(var k=0; k< maxwords; k++){	
					for (var i = 0; i< maxwords; i++){
						if(i == k)
							continue;
						var delt = Math.abs(xcoordinate[i]- xcoordinate[k])/CellWidth;
						if (k == 0)
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", true);
						else
							tmp = new Arcs(k, i, xcoordinate[k], ycoordinate, xcoordinate[i], (xcoordinate[k]+ xcoordinate[k])/2, delt, "NO", false);				
						arcs.push(tmp);
					}
				}
				for (var i=0; i<arcs.length; i++)
				{
					arcs[i].has = false;
				}
				var c=document.getElementById("cc" + listnum);
				hb=c.getContext("2d");
				
				var arcnum = "";
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
							arcnum += 1;
							break;
						}
					}
				}
				//window.alert(arcnum);
				drawcurve("cc" + listnum, CellWidth * maxwords, height);
				listnum += 1;
		}
		document.getElementById("content") = tmps;
		tt = document.getElementById("content");
	});
});


function drawcurve(canvas_num, width, height){
	hb.lineWidth = 1;//控制线的宽度
	hb.clearRect(0,0, width, height);

	for (var i=0; i<arcs.length; i++)
	{
		if(arcs[i].has == true){//有这条线就画出来
			//window.alert(i + "," + arcs[i].x1 + " " + arcs[i].x2);
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
					<option id = 'pnum1000' value='500'>500</option>
				</select>
				<input type="button" id="pnum-select" value="选择" class="submit-search">
			</div>
			
			<div class="changepage">
				<span id="total" ></span>&nbsp;&nbsp;<span id="lastpageup" class="changepage2">上一页</span>&nbsp;&nbsp;<span id="nextpageup" class="changepage2">下一页</span>&nbsp;&nbsp;<span id="pagenum1"></span>&nbsp;<span id="pagenum2"></span></span><span id="pagenum4"></span><span id="pagenum5"></span><span id="pagenum3">
				<label class="search">
					<select name="stime" id="stime2">
						
				   </select>
					<input type="button" id="search2" value="搜索" class="submit-search">
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
				<input type="button" id="search" value="搜索" class="submit-search" >
			</label>
		</div>
		
	</div>	 

</div>

</body>
</html>