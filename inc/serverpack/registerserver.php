<?php 
$err=0;
if(isset($_GET['red'])){$red=$_GET['red'];}else{$red='';}

if($_POST['name']=="" OR $_POST['login']=="" OR $_POST['email']=="" OR $_POST['password']==""){
		echo "Не все обязательные поля были введены";
		return 0;
}
 if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        echo  "Логин должен быть не меньше 3-х символов и не больше 30"."<br>";
        $err++;
    }else if(!preg_match("/^[a-zA-Z0-9_]+$/",$_POST['login']))
    {
echo  "Логин может состоять только из букв английского алфавита, цифр и нижних подчёркиваний"."<br>";
$err++;
return 0;
    }

    if(!preg_match('@[a-zA-Z]@u',$_POST['login'])) {
    echo  "Логин должен состоять хотя б из одной буквы английского алфавита"."<br>";
        $err++;
        return 0;
}

include ($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$bdint ="SELECT id FROM users WHERE login='".$_POST['login']."'";
$rdz = $bd->query($bdint);        
$i=0;
if ($rdz->num_rows > 0) {
	while($row = $rdz->fetch_assoc()) {
$i++;
}
}
if($i>0){
	echo "Данный логин уже занят <br>";
$i=0;
}
$bdint ="SELECT id FROM users WHERE email='".$_POST['email']."'";
$rdz = $bd->query($bdint);        

if ($rdz->num_rows > 0) {
	while($row = $rdz->fetch_assoc()) {
$i++;
	}
}
if($i>0){
	echo "Данный электронный адрес уже занят <br>";
$i=0;
}
if($i>0){
	return 0;
}

$sql = "INSERT INTO users (id,name, surname, login, email, password, avatar) VALUES ('".rand(time(),10000000)."','".htmlspecialchars($_POST['name'])."', '".htmlspecialchars($_POST['surname'])."', '".htmlspecialchars($_POST['login'])."', '".htmlspecialchars($_POST['email'])."', '".md5(md5(trim(htmlspecialchars($_POST['password']))))."', '')";

    if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }

 ?>
