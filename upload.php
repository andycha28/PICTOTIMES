<?php
 	include("Clases/uploadAction.php"); 
 	$strRepuesta = "";
	include('header.php');
	head('pictotime', 'Subir Archivos');	
?>
<br>


<div class="panel panel-default">
	<div class="panel-heading">
		Subir imagenes
	</div>
	<div class="panel-body">
		<form action = "upload.php" method = "post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="file" name = "btnSeleccionar" class="form-control" id="btnSeleccionar" value="Elegir archivo"><br>
				<label >Nombre: </label><input type="text" class="form-control" id="txtNombre" name = "txtNombre"><br>
		    </div>
		    <div class="form-group">
				<button type="submit" class="btn btn-primary" id="btnSubir" name = "btnSubir">Subir Archivo</button>
				<button type="reset" class="btn btn-default" id="btnCancelar" name="btnCancelar">Cancelar</button>
			</div>
				<?php
					$nombreArchivo = basename($_FILES["btnSeleccionar"]["name"]);
					$tipoArchivo =  pathinfo($nombreArchivo,PATHINFO_EXTENSION);
					$nombreTemporal = $_FILES["btnSeleccionar"]["tmp_name"];
					$tamanhoArchivo = $_FILES["btnSeleccionar"]["size"];

					if(isset($_POST['btnSubir']))
					{
						$Archivo = new Pictotimefile();
						$status = $Archivo->upload($_COOKIE['id_fb'], $nombreArchivo, $_POST["txtNombre"], $tipoArchivo, $tamanhoArchivo, isset($_POST["submit"]), $nombreTemporal, $strRepuesta);
					
					} 
				?>
			<div id=respuesta>
				<?php
					echo $strRepuesta
				?>
			</div>
		</form>
	</div>
</div>
<?php
	foot();
?>
