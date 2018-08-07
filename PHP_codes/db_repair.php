<?php
ob_start();
session_start();
require("config2.php");
	$sql = "select sentid from dependancy where res_sent != '' and sent= '' and skip = '1';";
	mysql_query("SET NAMES 'UTF8'");
	$res2 = mysql_query($sql);
	
	$num = 0;
	$num2 = 0;
	while($times = mysql_fetch_assoc($res2)){
		$sentid = $times['sentid'];
		$sql2 = "select sent from dep_sentence where sentid = " .$sentid. ";";
		mysql_query("SET NAMES 'UTF8'");
		$sentence = mysql_query($sql2);
		$flag = 0;
		while($s = mysql_fetch_assoc($sentence)){
			$sent = $s['sent'];
			//echo $sentid . " | " .$sql2 . " | " . $sent . "<br>";
			$sql3 = "update dependancy set sent = '" .$sent. "' where sentid = " .$sentid. " and sent = '';";
			mysql_query("SET NAMES 'UTF8'");
			mysql_query($sql3);
			//echo $sql3 . "<br><br>";
			$num += 1;
			$flag = 1;
		}
		if ($flag == 0){
			echo $sql2 . "<br>";
		}
		$num2 += 1;
	}
	echo $num . " , " . $num2;
?>