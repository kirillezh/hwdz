<?php 
if(isset($_POST['first'])){
	$firstname=$_POST['first'];
}else{
	$firstname="";
}
if(isset($_POST['last'])){
	$lastname=$_POST['last'];
}else{
	$lastname="";
}

	$id=intval($_POST['id']);


if(isset($_POST['login'])){
	$login=$_POST['login'];
}else{
	$login="";
}

if(isset($_POST['photo'])){
	$photo=$_POST['photo'];
}else{
	$photo="";
}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
$bdid ="SELECT id, login FROM users WHERE id ='$id' ";
$rdz = $bd->query($bdid);
$load=0;
if ($rdz->num_rows > 0) {

  while($row = $rdz->fetch_assoc()) {
  	$login=$row['login'];
 	$load++;
  }
}

if($load==1){

	if($login==""){
		echo "Тут перевод на отсутствуйщий login";
                return 0;
	}
            session_start();
            $_SESSION['login'] = $login; 
            $_SESSION['id'] = $id; 
            echo 100;
}elseif($load==0){


$sql = "INSERT INTO users (`id`, `login`, `email`, `name`, `surname`, `avatar`, `socailnet`) VALUES ('$id', '$login', '', '$firstname', '$lastname', '$photo', 'tg')";
 
 if (!mysqli_query($bd, $sql)) {
 		echo $id;
        die('Error: ' .mysqli_error($bd));
  }
  session_start();
            $_SESSION['login'] = $login; 
  $_SESSION['id'] = $id; 
  echo 100;

}

 ?>