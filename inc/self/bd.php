<?php 

$bd = new mysqli('localhost', '', '', '')
or die("Ошибка " . mysqli_error($bd)); 
mysqli_set_charset($bd, "utf8mb4");
 ?>
