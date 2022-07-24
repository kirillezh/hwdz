
<?php 
 session_start(); 

 if(!isset($_SESSION['id'])){
 header("Location: /login/");
 return 0;
 }

 
include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');

$dz ="SELECT * FROM files WHERE userid = '".$_SESSION['id']."' ";
$n=0;
$rdz = $bd->query($dz);
if ($rdz->num_rows > 0) {
while($row = $rdz->fetch_assoc()) {
    
    $url[$n]=$row['url'];
    $date[$n]=$row['date'];
    $name[$n]=$row['name'];
    $n++;
}
}?>
<a onclick="$('#stradding').html('')" class='blackall'></a>
<div class="str">
	<a id="exit" hotkey="Esc" onclick="$('#stradding').html('')"><i class="bi bi-x-lg"></i></a>

	<h1>Загрузить фото:</h1>
	<script>
	function  openbibl(){
$( "#bibl" ).css( "display", "block" ) ;
$( "#load" ).css( "display", "none" ) ;
$( "#but1" ).removeClass('chgbut');
$( "#but2" ).addClass('chgbut');
  }
  function  openload(){
$( "#load" ).css( "display", "block" ) ;
$( "#bibl" ).css( "display", "none" ) ;
$( "#but2" ).removeClass('chgbut');
$( "#but1" ).addClass('chgbut');
  }
  </script>
	<div style="margin-bottom: 15px; ">
	<button id="but1" onclick="openload()" <?php if($n!=0){?> class="strbut" <?php }else{ ?> class="strbut chgbut" <?php } ?>  >Загрузка</button>
	<button id="but2"  <?php if($n!=0){?> onclick="openbibl()" class="strbut chgbut" <?php }else{ ?> class="strbut" <?php } ?> >Библиотека</button>
	</div>



	<div class="biblstr" id="bibl" style="<?php
 	if($n==0){?> display: none;<?php } ?>">


   
<div class="biblstr_media">
<?php
$nnn=0;

for($nn=$n-1; $nn>=0;$nn--){

echo"<div class='imginf' id='".$nnn."' onclick='inf( ".$nnn." )'  style='background-image: url(".$url[$nn].") '></div> ";
$nnn++; 
 }
 ?>
 </div>
 <script>
 	function removeall(){
 		    var x;
 x=document.querySelectorAll("#stradding");

x[0].classList.remove('str2');
$("#stradding").html("");
 	}

 	function bdclick(){
var x = document.getElementsByClassName("imginf click");
var xl=[-1,-1,-1,-1,-1];

var html ='';
var i1=0;
var url_ph='';
for( var i = 0; i < x.length; i++ ) 
{
i1=i+1;
    var url = document.getElementById(x[i].id).style.backgroundImage;
    url_ph= url.substring(5, url.length-2);
html=html+'<div class="imgimfinf" id="phdiv_'+i1+'"><div class="imgstrlib" style="background-image:url('+url_ph+')"></div><input name="ph_'+i1+'" id="ph_'+i1+'" type="text" value="'+url_ph+'" disabled><button class="butdelph" onclick="delph('+i1+')"><i class="bi bi-x-lg"></i></button></div>';
}


$("#photoidl").html(html);
$("#stradding").html("");

var x;x=document.querySelectorAll("#stradding");
x[0].classList.remove('str2');
 	}
 	function inf(n){
 		var x, xm;
 		x=document.querySelectorAll(".imginf");
 		xm=document.querySelectorAll(".imginf.click");
 		if(x[n].classList.contains('click')){
		x[n].classList.remove('click'); 	
 		}else{
 		if(xm.length>=5){
 			alert("Нельзя выбрать более 5 картинок. Удалите из выбора другие картинки и повторите выбор этой фотографии")
 		}else{
 		
 		x[n].classList.add('click'); 			
 		}
 	}
 	}
</script>

<div id="blb"></div>
<div class="bottom"><input type='submit' value='Загрузить' onclick="bdclick()">
</div>

 	</div>
 	<div id="load" style="<?php
 	if($n==0){}else{?> display: none;<?php } ?>">
 		<style>
 			input[type="submit"] {
    width: auto;
    position: relative;
    box-shadow: none;
    border-radius: 5px!important;
    height: auto;
    padding: 10px 20px;
    font-size: 20px;
}

</style>
<script>
    var files;
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
            strad2();
        }
    });
}

</script>



<div class="mb-3">
  <input class="form-control" type='file' name='file[]' class='file-drop' id='file-drop' multiple required >
</div>

<input type='submit' value='Загрузить' onclick="setimage()">

</form>

 	</div>
 </div>
