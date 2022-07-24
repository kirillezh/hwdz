

<?php

session_start();
include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');


if(isset($_POST['upd']) AND $_POST['upd']=='check'){
    $name  = mysqli_real_escape_string($bd,$_POST['name']);
    $surname  = mysqli_real_escape_string($bd,$_POST['surname']);
    $login  = mysqli_real_escape_string($bd,$_POST['login']);
    $email  = mysqli_real_escape_string($bd,$_POST['email']);
    echo $photo  = mysqli_real_escape_string($bd,$_POST['ph_ph']);


    if($photo!=''){
$sql = "UPDATE users SET 
`name`='$name',
`surname`='$surname',
`login`='$login', 
`email`='$email', 
`avatar`='".$photo."'
WHERE `id`='".$_SESSION['id']."' ";
    }else{

$sql = "UPDATE users SET 
`name`='$name',
`surname`='$surname',
`login`='$login', 
`email`='$email'
WHERE `id`='".$_SESSION['id']."' ";
    }

    if (!mysqli_query($bd, $sql)) {
        die('Error: ' .mysqli_error($bd));
    }
    return 0;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <title>Редактирование профиля – Ёж Домашка</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/header.php'); ?>
</head>
<body>
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/footer.php'); 
$query_bd ="SELECT * FROM users WHERE id = '".$_SESSION['id']."' ";
$rdz = $bd->query($query_bd);
 $nte=0;
if ($rdz->num_rows > 0) {
   
  while($row = $rdz->fetch_assoc()) {
  	$login=$row['login'];
  	$name=$row['name'];
    $surname=$row['surname'];
  	$email=$row['email'];
    $social=$row['socailnet'];
  	$avatar=$row['avatar'];
}
}


?>
    <div>
        <div id='ven'></div>
    <div class="loginisation">
        <h1>Изменение профиля:</h1>
        <div class="input-group mb-3">
            <div class='avatar_chg' style='background-image: url("<?php echo $avatar; ?>")'></div>
            <input type="file" class="form-control" id="inputGroupFile01">
        </div>

        <div class="form-floating mb-3">
        <div class='row'>
            <div class='col'>
                <div class="form-floating">
                    <input type="text" class="form-control" value="<?php echo $name ?>"  id="name" placeholder="name" name="name" autocomplete="name" required>
                    <label for="name" >Имя</label>
                </div>
            </div>
            <div class='col'>
                <div class="form-floating">
                    <input type="text" class="form-control" value="<?php echo $surname ?>"  id="surname" placeholder="surname" name="surname" autocomplete="surname" >
                    <label for="name" >Фамилия</label>
                </div>
            </div>
        </div>
        </div>
        <div class="form-floating mb-3">
        <input type="text" class="form-control" id="login" value="<?php echo $login; ?>" placeholder="login" name="login" required autocomplete="username">
        <label for="login">Логин</label>
        </div>
        <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" autocomplete="home email" placeholder="exemple@gmail.com" name="email" required="">
        <label for="email">Электронный адрес</label>
        </div>


        <input class="btnsubmlg" type="submit" value="Обновить"  name="submit" id='butsubm'/>
        
    </div>
    <script>
        var urlph='';

        var files='';
    $('input[type=file]').on('change', function(){
	    files = this.files;
    });
        function setimage() {
        if( typeof files == 'undefined' ) return;
	var data = new FormData();
	$.each( files, function( key, value ){
		data.append( key, value );
	});
	data.append( 'my_file_upload', 1 );

    
    $.ajax({
        url: '/inc/serverpack/uploadph.php',
        data: data,
		processData : false,
		contentType : false, 
        type: 'POST',
        success: function (data) {
            url_ph(data);
        }
    });
}

function url_ph(data){
    urlph=data;
}
    butsubm.onclick = function() {
        setimage();
        $.ajax({
        url: '/profile/',
        data: {
            upd: 'check',
            name:  $("#name").val(),
            surname:  $("#surname").val(),
            login:  $("#login").val(),
            email:  $("#email").val(),
            ph_ph: urlph
        }, 
        type: 'POST',
        success: function (data) {
            location.reload();
        }
    });
    };
    </script>
</body>
</html>