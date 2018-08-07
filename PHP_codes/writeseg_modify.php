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

$psent = str_replace("\\", "\\\\", $psent);
$psent = str_replace("'", "\'", $psent);

$segsent = str_replace("\\", "\\\\", $segsent);
$segsent = str_replace("'", "\'", $segsent);

$btsent = str_replace("\\", "\\\\", $btsent);
$btsent = str_replace("'", "\'", $btsent);

$sql = "update fillout set segsent='".$segsent."', segtime='".$dates."', comment = '".$comment."' , asbtsent='". $btsent ."', tagsent='', tagtime='' where sent='".$psent."' and annoter='".$username."';";
//把tagsent清空，否则对一个历史记录，只修改了分词，而没修改词性，则会对应不上！
mysql_query("SET NAMES 'UTF8'");
mysql_query($sql);

echo "modify成功！" . $sql;
?>