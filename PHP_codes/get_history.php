<?php
require("config2.php");
$username = $_COOKIE["user"];

mysql_query("SET NAMES 'UTF8'");

$sql_1 = "select tagsent, tagtime, comment from fillout where annoter = '" .$username."' and tagsent != ' ' order by tagtime desc;";
$res = mysql_query($sql_1);

while($words = mysql_fetch_assoc($res)){
	//echo $words['tagsent']. "         " .$words['tagtime'] ."   ". $words['comment'] . ",";
	echo $words['tagsent']. "%%`$$" . $words['comment'] . "%%`$$" .$words['tagtime'] . "%%`$$";
}

?>