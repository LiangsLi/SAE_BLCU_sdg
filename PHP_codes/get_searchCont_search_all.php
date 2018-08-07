<?php
require("config2.php");
$cont = $_POST['cont'];
$cont = trim($cont);
$t = explode(' ', $cont); // space is split in keywords list.

$sql = "select * from dependancy where time != '' and skip = 0 and sentid < 13743 order by time desc";
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sql) or ("查询signup失败".mysql_error());
$result = "";

$num = 0;
while($times = mysql_fetch_assoc($res)){
	$tag = 0;
	
	#if ($num >380){//只返回结果的前100个
	#	break;
	#}
	
	//for($i = 0; $i< count($t); $i++){
		/*只在标注好的句子里，查找某一条依存弧与搜索的一致，搜索w1\tw2\tlabel*/
		$res_sent = explode("\t", $times['res_sent']);
		for($j=0; $j<count($res_sent); $j++){
			$label = explode('(', $res_sent[$j]);
			$tmp = explode('_', $label[0]);
			$w1 = explode(']', $tmp[0]);
			$w2 = explode(']', $tmp[1]);
			$tag = explode(')', $label[1]);
			
			if ($w1[1] == $t[0] && $w2[1] == $t[1] && $tag[0] == $t[2]){
				$result .= trim($times['sent']) ."%%`$$" .trim($times['res_sent']). "%%`$$" .$times['annoter'] . "%%`$$" .$times['comment'] . "%%`$$";
				$num += 1;
				break;
			}
		}
		/********************/
		
		/*
		if (strpos($times['res_sent'] , $t[$i]) == false && strpos($times['sent'] , $t[$i]) == false && strpos($times['comment'] , $t[$i]) == false){
			$tag = 1;
			break;
		}*/
	//}
	/*
	if ($tag == 0){
		$result .= trim($times['sent']) ."%%`$$" .trim($times['res_sent']). "%%`$$" .$times['annoter'] . "%%`$$" .$times['comment'] . "%%`$$";
		$num += 1;
	}*/
}
echo $result;
?>