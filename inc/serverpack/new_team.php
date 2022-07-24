<?php
$name=$com='';
$name=$_POST['name'];
$com=$_POST['com'];

if(str_replace(array(" ",  "<br />"), '', nl2br($name))==''){echo 'Error: No name'; return 0;}

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');


$id=$idb=0;
while($id==$idb){
    $id=rand(100000, 9999999);
    $bdid ="SELECT * FROM man_teams WHERE id_team=".$id;
    $rdz = $bd->query($bdid);
    if ($rdz->num_rows > 0) {
        while($row = $rdz->fetch_assoc()) {
          $idb=$row['id_team'];
        }
    }
}

/* ADD DATA TO MANAGER_TEAMS */

$sql = "INSERT INTO `man_teams` (`id_team`, `name_team`, `pass`, `id_admin`, `com_team`) VALUES
('".$id."', '".$name."', '".generatepass()."', '".$_SESSION['id']."', '".$com."')";

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}

/* CREATE TABLE TO LESS */

$sql = "CREATE TABLE `less_".$id."` (`id` int(11) NOT NULL AUTO_INCREMENT,
`name` text,`var` int(11) DEFAULT NULL,
`checkL` int(3) DEFAULT NULL, 
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}

/* CREATE TABLE TO DZ */

$sql = "CREATE TABLE `dz_less_".$id."` (
    `newid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `week` int(11) NOT NULL,
    `par_q` int(100) NOT NULL,
    `dz` text,
    `nph` int(11) DEFAULT NULL,
    `ph1` text,
    `ph2` text,
    `ph3` text,
    `ph4` text,
    `ph5` text,
    `day` int(11) DEFAULT NULL,
    `to_do` text,
    PRIMARY KEY (`newid`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}


/* INSERT USER TO NEW TEAM */
$sql = "INSERT INTO `userstoteams` (`userID`, `teamID`, `pos`) VALUES('".$_SESSION['id']."', '".$id."', 4);";

if ($bd->query($sql) !== TRUE) {
    echo "Error: " . $bd->error;
    return 0;
}
echo "ok";
?>