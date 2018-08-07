<?php
	require("config2.php");//链接数据库

	$username = $_POST['username'];
	$password = $_POST['password'];
	$autologin = $_POST['autologin'];//获取输入框信息
	/*$username="zhaokefirst";
	$password="gg";
	$autologin="1";*/
	//echo $username . " " . $password . " " . $autologin;
	
	mysql_query("SET NAMES 'UTF8'");//设定MYSQL连接编码，保证页面申明编码与这里设定的连接编码一致
	$tag = 0;
	$sqlquery2 = "select count(*) as total from signup where username = '" . $username . "' ;";//检索数据库中是否存在该用户，返回其数量（若存在则为1，不存在则为0）
	//echo $sqlquery2;
	$res = mysql_query($sqlquery2);//执行语句
	while($row = mysql_fetch_array($res)){//提取查询结果元素
		if($row['total'] == 0){
			$tag = 1;
			echo "1";//"用户名不存在！";（返回给JS的函数）
		}
	}
	if($tag == 0){//存在该用户名
		$sqlquery = "select * from signup where username='" . $username . "' ;";
		$result = mysql_query($sqlquery);// or die ("wrong!". mysql_error());
		$flag = 1;
		while($row = mysql_fetch_assoc($result)){
			if ($row["password"] == $password){//此时登录密码也正确！
				$_SESSION["users"] = $username;//给users赋值
				$_SESSION['uid'] = '0';
				$flag= 0;//如果密码正确就将flag重置为0
				$sql = "select times from signup where username = '" .$username. "';";//检索用户登录次数
				$res2 = mysql_query($sql);
				$time = 0;
				while($times = mysql_fetch_assoc($res2)){
					$time = $times['times'];//获取登录次数
				}
				$sql3 = "update signup set times = " .($time + 1). " where username = '" .$username. "';";//登录次数加一
				mysql_query($sql3);
				/*if($autologin == "2"){
					setcookie("user", "", time()-3600);
					setcookie("user", $username, time()+3600*24*7);
					echo "0";//login ok;
				*/
			}
		}
		if($flag == 1){
			echo  "2";//"密码错误！"（返回给JS的函数）
		}
	}
?>