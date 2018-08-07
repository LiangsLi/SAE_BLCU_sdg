<?php
session_start();
require("config2.php");

$sent = $_POST['sent'];
$admin = $_COOKIE["admin"];
//$sent = "公司_n 工程师_n 则更_d 希望_v 连字体_n 版权_n 的_u 费_n 都_d 收了，_v 这个_r 公司_n 就是_v 。_w%%`$$他_r 说_v ，_w 每_n 个人_v 只要_c 不放弃终归_v 可以_v 成功_a 。_w%%`$$";

date_default_timezone_set('PRC');//设置北京时间
$dates = date('Y-m-d H:i:s');

$sent = str_replace("\\", "\\\\", $sent);
$sent = str_replace("'", "\'", $sent);

$ss = explode("%%`$$", $sent);

for($i=0; $i<count($ss)-2; $i+= 3){
	if($ss[$i] != ""){
		$sql = "update dep_charge set result =". $ss[$i+2] .", chargecomment = '". $ss[$i+1] ."' ,chargetime='".$dates."' where sent ='".$ss[$i]."' and adminname='".$admin."';";
		mysql_query("SET NAMES 'UTF8'");
		mysql_query($sql);
		echo "写入成功！" . $sql;
	}
}
?>