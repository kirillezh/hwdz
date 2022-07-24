  <?php session_start(); 

if(!isset($_SESSION['id'])){
header("Location: /login/");
return 0;
}
if(!isset($_POST['act']) OR $_POST['act']!=1){
  echo "Хм... ты явно попал не туда.";
return 0;
}


  //Check connect
include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
//Include package
$id=$_POST['id'];
$week=$_POST['week'];
$bd_id=$_POST['bd_id'];
$day=floor($id/100);
$less=($id/10)%10;
$var=$id/10;
$idtobd=$id%100;
//Int intenger

$dz ="SELECT dz, ph1, ph2, ph3, ph4, ph5, nph, to_do FROM dz_less_".$bd_id." WHERE week = '".$week."' AND par_q = '$idtobd' AND day = '$day' ";
$rdz = $bd->query($dz);
$ntl=0;
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$dz_name= $row["dz"];
$ph[1]=$row["ph1"];
$ph[2]=$row["ph2"];
$ph[3]=$row["ph3"];
$ph[4]=$row["ph4"];
$ph[5]=$row["ph5"];
$to_do=$row["to_do"];
$ntl++;
  }
}
//BD_DZ

$leSS ="SELECT name FROM less_".$bd_id." WHERE id='$id' ";
$rdz = $bd->query($leSS);
$name=0;
if ($rdz->num_rows > 0) {
  while($row = $rdz->fetch_assoc()) {
$name=$row["name"];
}
  }
// Name less
?>
<a id="exitbg" onclick="onClickT()"></a>
<div class="updzin">
<div id="result"> </div>
<a id="exit" hotkey="Esc" onclick="onClickT()"><i class="bi bi-x-lg"></i> </a>
<div class="headern" style="background: rgb(<?php
 if($id==110 or $id==210){
  echo $day*100 ?> 
  <?php echo  $less*100+5 ?> 
  <?php echo 135 ?> <?php } else{
   echo $day*50+5 ?> 
   <?php echo  $less*50+5 ?> 
   <?php echo $var*120+15?><?php  } ?>);"><h1><?php echo $name; ?></h1></div>

   <script>

  $(document).ready(function () {
                var step, ph=[];


  $("form").submit(function(e) {
  for (step = 1; step <= 5; step++) {
  ph[step]=$('#ph_'+step).val();
  if(typeof(ph[step]) == "undefined" || ph[step] == null){
    ph[step]='';
  }
  }

    e.preventDefault();
    $.post('/inc/serverpack/create.php', {
        dz: $("#dzn").val(),
        to_do: $("#todz").val(),
        week: "<?php echo $week; ?>",
        ph_1: ph[1],
        ph_2: ph[2],
        ph_3: ph[3],
        ph_4: ph[4],
        ph_5: ph[5],
        idbd: "<?php echo $bd_id; ?>",
        id: "<?php echo $id; ?>" 
      },
      function(result) {
        if (result == "succes") {
          $('#result').addClass('ena');
          $("#result").html("Данные добавлены...");
          
         setTimeout(() => $('#result').removeClass('ena'), 6000);
        } else if(result =="succes0"){
$('#result').addClass('ena');

          $("#result").html("Данные обновлены...");
          
         setTimeout(() => $('#result').removeClass('ena'), 6000);

        }else{
          $('#result').addClass('ena');
$("#result").html(result);          
         setTimeout(() => $('#result').removeClass('ena'), 6000);
        }
      }
    );
  });
  });
</script>

  <form method="POST" action="create.php" >

<div class="form-floating">
  <textarea  name="dz"class="form-control" placeholder="Leave a comment here" id="dzn" ><?php if($ntl>0 ){echo $dz_name;}?></textarea>
<label for="dzn" style="    color: #676767;">Домашние задание</label>
</div>
<br>
<div class="form-floating">
  <textarea name="to_do" class="form-control" placeholder="" id="todz"><?php if($ntl>0 or $to_do=""){echo $to_do; }?></textarea>
  <label for="to_do">Метод отправки:</label>
</div>
<script>
    function strad2(){
       $.ajax({
    url: '/inc/pack/photolib.php',
    type: "POST",
    success: function(html) {
      var x;
      x=document.querySelectorAll("#stradding");
      x[0].classList.add('str2');
      $("#stradding").html(html);
    }
  });
    }
    function delph(id){
      $("#phdiv_"+id).html('');
      document.getElementById('phdiv_'+id).style.display = 'none';
    }
</script>

  <div class="addph">
  <a  onclick="strad2()">
    Добавить фото
  </a>
  </div>
  <div id="photoidl">
    <?php if($ntl>0){ 
for($ntl=1; $ntl<=5; $ntl++){
if($ph[$ntl] != ""){
  $ntl2=$ntl+1;
  echo "<div class='imgimfinf' id='phdiv_".$ntl."'><div class='imgstrlib'  style='background-image:url(".$ph[$ntl].")'></div><input name='ph_".$ntl."' id='ph_".$ntl."' type='text' value='".$ph[$ntl]."' disabled><button class='butdelph' onclick='delph(".$ntl.")'><i class='bi bi-x-lg'></i></button></div>";
}
}
}
      ?>
  </div>


<?php if($ntl>0){ ?>
  <script>
  function del() {
    $.ajax({
  url: '/inc/serverpack/2_d.php',
  data: {
        week: "<?php echo $week; ?>",
        day: "<?php echo $day; ?>",
        idbd: "<?php echo $bd_id; ?>",
        par_q: "<?php echo $idtobd; ?>" 
      },
  type: "POST",
  success: function(html) {

          
          if(html=="removed"){
            $('#result').addClass('ena');
            $("#result").html("Данные удалены...");
            setTimeout(() => $('#result').removeClass('ena'), 6000);
         setTimeout(() => $('#updz2').html(''), 1000);
       }else{
        $('#result').removeClass('ena');
        $('#result').addClass('ena');
        $("#result").html(html);
         
       }
       }
});
  }
</script>

  <div class="btn-group" role="group" >
  <button type="button" class="btn btn-danger" id="delete" onclick="del()">Удалить запись</button>
  
  <button type="submit" hotkey="Shift + Enter" class="btn btn-success">Обновить</button>
</div>

<?php }else{ ?>
<div class="btn-group" role="group">
<button type="submit" hotkey="Shift + Enter" class="btn btn-success">Добавить</button>
</div>  
  </form>

<?php } ?>

</div>
<?php
 //Out Check connection