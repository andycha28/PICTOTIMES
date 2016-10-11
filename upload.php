<?php
 	include("Clases/uploadAction.php"); 
 	$strRepuesta = "";
	include('header.php');
	head('pictotime', 'Subir Archivos');	
?>
<br>
<br>
<label >Subir imagenes</label><br>
<form action = "upload.php" method = "post" enctype="multipart/form-data">
	<input type="file" name = "btnSeleccionar" id="btnSeleccionar" value="Elegir archivo"><br>
	<label >Nombre: </label><input type="text" id="txtNombre" name = "txtNombre"><br>
	<button type="submit" id="btnSubir" name = "btnSubir">subir archivo</button>

	<?php
		$nombreArchivo = basename($_FILES["btnSeleccionar"]["name"]);
		$tipoArchivo =  pathinfo($nombreArchivo,PATHINFO_EXTENSION);
		$nombreTemporal = $_FILES["btnSeleccionar"]["tmp_name"];
		$tamanhoArchivo = $_FILES["btnSeleccionar"]["size"];

		if(isset($_POST['btnSubir'])){
			$Archivo = new Pictotimefile();
			$status = $Archivo->upload($_COOKIE['nombre'], $nombreArchivo, $_POST["txtNombre"], $tipoArchivo, $tamanhoArchivo, isset($_POST["submit"]), $nombreTemporal, $strRepuesta);
		
		} 
	?>
	<div id=respuesta>
		<?php
			echo $strRepuesta
		?>
	
	

</form>
<?php
	foot();
?>
