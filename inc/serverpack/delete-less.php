<?php
$id=$_POST['id'];
$idbd=$_POST['idbd'];

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
if(!is_it_really_admin($idbd, $_SESSION['id'])){
    echo "Ошибка"; return 0;
}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$sql = "DELETE FROM less_".$idbd." WHERE id=".$id;
if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}

echo 'ok';
?>