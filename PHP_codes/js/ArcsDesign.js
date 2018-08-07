//单元格宽度是40，该数是写到代码里的，待改。
var CellWidth = 40;
var CellCont = CellWidth -2;
var ArcStartPx = CellWidth/2 -4;
var maxwords = 150;//要调整该值，要同时调整canvas属性width和height，还有ycoordinate的值。
var xcoordinate =new Array();
var ycoordinate = 1795;
var canvasWidth = 6100;
var canvasHeight= 1800;


/*****************************history page set up global variable*/
var pageline = 100;//每页显示的句子数量，从cookie上复制
var canvasStartPxinTabal = 190;

/******************************/


var Arcs = function(x1idx, x2idx, x1, ycoordinate, x2, xtxt, delt, text, has){
	this.x1idx = x1idx;
	this.x2idx = x2idx;
	this.x1 = x1;
	this.y1 = ycoordinate;
	this.x  = x1;
	this.y  = ycoordinate-(30-0.1*delt)*delt;//调整25这个值可以调整弧高度，越大，弧越高。
	this.xx = x2;
	this.yy = ycoordinate-(30-0.1*delt)*delt;
	this.x2 = x2;
	this.y2 = ycoordinate;
	this.ytxt = this.y + 5 + 0.25 * (ycoordinate - this.y);//三次贝塞尔曲线可以算，有公式
	this.xtxt = xtxt;
	this.text = text;
	this.choose = false;//判断该弧是否是用户点击的弧
	this.graph = false;
	this.has = false;
};
