<?php if($_POST['act'] != 1) {
  echo "Хм... ты явно попал не туда.";
  return 0;
}

$now = time();
$your_date = strtotime("2021-01-10"); 
$week = $now - $your_date;
$week=$weekl=floor($week / (60 * 60 * 24*7)+1); 

$week=$_POST['week'];
$bd_id=$_POST['bd_id'];
$id=$_POST['id'];
$idtobd=$id%100;
$day=floor($id/100);
$less=($id/10)%10;
$var=$id/10;

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

 $leSS ="SELECT name FROM less_".$bd_id." WHERE id='$id' ";
$rdz = $bd->query($leSS);
$name=0;
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$name=$row["name"];
}
  }
 

?>
<a id="exitbg" onclick="onClickT()" hotkey="Esc"></a>
<div class="updzin">

	<a id="exit" onclick="onClickT()"><i class="bi bi-x-lg"></i>	</a>
	
<?php 
if($week%2 != 0){
  $ls[310]=1;
}else{
  $ls[310]=0;
} ?>
<div class="headern" style="background: rgb(<?php
 if($id==110 or $id==210){
 	echo $day*100?> <?php echo $less*100+5 ?> <?php echo 120+15 ?> <?php } else{ echo $day*50+5 ?> <?php echo  $less*50+5 ?> <?php echo $var*120+15?><?php }?>);">
 	<h1><?php echo $name; ?></h1></div>
 	  <div class="block_dz">
 	  	
 	  		<?php 
$dz ="SELECT dz, ph1, ph2, ph3, ph4, ph5, nph, to_do FROM  dz_less_".$bd_id." WHERE week = '$week' AND par_q = '$idtobd' AND day = '$day' ";
$rdz = $bd->query($dz);

if ($rdz->num_rows > 0) {

	?>
<h2><b id="dzz">Домашнее Задание: </b>
	<?php
  while($row = $rdz->fetch_assoc()) {

    $dz=$row["dz"];
$nph=$row["nph"]; 
$ph[1]=$row["ph1"];
$ph[2]=$row["ph2"];
$ph[3]=$row["ph3"];
$ph[4]=$row["ph4"];
$ph[5]=$row["ph5"];
$to_do=$row["to_do"];
?>
    <?php

  }
  ?>
  <div id="dz"><?php echo nl2br($dz); ?></div>
 	</h2>
 	<h3><b id="dzz">Метод отправки: </b><?php echo $to_do; ?></h3>
 	<?php
 	$lnhw=1;
 	

 	for ($i=1; $i <= 5; $i++) { 
 		if($ph[$i]!=""){?>


 		<div data-fancybox="gallery" class="img"><img src=<?php echo $ph[$i]; ?>></div>
 		
 	<?php } }

}else{?>
<h2 class="dznone"><b>Домашнего задания не найдено.</b>
	<?php
}
?>
 </div>
</div>