<?php
$id=$_POST['id'];
$idbd=$_POST['idbd'];
$radio=$_POST['radio'];
$name=$_POST['name'];

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
if(!is_it_really_admin($idbd, $_SESSION['id'])){
    echo "Ошибка";return 0;
}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

if(str_replace(array(" ",  "<br />"), '', nl2br($name))==''){echo 'Введите данные!';return 0;}

$name_bd=$var_bd='';
$n=0;
$bdid ="SELECT * FROM less_".$idbd." WHERE id=".$id;
$rdz = $bd->query($bdid);
if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
        $n=1;
        $name_bd=$row['name'];
        $var_bd=$row['var'];
    }
}

if($name_bd!=$name OR $var_bd!=$radio){
    if($n==1){
        $sql = "UPDATE less_".$idbd." SET name='".$name."' , var='".$radio."' WHERE id=".$id;
        if ($bd->query($sql) !== TRUE) {
            echo "Error: " . $bd->error;
            return 0;
        }
    }else{
        $sql = "INSERT INTO less_".$idbd." (name, var, id, checkL) VALUES ('".$name."', '".$radio."', '".$id."', '1') ";
        if ($bd->query($sql) !== TRUE) {
            echo "Error: " . $bd->error;
            return 0;
        }
    }
    
}
echo 'ok';
?>