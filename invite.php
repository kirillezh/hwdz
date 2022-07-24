<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Редактирование списка – Ёж Домашка</title>
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
    <?php
    //if(!isset($id)){header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');require __DIR__ . '/404.php';return 0;}
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
    if(is_it_ID($id, $_SESSION['id'])){header( 'Location: /100000/', true, 307 ); return 0;}
    include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/footer.php');
    include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
    if(!isset($pass)){
        ?>
        <div class="form">
            <h1>Вход в группу:</h1>
        <div class="form-floating">
        <input type="password" class="form-control" id="pass" placeholder="Пароль">
        <label for="pass">Пароль</label>
        </div>
        <button onclick="check()" id='post_invite'>Войти</button>
        <h3 id='out'>или</h3>
        <button onclick="post_check()" id='post_invite'>Отправить запрос</button>
        </div>
        <style>
        .form {
        max-width: 400px;
        }
    </style>
    <script>
        function post_check() {
            $.ajax({
            url: '/inc/serverpack/post-invite.php',
            data: {
                "cus": 1,
                "id": <?php echo $id; ?>
            },
            type: "POST",
            success: function(html) {
                if(html=='ok'){
                    $('#ven').addClass('ena');
                    $("#ven").html("Успешно");   
                    setTimeout(() => window.location.href = <?php echo "/".$id."/"; ?>, 5000);
                }
                else{
                    $('#err').addClass('ena');
                    $("#err").html(html);   
                    setTimeout(() => $('#err').removeClass('ena'), 6000);
                }
            }
            });
            }
        function check() {
            var pass = document.getElementById("pass").value;
            $.ajax({
            url: '/inc/serverpack/post-invite.php',
            data: {
            "cus": 0,
                "id": <?php echo $id; ?>,
            "pass": pass
            },
            type: "POST",
            success: function(html) {
                if(html=='ok'){
                    $('#ven').addClass('ena');
                    $("#ven").html("Успешно");   
                    setTimeout(() => window.location.href = <?php echo "/".$id."/"; ?>, 5000);
                }
                else{
                    $('#err').addClass('ena');
                    $("#err").html(html);   
                    setTimeout(() => $('#err').removeClass('ena'), 6000);
                }
            }
            });
            }
    </script>
        <?php
    }else{
        $bdid = "SELECT * FROM man_teams WHERE id_team=".$id;
        $rdz = $bd->query($bdid);
        $pass_bd='';
        if ($rdz->num_rows > 0) {
            while($row = $rdz->fetch_assoc()) {
                $pass_bd=$row['pass'];
            }
        }
        if($pass_bd=='' OR $pass_bd!=$pass){
            echo "Не правильный пароль";
            return 0;
        }

        $sql = "INSERT INTO userstoteams (userID, teamID, inf) VALUES ('".$_SESSION['id']."', '".$id."', '1') ";
                if ($bd->query($sql) !== TRUE) {
                    echo "Error: " . $bd->error;
                    return 0;
                }
                echo "<script>window.location.href = '/".$id."/';</script>";
    }
    ?>
</body>
</html>