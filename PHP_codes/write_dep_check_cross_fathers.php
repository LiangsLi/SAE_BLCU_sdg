<?php
session_start();
require("config2.php");

$psent = $_POST['psent'];
$res_sent = $_POST['res_sent'];
$username = $_COOKIE['user'];
$skip = $_POST['skip'];
$comment = $_POST['comment'];

date_default_timezone_set('PRC');//设置北京时间
$dates = date('Y-m-d H:i:s');
$psent = str_replace("\\", "\\\\", $psent);
$psent = str_replace("'", "\'", $psent);

$res_sent = str_replace("\\", "\\\\", $res_sent);
$res_sent = str_replace("'", "\'", $res_sent);

if($skip == "0" || $skip == 0){
	$sql = "update dependancy2 set tag = '1', res_sent='".$res_sent."', time='".$dates."' , comment='" .$comment."' ,skip = '0' where sent='".$psent."';";
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sql);
	
	$sql = "update dependancy set tag = '1', time='".$dates."' , comment='" .$comment."' ,skip = '0' where sent='".$psent."';";
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sql);

}else if($skip == "1" || $skip == 1){
	$sql = "update dependancy2 set skip= '1', tag = '1' ,comment='" .$comment."', res_sent = '".$res_sent."', time='".$dates."' where sent='".$psent."';";
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sql);
}
echo $sql3 ."写入成功！" . $sql;
?>