<?php
 /* 连主数据库 */ 
$link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 
/*连从库*/
/*
    $link=mysql_connect(SAE_MYSQL_HOST_S.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
*/
if($link){ 
    mysql_select_db(SAE_MYSQL_DB,$link);
    //your code goes here
}

$user = $_POST['users'];
//mb_convert_encoding($user,"UTF-8","GBK");

$sql_query = "select count(*) as total from signup where username = '" .$user ."';";
mysql_query("SET NAMES 'UTF8'");
$res = mysql_query($sql_query);

$total = 0;
while ($num = mysql_fetch_assoc($res)){
	$total = $num['total'];
	if($total != 0){
		echo "用户名不可用！";
	}
}
if($total == 0){
	echo "用户名可用！";
}
?>
