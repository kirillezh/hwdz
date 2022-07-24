<?php 
$databl=$id;
$d[1]="Понедельник";
$d[2]="Вторник";
$d[3]="Среда";
$d[4]="Четверг";
$d[5]="Пятница";
 $l=array_fill ( 0 , 553 , 0 );
$now = time();
$your_date = strtotime("2021-01-10"); 
$week = $now - $your_date;



$week=$weekl=floor($week / (60 * 60 * 24*7)+1); 



if(!isset($we)){$we=$week;}
$week_cent=$we%2;
if($week_cent==1){$week_cent=2;}
if($week_cent==0){$week_cent=1;}
include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');


 session_start(); 

       $bdid ="SELECT  name_team, com_team FROM man_teams WHERE id_team ='".$databl."' ";
     $rdz = $bd->query($bdid);
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
    $nameComm=$row["name_team"];
    $comComm=$row["com_team"];
  } }
  ?>
<!DOCTYPE HTML>
<html lang="ru">
 <head>
  <meta charset="utf-8">
  <meta property="og:image" content="<?php echo $_SERVER['SERVER_NAME']."/inc/serverpack/text2image.php?t=".$nameComm."&p=".$comComm; ?>">
  <title><?php echo $nameComm." – ".$comComm; ?> – Ёж Домашка</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/header.php'); ?>
 </head>
<?php 
 if (!preg_match('/^\+?\d+$/', $we)) {
  header( 'Location: /'.$id.'/', true, 307 );
  return 0;
}  
  if($we>$week+3){
    $week3=$week+3;
    header( 'Location: /'.$id.'/'.$week3.'/', true, 307 );
    return 0;
  }
if($we<6){
    header( 'Location: /'.$id.'/6/', true, 307 );
    return 0;
  }

 ?>

 <body>


  <?php 

  if (!is_enable($databl,$_SESSION['id'])) {
echo"<div class='noint'>
   <h1>Или у вас нету доступа к этой комнате, <br>
или такой комнаты не сущевствует.<br>
  </h1>   
  <h2><a href='/'>Перейти на главную страницу.</a>
</h2>
  </div>";
  return 0;
  } 

$datab="dz_less_".$databl;
$dataL="less_".$databl;
   ?>
 <div id="updz2"></div>
 <div id="stradding"></div>
  <div id="week0"></div>
  <script type="text/javascript">
     
     <?php if(is_it_admin($databl, $_SESSION['id']) AND isset($_SESSION['adm']) AND $_SESSION['adm']==1){ 
    $url_chg='/inc/serverpack/2_1.php';
   } else{ 
    $url_chg='/inc/serverpack/2.php'; } ?>

function onClick(id, week) {
  $( "body" ).css( "overflow", "hidden" ) ;
$.ajax({
  url: "<?php echo $url_chg; ?>",
  data: {"id": id, 
  "week": week, 
  "act": 1, 
  "bd_id": '<?php echo $id; ?>'},
  type: "POST",
  success: function(html) {
      $("#updz2").html(html);    
  }
});
}




function onClickT() {
  $( "body" ).css( "overflow", "auto" ) ;
      $("#updz2").html('');
}
function  opencus(){
$( "#Elem" ).css( "display", "block" ) ;
$( "#updz2" ).html("<div id='back' onclick='closecus()'></div>"
) ;
$( "body" ).css( "overflow", "hidden" ) ;
  }
  function  closecus(){
$( "body" ).css( "overflow", "auto" ) ;
$( "#Elem" ).css( "display", "none" ) ;
$( "#updz2" ).html("") ;
  }
  </script>


<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/footer.php');  ?>

 <content>

 <h1 style="text-align: center;" id="week">
  <?php    if($we<7){ echo "<a id='prev'  > <i  class='bi bi-arrow-left noinput' style='color: #606060;'></i>";}else{$week1=$we-1;
    echo "<a id='prev' href='/".$databl."/".$week1. "/'><i class='bi bi-arrow-left'></i>"; } ?>
    
  </a>
<a href="/inv/<?php echo $id; ?>/" id="altver" >
  <i class="bi bi-card-list"></i>
</a>
<?php if($we==$weekl){ echo "<p id='ned'>Настоящяя</p><p id='ded'>+0</p>";}else{echo "<p id='ned'>Неделя: </p>";if($weekl<$we){echo "+";}echo $we-$weekl;}?>

<?php    if($we-$weekl>=3){ echo "<a id='next' ><i class='bi bi-arrow-right noinput' style='color: #606060;'></i> ";}else{$week1=$we+1;
    echo "<a id='next' href='/".$databl."/".$week1. "/'><i class='bi bi-arrow-right'></i>"; } ?>
    
  </a>
 </h1>

  


<?php
$bdid ="SELECT * FROM less_".$id." ORDER BY `id` ASC";
$rdz = $bd->query($bdid);
$nte=1;
$lday=0;
$d[1]="Понедельник";
$d[2]="Вторник";
$d[3]="Среда";
$d[4]="Четверг";
$d[5]="Пятница";
$max_less=1;
$var = array();

if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
        $varn=floor($row['id']%10);
         $leeess=floor($row['id']%100/10);
         $day=floor($row['id']/100);

         $max_less=max($max_less, $leeess);
      
        $less[$day][$leeess][$varn]['id']=$row['id'];
         $less[$day][$leeess][$varn]['name']=$row['name'];
         
         $less[$day][$leeess][$varn]['var'] = $row['var'];
         
         if(gettype($less[$day][$leeess][$varn]['var'])=='NULL'){
           $var[$day][$leeess][$varn] = 0;
          }else{
          $var[$day][$leeess][$varn]=$less[$day][$leeess][$varn]['var'] ;}
    }

}
?> 
<?php
for($i=1;$i<=5;$i++){

    ?><div class="part">  <h1 id="day"><?php echo $d[$i]; ?></h1> <table id="allow"><tbody><?php
    $n=1;
    
    while($max_less>=$n){ ?><tr><td id="addlnoad"><table><tbody> <?php
     
        if(!isset($less[$i][$n][0]['id']) AND !isset($less[$i][$n][1]['id']) AND !isset($less[$i][$n][2]['id'])){
            echo "<tr><td><div class='redbg'></div></td></tr>";
        }elseif(isset($less[$i][$n][0]['id'])){ if($var[$i][$n][0]==$week_cent){echo "<tr><td><div class='redbg'></div></td></tr>";}else{ ?><tr><td><a onclick="onClick(<?php echo $less[$i][$n][0]['id'];?>, <?php echo $week; ?>)" id="updz"><h5 class="les"><?php
            echo $less[$i][$n][0]['name'];  ?></h5></a></td></tr> <?php
        }}else{ ?> <tr><td style="border-right:1px solid black;" class="row_2"> <?php
            if(isset($less[$i][$n][1]['id'])){ if($var[$i][$n][1]==$week_cent){echo "<div class='redbg'></div>";}else{
            echo "<a onclick='onClick(".$less[$i][$n][1]['id'].",".$week.")' id='updz'><h5 class='les' id='no1'>".$less[$i][$n][1]['name']."</h5></a>";
            }}else{
                echo "<div class='redbg'></div>";
            }
            ?></td><td class="row_2"><?php
            if(isset($less[$i][$n][2]['id'])){if($var[$i][$n][2]==$week_cent){echo "<div class='redbg'></div>";}else{
                echo "<a onclick='onClick(".$less[$i][$n][2]['id'].",".$week.")' id='updz'><h5 class='les' id='no1'>".$less[$i][$n][2]['name']."</h5></a>";
                }}else{
                    echo "<div class='redbg'></div>";
            }
            ?></td></tr><?php
        }
        $n++;
        ?></tr></td></table></tbody><?php
    }
    ?>
    </tbody></table></div>
    <?php
}


?>
   </content>
 
 </body>
</html>