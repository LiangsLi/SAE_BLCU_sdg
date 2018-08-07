<?php
session_start();
require("config2.php");

$psent = $_POST['psent'];
$npsent = $_POST['sent'];
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

$npsent = str_replace("\\", "\\\\", $npsent);
$npsent = str_replace("'", "\'", $npsent);

if($skip == "0" || $skip == 0){
	$sql = "update dependancy set tag = 0, res_sent='".$res_sent."', sent='". $npsent ."' ,time='".$dates."' , comment='" .$comment."' ,skip = 0 where sent='".$psent."' and annoter='".$username."';";
	if($username=='lijuanzheng'){	//lijuanzheng and shijun's super privilege.
		$sql = "update dependancy set tag = 0, res_sent='".$res_sent."', sent='". $npsent ."' ,time='".$dates."' , comment='" .$comment."' ,skip = 0, reviser='lijuan_revise' where sent='".$psent."';";	
	}else if ($username=='shijunliu') {
		$sql = "update dependancy set tag = 0, res_sent='".$res_sent."', sent='". $npsent ."' ,time='".$dates."' , comment='" .$comment."' ,skip = 0, reviser='shijun_revise' where sent='".$psent."' and reviser='shijunliu';";			
	} else if ($username=='GJX') {
		$sql = "update dependancy set tag = 0, res_sent='".$res_sent."', sent='". $npsent ."' ,time='".$dates."' , comment='" .$comment."' ,skip = 0, reviser='jingxuan_revise' where sent='".$psent."' and reviser='jingxuanguo';";
	}
	else if ($username=='linli') {
		$sql = "update dependancy set tag = 0, res_sent='".$res_sent."', sent='". $npsent ."' ,time='".$dates."' , comment='" .$comment."' ,skip = 0, reviser='linli_revise' where sent='".$psent."' and reviser='linli';";
	}
    //echo $username;
    //echo $sql;
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sql);

	if ($psent != $npsent){
		$sql5 = "update dep_sentence set sent='".$npsent."' where sent='" .$psent. "'";
		mysql_query("SET NAMES 'UTF8'");
		mysql_query($sql5);
	}
	
	
	$sql4 = "select count(*) as complete from dependancy where annoter='".$username."' and time != '' and skip = 0;";//将标注者的完成数+1
	mysql_query("SET NAMES 'UTF8'");
	$res4 = mysql_query($sql4);
	$comp = 0;
	while($times2 = mysql_fetch_assoc($res4)){
		$comp = $times2['complete'];//if find a reasonable result, ok
	}

	$sql3 = "update signup set dep_compelete='".$comp."' where username='".$username."';";
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sql3);

	//setcookie("dep_finish", $comp);
	
}else if($skip == "1" || $skip == 1){
	$sql = "update dependancy set skip= 1, tag = 0 , sent='".$psent."' ,comment='" .$comment."', res_sent = '".$res_sent."', time='".$dates."' where sent='".$psent."' and annoter='".$username."';";
	mysql_query("SET NAMES 'UTF8'");
	mysql_query($sql);
	//echo $sql;
}
echo "写入成功！" ;
//echo $sql5 ."写入成功！" . $sql;
?>