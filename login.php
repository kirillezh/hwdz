	<head>
  <link rel=”icon” href=inc/ico.png type=”image/x-icon”>
  <meta charset="utf-8">
  <title>Авторизация – Ёж Домашка</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

  <?php include "inc/pack/header.php" ?>
 </head>
	 
   <?php 
   session_start();
   if(isset($_SESSION['id'])){
    header("Location: /");
    return 0;
   }
   

    ?>
<?php if(isset($_GET['red'])){$red=$_GET['red'];}else{$red='';} ?>



<div class="loginisation">

<h1 id="InAcc">Вход в аккаунт:</h1>

</br>
<form id="loginform">
    <div class="form-floating mb-3">
  <input type="text" class="form-control" id="login" placeholder="name@example.com" name="login" autocomplete="username" required>
  <label for="login">Логин или электронная почта</label>
</div>
<div class="form-floating">
  <input type="password" class="form-control" id="password" placeholder="Password" name="password" id="pass" autocomplete="current-password"  required>
  <label for="password" >Пароль</label>
  </div>
<a href="/auth/forg_pass/">Забыли пароль?</a>

  <input class="btnsubmlg" type="button" onclick="open_post()" value="Войти" name="submit" />
    <script async src="https://telegram.org/js/telegram-widget.js?15" data-telegram-login="hwdz_api_bot" data-size="large" data-userpic="false" data-onauth="onTelegramAuth(user)"></script>
    <script type="text/javascript">
  function onTelegramAuth(user) {

    $.ajax({
  url: '/auth/auth_telegram/',
  data: {"first": user.first_name, "last": user.last_name, "id": user.id,  "login": user.username, "photo": user.photo_url},
  type: "POST",
  success: function(html) {
     if(html==100){
       <?php if($red!=''){ ?>
        document.location.href = <?php echo $red; ?>;
      <?php }else{ ?>
      document.location.href = "/";
      <?php } ?>
     }
  } 
  });

  }
  function open_post(){
    if($('#login').val()=='' ){
      var errorlog = document.getElementById("errorlog");
      errorlog.innerText = 'Вы не ввели логин';
      errorlog.classList.add("ena");
      return;
    }
    if($('#password').val()=='' ){
      var errorlog = document.getElementById("errorlog");
      errorlog.innerText = 'Вы не ввели пароль';
      errorlog.classList.add("ena");
      return;
    }
  $.ajax({
  url: '/auth/login_ser/',
  data: {
    "login": $('#login').val(), 
    "password": $('#password').val()},
  type: "POST",
  success: function(html) {
     if(html==100){
       <?php if($red!=''){ ?>
        document.location.href = <?php echo $red; ?>;
      <?php }else{ ?>
      document.location.href = "/";
      <?php } ?>
     }else if(html=101){
      var errorlog = document.getElementById("errorlog");
      errorlog.innerText = 'Вы ввели неправильный пароль или логин';
      errorlog.classList.add("ena");
    }else if(html=102){
      var errorlog = document.getElementById("errorlog");
      errorlog.innerText = 'Регистрация была проведена через "Вход с помощью Telegram"';
      errorlog.classList.add("ena");
     }

  } 
  });
  event.preventDefault();
}

</script>

</form>




<p style="color: gray;font-size: 18px;margin-top:5px; text-align: left;">Ещё нету аккаунта? <a href="/auth/register/<?php if($red!=''){ echo "?red=".$red;} ?>">Зарегистрируйтесь</a></p>
</div>