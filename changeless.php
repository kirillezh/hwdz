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
    include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/inc/pack/footer.php');
    if(!is_it_really_admin($id, $_SESSION['id'])){
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        require __DIR__ . '/404.php';
        return 0;
    }
    include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
    $bdid ="SELECT * FROM less_".$id." ORDER BY `id` ASC";
    $rdz = $bd->query($bdid);
    $nte=1;
    $lday=0;
    $d[1]="Понедельник";
    $d[2]="Вторник";
    $d[3]="Среда";
    $d[4]="Четверг";
    $d[5]="Пятница";

    if ($rdz->num_rows > 0) {
        while($row = $rdz->fetch_assoc()) {
            $varn=floor($row['id']%10);
            $leeess=floor($row['id']%100/10);
             $day=floor($row['id']/100);
            
            
             if($day==$lday){
                 if($less[$day]['less']<floor($row['id']%100/10)){
                    $less[$day]['less']=$less[$day]['less']+1;
                 }  
                
            }else{
                $lday=$day;
                $less[$day]['less']=1;
            }
            $less[$day][$leeess][$varn]['id']=$row['id'];
            $less[$day][$leeess][$varn]['name']=$row['name'];
            $less[$day][$leeess][$varn]['var']=$row['var'];
        }

    }
    ?> 
    <content> 
    <?php
     $max_less=8;
    for($i=1;$i<=5;$i++){

        ?><div class="part"><h1 id="day"><?php echo $d[$i]; ?></h1> <table id="allow"><tbody><?php
        $n=1;
        
        while($max_less>=$n){ ?><tr><td id="addlnoad"><table id="<?php echo $i.$n."0"; ?>"><tbody> <?php
            if(!isset($less[$i][$n][0]['id']) AND !isset($less[$i][$n][1]['id']) AND !isset($less[$i][$n][2]['id'])){
                echo "<tr><td><a onclick='change(".$i.$n."0)' id='n".$i.$n."0'><div class='change'><i class='bi bi-plus'></i></div></a><a onclick='add(".$i.$n."0)'><div class='add'><i class='bi bi-plus'></i></div></a></td></tr>";
            }elseif(isset($less[$i][$n][0]['id'])){ ?><tr><td><a onclick="change(<?php echo $less[$i][$n][0]['id'];?>)" id="<?php echo "n".$less[$i][$n][0]['id'];?>"><h5 class="les chang"><?php
                echo $less[$i][$n][0]['name'];  ?></h5></a><a onclick='add(<?php echo $i.$n."0"; ?>)'><div class='add'><i class='bi bi-plus'></i></div></a></td></tr> <?php
            }else{ ?>  <?php
                if(isset($less[$i][$n][1]['id'])){
                echo "<tr><td style='border-right:1px solid black;' class='row_2'><a onclick='change(".$less[$i][$n][1]['id'].")' id='n".$less[$i][$n][1]['id']."'><h5 class='les chang' id='no1'>".$less[$i][$n][1]['name']."</h5></a>";
                }else{
                    echo "<tr><td class='row_2'><a onclick='change(".$i.$n."1)' id='n".$i.$n."1'><div class='change one'><i class='bi bi-plus'></i></div></a>";
                }
                ?></td><td class="row_2" id='peop2'><?php
                if(isset($less[$i][$n][2]['id'])){
                    echo "<a onclick='change(".$less[$i][$n][2]['id'].")' id='n".$less[$i][$n][2]['id']."'><h5 class='les chang' id='no1'>".$less[$i][$n][2]['name']."</h5></a>";
                    }else{
                        echo "<a onclick='change(".$i.$n."2)' id='n".$i.$n."2'><div class='change'><i class='bi bi-plus'></i></div></a>";
                }
                ?><a onclick='rem(<?php echo $i.$n."0"; ?>)'><div class='add'><i class="bi bi-dash"></i></div></a></td></tr><?php
            }
            $n++;
            ?></table></tbody><?php
        }
        ?>
        </tbody></table></div>
        <?php
    }

    
    ?>
       </content>
        <script>
            function change(id) {
                $.ajax({
            url: '/inc/serverpack/change-less.php',
            data: {"id": id, 
            "idbd": <?php echo $id; ?>,
            },
            type: "POST",
            success: function(html) {
                    $("#udz").html(html);   
            }
            });
            }
            function upd(id, idn, chl) {
            $.ajax({
            url: '/inc/serverpack/update-less.php',
            data: {"id": id, 
            "idn": idn, 
            "idbd": <?php echo $id; ?>,
            "chl": chl
            },
            type: "POST",
            success: function(html) {
                if(html!='ok'){
                    $('#err').addClass('ena');
                    $("#err").html(html);   
                    setTimeout(() => $('#err').removeClass('ena'), 6000);
                }
            }
            });
            }
            function add(id) {
                var change = document.getElementById("n" + id);
                var content= change.innerHTML;
                
                id1=id+1;
                id2=id+2;
                if(content!= '<div class="change"><i class="bi bi-plus"></i></div>'){
                    var html ='<tbody><tr><td  class="row_2"> <a onclick="change('+ id1 +')" id="n'+id1+'">'+content+'</a></td><td class="row_2" id="peop2"><a onclick="change(' + id2 + ')" id="n'+id1+'"><div class="change two"><i class="bi bi-plus"></i></div></a><a onclick="rem(' + id + ')"><div class="add"><i class="bi bi-dash"></i></div></a></td></tr></tbody>';
                }
                else{
                    var html ='<tbody><tr><td  class="row_2"> <a onclick="change('+ id1 +')" id="n'+id1+'"><div class="change one"><i class="bi bi-plus"></i></div></a></td><td class="row_2" id="peop2"><a onclick="change(' + id2 + ')" id="n'+id2+'"><div class="change two"><i class="bi bi-plus"></i></div></a><a onclick="rem(' + id + ')"><div class="add"><i class="bi bi-dash"></i></div></a></td></tr></tbody>';
                }
                document.getElementById(id).innerHTML = html;
                upd(id, id1, 'add');
            }
            function rem(id) {
                id1=id+1;
                id2=id+2;
                var change = document.getElementById("n" + id1);
                var content= change.innerHTML;
                
                
                if(content!= '<div class="change one"><i class="bi bi-plus"></i></div>'){
                    var html ='<tbody> <tr><td><a onclick="change('+id+')" id="n'+id+'">'+content+'</a><a onclick="add('+id+')"><div class="add"><i class="bi bi-plus"></i></div></a></td></tr> </tbody>';
                }
                else{
                    var html ='<tbody> <tr><td><a onclick="change('+id+')" id="n'+id+'"><div class="change"><i class="bi bi-plus"></i></div></a><a onclick="add('+id+')"><div class="add"><i class="bi bi-plus"></i></div></a></td></tr> </tbody>';
                }
                document.getElementById(id).innerHTML = html;
                upd(id1, id, 'rem');
            }
        </script>
    </body>
</html>