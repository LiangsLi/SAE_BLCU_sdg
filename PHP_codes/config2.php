<?PHP
//本文件的作用是链接数据库。
session_start();//session_start() 会创建新会话或者重用现有会话。 如果通过 GET 或者 POST 方式，或者使用 cookie 提交了会话 ID， 则会重用现有会话。
$config_forumsname = "blucsdg";//数据库名称？？

// script options:
$usernameLengthMIN = 1; 		// Sets the minium nubmer of characters in the username 
$usernameLengthMAX = 20;		// Sets the maxium number of characters in the username (max 20 chars!)
$passwordLengthMIN = 3; 		// Sets the minium nubmer of characters in the password 
$passwordLengthMAX = 8;			// Sets the maxium number of characters in the password (max 20 chars!)

// ErrorStrings（错误提示信息）:
$couldNotConnectMysql = "Could not connect MySQL<BR>\n please check your settings in config.php";
$couldNotOpenDatabase = "Could not open database<BR>\n please check your settings in config.php";
$disabledFeatures = "The adminstrator of this site has disabled this feature";
$incorrectLogin = "Incorrect login";
$underAttackReLogin = "This account was under attack. Therefore it was locked. To terminate the lock log-in with you correct loginname and password. After this log-in the lock will be terminated and you can you use our account as normal<BR> NOTE: make sure you do not make any type errors. This would activate the lock again.";
$underAttackPleaseWait = "This account is under attack. Please wait an until the account is released again."; 
$accountNotActivated = "This account has not been activated yet.";
$incorrectUserMailaders = "The username / e-mail-combination you entered is incorrect.";
$activationCodeHasBeenResend = "Your activationcode has been resend to your mailadres.";
$incorrectUserActcode ="The username/activation-combination you entered is not correct. Please try again.";

/*
用户名　 :  SAE_MYSQL_USER
密　　码 :  SAE_MYSQL_PASS
主库域名 :  SAE_MYSQL_HOST_M
从库域名 :  SAE_MYSQL_HOST_S
端　　口 :  SAE_MYSQL_PORT
数据库名 :  SAE_MYSQL_DB
*/

 /* 连主数据库 */ 
$link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS) or die ("不能选择数据库".mysql_error); 
/*连从库*/
/*
    $link=mysql_connect(SAE_MYSQL_HOST_S.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
*/
if($link){ 
    mysql_select_db(SAE_MYSQL_DB,$link);
    //your code goes here
}

?>