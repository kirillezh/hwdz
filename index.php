<?php 

require __DIR__.'/router/AltoRouter.php';

$router = new AltoRouter();

function is_logined(){
    session_start();
    if (!isset($_SESSION['id'])) {
        session_write_close();
        return False;
    }
    session_write_close();
    $login=$_SESSION['login'];
    $id=$_SESSION['id'];
    
	if (isset($login) and isset($id)){return True;}else{return False;}
}



$router->map('GET','/',  function() {
    if(is_logined()){
        $t=3;
        require __DIR__ . '/main.php';
    }else{
        $t=1;
        require __DIR__ . '/index_.php';
    }
} , 'home');

$router->map( 'POST', '/check/check/',
    function() {
    require __DIR__ . "/check/check.php";
}, 'check' );
$router->map( 'POST', '/check/lstupt/',
    function() {
    require __DIR__ . "/check/lstupt.php";
}, 'lstupt' );


    $router->map( 'GET', '/[i:id]/',
    function($id) {
    $t=0;
    if(!is_logined()){header("Location: /auth/login/?red='/".$id."/'");return 0;}

        require __DIR__ . "/group.php";
    
    }, 'group' );
    
    $router->map( 'GET', '/[i:id]/[i:week]/',
    function($id, $we) {
    $t=0;
    if(!is_logined()){header("Location: /auth/login/?red='/".$id."/".$we."/'");return 0;}

    require __DIR__ . "/group.php";
}, 'group_week' );

    $router->map( 'GET', '/inv/[i:id]/',
    function($id) {
    $t=1;
    if(!is_logined()){header("Location: /auth/login/?red='/inv/".$id."/'");return 0;}

    require __DIR__ . "/task.php";
}, 'group_inv' );
    $router->map( 'GET', '/inv/[i:id]/[i:week]/',
    function($id, $we) {
    $t=1;
    if(!is_logined()){header("Location: /auth/login/?red='/inv/".$id."/".$we."/'");return 0;}

    require __DIR__ . "/task.php";
}, 'group_inv_week' );
    $router->map( 'GET', '/inv/[i:id]/[i:week]/[i:day]/',
    function($id, $we, $da) {
        $t=1;
        if(!is_logined()){header("Location: /auth/login/?red='/inv/".$id."/".$we."/".$da."/'");return 0;}

        require __DIR__ . "/task.php";
}, 'group_inv_day' );

$router->map( 'GET', '/lesschange/[i:id]/',
function($id) {
    $t=1;
    if(!is_logined()){header("Location: /auth/login/?red='/lesschange/".$id."/'");return 0;}

    require __DIR__ . "/changeless.php";
}, 'lesschange' );
$router->map( 'GET', '/[i:id]/setting/',
function($id) {
    $t=1;
    if(!is_logined()){header("Location: /auth/login/?red='/".$id."/setting/'");return 0;}

    require __DIR__ . "/setting.php";
}, 'setting' );
$router->map( 'GET', '/addteam/',
function() {
    $t=1;
    if(!is_logined()){header("Location: /auth/login/?red='/addteam/'");return 0;}

    require __DIR__ . "/newteam.php";
}, 'newteam' );

$router->map( 'GET', '/invite/[i:id]/',
function($id) {
    $t=1;
    if(!is_logined()){header("Location: /auth/login/?red='/invite/".$id."/'");return 0;}
    require __DIR__ . "/invite.php";
}, 'invite' );

$router->map( 'GET', '/invite/[i:id]/[a:pass]/',
function($id, $pass) {
$t=1;
if(!is_logined()){header("Location: /auth/login/?red='/invite/".$id."/".$pass."/'");return 0;}
require __DIR__ . "/invite.php";
}, 'invite_pass' );

$router->map( 'POST|GET', '/profile/',
function() {
$t=1;
if(!is_logined()){header("Location: /auth/login/?red='/profile/'");return 0;}
require __DIR__ . "/profile.php";
}, 'profile' );






if(!is_logined()){
$router->map('GET','/auth/login/',  function() {
    require __DIR__ . '/login.php';
} , 'auth');

$router->map('GET','/auth/register/',  function() {
    require __DIR__ . '/register.php';
} , 'reg');
$router->map('POST','/auth/login_ser/',  function() {
    require __DIR__ . '/inc/serverpack/loginserver.php';
} , 'loginser');
$router->map('POST','/auth/auth_telegram/',  function() {
    require __DIR__ . '/inc/auth_telegram.php';
} , 'auth_tg');

$router->map('GET|POST','/auth/auth_gg/',  function() {
    require __DIR__ . '/inc/auth_gg.php';
} , 'auth_gg');

}

$router->map('GET','/auth/forg_pass/',  function() {
    require __DIR__ . '/forg_pass.php';
} , 'forg_pas');


$match = $router->match();
if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] ); 
} else {
//    if($unt==0){
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require __DIR__ . '/404.php';
  /*  }elseif($unt==1){
        require __DIR__ . '/login.php';
    } */
}

 ?>