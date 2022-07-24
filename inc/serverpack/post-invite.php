<?php

$id=$_POST['id'];
if(isset($_POST['pass'])){$pass=$_POST['pass'];}


include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

if($_POST['cus']==0){
    $bdid = "SELECT * FROM man_teams WHERE id_team=".$id;
    $rdz = $bd->query($bdid);
    $pass_bd='';
    if ($rdz->num_rows > 0) {
        while($row = $rdz->fetch_assoc()) {
            $pass_bd=$row['pass'];
        }
    }
    if($pass_bd=='' OR $pass_bd!=$pass){
        echo "Не правильный пароль";
        return 0;
    }

    $sql = "INSERT INTO userstoteams (userID, teamID, inf) VALUES ('".$_SESSION['id']."', '".$id."', '1') ";
            if ($bd->query($sql) !== TRUE) {
                echo "Error: " . $bd->error;
                return 0;
            }
}elseif($_POST['cus']==1){
    $cont=addnotif($_SESSION['id'], 0, 201, $id, 0);
    if($cont!='ok'){
        echo $cont;
        return 0;
    }
    $sq ="SELECT * FROM `userstoteams` WHERE teamID='".$id."' AND pos>2";
    $rdz = $bd->query($sq);
    $n=0;
    if ($rdz->num_rows > 0) {
        while($row = $rdz->fetch_assoc()) {
        $idA[$n]=$row['userID'];
        $n++;
        }
    }
    if($n>0){
        $i=0;
        for($i>0; $i<$n; $i++){
            $cont=addnotif($idA[$i], $_SESSION['id'], 202, $id, 0);
            if($cont!='ok'){
                echo $cont;
                return 0;
            }
        }
    }
}

echo 'ok';
return 0;
    
?>