<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
  <link rel=”icon” href=inc/ico.png type=”image/x-icon”>
  <meta charset="utf-8">
  
  <title>Регистрация – Ёж Домашка</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

  <?php include "inc/pack/header.php" ?>

  <?php if(isset($_GET['red'])){$red=$_GET['red'];}else{$red='';} ?>
  <script>
  $(document).ready(function () {
  $("#loginform").submit(function(e) {
  	$('#err').html("");
    e.preventDefault();
   	 $.post(
      '/inc/serverpack/registerserver.php', {
        name: $("#name").val(),
        surname: $("#surname").val(),
        login: $("#login").val(),
        email: $("#email").val(),
        password: $("#pass").val(),
      },
      function(result) {
        if (result == "") {
            document.location.href = "/auth/login/<?php if($red!=''){ echo "?red=".$red;} ?>";
        }else{
        	$('#err').html("<div id='errorlog'></div>");
          $("#errorlog").html(result);
           setTimeout(() => $('#err').removeClass('add'), 6000);
        }
      }
    );
  });
  });
  </script>

</head>
<body>
	<div id="err"></div>
	<div class="loginisation">
	<form method="POST" id="loginform" autocomplete="on">
  <h1>Регистрация</h1>
  <small style="color: red;">* Отмеченые поля обязательны для заполнения</small>
<div class="row">
  <div class="col">
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="name" placeholder="Имя" name="name" autocomplete="name" required>
  <label for="name" >Имя*</label>
  </div>
</div>
  <div class="col">
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="surname" placeholder="Фамилия" name="surname" autocomplete="lastname">
  <label for="surname">Фамилия</label>
  </div>
</div>
</div>
<div class="form-floating mb-3">
  <input type="text" class="form-control" id="login" placeholder="login" name="login" required autocomplete="username">
  <label for="login">Логин*</label>
</div>
<div class="form-floating mb-3">
  <input type="email" class="form-control" id="email" autocomplete="home email"  placeholder="exemple@gmail.com" name="email" required>
  <label for="email">Электронный адрес*</label>
</div>
<div class="form-floating">
  <input type="password" class="form-control" id="pass" placeholder="Password" name="password" autocomplete="new-password" required>
  <label for="pass">Пароль*</label>
</div>

<div class="form-floating mb-3">
  <input class="btnsubmlg" id="sbmreg" class="button" type="submit" value="Зарегистрироваться" name="submit" hotkey="Enter" />

</div>
</form>
<p  style="color: gray; font-size: 18px;margin-top: 5px; text-align: left;" hotkey="Esc">Уже зарегистрированы? <a href="/auth/login/<?php if($red!=''){ echo "?red=".$red;} ?>">Войти</a></p>
</div>
</body>
</html>