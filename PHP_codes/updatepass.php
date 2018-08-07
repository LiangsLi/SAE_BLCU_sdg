<?php
require("config2.php");
$users = $_POST['user'];
$pass = $_POST['pass'];

$tag = 0;
$sqlquery2 = "select count(*) as total from signup where username='" . $users . "' and uid = '".$uid."'";
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sqlquery2);
while($row = mysql_fetch_array($res)){
	if($row['total'] == 0){
		$tag = 1;
		echo "用户名不存在 0";
	}
}
if($tag == 0){
	$sql_save2 = "update signup set password='" .$pass ."' where username = '" .$users. "';";
	mysql_query($sql_save2);// or die("更新！".mysql_error());
	$_SESSION['users']= $users;
	
	$sql = "select times from signup where username = '" .$users. "'";
	$res2 = mysql_query($sql);
	$time = 0;
	while($times = mysql_fetch_assoc($res2)){
		$time = $times['times'];
	}
	$sql3 = "update signup set times = " .($time + 1). " where username = '" .$users. "'";
	mysql_query($sql3);
	echo "密码修改成功 1";
}
?>