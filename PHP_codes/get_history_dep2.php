<?php
require("config2.php");
$username = $_COOKIE["user"];
$sent = $_POST['sent'];
mysql_query("SET NAMES 'UTF8'");

$sql_1 = "select dep_sent from dependancy where sent ='".$sent."' and skip = 1 and sentid >= 13743;";
$res = mysql_query($sql_1);
$result = "null";
while($words = mysql_fetch_assoc($res)){
	$result .= $words['dep_sent'];
}
echo $result;
?>