

  <?php session_start();

  include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

  if (!is_enable($id,$_SESSION['id'])) {
echo"<div class='noint'>
   <h1>Или у вас нету доступа к этой комнате, <br>
или такой комнаты не сущевствует.<br>
  </h1>   
  <h2><a href='/'>Перейти на главную страницу.</a>
</h2>
  </div>";
  return 0;
  } 

 $l=array_fill ( 0 , 553 , 0 );
$now = time();
$your_date = strtotime("2021-01-10"); 
$weektr = $now - $your_date;
$week=$weekl=floor($weektr / (60 * 60 * 24*7)+1); 
 $day=$dayl=floor($weektr / (60 * 60 * 24)) - ($week - 1) * 7; 
if(!isset($we)){$we=$week;}
if(!isset($da)){$da=$day;}

if (isset($da)) {
  if($da>5){
    header( 'Location: /inv/'.$da.'/'.$we.'/5/', true, 307 );
    return 0;
  }
  if($da<1){
    header( 'Location: /inv/'.$da.'/'.$we.'/1/', true, 307 );
    return 0;
  }

  if (!preg_match('/^\+?\d+$/', $da)) { 
  header( 'Location: /inv/'.$we.'/'.$da.'/', true, 307 );
  return 0;
  }

}

if(isset($we)){
 if (!preg_match('/^\+?\d+$/', $we)) { 
  header( 'Location: /inv/'.$we.'/', true, 307 );
  return 0;
}  
  if($we>$week+3){
    $week3=$we+3;
    header( 'Location: /inv/'.$_GET['id'].'/'.$week3.'/', true, 307 );
    return 0;
  }
if($we<6){
    header( 'Location: /inv/'.$we.'/6/', true, 307 );
    return 0;
  }
}



         $bdid ="SELECT  name_team, com_team FROM man_teams WHERE id_team ='".$id."' ";
     $rdz = $bd->query($bdid);
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
    $nameComm=$row["name_team"];
    $comComm=$row["com_team"];
  } }

   ?>


<!DOCTYPE HTML>
<html lang='ru'>
 <head>
<link rel=”icon” href=/ico.png type=”image/x-icon”>
  <meta charset="utf-8">
  <title><?php echo $nameComm." – ".$comComm; ?> – Ёж Домашка</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/header.php');   ?>
</head>
<body>
<script>
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
document.write('<h1 style="    hyphens: auto;">Эта страница не поддерживает мобильные устройства</h1></head></body><style type="text/undefined">')


}
</script>
  <?php 
  $ghd=$id;
$databl=$id;

$datab="dz_less_".$databl;
?>

<?php $week11=$week1=$we;


$day1 = $da-1;
$day11 = $da+1;
if($da<=1){ $day1=5; $week1=$week1-1;} 

if($da>=5){$day11=1; $week11++;} ?>

 <h1 style="text-align: center;" id="week">
  <?php    if($we<7){
   echo "<a id='prev' style='color: #606060;' > ";
 }else{
    echo "<a id='prev' href='/inv/".$databl."/".$week1. "/".$day1."/'>"; } ?>
    <i class="bi bi-arrow-left"></i>
  </a>
<a href="/<?php echo $id; ?>/" id="altver" >
  <i class="bi bi-card-list"></i>
</a>
<?php if($we==$weekl AND $da==$dayl){ echo "<p id='ned'>Сегодня</p><p id='ded'>+0</p>";}else{ if($we==$weekl){echo "День: ".$da;}else{echo "<p id='ned'>Неделя: </p>";if($weekl<$we){echo "+";}echo $we-$weekl; echo ", день: ".$da;} }?>

<?php    if($we-$weekl>=3){ echo "<a id='next' style='color: #606060;' > ";}else{
    echo "<a id='next' href='/inv/".$databl."/".$week11. "/".$day11."/'>"; } ?>
    <i class="bi bi-arrow-right"></i>
  </a>
 </h1>

<?php
$datab="dz_less_$databl";
$dataL="less_$databl";


$ls=array_fill ( 0 , 553 , 0 );

 $leSS ="SELECT id,name,var FROM $dataL ";
$rdz = $bd->query($leSS);

if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$ls[$row["id"]]=$row["name"];
if($row["var"]==1 and $week%2==0){
$ls[$row["id"]]=0;
}
if($row["var"]==2 and $week%2==1){
$ls[$row["id"]]=0;
}
  }
  }


  $dz ="SELECT dz, par_q, to_do FROM $datab WHERE week = '$we' AND   day = '$da' ";
  $rdz = $bd->query($dz);
  if ($rdz->num_rows > 0) {
    ?>
    <div class="table task">
  <table id="taskt">
    <tbody>
      <tr>
        <td>Предмет</td>
        <td >Домашние задание</td>
        <td>Метод отправки</td>
      </tr>
    <?php
  while($row = $rdz->fetch_assoc()) {
$dz=$row["dz"]; 
$par_q=$row["par_q"];
$to_do=$row["to_do"];
$d=$day*100+$par_q;
?>
<tr id="task">
  <td id="namel"><?php echo $ls[$d]; ?><?php if ($par_q%10==1){ ?><br><span class="badge bg-danger">1 группа</span> <?php } ?><?php if ($par_q%10==2){ ?><br><span class="badge bg-danger">2 группа</span> <?php } ?></td>
<td id="dzl"><?php echo $dz; ?></td>
<td id="todol"><?php echo $to_do; ?></td>
</tr>
<?php
} ?>
</tbody>
</table>
</div>

<?php
}else{ ?>
  <div class="table task">
  <table id="taskt">
    <tbody>
      <tr>
        <td>Предмет</td>
        <td id="dzl">Домашние задание</td>
        <td>Метод отправки</td>
      </tr>
    </tbody>
  </table>
  <div class="redbg2" style="height:auto;padding: 10vh 0;">
  <h1 style="text-align: center;    text-shadow: 2px 2px 9px var(--bg); ">Д/З за данный период не найдено</h1>
  </div>
<?php } ?>
</body>
</html>