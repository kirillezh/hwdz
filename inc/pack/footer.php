<?php $url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url); ?>
 <div class="footer">

<script>
    function addteam() {
    $.ajax({
  url: 'addteam.php',
  data: {},
  type: "POST",
  success: function(html) { 
    $("#addroom").html(html);
  }
});
}
setInterval( function() {
  if(document.hidden === false) {
    Update();
  } } ,10000);

function Update(){
    $.post("/check/check/",{update:1},function(result){eval(result);});}


</script>

<a class="logo" href="/">
  <div id="logo"></div>
  <p id="name-logo">Домашка</p>
</a>

<div class="right">
<div class="notif" id='notif'>
<?php echo notif(); ?>
</div>

<div class="useracc">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="drpmenu" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profile">
    <?php echo is_name($_SESSION['id']); ?>
  </button>
  <ul class="dropdown-menu" aria-labelledby="drpmenu">

    <?php
    if(isset($id) AND $t==0){
      if(is_it_admin($databl, $_SESSION['id'])){
      ?>
            <script>
    

    function addloud(loud) {
$.ajax({
  url: '/inc/serverpack/addload.php',
  data: {"loud":loud},
  type: "POST",
  success: function(html) {
      window.location.reload();
    }
});
}
  </script>
  <?php
        if(isset($_SESSION['adm']) AND $_SESSION['adm']==1){ ?>
      
    <li><a onclick="addloud(1)" href="#">Выйти из режима писателя</a></li>
<?php }  else{ ?>
<li><a onclick="addloud(0)"href="#" >Войти в режим писателя</a></li>
<?php }  } 
if(is_it_really_admin($databl, $_SESSION['id'])){ ?>
  <li><a  onclick="opencus()">Панель Администратора</a></li>
  <?php } }
    ?>
    <?php if($t==3){ ?>
      <li><a href='/addteam/'>Создать группу</a></li>
    <?php } ?>
    <li><a href="/profile/">Профиль</a></li>
    <li><a href="/inc/serverpack/loginserver.php?out">Выйти</a></li>
  </ul>
</div>
</div>


</div>
<div  style='height: 35px;'></div>
<?php
if(isset($id) AND $t==0){
 if(is_it_really_admin($databl, $_SESSION['id'])){ ?>
<script>
  setInterval( function() {
         if(document.hidden === false) {
             Updl(0);
         } } ,5000);
function Updl(d){
    $.post("/check/lstupt/",{d:d,id: <?php echo $id; ?>},function(result){if(result=='exist'){return 0;}$("#retload").html(result);});}
</script>
  <div class="custom" id="Elem">
  <a id="closecust" onclick="closecus()">
    <i class="bi bi-x"></i>
  </a>
  <h2>Панель администратора</h2>
  <style>
  button.btn-clipboard {
    position: absolute;
    top: -10px;
    right: 0;
    height: 20px;
    font-size: 11px;
    border: none;
    border-radius: 6px;
}
.highlight {
    position: relative;
}
</style>
<h3>Информация о группе</h3>
<ul class="dropdown-menu">
   
<li id="retload">
<?php echo exist_return($id); ?>    
</li>

 <li id="expens">
<?php 
$leSS ="SELECT pass FROM man_teams WHERE id_team=".$id;
$rdz = $bd->query($leSS);
if ($rdz->num_rows > 0) {
    while($row = $rdz->fetch_assoc()) {
      $pass=$row['pass'];
    }
  }
 ?>
<h3 id="gg">Приглашение</h3>
<p><b>Приглашение с паролем</b></p>
 <div class="highlight">
<pre class="chroma"><code class="language-sh" data-lang="sh" id="wpa"><?php echo "https://".$_SERVER['SERVER_NAME']."/invite/".$id."/".$pass."/" ?>
   </code></pre>
 </div>
<p><b>Приглашение без пароля</b></p>
 <div class="highlight">
<pre class="chroma"><code class="language-sh" data-lang="sh" id="wtpa"><?php echo "https://".$_SERVER['SERVER_NAME']."/invite/".$id."/" ?>
   </code>
</pre>
 </div>
<p><b>Пароль</b></p>
<div class="highlight">
<pre class="chroma"><code class="language-sh" data-lang="sh" id="pa"><?php echo $pass ?>
   </code></pre>

 </div>
</li>
  </ul>
  <h3>Управление группой</h3>
    <ul id="listed">
    <li id="listname"><a href="/lesschange/<?php echo $id ?>/">Редактирование списка</a></li>
    <li id="listname"><a href="/<?php echo $id ?>/setting/">Настройки</a></li>
    </ul>


</div>

  <?php } } ?>
