<?php 
  include($_SERVER['DOCUMENT_ROOT'].'/inc/function.php');
  include($_SERVER['DOCUMENT_ROOT'].'/inc/self/bd.php');
  session_start();
  if(!isset($_SESSION['id'])){
    header("Location: /login/");
    return 0;
    }

    if( isset( $_POST['my_file_upload'] ) ){  
        // ВАЖНО! тут должны быть все проверки безопасности передавемых файлов и вывести ошибки если нужно
    
        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload'; // . - текущая папка где находится submit.php
    
        // cоздадим папку если её нет
        if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
    
        $files      = $_FILES; // полученные файлы
        $done_files = array();
    $done ='';
        // переместим файлы из временной директории в указанную
        foreach( $files as $file ){
            $file_name = $file['name'];
            
            if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ){
                $done_files = $file_name;
                $done = $file_name;
                $url_ph="https://".$_SERVER["SERVER_NAME"]."/upload/".$file_name;
                echo( $url_ph );

                $sql = "INSERT INTO files (`name`,`userid`,`date`,`url`) VALUES ('".$file_name."', '".$_SESSION['id']."', '".date("Y-m-d H:i:s")."', '".$url_ph."') ";
                
                if (!mysqli_query($bd, $sql)) {
                    die('Error: ' .mysqli_error($bd));
                }
                
            }
                   
        }
     
        $data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');
    
    }