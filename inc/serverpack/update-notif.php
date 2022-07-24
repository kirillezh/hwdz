<?php

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

if($_POST['d']=='d'){
    echo notif_ul();
    return 0;
}

$ul=notif_ul();



$sql = "UPDATE `notification` SET `verif`=1 WHERE to_id=".$_SESSION['id'];
if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}
if($ul==notif_ul()){
    echo 'ok';
    return 0;
}
echo notif_ul();
return 0;
?>