<?php
session_start();
require("config2.php");

$fsent = $_POST['fsent'];
$username = $_COOKIE['user'];
$psent = $_POST['psent'];
$comment = $_POST['comment'];

date_default_timezone_set('PRC');//设置北京时间
$dates = date('Y-m-d H:i:s');

$sql2 = "select comment from fillout where sent='".  $psent . "' and annoter='".$username."';";
mysql_query("SET NAMES 'UTF8'");//将已有comment取出，+comment写入
$res2 = mysql_query($sql2);
$com = "";
while($times = mysql_fetch_assoc($res2)){
	$com = $times['comment'];//if find a reasonable result, ok
}
if($comment != ""){
	$com .= "|" . $comment;
}

$psent = str_replace("\\", "\\\\", $psent);
$psent = str_replace("'", "\'", $psent);

$fsent = str_replace("\\", "\\\\", $fsent);
$fsent = str_replace("'", "\'", $fsent);

$sql = "update fillout set tagsent='".$fsent."', tagtime='".$dates."', comment = '".$com."' where sent='".$psent."' and annoter='".$username."';";
mysql_query("SET NAMES 'UTF8'");
mysql_query($sql);


$sql4 = "select count(*) as complete from fillout where annoter='".$username."' and tagsent != '';";//将标注者的完成数+1
mysql_query("SET NAMES 'UTF8'");
$res4 = mysql_query($sql4);
$comp = 0;
while($times2 = mysql_fetch_assoc($res4)){
	$comp += $times2['complete'];//if find a reasonable result, ok
}

$sql3 = "update signup set complete='".$comp."' where username='".$username."';";
mysql_query("SET NAMES 'UTF8'");
mysql_query($sql3);

setcookie("finish", $comp);

echo $sql2 ."写入成功！" . $sql;
?>