<?php 
//Obteniendo los valores para generar la imagen
$ruta = $_POST['valorRuta'];
$text_1 = $_POST['valorTexto'];
$text_2 = $_POST['valorTexto2'];
$rgb1 = $_POST['RGB1'];
$arreglo_rgb1 = explode(",",$rgb1);
$rgb2 = $_POST['RGB2'];
$arreglo_rgb2 = explode(",",$rgb2);
//
$rojo_1 = $arreglo_rgb1[0];
$verde_1 = $arreglo_rgb1[1];
$azul_1 = $arreglo_rgb1[2];
//
$rojo_2 = $arreglo_rgb2[0];
$verde_2 = $arreglo_rgb2[1];
$azul_2 = $arreglo_rgb2[2];

$fuente = $_POST['valorFuente'];
$size = $_POST['valorSize'];
$alineacionTexto1 = $_POST['valorAlineacionTexto1'];
$alineacionTexto2 = $_POST['valorAlineacionTexto2'];
$margen1 = $_POST['valorMargen1'];
$margen2 = $_POST['valorMargen2'];

//Obteniendo la extensión del archhivo
$extension = pathinfo($ruta,PATHINFO_EXTENSION);
if($extension == "png"){
	$imagen = imagecreatefrompng($ruta);
}else{
	$imagen = imagecreatefromjpeg($ruta);
}
$nuevoNombre = substr($ruta, 0, strlen($ruta) - strlen($extension) - 1) . "_e." . $extension;
$colorTexto1 = imagecolorallocate($imagen, $rojo_1, $verde_1, $azul_1);
$colorTexto2 = imagecolorallocate($imagen, $rojo_2, $verde_2, $azul_2);

$font = './.Fuentes/'.$fuente.'.ttf';

//Calculando las dimensiones del texto
$cajaTexto_1 = imagettfbbox($size, 0, $font, $text_1);
$tamanhoCaja1_x = $cajaTexto_1[2]-$cajaTexto_1[0];
$tamanhoCaja1_y = $cajaTexto_1[7]-$cajaTexto_1[1];
$cajaTexto_2 = imagettfbbox($size, 0, $font, $text_2);
$tamanhoCaja2_x = $cajaTexto_2[2]-$cajaTexto_2[0];
$tamanhoCaja2_y = $cajaTexto_2[7]-$cajaTexto_2[1];

//Calculando la posición del texto 1
if($alineacionTexto1 == "Center"){
	$posicionXTexto1 = (imagesx($imagen) - $tamanhoCaja1_x) / 2;
}elseif($alineacionTexto1 == "Left"){
	$posicionXTexto1 = 0;
}else{
	$posicionXTexto1 = imagesx($imagen) - $tamanhoCaja1_x;
}
//Calculando la posición del texto 2
if($alineacionTexto2 == "Center"){
	$posicionXTexto2 = (imagesx($imagen) - $tamanhoCaja2_x) / 2;
}elseif($alineacionTexto2 == "Left"){
	$posicionXTexto2 = 0;
}else{
	$posicionXTexto2 = imagesx($imagen) - $tamanhoCaja2_x;
}

imagettftext($imagen, $size, 0, $posicionXTexto1, $margen1 + $tamanhoCaja2_y*-1, $colorTexto1, $font, $text_1);

imagettftext($imagen, $size, 0, $posicionXTexto2, imagesy($imagen) - ($margen2), $colorTexto2, $font, $text_2);

//header('Content-type: image/jpeg');
if($extension == "png"){
	imagepng($imagen,$nuevoNombre);
}else{
	imagejpeg($imagen,$nuevoNombre);
}
$longitudX = imagesx($imagen) * .6;
$longitudY = imagesy($imagen) * .6;
imagedestroy($imagen);
$time =  time();
echo "&nbsp&nbsp&nbsp<a class='btn btn-default' id=\"testTere\" name=\"testTere\" href=\"ImageDownload.php?ubicacion=".$nuevoNombre."\">Generar y descargar<a><br>";
echo "'<img src='".$nuevoNombre."?".$time."' style='width:".$longitudX."px;height:".$longitudY."px;'/>";
//$resultado = "'<img src='".$nuevoNombre."'/>'";
//echo $resultado;
?>
