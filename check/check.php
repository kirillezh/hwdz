<?php 
if($_POST['update']==1){
	include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

session_start();

$date = date("Y-m-d H:i:s");
$date_d=date("Y-m-d");

$dz ="SELECT * FROM activeuser WHERE userid = '".$_SESSION['id']."' ";
$rdz = $bd->query($dz);
$ntl=0;
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$ntl++;
  }
}

if($ntl==0){
$sql = "INSERT INTO activeuser (userid, dataint, dateintegare) VALUES ('".$_SESSION['id']."', '$date', '$date_d')";
}else{
	$sql = "UPDATE activeuser SET dataint = '$date', dateintegare = '$date_d' WHERE userid = '".$_SESSION['id']."' " ;
}

 if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }
}

 ?>