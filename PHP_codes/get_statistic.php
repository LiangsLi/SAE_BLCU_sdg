<?php
require("config2.php");

$annoter = $_POST['annoter'];

$str = "";
$sql = "select complete,firstweek from signup where username = '". $annoter ."'";
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sql) or ("查询sentence失败".mysql_error());

while($times = mysql_fetch_assoc($res)){//完成数目
	$tmp = (int)$times['complete'];
	$tmp2 = (int)$times['firstweek'];
	$str .= $tmp . "%%`$$";//0
	$tmp3 = $tmp - $tmp2;
	$str .= $tmp3 . "%%`$$";//1
}

$sql2 = "select * from charge where annoter = '". $annoter ."' and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(chargetime)";//查询一周以内
mysql_query("SET NAMES 'UTF8'");
$res2 = mysql_query($sql2) or ("查询sentence失败".mysql_error());
$num = 0;
$wrong = 0;
while($times2 = mysql_fetch_assoc($res2)){//完成数目
	$num += 1;
	if($times2['result'] == 1){//wrong
		$wrong += 1;
		$str .= $times2['tagsent'] . " ,    " .$times2['tagtime'] . ",    <b>" . $times2['chargecomment'] . "</b><br>"; //2
	}
}
if($num != 0)
	$str .= "%%`$$" . (1.0-$wrong/$num);//3
else
	$str .= "%%`$$no!";
echo $str;
?>