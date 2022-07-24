<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Создание группы – Ёж Домашка</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
 
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/header.php'); ?>
</head>
<body>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/footer.php'); ?>
    <div id="err"></div>
    <div id="udz"></div>
    <div id="ven"></div>

<div class="form">
  <h1>Создание группы:</h1>
<div class="form-floating">
  <textarea  name="name"class="form-control" id="name" ></textarea>
<label for="name" style="color: #676767;">Название</label>
</div>
<div class="form-floating">
  <textarea  name="com"class="form-control" id="com" ></textarea>
<label for="com" style="color: #676767;">Описание</label>
</div>
<button type="submit" class="btn btn-success" id='create'>Создать</button>


</div>

<script>
  create.onclick = function() {
    if($("#name").val()==''){
        alert('Введите имя');
        return 0;
    }
    $.ajax({
            url: '/inc/serverpack/new_team.php',
            data: {
            "name": $("#name").val(), 
            "com": $("#com").val(), 
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
</script>

</body>
</html>