<?php
require("config2.php");
$username = $_COOKIE["user"];

mysql_query("SET NAMES 'UTF8'");

//$sql_1 = "select sent, res_sent, time, comment from dependancy where sentid >= 13743 and annoter = '" .$username."' and time != '' order by time, comment desc;";
$sql_1 = "select sent, res_sent, time, comment from dependancy where annoter = '" .$username."' and skip='0' and time != '' order by time, comment desc;";
//$sql_1 = "select sent, res_sent, tag, comment from dependancy where annoter = '" .$username."' and skip = '0' and time != '' order by time,tag desc;";
if($username=='lijuanzheng' ){	//super privilege.
	$sql_1 = "select sent, res_sent, tag, comment from dependancy where skip = '0' and time != '' and sentid >13742 and reviser='lijuanzheng' order by time,tag desc;";
} else if($username=='shijunliu' ){	//super privilege.
	$sql_1 = "select sent, res_sent, tag, comment from dependancy where skip = '0' and time != '' and reviser='shijunliu' and sentid > 13742 order by sentid;";
} else if($username=='linli' ){	//super privilege.
	$sql_1 = "select sent, res_sent, tag, comment from dependancy where skip = '0' and time != '' and reviser='linli' and sentid > 13742 order by sentid;";
} else if($username=='GJX' ){	//super privilege.
	$sql_1 = "select sent, res_sent, tag, comment from dependancy where skip = '0' and time != '' and reviser='jingxuanguo' and sentid > 13742 order by sentid;";
}
$res = mysql_query($sql_1);
$result = "";
while($words = mysql_fetch_assoc($res)){
	$result .= trim($words['sent']) ."%%`$$" .trim($words['res_sent']). "%%`$$" .$words['time'] . "%%`$$" .$words['comment'] . "%%`$$";
	//trim() 函数移除字符串两侧的空白字符或其他预定义字符。
}
echo $result;//返回结果
?>