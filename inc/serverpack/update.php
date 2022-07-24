<?php 


if(!isset($new_id)){
    echo "Хм... что-то не так";
    return 0;
}

$sql = "UPDATE dz_less_".$idbd." SET dz='$dz',
`to_do`='$to_do',
 `ph1`='$ph[1]',
  `ph2`='$ph[2]',
   `ph3`='$ph[3]',
    `ph4`='$ph[4]',
     `ph5`='$ph[5]',
      `week`='$week', 
      `day`='$day', 
      `par_q`='$idtobd' 
      WHERE `newid`=$new_id; ";

    if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }

    echo "Данные обновлены!";

    mysqli_close($bd); 




?>