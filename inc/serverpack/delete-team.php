<?php
$id=$_POST['id'];

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
if(!is_it_really_admin($id, $_SESSION['id'])){
echo "Ошибка";
return 0;

}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

/* DELETE TABLE DZ */

$sql = "DROP TABLE dz_less_".$id;

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}

/* DELETE TABLE LESS */

$sql = "DROP TABLE less_".$id;

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}


/* DELETE TEAMS FROM MANAGER TEAMS */

$sql = "DELETE FROM `man_teams` WHERE `id_team`=".$id;
if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}

/* DELETE USER TO NEW TEAM */
$sql = "DELETE FROM `userstoteams` WHERE `teamID`=".$id;

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}
echo "ok";
?>