<?php
require("config2.php");
date_default_timezone_set('PRC');//设置北京时间
$dates = date('Y-m-d H:i:s');
$admin = $_COOKIE['admin'];

$result = array();
if(($admin == "admin1") ||( $admin == "admin2") || ($admin == "admin3")|| ($admin == "admin4") || ($admin == "admin5")){
	$sql0 = "select * from dep_charge where adminname = '". $admin ."' and chargetime = '' limit 5;";
	$res0 = mysql_query($sql0);
	$result = "";
	while($ts = mysql_fetch_assoc($res0)){
		$result .= trim($ts['sent']) ."%%`$$" .trim($ts['res_sent']). "%%`$$" .$ts['res_time'] . "%%`$$" .$ts['comment'] . "%%`$$";
		$unp_flag = 1;
	}
	if($unp_flag == 0){
		$sqls = "select * from signup where dep_compelete >10 and username != '丁宇' and username != 'Car' and username != '曲咏措姆' and username != 'zldeng' and username != 'oneplus';";
		mysql_query("SET NAMES 'UTF8'");
		$ress = mysql_query($sqls);
		$result = "";
		while($ts = mysql_fetch_assoc($ress)){
			$rands = rand(2160, 86400*5);
			$sqlquery = "SELECT * FROM `dependancy` where UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(time)<=". $rands ." and annoter ='".$ts['username']."' and time !='' and sentid not in (select sentid from dep_charge)  limit 2;";//order by tagtime desc查询太多行，数据库查询会出错
			//$sqlquery = "SELECT * FROM `dependancy` where UNIX_TIMESTAMP(NOW())-UNIX_TIMESTAMP(tagtime)<=80000 and skip = 0 and annoter ='芭蕾兔' and time !='' and sentid not in (select sentid from dep_charge)  limit 2;";
			//查找一天之内的内容86400s
			mysql_query("SET NAMES 'UTF8'");
			$res5 = mysql_query($sqlquery);
			while($times = mysql_fetch_assoc($res5)){
				if($times['dep_sent'] == "")
					break;			
				$result .= trim($times['sent']) ."%%`$$" .trim($times['res_sent']). "%%`$$" .$times['time'] . "%%`$$" .$times['comment'] . "%%`$$";

				$times['sent'] = str_replace("\\", "\\\\", $times['sent']);
				$times['sent'] = str_replace("'", "\'", $times['sent']);

				$times['res_sent'] = str_replace("\\", "\\\\", $times['res_sent']);
				$times['res_sent'] = str_replace("'", "\'", $times['res_sent']);

				$times['comment'] = str_replace("\\", "\\\\", $times['comment']);
				$times['comment'] = str_replace("'", "\'", $times['comment']);

				$sqlquery2 = "insert into dep_charge values('".$times['sentid'] . "', '" . $times['sent']."','".$times['res_sent']. "','".$ts['username']. "','".$times['time']. "','". $times['comment']. "','',0,'" . $admin . "' , '')";

				mysql_query("SET NAMES 'UTF8'");
				mysql_query($sqlquery2);
				
				$sent = trim($times['res_sent']);
				
				$result[$num] = $sent;
			}
		}
	}
//原句%%`$$句子%%`$$时间%%`$$原句%%`$$句子%%`$$时间
echo trim($result);
}