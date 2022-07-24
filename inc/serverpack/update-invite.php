<?php 

$change=$_POST['change'];
$idbd=$_POST['idbd'];
$from=$_POST['from'];

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
if(!is_it_really_admin($idbd, $_SESSION['id'])){
echo "Ошибка";
return 0;

}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$bdid ="SELECT * FROM `notification` WHERE `from_id`=".$from."AND `text`='".$idbd."'";
    if($change==0){
        $sql = "UPDATE `notification` SET code='206' WHERE  `from_id`='".$from."' AND `text`='".$idbd."' AND code = 202";
        if ($bd->query($sql) !== TRUE) {
            echo "Error: " . $bd->error;
            return 0;
        }
        $sql = "UPDATE `notification` SET code='204' WHERE `to_id`='".$from."' AND `text`='".$idbd."' AND code=201";
        if ($bd->query($sql) !== TRUE) {
            echo "Error: " . $bd->error;
            return 0;
        }
    }elseif($change==1){
        $sql = "UPDATE `notification` SET code='205' WHERE `from_id`='".$from."' AND `text`='".$idbd."' AND code = 202";
        if ($bd->query($sql) !== TRUE) {
            echo "Error: " . $bd->error;
            return 0;
        }
        $sql = "UPDATE `notification` SET code='203' WHERE `to_id`='".$from."' AND `text`='".$idbd."' AND code = 201";
        if ($bd->query($sql) !== TRUE) {
            echo "Error: " . $bd->error;
            return 0;
        }
        $sql = "INSERT INTO `userstoteams` (`userID`, `teamID`, `pos`) VALUES ('".$from."', '".$idbd."', '1')";
        if ($bd->query($sql) !== TRUE) {
            echo "Error: " . $bd->error;
            return 0;
        }
    }
    echo 'ok';
    return 0;

?>