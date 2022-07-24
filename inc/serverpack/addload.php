<?php 
session_start(); 

$loud=$_POST['loud'];


if($loud==1){
	unset($_SESSION['adm']); 
}else{
	$_SESSION['adm']=1; 

}

 ?>