//切记：每次旋转或者平移了原点之后都要保持回到原位，否则后面会很麻烦==！
function drawcurve(){
	/*for(var i = 0; i< wordlen; i++){
			pixel[i] = new Array();
			for (var j=0; j< wordlen; j++)
			{
				pixel[i][j] = 0;
			}
	}
	for(var i = 0; i<arcs.length; i++){//在这里将弧与词语中table的cell的下标对应上
			if(arcs[i].has == true){
				var fs = -1;
				var ss = -1;
				for(var j = 0; j< maxwords; j++){
					if(xcoordinate[j] == arcs[i].x1){
						fs = j;
					}else if(xcoordinate[j] == arcs[i].x2){
						ss = j;
					}
					if(fs != -1 && ss != -1){
						pixel[fs][ss] = 1;
						break;
					}
				}
			}
	}
	var inarc = new Array();
	for (var i=0 ; i< wordlen; i++)
	{
		inarc[i] = 0;
	}
	for(var i = 0; i< wordlen; i++){
		for (var j=0; j< wordlen; j++)
		{
			if(pixel[i][j] == 1){
				inarc[j] += 1;
				tmp += i + " , " + j + "<br>";
			}
			if (inarc[j] > 1){
				window.alert("除Root之外的每个节点需要有且仅有一个入弧！不满足，请继续！");
				return false;
			}
		}
	}*/

	
	hb.lineWidth = 1;//控制线的宽度
	hb.clearRect(0,0, 6100, 1800);//与cover大小一致

	var str = "<br><br>";
	for (var i=0; i<arcs.length; i++)
	{
		if(arcs[i].has == true){//有这条线就画出来
			str += arcs[i].x1 + ",    " + arcs[i].x2 + "   <br>" ;

			hb.beginPath();
			
			if(arcs[i].x1 < arcs[i].x2){//to right
				hb.moveTo(arcs[i].x1+10, arcs[i].y1 + 3);
				hb.bezierCurveTo(arcs[i].x + 10, arcs[i].y, arcs[i].xx, arcs[i].yy, arcs[i].x2, arcs[i].y2);
				if(arcs[i].choose == true){
					hb.strokeStyle = "rgb(255,0,0)";//红色
					hb.fillStyle = "rgb(255,0 , 0)";
				}
				else if(arcs[i].graph == true){
					hb.strokeStyle = "black";//黑色
					hb.fillStyle = "black";
				}
				else{
					hb.fillStyle="blue";
					hb.strokeStyle = "blue";//蓝色
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
				var vancas = document.getElementById('cc').getContext("2d");//原点归为
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
				var vancas = document.getElementById('cc').getContext("2d");//原点归为
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
	/*document.getElementById('tmp').innerHTML = str;
	for (var j=0; j< wordlen; j++)
	{
			tt.rows.item(0).cells.item(j).style.background="#75ef92";
			tt.rows.item(1).cells.item(j).style.background="#75ef92";
	}
	for(var x = 0; x< wordlen; x++){
		tt.rows.item(0).cells.item(x).style.background="#E1E1DF";//返回背景色
		tt.rows.item(1).cells.item(x).style.background="#E1E1DF";
	}*/
	
	/*for(var i=0; i<document.all.tags("tr").length; i++)
	{
		window.alert('i' + i);
		document.all.tags("tr")[i].bgColor="#E1E1DF";
	}*/	
}
