<?php
require("config2.php");
$username = $_COOKIE["user"];

mysql_query("SET NAMES 'UTF8'");

$maxwords = 65;
$xcoordinate =array();
$ycoordinate = 694;
class Arcs{
	public $x1;
	public $x2;
	public $has;
	
	function  __construct($x1 ,$x2){
		$this->x1 = $x1;
		$this->x2 = $x2;
		$this->has = true;
	}
}



function checkCorss($arcs){
	for ($i = 0; $i < count($arcs); $i++){
		for($j=0; $j< count($arcs); $j++){//右弧
			if ($i == $j)
				continue;
		
			if($arcs[$j]->x1 < $arcs[$i]->x2 && $arcs[$j]->x1 > $arcs[$i]->x1){//j->x1在i->x1和i->x2中间
				if($arcs[$j]->x2 < $arcs[$i]->x1 || $arcs[$j]->x2 > $arcs[$i]->x2){//j->x2在i->x1另一侧或在i->x2另一侧
					//echo "1<br>";
					return false;
				}
			}
			else if($arcs[$j]->x2 < $arcs[$i]->x2 && $arcs[$j]->x2 > $arcs[$i]->x1){//j->x2在i->x1和i->x2中间
				if($arcs[$j]->x1 < $arcs[$i]->x1 || $arcs[$j]->x1 > $arcs[$i]->x2){//j->x1在i->x1另一侧或在i->x2另一侧
					//echo "2<br>";
					return false;
				}
			}//左弧
			else if($arcs[$j]->x1 < $arcs[$i]->x1 && $arcs[$j]->x1 > $arcs[$i]->x2){//j->x1在i->x1和i->x2中间
				if($arcs[$j]->x2 < $arcs[$i]->x2 || $arcs[$j]->x2 > $arcs[$i]->x1){//j->x2在i->x1另一侧或在i->x2另一侧
					//echo "3<br>";
					return false;
				}
			}
			else if($arcs[$j]->x1 < $arcs[$i]->x1 && $arcs[$j]->x1 > $arcs[$i]->x2){//j->x2在i->x1和i->x2中间
				if($arcs[$j].x1 < $arcs[$i]->x2 || $arcs[$j]->x1 > $arcs[$i]->x1){//j->x1在i->x1另一侧或在i->x2另一侧
					//echo "4<br>";
					return false;
				}
			}
		}
	}
	return true;
}	
		

		
$sql_1 = "SELECT * FROM `dependancy` where res_sent != '' and skip = 0";
$res = mysql_query($sql_1);
$num = 0;
while($sents = mysql_fetch_assoc($res)){
	//echo $sents['res_sent']. "  " . $sents['comment'] . "  " .$sents['annoter'] . "  " . "<br>";

	$words = explode(")", $sents['res_sent']);
	//echo count($words). "<br>";
	$arcs = array();
	$idx = 0;
	for($i = 0; $i< count($words)-1; $i++){
		if($words[$i] == '')
			continue;
		$tmp2 = explode("[", $words[$i]);
		$temp = explode("]", $tmp2[1]);
		$f = (int)$temp[0];
		$temp2 = explode("]", $tmp2[2]);
		$s = (int)$temp2[0];
				
		//$tmp3 = explode(')', $words[$i]);
		//$tmp4 = $tmp3[count($tmp3)-2];
		//$tmp5 = explode('(', $tmp4);
		//$text = $tmp5[count($tmp5)-1];
		//echo $f. "  " . $s . " , ".count($arcs) . "<br>";
		//$arcs[$j].text = $text;
		$tmp = new Arcs($f, $s);
		$arcs[$idx] = $tmp;
		$idx += 1;
		//echo $j . "<br>";
	}
	//echo 'arcs.length:' . count($arcs) . "<br>";
	//for ($i=0; $i<count($arcs); $i++){
	//	echo $arcs[$i]->x1 . " || " . $arcs[$i]->x2 . "<br>";
	//}
	if (checkCorss($arcs) == false){
		//echo "true!<br>";
		if (strstr($sents['comment'], "cross") == null ){
			echo $sents['annoter'] . $sents['res_sent']. " ||| " . $sents['comment'] . " ||| " . "<br>";
			$sents['comment'] .= " #cross#";
			$wsql = "update dependancy set comment = '" .$sents['comment'] . "' where annoter = '".$sents['annoter']."' and res_sent = '".$sents['res_sent']."'";
			echo $wsql . "<br>";
			mysql_query("SET NAMES 'UTF8'");
			//mysql_query($wsql);
		}
		else {
			//echo "comment:" . $sents['comment'] . "<br>";
			echo "";
		}
		$num += 1;
	}
	else{
		if (strstr($sents['comment'], "cross") != null ){
			echo $sents['annoter'] . $sents['res_sent']. " ||| " . $sents['comment'] . " ||| " . "<br>";
		}
	}
}
echo $num ;	

?>