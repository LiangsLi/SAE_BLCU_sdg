<?php
require("config2.php");
$cont = $_POST['cont'];
$username = $_COOKIE["user"];
$t = explode(' ', $cont);

$sql = "select * from dependancy where annoter = '". $username ."' and time != ''";
if ($username == "lijuanzheng"){	//lijuanzheng's super privilege to revise the 13743 sentences. data is saved into dependancy2 table.
	$sql = "select * from dependancy2 where time != '' and skip = 0 and sentid < 13743 order by time";
}
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sql) or ("查询signup失败".mysql_error());
$result = "";

while($times = mysql_fetch_assoc($res)){//全部显示出来
	$tag = 0;
	for($i = 0; $i< count($t); $i++){
		if (strpos($times['res_sent'] , $t[$i]) == false && strpos($times['sent'] , $t[$i]) == false && strpos($times['comment'] , $t[$i]) == false){
			$tag = 1;
			break;
		}
	}
	if ($tag == 0){
		$result .= trim($times['sent']) ."%%`$$" .trim($times['res_sent']). "%%`$$" .$times['annoter'] . "%%`$$" .$times['comment'] . "%%`$$";
	}
}
echo $result;
?>