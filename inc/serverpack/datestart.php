<?php 
$data=$_POST['data'];
 $gmt=$_POST['gmt']*(-1)/60;
if($gmt>=0){
	$gmt='+'.$gmt;
}
date_default_timezone_set('Etc/GMT'.$gmt);
$arr = [
  'января',
  'февраля',
  'марта',
  'апреля',
  'мая',
  'июня',
  'июля',
  'августа',
  'сентября',
  'октября',
  'ноября',
  'декабря'
];
$month = date('n')-1;
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT name FROM users WHERE id = '".$_SESSION['id']."' ";
$rdz = $bd->query($bdid);
  while($row = $rdz->fetch_assoc()) {
$name=$row["name"];
  }  

  if($data>0 and $data<=10){
    echo "Доброе утро, ".$name."!";
  }
  if($data>10 and $data<=17){
     echo "Добрый день, ".$name."!";
  }
  if($data>17 and $data<24){
 echo "Добрый вечер, ".$name."!";
}
echo "</br><div id='date'>".date("d")." ".$arr[$month]." ".date("Y")."</div>";
 ?>