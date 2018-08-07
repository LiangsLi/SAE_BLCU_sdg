<?php
require("config2.php");
$username = $_COOKIE["user"];

mysql_query("SET NAMES 'UTF8'");

$sql_1 = "select sent, res_sent, time, comment, annoter from dependancy where time != '' order  by annoter, time desc;";
$res = mysql_query($sql_1);
$result = "";
while($words = mysql_fetch_assoc($res)){
	$result .= trim($words['sent']) ."%%`$$" .trim($words['res_sent']). "%%`$$" .$words['time'] . "%%`$$" .$words['comment'] . "%%`$$" .$words['annoter'] . "%%`$$";
}
echo $result;
?>