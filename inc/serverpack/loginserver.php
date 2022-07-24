<?php

include ($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

if (isset($_POST['login']) and isset($_POST['password']) and $_POST['login']!='' and $_POST['password']!='') {

        $login = $_POST['login'];
        $password = md5(md5(trim($_POST['password'])));  


        $bdint ="SELECT `id`, `login` FROM `users` WHERE (`login` = '$login' OR `email` = '$login') AND `password` = '$password'";

        $rdz = $bd->query($bdint);
        if ($rdz->num_rows > 0) {
            while($row = $rdz->fetch_assoc()) {
                $idU=$row['id'];
                $logU=$row['login'];
            }
        }
        $bdint ="SELECT `id`, `login` FROM `users` WHERE `login` = '$login' AND socailnet = 'tg' ";
        $rdz = $bd->query($bdint);
        if ($rdz->num_rows > 0) {
            while($row = $rdz->fetch_assoc()) {
                $idUtg=$row['id'];
                $logUtg=$row['login'];
            }
            if($social='tg' AND $_POST['login']==$logUtg){
                echo '102';
                return 0;
            }
        }

        if (!isset($idU)) 
        {
           echo '101';
           return 0;
        }
        
        
        session_start();
        $_SESSION['login'] = $logU; 
        $_SESSION['id'] = $idU; 
        echo '100';            
} 

if (isset($_GET['out'])) {

session_start(); 
unset($_SESSION['login']); 
unset($_SESSION['id']);
session_destroy();
header("Location: /auth/login/");
 exit();
}


?>

