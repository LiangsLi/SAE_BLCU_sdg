<?php
ob_start();
session_start();
require("config2.php");

if($_COOKIE['sentnum'] == null){
	$username = $_COOKIE['user'];

	$sql = "select dep_sent, sent from dependancy where annoter='". $username ."' and res_sent = '' and sent!= '' and time = '';";
	mysql_query("SET NAMES 'UTF8'");
	$res2 = mysql_query($sql);
	$sent = "";
	$dep_sent = "";
	$num = 0;
	/*while($times = mysql_fetch_assoc($res2)){
		$dep_sent = $times['sent'] ."%%`$$" .$times['dep_sent'];
		$num += 1;
	}
	echo $dep_sent;*/
	
	if($num == 0){//没找到未完成的句子
		$dep_sent = '';
		$tmp = '';
		$strs = '';
		$sentid = '';
		//$sqlquery = "select sentid, sent, proto_depsent from dep_sentence where sent not in (select sent from dependancy) limit 1;";
		$sqlquery = "select comment, sent, res_sent from dependancy where sentid <20000 and res_sent != '' and tag = '0' and skip = '0' limit 5000;";
		mysql_query("SET NAMES 'UTF8'");
		$res4 = mysql_query($sqlquery);
		while($times4 = mysql_fetch_assoc($res4)){
			$dep_sent = $times4['proto_depsent'];//if find a reasonable result, ok
			$tmp =$times4['sent'];
			$sentid = $times4['sentid'];
			$strs .= '!!~~!!' . trim($times4['sent']) . "%%`$$" . trim($times4['res_sent']) . "%%`$$" . trim($times4['comment']);
		}

		$dep_sent = str_replace("\\", "\\\\", $dep_sent);
		$dep_sent = str_replace("'", "\'", $dep_sent);


		echo $strs;
	}
}
?>