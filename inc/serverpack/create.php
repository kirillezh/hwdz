<?php 
include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start(); 
if(!isset($_SESSION['id'])){
header("Location: /login");
return 0;
}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
    $idbd=mysqli_real_escape_string($bd,$_POST['idbd']);

if(!isset($idbd)){
  header("Location: /main");
return 0;
}
  if (!is_it_admin($idbd,$_SESSION['id'])) {
echo"Что-то не так";
  return 0;
  } 

    $id  = mysqli_real_escape_string($bd,$_POST['id']);
    $week  = mysqli_real_escape_string($bd,$_POST['week']);
    $day=floor($id/100);
    $less=($id/10)%10;
    $var=$id/10;
    $idtobd=$id%100;
    $dz=mysqli_real_escape_string($bd,$_POST['dz']);
    $to_do=mysqli_real_escape_string($bd,$_POST['to_do']);
    $ph=['','','','',''];
    $ph[1] = mysqli_real_escape_string($bd,$_POST['ph_1']);
    $ph[2] = mysqli_real_escape_string($bd,$_POST['ph_2']);
    $ph[3] = mysqli_real_escape_string($bd,$_POST['ph_3']);
    $ph[4] = mysqli_real_escape_string($bd,$_POST['ph_4']);
    $ph[5] = mysqli_real_escape_string($bd,$_POST['ph_5']);
    
    $idbd=mysqli_real_escape_string($bd,$_POST['idbd']);
$err_l=0;
if(str_replace(array(" ",  "<br />"), '', nl2br($dz))==''){
    echo "Добавьте какую-нибудь информацию в строчку 'Домашнее задание'";
    $err_l++;
}
if(str_replace(array(" ",  "<br />"), '', nl2br($to_do))==''){
    if($err_l==1){
        echo " и в строчку 'Метод отправки'";
    }else{
      echo "Добавьте какую-нибудь информацию в строчку 'Метод отправки'";  
    } 
    $err_l++;
}
if($err_l>0){
    echo "!";
    return 0;
}
$search ="SELECT newid FROM `dz_less_".$idbd."` WHERE `week` = '$week' AND `par_q` = '$idtobd' AND `day` = '$day' ";
$rdz = $bd->query($search);
$n=0;
if ($rdz->num_rows > 0) {
while($row = $rdz->fetch_assoc()) {
    $n++;
    $new_id=$row['newid'];
}
}
mysqli_close($bd); 

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

if($n>0){
    include($_SERVER['DOCUMENT_ROOT'].'/inc/serverpack/update.php');
    return 0;
}
$sql = "INSERT INTO `dz_less_".$idbd."` (`week`, `par_q`, `dz`,  `day`, `to_do`) VALUES 
('".$week."', '".$idtobd."', '".$dz."',  '".$day."','".$to_do."')";

    if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }
    echo "Данные добавлены...";

    mysqli_close($bd); 


?>