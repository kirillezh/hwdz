<?php
$id=$_POST['id'];
$idbd=$_POST['idbd'];

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
if(!is_it_really_admin($idbd, $_SESSION['id'])){
return "Ошибка";
}
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$name='';
$var=0;

$bdid ="SELECT * FROM less_".$idbd." WHERE id=".$id;
    $rdz = $bd->query($bdid);
    if ($rdz->num_rows > 0) {
        while($row = $rdz->fetch_assoc()) {
            $name=$row['name'];
            $var=$row['var'];
        }
    }
?>
<script>
function close_bg() {$("#udz").html('');} 

function del(id) {
            $.ajax({
            url: '/inc/serverpack/delete-less.php',
            data: {"id": id, 
            "idbd": <?php echo $idbd; ?>,
            },
            type: "POST",
            success: function(html) {
                if(html=='ok'){
                    $("#n<?php echo $id; ?>").html('<div class="change"><i class="bi bi-plus"></i></div>');
                    $('#ven').addClass('ena');
                    $("#ven").html('Сохранено');
                    setTimeout(() => $('#ven').removeClass('ena'), 6000);
                    $("#udz").html('');
                }else{
                    $('#err').addClass('ena');
                    $("#err").html(html);   
                    
                    setTimeout(() => $('#err').removeClass('ena'), 6000);
                }
            }
            });
            }

$(document).ready(function () {
    $("form").submit(function(e) {
    e.preventDefault();

    if($('#flexRadioDefault1').prop('checked')){
        var radio = '0';
    }
    else if($('#flexRadioDefault2').prop('checked')){
        var radio = '2';
    }
    else if($('#flexRadioDefault3').prop('checked')){
        var radio = '1';
    }else{
        var radio = '0';
    }
        $.ajax({
            url: '/inc/serverpack/add-less.php',
            data: {"id": <?php echo $id; ?>, 
            "name": $("#name").val(), 
            "idbd": <?php echo $idbd; ?>,
            "radio": radio},
            type: "POST",
            success: function(html) {
                if(html=='ok'){
                    $("#n<?php echo $id; ?>").html('<h5 class="les chang">'+$("#name").val()+'</h5>');
                    $('#ven').addClass('ena');
                    $("#ven").html('Сохранено');
                    setTimeout(() => $('#ven').removeClass('ena'), 6000);
                }else{
                    $('#err').addClass('ena');
                    $("#err").html(html);   
                    setTimeout(() => $('#err').removeClass('ena'), 6000);
                }
            }
        });
    });
});
</script>
    <a onclick="close_bg()"><div class="bg_close"></div></a>
    <div class="chgls">
    <a id="exit" onclick="close_bg()"><i class="bi bi-x-lg"></i>	</a>
    <form method="POST"  >
    <div class="form-floating">
        <textarea  name="name"class="form-control" id="name"><?php if($name!=''){echo $name;}?></textarea>
        <label for="name" style="color: #676767;">Название</label>
    </div>
    <br>
    <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioDefault1" value="0" <?php if($var!=1 AND $var!=2){echo "checked";} ?> >
  <label class="form-check-label" for="flexRadioDefault1" >
    Урок каждую неделю
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioDefault2" value="2" <?php if($var==2){echo "checked";} ?>>
  <label class="form-check-label" for="flexRadioDefault2">
    Урок через неделю(чётную)
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadio" id="flexRadioDefault3" value="1" <?php if($var==1){echo "checked";} ?>>
  <label class="form-check-label" for="flexRadioDefault3">
    Урок через неделю(нечётную)
  </label>
    <div class="btn-group" role="group" aria-label="Basic example">
    <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
    <button type="button" class="btn btn-danger" onclick='del(<?php echo $id; ?>)'>Удалить</button>
    </div>
</div>
    
</div>
