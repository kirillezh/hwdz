
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Главная страница – Ёж Домашка</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/header.php'); ?>
</head>
<body>
<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
 ?>
<div id="addroom" style="position: absolute;"></div>


<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/footer.php'); ?>

<div id="updz2"></div>



<?php $bdid ="SELECT teamID,pos FROM userstoteams WHERE userID = '".$_SESSION['id']."' ";
$rdz = $bd->query($bdid);
$nte=1;
if ($rdz->num_rows > 0) {
    
  while($row = $rdz->fetch_assoc()) {
    $teamID[$nte]=$row["teamID"];
    $pos[$nte]=$row["pos"];
    $nte++;

  }
  }
  ?>
<script>
  $(document).ready(function () {
    var date = new Date();
    dateload=date.getHours();
    $.post('inc/serverpack/datestart.php', 
      {
        data:dateload,
        gmt: date.getTimezoneOffset()
      },
      function(result) {
        $("#hoursrightless").html(result); 
      }
      );
    });
</script>
<div class="row_team">
    <h1 id="hoursrightless"></h1>

<?php
  for($nte2=1;$nte2<$nte;$nte2++){
$nte3=$nte2;
    $posist=$teamID[$nte2];
     $bdid ="SELECT  name_team,com_team FROM man_teams WHERE id_team ='$posist' ";
     $rdz = $bd->query($bdid);
     $load=0;
if ($rdz->num_rows > 0) {

  while($row = $rdz->fetch_assoc()) {
    $name=$row["name_team"];

    $com=$row["com_team"];
$load++;
?>

<div class="team" style="background: linear-gradient(31deg, <?php echo "#".to_text($name.$com) ?>, #252525);
">
    <div id="del"><button type="button" class="btn-close btn-close-white" onclick="delUinT(<?php echo $_SESSION['id'].", ".$posist; ?>)" aria-label="Close"></button></div>
    <a href="/<?php echo $teamID[$nte2];  ?>/">
      
        <h4><?php echo who_you($_SESSION['id'], $posist) ?></h4>
        <div id="name">
          <h2 title='<?php echo $name; ?>'><?php echo $name; ?></h2>  
          <h3><?php echo $com; ?></h3>
        </div>
    </a> 
</div>

  <?php }
}?>


<?php  }
if($nte==1){?>

<h1 class="noteam"><p>Команда отсутствует</p></h1>

<?php
}
?>
</div>
   <script>
    function delUinT(idU,idT) {
    $.ajax({
  url: 'deluserinteam.php',
  data: {"act1": 1, "idU":idU,"idT":idT},
  type: "POST",
  success: function(html) { 
    $("#updz2").html(html);
      setInterval(function() {
 location.reload();
}, 1000);
  }
});
}
</script>
</body>
</html>