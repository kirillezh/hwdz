<?php
$name=$_POST['name'];
$com=$_POST['com'];
 $idbd=$_POST['idbd'];

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
if(!is_it_really_admin($idbd, $_SESSION['id'])){
echo "Ошибка";
return 0;
}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$sql = "UPDATE man_teams SET `name_team`='".$name."', `com_team`='".$com."' WHERE id_team=".$idbd;

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}
echo 'ok';
return 0;
?>