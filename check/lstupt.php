<?php 
session_start();

include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
if(!isset($_SESSION['id'])){return 0;}
if(!is_it_really_admin($_POST['id'],$_SESSION['id'])){return 0;}

if($_POST['id']!='' AND $_POST['d']==1){

return exist_return($_POST['id']);

 }

include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
 $id_t=mysqli_real_escape_string($bd,$_POST['id']);
$bash_code='';
$sql = "SELECT userID FROM userstoteams WHERE teamID='$id_t'";
if($result = $bd->query($sql)){
    foreach($result as $row){
    $userid=$row["userID"];
        $chel ="SELECT dataint, dateintegare FROM activeuser WHERE userid='".$userid."' ";
        $rdz = $bd->query($chel);
        if ($rdz->num_rows > 0) {
            while($row = $rdz->fetch_assoc()) {
                $time_now = strtotime(date('Y-m-d H:i:s'));
                $time_need = strtotime($row['dataint']);
                 $time=ceil($time_now-$time_need);
                $time_need = strtotime($row['dateintegare']);
                $time_now = strtotime(date('Y-m-d'));
                 $date= ceil($time_now-$time_need);
                if($date==0 and $time<60){
                    $userid.='1'; 
                 $bash_code.=$userid;
                }
                else{
                    $userid.='0';
                     $bash_code.=$userid;
                }
                
                }
            }
        }
    }    



if(!isset($_SESSION['bash_log'])){
 $_SESSION['bash_log'] = md5($bash_code);
}else{
if(md5($bash_code) == $_SESSION['bash_log']){
    echo 'exist';
    return 0;
}else{
$_SESSION['bash_log'] = md5($bash_code);
}

}
if($_POST['id']!=''){

return exist_return($_POST['id']);

 }
?>