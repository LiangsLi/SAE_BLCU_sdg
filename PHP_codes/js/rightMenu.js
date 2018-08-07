/**
 * 右键菜单功能，要使用右键功能时，在所在元素的标签中添加这样的配置：
 *  oncontextmenu="(function(event){setRightMenu(event,'rightMenuId');})(event);return false;" 
 *   其中rightMenuId是指已经定义好的右键菜单的ID。
 *  注意：
 *  1、需要用到直线和箭头两个图片,在该Demo的images目录下可以找到
 *  2、如要使用该Demo的菜单样式，div的class属性请设置为rightMenu，并在页面导入rightMenu.css
 *  3、程序支持多级菜单，所以定义菜单时请使用div+ul标签进行定义:最外层用div，菜单内容用ul+li标签，如：
 *  <div class="rightMenu"  id="rightMenu1" style="display:none">
	    <ul>
	        <li>菜单项1</li>
	        <li>
	            菜单项2，我有多级标签
	            <ul>
	                <li>111</li>
	                <li>222</li>
	                <li>333</li>
	            </ul>
	        </li>
	    </ul>
	 <div>      
 * 林树涛
 * 2011年11月17日14:34:54
 * */

//当前显示的右键菜单的ID
var currentRightMenuID;

//隐藏当前显示的右键菜单
function hideRightMenu(){
	if(document.getElementById(currentRightMenuID)){
		document.getElementById(currentRightMenuID).style.display = "none";
	}
}
//点击页面其他地方时隐藏菜单
  	document.onclick = function (){
  		hideRightMenu();
	}; 	  

/*
 * 设置（配置）右键菜单,并弹出右键菜单
 * rightMenuId：右键菜单的ID
 * */
function setRightMenu(event,rightMenuId){
	var event = event || window.event;
	hideRightMenu();
	currentRightMenuID = rightMenuId;
	var oMenu = document.getElementById(rightMenuId);
	var aUl = oMenu.getElementsByTagName("ul");
	var aLi = oMenu.getElementsByTagName("li");
	var showTimer = hideTimer = null;
	var i = 0;
	var maxWidth = maxHeight = 0;
	var aDoc = [document.documentElement.offsetWidth, document.documentElement.offsetHeight];	
	var getOffset = {
			top: function (obj) {
				return obj.offsetTop + (obj.offsetParent ? arguments.callee(obj.offsetParent) : 0) 
			},
			left: function (obj) {
				return obj.offsetLeft + (obj.offsetParent ? arguments.callee(obj.offsetParent) : 0) 
			}	
		};	
	oMenu.style.display = "none";
	for (i = 0; i < aLi.length; i++){
		//为含有子菜单的li加上箭头
		aLi[i].getElementsByTagName("ul")[0] && (aLi[i].className = "sub");
		//鼠标移入
		aLi[i].onmouseover = function (){
			var oThis = this;
			var oUl = oThis.getElementsByTagName("ul");
			
			//鼠标移入样式
			oThis.className += " active";						
			//显示子菜单
			if (oUl[0]){
				clearTimeout(hideTimer);				
				showTimer = setTimeout(function (){
					for (i = 0; i < oThis.parentNode.children.length; i++){
						oThis.parentNode.children[i].getElementsByTagName("ul")[0] &&
						(oThis.parentNode.children[i].getElementsByTagName("ul")[0].style.display = "none");
					}
					oUl[0].style.display = "block";
					/*
					 * offsetHeight/Width、offsetTop/offsetLeft
					 * 等返回的都是只读的并且以数字的形式返回像素值（例如，返回12，而不是'12px'）。
					 * */
					oUl[0].style.top = oThis.offsetTop + "px";
					oUl[0].style.left = oThis.offsetWidth + "px";
					setWidth(oUl[0]);					
					//最大显示范围					
					maxWidth = aDoc[0] - oUl[0].offsetWidth;
					maxHeight = aDoc[1] - oUl[0].offsetHeight;					
					//防止溢出
					maxWidth < getOffset.left(oUl[0]) && (oUl[0].style.left = -oUl[0].clientWidth + "px");
					maxHeight < getOffset.top(oUl[0]) && (oUl[0].style.top = -oUl[0].clientHeight + oThis.offsetTop + oThis.clientHeight + "px")
				},300);
			}			
		};
			
		//鼠标移出	
		aLi[i].onmouseout = function (){
			var oThis = this;
			var oUl = oThis.getElementsByTagName("ul");
			//鼠标移出样式
			oThis.className = oThis.className.replace(/\s?active/,"");		
			clearTimeout(showTimer);
			hideTimer = setTimeout(function (){
				for (i = 0; i < oThis.parentNode.children.length; i++){
					oThis.parentNode.children[i].getElementsByTagName("ul")[0] &&
					(oThis.parentNode.children[i].getElementsByTagName("ul")[0].style.display = "none");
				}
			},300);
		};
	}

 	oMenu.style.display = "block";
 	oMenu.style.top = event.pageY;
 	oMenu.style.left = event.pageX;
	if(screen.width - event.pageX < 250){//为了使右键菜单不跑到屏幕之外
		mlay.style.pixelLeft = event.pageX - 250;
	}
	if(screen.height - event.pageY < 200){
		mlay.style.pixelTop = screen.height - 200 ;
	}
/*	setWidth(aUl[0]);
	//最大显示范围
	maxWidth = aDoc[0] - oMenu.offsetWidth;
	maxHeight = aDoc[1] - oMenu.offsetHeight;	
	//防止菜单溢出
	oMenu.offsetTop > maxHeight && (oMenu.style.top = maxHeight + "px");
	oMenu.offsetLeft > maxWidth && (oMenu.style.left = maxWidth + "px");*/
	return false;
}//##########end of setRightMenu


//取li中最大的宽度, 并赋给同级所有li	
function setWidth(obj){
	maxWidth = 0;
	for (i = 0; i < obj.children.length; i++){
		var oLi = obj.children[i];			
		var iWidth = oLi.clientWidth - parseInt(oLi.currentStyle ? oLi.currentStyle["paddingLeft"] : getComputedStyle(oLi,null)["paddingLeft"]) * 2
		if (iWidth > maxWidth) maxWidth = iWidth;
	}
	for (i = 0; i < obj.children.length; i++){
		obj.children[i].style.width = maxWidth + "px";
	} 
} 
