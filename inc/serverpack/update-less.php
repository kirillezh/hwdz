<?php
$id_old=$_POST['id'];
$id_new=$_POST['idn'];
$idbd=$_POST['idbd'];
$chl=$_POST['chl'];

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
if(!is_it_really_admin($idbd, $_SESSION['id'])){
echo "Ошибка";
return 0;

}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$sql = "UPDATE less_".$idbd." SET id=".$id_new." WHERE id=".$id_old;

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}
if($chl=='rem'){
 
    $id2=$id_old+1;
    
 $bdid ="SELECT * FROM less_".$idbd." WHERE id=".$id2;
    $rdz = $bd->query($bdid);
    if ($rdz->num_rows > 0) {
        while($row = $rdz->fetch_assoc()) {
            $id12=$row['id'];
        }
    }
    if($id12=$id2){
        $sql = "DELETE FROM less_".$idbd." WHERE id=".$id2;

        if ($bd->query($sql) !== TRUE) {
        echo "Error: " . $bd->error;
        return 0;
        }
    }
}
echo 'ok';
return 0;
?>