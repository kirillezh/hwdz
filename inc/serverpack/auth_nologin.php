<?php 

session_start();

$bdint ="SELECT login FROM users WHERE id='".$_SESSION['id']."'";
$rdz = $bd->query($bdint);        

if ($rdz->num_rows > 0) {
	while($row = $rdz->fetch_assoc()) {
$login=$row['login'];
	}
}
if($login==$_SESSION['login'] and $login==""){
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
	</head>
	<body>
		
	</body>
	</html>
	<?php
}

 ?>