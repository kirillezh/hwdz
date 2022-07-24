<?php
if(!isset($_GET['t'])){return 0;}
$text=$_GET['t'];
if(isset($_GET['p'])){$text2=$_GET['p'];
	if (strlen($text2)>52) {
	$text2=mb_substr($text2, 0, 52)."...";
	}
}
if (strlen($text)>8) {
	$text=mb_substr($text, 0, 8);
	}


// Тип содержимого
header('Content-Type: image/png');
// Создание изображения
$img = imagecreatetruecolor(1280, 720);
// Создание цветов
$logo = imagecreatefrompng($_SERVER['DOCUMENT_ROOT']
.'/inc/logoezh_60.png');
$white = imagecolorallocate($img, 255, 255, 255);
$grey = imagecolorallocate($img, 128, 128, 128);
$black = imagecolorallocate($img, 0, 0, 0);
imagefilledrectangle($img, 0, 0, 1280, 720, $white);
// Шрифт
$font = $_SERVER['DOCUMENT_ROOT']
.'/inc/product-sans/ProductSans-Black.ttf';
$font_regular = $_SERVER['DOCUMENT_ROOT']
.'/inc/product-sans/ProductSans-Regular.ttf';
// Лого
imagesetbrush($img, $logo);
imageline($img, 70, 60, 70, 60, IMG_COLOR_BRUSHED);
imagettftext($img, 25, 0, 100, 75, $black, $font, "Домашка");
// Заголовок
imagettftext($img, 200, 0, 40, 570, $black, $font, $text);

// Подзаголовок

if(isset($_GET['p'])){
imagettftext($img, 30, 0, 50, 670, $grey, $font_regular, $text2);
}
imagefilledrectangle($img, 1220, 0, 1280, 720, $white);

imagepng($img);
imagedestroy($img);
?>