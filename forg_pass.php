<head>
  <link rel=”icon” href=inc/ico.png type=”image/x-icon”>
  <meta charset="utf-8">
  <title>Востановление пароля – Ёж Домашка</title>
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
    <div>
        <div id='ven'></div>
    <div class="loginisation">
        <h1>Востановление пароля:</h1>
        <div class="form-floating">
            <input type="text" class="form-control" id="txt_bar" placeholder="Email or login" name="login" autocomplete="username" required>
            <label for="txt_bar" >Логин или электронная почта</label>
        </div>
        <div class="form-floating" id='code' >
        </div>
        <div id='sucbm'>
            <input class="btnsubmlg" type="submit" value="Востановить" name="submit" id='butsubm'/>
        </div>    
        <script>
            butsubm.onclick = function() {
                $.ajax({
                    url: '/inc/serverpack/forgpass_ser.php',
                    data: {
                        "login": $("#txt_bar").val(), 
                    },
                    type: "POST",
                    success: function(html) {
                        if(html='ok'){
                            $('#ven').addClass('ena');
                            $("#ven").html('Письмо отправлено. <br> Письмо могло попасть в папку "Спам"');
                            $("#code").html('<input type="text" class="form-control" id="code" placeholder="code" name="code" required><label for="code" >Код</label>');
                            $("#sucbm").html('<input class="btnsubmlg" type="submit" value="Востановить" name="submit" id="butsubm_2"/>');
                            setTimeout(() => $('#ven').removeClass('ena'), 6000);
                        
                        }else{
                            $('#ven').addClass('ena');
                            $("#ven").html(html);
                            setTimeout(() => $('#ven').removeClass('ena'), 6000);
                        }
                        } 
                });
            };
        </script>
    </div>