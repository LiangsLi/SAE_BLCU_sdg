<?php
require("config2.php");

$annoter = $_POST['annoter'];

$str = "";
$sql = "select dep_compelete from signup where username = '". $annoter ."'";
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sql) or ("查询sentence失败".mysql_error());

while($times = mysql_fetch_assoc($res)){//完成数目
	$tmp = (int)$times['dep_compelete'];
	$str .= $tmp . "%%`$$";
}

$sql2 = "select * from dep_charge where annoter = '". $annoter ."' and DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(chargetime)";//查询一周以内

mysql_query("SET NAMES 'UTF8'");
$res2 = mysql_query($sql2) or ("查询sentence失败".mysql_error());
$num = 0;
$wrong = 0;
$str2 = "";
while($times2 = mysql_fetch_assoc($res2)){//完成数目
	$num += 1;
	if($times2['result'] == 1){//wrong
		$wrong += 1;
		$str2 .= $times2['sent'] ."%%`$$" . $times2['res_sent']."%%`$$" .$times2['res_time']."%%`$$" .$times2['chargecomment']."%%`$$"; 
	}
}

$str3 = "";
if($num != 0)
	$str3 = $str . (100-$wrong*100/$num) . "%%`$$" . $str2;
else
	$str .= $str . "100";

echo $str3;//数量;“no”or错误率;显示错误：原句%%`$$句子%%`$$时间%%`$$
?>