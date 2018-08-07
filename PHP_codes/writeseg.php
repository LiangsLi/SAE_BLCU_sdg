<?php
session_start();
require("config2.php");

$segsent = $_POST['segsent'];
$username = $_COOKIE['user'];
$comment = $_POST['comment'];
$psent = $_POST['psent'];
$btsent = $_POST['fsent'];

date_default_timezone_set('PRC');//设置北京时间
$dates = date('Y-m-d H:i:s');

//$sql = "insert into fillout (sent, segsent, segtime, annoter, asbtsent, comment) values('".$psent."', '".$segsent."', '".$dates."', '".$username."' , '" . $btsent . "', '" .$comment. "');";

$psent = str_replace("\\", "\\\\", $psent);
$psent = str_replace("'", "\'", $psent);

$segsent = str_replace("\\", "\\\\", $segsent);
$segsent = str_replace("'", "\'", $segsent);

$btsent = str_replace("\\", "\\\\", $btsent);
$btsent = str_replace("'", "\'", $btsent);
$sql = "update fillout set segsent = '" . $segsent . "', segtime='" . $dates . "', asbtsent='" . $btsent . "', comment='" . $comment . "' where sent='" . $psent . "' and annoter='" . $username . "';";
mysql_query("SET NAMES 'UTF8'");
mysql_query($sql);

echo "写入成功！" . $sql;
?>