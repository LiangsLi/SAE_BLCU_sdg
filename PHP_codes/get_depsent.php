<?php
ob_start();
session_start();
require("config2.php");

if($_COOKIE['sentnum'] == null){
	$username = $_COOKIE['user'];

	$sql = "select dep_sent, sent from dependancy where annoter='". $username ."' and res_sent = '' and sent!= '' and skip!=1;";
	mysql_query("SET NAMES 'UTF8'");
	$res2 = mysql_query($sql);
	$sent = "";
	$dep_sent = "";
	$num = 0;
	while($times = mysql_fetch_assoc($res2)){
		$dep_sent = $times['sent'] ."%%`$$" .$times['dep_sent'];
		$num += 1;
	}
    if($num > 0)
    {
        echo $dep_sent.'0';
    }
	if($num == 0){//没找到未完成的句子
		$username = $_COOKIE['user'];
		$sql = "select dep_sent, sent from dependancy where annoter='". $username ."' and skip=1 and sent!= '';";
		mysql_query("SET NAMES 'UTF8'");
		$res2 = mysql_query($sql);
		$sent = "";
		$dep_sent = "";
		$num = 0;
		while($times = mysql_fetch_assoc($res2)){
			$dep_sent = $times['sent'] ."%%`$$" .$times['dep_sent'];
			$num += 1;
		}
        echo $dep_sent.'1';
	}
}
?>