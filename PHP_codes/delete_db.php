<?php
session_start();
require("config2.php");
/*
$filename = "longerthan60.utf8.txt";
$handle = fopen($filename, "r");

while (!feof($handle)){
	$buffer = fgets($handle, 1024);//读一行
	$buffer = trim($buffer);//删掉开头结尾的空格	
	$sql = "select * from sentence where protosent = '" . $buffer . "';";
	mysql_query("SET NAMES 'UTF8'");
	$res = mysql_query($sql) or ("查询dependancy失败".mysql_error());
	while($times = mysql_fetch_assoc($res)){
		//echo $times['protosent'] . " " . $times['sent'] . ' ' . $times['sentid'] . ' ' . $times['done'];
		echo $times['sentid'];
		echo "<br>";
	}
	$sql2 = "delete from sentence where protosent = '" . $buffer . "';";
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sql2) or ("查询dependancy失败".mysql_error());
}*/


/*
$sql = "select * from dep_sentence where sentid >= 38276;";
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sql) or ("查询dependancy失败".mysql_error());
while($times = mysql_fetch_assoc($res)){
	echo $times['proto_depsent'] . " " . $times['sent'] . ' ' . $times['sentid'] . ' ' . $times['done'];
	//echo $times['sentid'];
	echo "<br>";
}*/


$sql = "SELECT * FROM `fillout` where DATE_SUB(CURDATE(), INTERVAL 6 DAY) <= date(tagtime) and sent not in (select sent from sentence);";
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sql) or ("查询dependancy失败".mysql_error());
while($times = mysql_fetch_assoc($res)){
	echo $times['sent'];
	//echo $times['sentid'];
	echo "<br>";
}



?>