<?php
$link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 

if($link){ 
    mysql_select_db(SAE_MYSQL_DB,$link);
    //your code goes here
}
//$taglist = ["v", 'n', 'w', 'd', 'r', 'u', 'nr' ,'a', 'm', 'p', 'q', 'c', 'vn', 't', 'ns', 'f', 'y', 'Ng', 'Vg', 'nx', 'b', 'l', 'ad', 'j', 's', 'i', 'nz', 'an', 'z', 'k', 'e', 'Ag', 'Tg', 'nt', 'vd', 'o', 'Dg', 'h', 'g', 'x', 'Mg', 'Bg', 'Rg'];//43

//$filename = "hot_weibo_pku_pos.txt";
//$filename = "morethan10.txt";
//$filename = "add_weibo_12k_pku_pos.txt";
//$filename = "event_left.txt";
//$filename = "event_long&lyj.txt";
//$filename = "random_weibo2_pku_pos_nodump.txt";
//$filename = "wrong.txt";
$filename = "events_weibo_7k_quchong.txt";

$handle = fopen($filename, "r");

$num = 1;//62339;//46561;//41546;//29550;

while (!feof($handle)){
	$buffer = fgets($handle, 1024);//读一行
	$buffer = trim($buffer);//删掉开头结尾的空格	
	$words = explode(" ", $buffer);
	$sent = "";
	for($i = 0; $i < count($words); $i++){//对原句进行找protosent操作
		$slide = explode("_", $words[$i]);
		if($slide[0] != ""){
			$slide2 = $slide[0];
		}else{
			$slide2 = '';//全是_时，应该比‘a_b_c_tag’的少一个下划线！！！！！！！！！！！！！！！
		}
		for($j =1; $j<count($slide)-1; $j++){
			if($slide[$j] == ""){
				$slide2 .= "_";
			}else{
				$slide2 .= "_" . $slide[$j];
			}
		}
		$sent = $sent. $slide2;
	}

	//echo $num . " : " . $buffer . "   |    ". $sent." ". count($slide) ."<br>";
	//$sql = "insert into sentence (protosent, sent, sentid) values(\"" .$buffer. "\", \"".$sent."\", " .$num. ");";
	$sent = str_replace("\\", "\\\\", $sent);
	$sent = str_replace("'", "\'", $sent);

	$buffer = str_replace("\\", "\\\\", $buffer);
	$buffer = str_replace("'", "\'", $buffer);

	$sql = "insert into sentence (protosent, sent, sentid) values('" .$buffer. "', '".$sent."', " .$num. ");";
	mysql_query("SET NAMES 'UTF8'");
	//mysql_query($sql) or ("插入失败".mysql_error());
	echo $sql ."<br>";
	$num += 1;
}
echo "完成！" . $num;
fclose($handle);
 ?>