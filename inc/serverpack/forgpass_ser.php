<?php 


$from = 'From: no_reply@hwdz.ezh.com.ua';

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$bdint ="SELECT * FROM users WHERE (`email`='".$_POST['login']."' OR `login`='".$_POST['login']."') AND (`email` <> '' AND `password` <> '' AND `socailnet` <> 'tg')";
$rdz = $bd->query($bdint);        
$n=0;
if ($rdz->num_rows > 0) {
	while($row = $rdz->fetch_assoc()) {
        $n=1;
         $email=$row['email'];
         $name=$row['name'];
         $surname=$row['surname'];
         $login=$row['login'];
	}
}

if($n==0){
    echo "Учётная запись не была найдена";
}
$pass=randomer(100000,999999);
$sql = "INSERT INTO `enginepass` (`email`, `pass`) VALUES 
('".$email."', '".$pass."')";

    if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }



$to      = $email;
$subject = 'Востановление пароля';
$message = $name.", Ваш пароль: ".$pass;
$message = wordwrap($message, 70, "\r\n");
$headers = array(
    'From' => 'no_reply@hwdz.com.local',
    'X-Mailer' => 'PHP/' . phpversion()
);

if(mail($to, $subject, $message, $headers)){
    echo 'ok';
}else{
    echo "Письмо не отправлено. Произошла ошибка.";
}
?>

