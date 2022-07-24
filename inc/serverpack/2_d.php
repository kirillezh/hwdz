<?php     
    $par_q  = $_POST['par_q'];
    $week  = $_POST['week'];
    $day  = $_POST['day'];
$idbd=$_POST['idbd'];
    include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
    $sql = "DELETE FROM dz_less_".$idbd." WHERE par_q = '$par_q' AND day = '$day' ";
    if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }
    echo "removed";
    mysqli_close($bd); 

?>