<?php
$link=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS); 

if($link){ 
    mysql_select_db(SAE_MYSQL_DB,$link);
    //your code goes here
}
//$filename = "hit_all.root.quchong.txt";//-108 p.XX

//$filename = "form_pos_unannotation.txt";
//$filename = "100sent_pos_ws.txt";/101 (id:1-103)
//$filename = "english_unannotation.txt"; //611 (id:207-815)
//$filename = "pos_context001_db.txt"; //2029 (id:816-2845)
//$filename = "pos_context004_db.txt";//5380-138numlines(id:2846-8085) shijun(id:1-8085);others for lijuan(id:8086-28253)
//$filename = "spoken.3000.db.txt";//3002(id:8086-11087)
//$filename = "newconcept.pos.2600.db.txt";//2657 (id:11088-13742)
//$filename = "hit_shorter_35.txt";//6266；(id:13743-20007)
$filename = "hit_longer_35.txt"; //(id:20008,24764-28253 3493句)
                                 //dependancy table, id:30655-30893 198 sentences. 规范中的句子。  
$handle = fopen($filename, "r");

$num = 20009;
$sent = "";
$flag =1;
while (!feof($handle)){  //无预标注！！
	$buffer = fgets($handle, 8096);//读一行
	$sql = "insert into dep_sentence (sent, proto_depsent) values('" .trim($buffer). "', '' );";
	mysql_query("SET NAMES 'UTF8'");
	//mysql_query($sql) or ("插入失败".mysql_error());
	echo $num . " | " .$sql ."<br>";
	$num += 1;
}
echo "完成！" . $num;
fclose($handle);
 ?>