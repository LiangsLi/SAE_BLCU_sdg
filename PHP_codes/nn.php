<?php
require("config2.php");
$username = $_COOKIE["user"];
mysql_query("SET NAMES 'utf8'");
header('Content-Type:text/html;charset=utf8');
echo $username;
//$sql_2 = "update  dependancy set tag='0' where tag='1'";
//mysql_query($sql_2);
//exit(1);

$sql_1 = "select * from dependancy where annoter = '$username'and skip=''order by time asc";

$res = mysql_query($sql_1);
$num=mysql_num_rows($res);
$count=1;
$words = mysql_fetch_assoc($res);
$ds1=$words['time'];
while($words = mysql_fetch_assoc($res)){
    //  echo $words['time']."</br>";
   $id=$words['sentid'];
    $ds2=$words['time'];
$d1=second($ds1);
$d2=second($ds2);
$d=$d2-$d1;
    // echo $d."</br>";
if($d<0)
{
   
    $words = mysql_fetch_assoc($res);
$ds1=$words['time'];
}
else if($d>20)
{
$ds1=$ds2;
}
else
 {
    //  echo $ds1."___".$ds2."-------".$d."---------------".$id."</br>";
    $count++;
    $ds1=$ds2;

  $sql_2 = "update  dependancy set tag='1' where annoter = '" .$username."' and sentid='$id'";
  mysql_query($sql_2);
  
 }


}
echo $count;
 function second($dd)
{
   $d=explode(" ",$dd);
$str1=$d[0];
$str2=$d[1];
$ar1=explode("-",$str1);
$ar2=explode(":",$str2);
$d=$ar1[2];
$h=$ar2[0];
$i=$ar2[1];
$s=$ar2[2]; 
$sums=$d*24*3600+$h*3600+$i*60+$s;
return $sums;
}
 ?>