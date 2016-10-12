<?php
	$ubicacion = $_GET['ubicacion'];
	$extension = pathinfo($ubicacion,PATHINFO_EXTENSION);
	if(file_exists($ubicacion)){
		header('Content-disposition: attachment; filename='.basename($ubicacion));
		if($extension == "png"){
			header('Content-type: image/png');
		}else{
			header('Content-type: image/jpeg');
		}
		//readfile('textosimple.png');
		readfile($ubicacion);
		unlink($ubicacion);
		$Imagen = new uploadImage();
	
	}else{
		echo "<br>La imagen solicitada ya no existe, intente volviendo a visualizarla<br>";
	}	
?>
