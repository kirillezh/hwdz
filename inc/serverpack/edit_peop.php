<?php 
session_start();
$id=$_POST['id'];
$ed=$_POST['ed'];
$idbd=$_POST['idbd'];

if($ed>2 OR $ed<0){ return 'error'; }


include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

if(!is_it_really_admin($idbd, $_SESSION['id'])){return 'error';}

if($ed==2 AND is_it_red_admin($idbd, $id)){return 'error';}

if($ed==2 AND is_it_red_admin($idbd, $_SESSION['id'])){

  $sql = "DELETE FROM userstoteams WHERE userID=".$id." AND teamID=".$idbd;
  if ($bd->query($sql) !== TRUE) {
      echo "Error: " . $bd->error;
      return 0;
  }
  echo 'ok';
return 0;
}


$query_bd ="SELECT iD, pos FROM userstoteams WHERE userID = '$id' and teamID = '$idbd' ";
$rdz = $bd->query($query_bd);
 $nte=0;
if ($rdz->num_rows > 0) {
   
  while($row = $rdz->fetch_assoc()) {
  	$iD=$row['iD'];
  	$pos=$row['pos'];
    $nte++;
}
}
if($nte==0){return 'error';}

if(($pos==3 AND $ed==1) OR ($pos==1 AND $ed==0)){return 'error';}

if($ed==1){$pos++;}
if($ed==0){$pos--;}

$sql = "UPDATE userstoteams SET `pos` = '".$pos."' WHERE `iD`='".$iD."' ";

    if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }
   echo 'ok';

 ?>
