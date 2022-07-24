<?php 
$week= $weekl=floor((time() - strtotime("2021-01-10") ) / (60 * 60 * 24*7)+1); 

$day = $dayl=date("w", mktime(0,0,0,date("m"),date("d"),date("Y")));

if($day==0){
  $day=7;
}

function is_save_change($id){
  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
  $bdid ="SELECT checkL FROM less_".$id;
  $rdz = $bd->query($bdid);
  if ($rdz->num_rows > 0) {
      while($row = $rdz->fetch_assoc()) {
      if($row['checkL']==0){return false;}
      return true;
      }
  }
}

function is_it_ID($idT, $idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT iD FROM userstoteams WHERE userID = '$idUser' and teamID = '$idT' ";
$rdz = $bd->query($bdid);
 $nte=0;
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
    $nte++;
  }
}
if($nte>0){
  return True;
}else{
  return False;
}

}
function is_it_redact($idT, $idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT pos FROM userstoteams WHERE userID = '$idUser' and teamID = '$idT' ";
$rdz = $bd->query($bdid);
 $nte=0;
 $pos=0;
if ($rdz->num_rows > 0) {
   
  while($row = $rdz->fetch_assoc()) {
    $nte++;

$pos=$row["pos"];
  }
}
if($pos==2){
  return true;
}else{
  return false;
}
}
function is_it_user($idT, $idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT pos FROM userstoteams WHERE userID = '$idUser' and teamID = '$idT' ";
$rdz = $bd->query($bdid);
 $nte=0;
 $pos=0;
if ($rdz->num_rows > 0) {
   
  while($row = $rdz->fetch_assoc()) {
    $nte++;

$pos=$row["pos"];
  }
}
if($pos==1){
  return true;
}else{
  return false;
}
}
function is_it_admin($idT, $idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT pos FROM userstoteams WHERE userID = '$idUser' and teamID = '$idT' ";
$rdz = $bd->query($bdid);
 $nte=0;
if ($rdz->num_rows > 0) {
   
  while($row = $rdz->fetch_assoc()) {
    $nte++;

$pos=$row["pos"];
  }
}
if($pos>=2){
  return true;
}else{
  return false;
}
}
function is_enable($idT, $idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT userID FROM userstoteams WHERE userID = '$idUser' and teamID = '$idT' ";
$rdz = $bd->query($bdid);
 $nte=0;
if ($rdz->num_rows > 0) {
   
  while($row = $rdz->fetch_assoc()) {
    $nte++;
  }
}
if($nte>0){
  return true;
}else{
  return false;
}
}
function upload_files($FILES){
  if(isset($FILES)) {

$allowedTypes = array('image/jpeg','image/png','image/gif');

$uploadDir = "upload/"; //Директория загрузки. Если она не существует, обработчик не сможет загрузить файлы и выдаст ошибку

for($i = 0; $i < count($_FILES['file']['name']); $i++) { //Перебираем загруженные файлы

$uploadFile[$i] = $uploadDir . basename($FILES['file']['name'][$i]);

$fileChecked[$i] = false;


for($j = 0; $j < count($allowedTypes); $j++) { //Проверяем на соответствие допустимым форматам

if($_FILES['file']['type'][$i] == $allowedTypes[$j]) {

$fileChecked[$i] = true;

break;

}

}

if($fileChecked[$i]) { //Если формат допустим, перемещаем файл по указанному адресу

if(move_uploaded_file($FILES['file']['tmp_name'][$i], $uploadFile[$i])) {

echo $_SERVER['HTTP_HOST'].'/upload/'.$FILES['file']['name'][$i];

} else {

echo "Ошибка ".$FILES['file']['error'][$i]."<br>";

}

} else {

echo "Недопустимый формат <br>";

}

}

} else {

echo "Вы не прислали файл!" ;

}

}
function is_it_really_admin($idT, $idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT pos FROM userstoteams WHERE userID = '$idUser' and teamID = '$idT' ";
$rdz = $bd->query($bdid);
 $nte=0;
 $pos=0;
if ($rdz->num_rows > 0) {
   
  while($row = $rdz->fetch_assoc()) {
    $nte++;

$pos=$row["pos"];
  }
}
if($pos>=3){
  return true;
}else{
  return false;
}
}
function is_it_red_admin($idT, $idUser){

  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
  $bdid ="SELECT pos FROM userstoteams WHERE userID = '$idUser' and teamID = '$idT' ";
  $rdz = $bd->query($bdid);
   $nte=0;
   $pos=0;
  if ($rdz->num_rows > 0) {
     
    while($row = $rdz->fetch_assoc()) {
      $nte++;
  
  $pos=$row["pos"];
    }
  }
  if($pos>=4){
    return true;
  }else{
    return false;
  }
  }
function is_it_name($idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT name FROM users WHERE login = '$idUser' ";
$rdz = $bd->query($bdid);
$name=0;


  while($row = $rdz->fetch_assoc()) {
$name=$row["name"];
  }

if($name!=0){
  echo $name;  
}

}
function is_it_nam($idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT name FROM users WHERE id = '$idUser' ";
$rdz = $bd->query($bdid);
$name=0;


  while($row = $rdz->fetch_assoc()) {
$name=$row["name"];
  }

  return $name;  


}
function is_it_surnam($idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT surname FROM users WHERE id = '$idUser' ";
$rdz = $bd->query($bdid);
$name=0;


  while($row = $rdz->fetch_assoc()) {
$name=$row["surname"];
  }

  return $name;  


}
function is_it_log($idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT login FROM users WHERE id = '$idUser' ";
$rdz = $bd->query($bdid);
$login="";


  while($row = $rdz->fetch_assoc()) {
$login=$row["login"];
  }

if($login!=""){
  return $login;  
}

}
function is_it_really($idUser,$pass,$id){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT name FROM users WHERE login = '$idUser' AND password ='$pass' AND id='$id' ";
$rdz = $bd->query($bdid);
$n=0;

if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$n++;
  }
}

if($n==1){
return true;
}else{
  return false;
}

}
function is_realy($idUser,$id){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT name FROM users WHERE password ='$pass' AND id='$idUser' ";
$rdz = $bd->query($bdid);
$n=0;

if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$n++;
  }
}

if($n==1){
return true;
}else{
  return false;
}

}
function randomer($from,$to) {
  for($c=round(rand($from,$to));$c<=$to;$c++) {
     mt_srand();
     $r=round(rand($from,$to));
  }
  return $r;
}
function what_time(){
  $poyas=+2;
   $t=gmdate('H',time()+($poyas*3600));
  if($t>0 and $t<=10){
    return "1";
  }
  if($t>10 and $t<=17){
    return "2";
  }
  if($t>17 and $t<24){
return "3";
  }

}
function generatepass(){

$chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
$max=10;
$size=StrLen($chars)-1;
$password=null;

    while($max--)
    $password.=$chars[rand(0,$size)];

return $password;

}
function is_it_surname($idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT surname FROM users WHERE login = '$idUser' ";
$rdz = $bd->query($bdid);
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$surname=$row["surname"];
  }
}
if($surname!=0){
  echo $surname;  
}
}
 

function is_name($idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$bdid ="SELECT surname, name, avatar FROM users WHERE id = '$idUser' ";
$rdz = $bd->query($bdid);
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
    $imgA=$row["avatar"];
$surname=$row["surname"];
$name=$row["name"];
  }
}
if(isset($surname) or isset($name)){
  echo "<div class='img_avatar' style='background-image: url(".$imgA.")'></div><h5>".$name." ".$surname."</h5>";  
}
}



function checked_online($id){
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$log ="SELECT * FROM activeuser WHERE userid = '".$id."' ";
$rdz = $bd->query($log);
$ntl=0;
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$ntl++;
$data=$row['dataint'];
$date=$row['dateintegare'];
  }
}
if($ntl>0) {
    $time_now = strtotime(date('Y-m-d H:i:s'));
 $time_need = strtotime($data);

$time= ceil($time_now-$time_need);

    $time_now = strtotime(date('Y-m-d'));
 $time_need = strtotime($date);

$time2= ceil($time_now-$time_need);

if($time2==0 and $time<60){

echo "#31f331";
} else{
  echo "#f33030";
}
}else{
  echo "#f33030";
}

}

function name_peop($idUser){

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT name, surname FROM users WHERE id = '$idUser' ";
$rdz = $bd->query($bdid);
$namer="";
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$surname=$row["surname"];
$name=$row["name"];
  }
}
if(isset($name)){
$namer=$name;
}
if(isset($surname)){
  if(isset($name)){
$namer=$name." ".$surname;
}else{
$namer=$surname;
}
}
return $namer;
}
function ph_people($id){
  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$leSS ="SELECT avatar FROM users WHERE id='".$id."' ";
$rdz = $bd->query($leSS);
$ava="";
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
 $ava=$row['avatar'];
  }
}
return $ava;
}

 function up_down_cri($id, $idt){
?>

<div id="count_peop">
  
        <?php
        if($id==$_SESSION['id'] OR is_it_red_admin($idt, $id) OR (!is_it_red_admin($idt, $_SESSION['id']) AND is_it_really_admin($idt, $_SESSION['id']) AND is_it_really_admin($idt, $id)) ){return '</div>';}


         if(!is_it_really_admin($idt, $id)){ ?>
        <div id="up"><a onclick="edit_peop(1, <?php echo $id; ?> )"><i class="bi bi-arrow-up"></i></a></div>
      <?php }else{ ?>
        <div id="up" style="color:gray;"><i class="bi bi-arrow-up"></i></div>
      <?php } ?>
      <?php if(is_it_user($idt,$id)){ ?>
        <div id="down" style="color:red;"><a onclick="edit_peop(2, <?php echo $id; ?>)"><i class="bi bi-x"></i></a></div>
        <?php }else{ ?>
          <div id="down"><a onclick="edit_peop(0, <?php echo $id; ?>)"><i class="bi bi-arrow-down"></i></a></div>
          
        <?php } ?>
          <script>
  function edit_peop(ed, id) {
    $.ajax({
  url: '/inc/serverpack/edit_peop.php',
  data: {
        id: id,
        ed: ed,
        idbd: "<?php echo $idt; ?>",
      },
  type: "POST",
  success: function(html) {
    if(html=="ok"){$('#stradding').addClass('ena');$('#stradding').html("Успешно!"); Updl(1);setTimeout(() => $('#stradding').removeClass('ena'), 6000);}
    else {$('#stradding').html(html);}
       }
});
  }
</script>
      </div>
      <?php } 

function exist_return($id){
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$leSS ="SELECT userID FROM userstoteams WHERE teamID='".$id."' ";
$rdz = $bd->query($leSS);
$n=0;
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {

$ucD[$n]=$row['userID'];
    $ucN[$n]=name_peop($row['userID']);
    $ucL[$n]=is_it_log($row['userID']);
    
    $ucPh[$n]=ph_people($row['userID']);
    $n++;
}
}
   ?>

<h3 id="gg">Участники (<?php echo $n ?>)</h3>

  <ul>
    <?php 
$n2=0;
while($n2<$n) {
     ?>
    <li class="local">
      <div class="picTools">
      <?php if($ucPh[$n2]==""){ ?>
      <i style="display: inline-block;font-size: 40px;vertical-align: top;background: #0000006b;border-radius: 1000px;line-height: 45px;width: 45px;text-align: center;" class="bi bi-person"></i>
    <?php }else{ ?>
      <div style="background-image: url('<?php echo $ucPh[$n2]; ?>'); background-size: 100%; background-repeat: no-repeat; height: 45px; width: 45px; border-radius: 1000px;"></div>
    <?php } ?>
    </div>
      <div class="localpic" style="background: <?php echo checked_online($ucD[$n2]) ?> "></div>
      <div style="display: inline-block;" id="georg">
      <h4><?php echo $ucN[$n2]; ?></h4>
      <div id="cont"><?php  if(is_it_really_admin($id,$ucD[$n2])){echo "<i title='Администратор' class='bi bi-star-fill'></i>";}elseif(is_it_redact($id,$ucD[$n2])){echo "<i title='Редактор'  class='bi bi-star'></i>";} ?></div>

      <?php echo up_down_cri($ucD[$n2], $id); ?>

      <h7 style="color: gray;"><?php echo $ucL[$n2]; ?></h7>
      </div>
      <div class="dropdown-divider"></div>
    </li>

    <?php
$n2++;
     } 
     ?>
  </ul>
  <?php
}

function who_you($id, $tid){
  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
  $leSS ="SELECT pos FROM userstoteams WHERE userID='$id' AND teamID='$tid' ";
  $rdz = $bd->query($leSS);
  $pos=0;
  if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $pos=$row["pos"];
    }
  }

  switch ($pos) {
      case 0:
          return '';
          break;
      case 1:
          return 'Участник';
          break;
      case 2:
          return 'Редактор';
          break;
      case 3:
        return 'Администратор';
        break;
      case 4:
          return 'Главный администратор';
          break;
  }

}



function switch_lang($value)
{

  $converter = array(
    'а' => 'f', 'б' => ',', 'в' => 'd', 'г' => 'u', 'д' => 'l', 'е' => 't', 'ё' => '`',
    'ж' => ';', 'з' => 'p', 'и' => 'b', 'й' => 'q', 'к' => 'r', 'л' => 'k', 'м' => 'v',
    'н' => 'y', 'о' => 'j', 'п' => 'g', 'р' => 'h', 'с' => 'c', 'т' => 'n', 'у' => 'e',
    'ф' => 'a', 'х' => '[', 'ц' => 'w', 'ч' => 'x', 'ш' => 'i', 'щ' => 'o', 'ь' => 'm',
    'ы' => 's', 'ъ' => ']', 'э' => "'", 'ю' => '.', 'я' => 'z',
    'А' => 'F', 'Б' => '<', 'В' => 'D', 'Г' => 'U', 'Д' => 'L', 'Е' => 'T', 'Ё' => '~',
    'Ж' => ':', 'З' => 'P', 'И' => 'B', 'Й' => 'Q', 'К' => 'R', 'Л' => 'K', 'М' => 'V',
    'Н' => 'Y', 'О' => 'J', 'П' => 'G', 'Р' => 'H', 'С' => 'C', 'Т' => 'N', 'У' => 'E',
    'Ф' => 'A', 'Х' => '{', 'Ц' => 'W', 'Ч' => 'X', 'Ш' => 'I', 'Щ' => 'O', 'Ь' => 'M',
    'Ы' => 'S', 'Ъ' => '}', 'Э' => '"', 'Ю' => '>', 'Я' => 'Z',
    '"' => '@', '№' => '#', ';' => '$', ':' => '^', '?' => '&', '.' => '/', ',' => '?',
  );
 
  $value = strtr($value, $converter);
  return $value;
}

function to_text($x){
  $x=switch_lang($x);
  $strBin = "";
  for ($i = 0; $i < strlen($x); $i++) {
      $strBin = $strBin.decbin(ord($x[$i]));
  }

  if(strlen($strBin)>60){
    $strBin=mb_substr($strBin, 10, 50);
  }

  $strBin=dechex(bindec($strBin));

  if(strlen($strBin)>6){
    return mb_substr($strBin, 0, 6);
  }else{
    return $strBin;
  }

}

function notif_ul(){

  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
  $sq ="SELECT * FROM `notification` WHERE to_id='".$_SESSION['id']."' ORDER BY `id` DESC";
  $rdz = $bd->query($sq);
  $n=0;
  $lg=0;
  $a='';
  if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $code[$n]=$row['code'];
      $text[$n]=$row['text'];
      $ver[$n]=$row['verif'];
      $from[$n]=$row['from_id'];
      $n++;
      if($row['verif']==0){$lg++;}
    }
  }
  if($n==0){echo "<li>Уведомлений нету</li>";}
    for($i=0; $i<$n; $i++){   
      $a= $a.noti($code[$i], $ver[$i], $text[$i], $i, $from[$i]);
    }
    return $a;
}

function notif(){

  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

  $sq ="SELECT * FROM `notification` WHERE to_id='".$_SESSION['id']."' ORDER BY `id` DESC";
  $rdz = $bd->query($sq);
  $n=0;
  $lg=0;
  if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $from[$n]=$row['from_id'];
      $code[$n]=$row['code'];
      $text[$n]=$row['text'];
      $ver[$n]=$row['verif'];
      $n++;
      if($row['verif']==0){$lg++;}
    }
  }
  ?>
  <script>
    function ellout(time) {
                $.ajax({
            url: '/inc/serverpack/update-notif.php',
            type: "POST",
            data: {
              "d": 'l'
            },
            success: function(html) {
              if(html!='ok'){
                setTimeout(() => $("#dropnoti").html(html), time);
              }
             

            }
            });
      }
      function ellout_upd(time) {
                $.ajax({
            url: '/inc/serverpack/update-notif.php',
            type: "POST",
            data: {
              "d": 'd'
            },
            success: function(html) {
                setTimeout(() => $("#dropnoti").html(html), time);

            }
            });
      }
  </script>
  <div class="dropdown">

    <?php if($lg>0){ echo "<div id='red-line'>".$lg."</div>";} ?>
  <button id="drpnotif" onclick="ellout(5000)" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-bell"></i></button>
  <ul class="dropdown-menu" aria-labelledby="drpnotif" id='dropnoti' style='padding: 0;'>
   <script>
       $(function() {


$('#dropnoti').on('click', function(event) {
  event.stopPropagation();
});

$(window).on('click', function() {
  $('#dropnoti').slideUp();
});

});
   </script>
   <?php
    if($n==0){echo "<li>Уведомлений нету</li>";}
    for($i=0; $i<$n; $i++){
      
      echo noti($code[$i], $ver[$i], $text[$i], $i, $from[$i]);
    }
    ?>
  </ul>
</div>
<?php

}

function noti($code, $if, $text, $i, $from)
{
  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

  $blo='';
  if($i!=0 AND $if==0){$blo=$blo.'<li class="txtborder no">';}elseif($i!=0){$blo=$blo.'<li class="txtborder">';}elseif($if==0){$blo=$blo.'<li class="no">';}else{$blo=$blo.'<li>';}
  if($if==0){
    $blo=$blo."<div id='red_point'></div>";
  }
if(floor($code/100)==2){
  $name='';
  $sq ="SELECT * FROM `man_teams` WHERE id_team='".$text."'";
  $rdz = $bd->query($sq);
  if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $name=$row['name_team'];
    }
  }
}

  if($code==203){
  $blo=$blo."<div>Вас добавили в группу <b>".$name."</b>.</div>";
}elseif($code==201){
  $blo=$blo."<div>Отправлен запрос в группу <b>".$name.".</b>.
  </div>";
}elseif($code==204){
  $blo=$blo."<div>Отказано в доступе к группу <b>".$name.".</b>
  </div>";
}elseif($code==202){

  $sq ="SELECT * FROM `users` WHERE id='".$from."'";
  $rdz = $bd->query($sq);
  if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $u_name=$row['name'];
    }
  }

  $blo=$blo."<div>Пользователь <b>".$u_name."</b> хочет присоедениться к группе <b>".$name.".</b>
  <div class='but-group'>
  <button class='bg-green succes but-notif' onclick='luck(1)'><i class='bi bi-check'></i></button>
  <button class='bg-red succes but-notif' onclick='luck(0)'><i class='bi bi-x'></i></button>
  </div></div>
  <script>
   function luck(id) {
    $.ajax({
      url: '/inc/serverpack/update-invite.php',
      data: {'change': id, 
      'idbd': ".$text.",
      'from': ".$from."
      },
      type: 'POST',
      success: function(html) {
        if(html=='ok'){
          ellout_upd(0);
        }else{
          $('#errorlog').addClass('ena');
          $('#errorlog').html(html);   
          setTimeout(() => $('#errorlog').removeClass('ena'), 6000);
        }
      }
    });
  }
   </script>
  ";

}elseif($code==205){

  $sq ="SELECT * FROM `users` WHERE id='".$from."'";
  $rdz = $bd->query($sq);
  if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $u_name=$row['name'];
    }
  }

  $blo=$blo."<div>Пользователь <b>".$u_name."</b> добавлен к группе <b>".$name.".</b>
  <div class='but-group'>
  <div class='col-green almost'>Добавлен</div> 
  </div></div>
  ";

}elseif($code==206){

  $sq ="SELECT * FROM `users` WHERE id='".$from."'";
  $rdz = $bd->query($sq);
  if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $u_name=$row['name'];
    }
  }

  $blo=$blo."<div>Пользователю <b>".$u_name."</b> отказанно в доступе к группе <b>".$name.".</b>
  <div class='but-group'>
   <div class='col-red almost'>Отказано</div> 
  </div></div>
  ";

}
return $blo."</li>";

}

function addnotif($to_id, $from_id, $code, $text, $verif){
  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

  $sql = "INSERT INTO `notification` ( `from_id`, `to_id`, `text`, `code`, `verif`) VALUES ('".$from_id."', '".$to_id."', '".$text."', '".$code."', '".$verif."') ";
  if ($bd->query($sql) !== TRUE) {
      return "Error: " . $bd->error;
      
  }
  return 'ok';
}
function uptnotif($to_id, $from_id, $code, $text, $verif){

}