
    <?php
    
    if(!isset($id)){header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');require __DIR__ . '/404.php';return 0;}
    include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
    if(!is_it_really_admin($id, $_SESSION['id'])){
      header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
      require __DIR__ . '/404.php';
      return 0;
  }
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/footer.php');
    
    include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
    
    $bdid ="SELECT * FROM man_teams WHERE id_team=".$id;
    $rdz = $bd->query($bdid);
    if ($rdz->num_rows > 0) {
        while($row = $rdz->fetch_assoc()) {
          $name=$row['name_team'];
          $com=$row['com_team'];
        }
    }

    ?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Настройки группы – <?php echo $name; ?> – Ёж Домашка</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/header.php'); ?>
</head>
<body>
    <div id="err"></div>
    <div id="udz"></div>
    <div id="ven"></div>

<div class="form">
  <h1>Редактирование группы:</h1>
<div class="form-floating">
  <textarea  name="name"class="form-control" id="name" ><?php if(isset($name)){echo $name;}?></textarea>
<label for="name" style="color: #676767;">Название</label>
</div>
<div class="form-floating">
  <textarea  name="com"class="form-control" id="com" ><?php if(isset($com)){echo $com;}?></textarea>
<label for="com" style="color: #676767;">Описание</label>
</div>
<button type="submit" class="btn btn-success" id='edit'>Сохранить</button>
<button type="submit" class="btn btn-danger" id='del'>Удалить</button>


</div>

<script>
  edit.onclick = function() {
    $.ajax({
            url: '/inc/serverpack/setting-save.php',
            data: {
            "idbd": <?php echo $id; ?>,
            "name": $("#name").val(), 
            "com": $("#com").val(), 
            },
            type: "POST",
            success: function(html) {
              if(html=='ok'){
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
  }
  del.onclick = function() {
    if (confirm("Точно хочешь удалить группу? \nВсе участники и все данные будут удалены")) {
      $.ajax({
            url: '/inc/serverpack/delete-team.php',
            data: {
            "id": <?php echo $id; ?>,
            },
            type: "POST",
            success: function(html) {
              if(html=='ok'){
                window.location.href = '/';
                }else{
                    $('#err').addClass('ena');
                    $("#err").html(html);   
                    setTimeout(() => $('#err').removeClass('ena'), 6000);
                }
            }
            });
    }
  };
</script>

</body>
</html>