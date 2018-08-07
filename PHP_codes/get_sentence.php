<?php
session_start();
require("config2.php");
$sent = "";
$psent = "";
$complete = 0;
$restart = $_COOKIE['restart'];
//echo $restart . "  ||  " ;

if($restart != null){
	$sql11 = "select protosent from sentence where sent = '". $restart ."';";
	mysql_query("SET NAMES 'UTF8'");
	$res211 = mysql_query($sql11);
	while($times311 = mysql_fetch_assoc($res211)){
		$sent = $times311['protosent'];//if find the same sent
		$sent .= "%%`$$";
		$sent .= $restart;
	}

	$restart = str_replace("\\", "\\\\", $restart);
	$restart = str_replace("'", "\'", $restart);

	$sqlupdate = "update fillout set segsent='' , segtime = '', asbtsent='' where sent = '" . $restart . "';";
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sqlupdate);

	echo $sent;
}
else{
	date_default_timezone_set('PRC');//设置北京时间
	$dates = date('Y-m-d H:i:s');


	$sql = "SELECT sum(complete) as total from signup";
	mysql_query("SET NAMES 'UTF8'");
	$res2 = mysql_query($sql);
	while($times3 = mysql_fetch_assoc($res2)){
		$complete = $times3['total'];
	}

	$total = 0;
	$sql2 = "select sentid as total from sentence order by sentid desc limit 1;";
	mysql_query("SET NAMES 'UTF8'");
	$res3 = mysql_query($sql2);
	while($times2 = mysql_fetch_assoc($res3)){
		$total = $times2['total'];
	}

	if($total == $complete){
		echo "last%%`$$one";
	}else {//选择上次被选出来，但是用户没有完成分词任务的句子。
		$select = 0;
		$sql3 = "select sent from fillout where tagsent = '' and tagtime = '' and annoter='". $_COOKIE['user'] ."';";
		mysql_query("SET NAMES 'UTF8'");
		$res5 = mysql_query($sql3);
		while($times44 = mysql_fetch_assoc($res5)){
			$tmp =  $times44['sent'];
			$sql5 = "select protosent from sentence where sent = '" . $tmp . "';";
			mysql_query("SET NAMES 'UTF8'");
			$res55 = mysql_query($sql5);
			while($times4 = mysql_fetch_assoc($res55)){
				$sent .= $times4['protosent'];//if find a reasonable result, ok
				$sent .= "%%`$$";
			}
			$psent = $tmp;
			$sent .= $tmp;
			$select += 1;
			break;
		}
		if($select == 0){//重新选择一个新的句子
			//$sqlquery = "select * from sentence where sentid >= " . $complete . " and sent not in (select sent from fillout) limit 1;";
			$sqlquery = "select * from sentence where sent not in (select sent from fillout) limit 1";
			mysql_query("SET NAMES 'UTF8'");
			$res4 = mysql_query($sqlquery);
			while($times4 = mysql_fetch_assoc($res4)){
				$sent = $times4['protosent'];//if find a reasonable result, ok
				$psent =$times4['sent'];
				$sent .= "%%`$$";
				$sent .= $times4['sent'];
			}
		
			$psent = str_replace("\\", "\\\\", $psent);
			$psent = str_replace("'", "\'", $psent);

			$sqlinsert = "insert into fillout (sent, inserttime, annoter ) values('" . $psent . "', '" . $dates . "', '". $_COOKIE['user'] . "');";
			mysql_query("SET NAMES 'UTF8'");
			mysql_query($sqlinsert);
		}
		echo $sent;
	}
}
?>