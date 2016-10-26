<?php
	require_once('Clases/searchAction.php');
	$strBuscar = "";
	$strRespuesta = "";	
	$numIndices = 0;
	$numResultados = 0;
	include('header.php');
	head('Pictotime', 'Busqueda');
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3>Buscar Memes</h3>
	</div>
	<form action = "search.php" method = "post" enctype="multipart/form-data">
	<div class="panel-body">
			<div class="form-group">
				<label>&iquest;Que necesitas?</label>
				<input name="txtBuscar" class="form-control" size="15" maxlength="128" type="text">
			</div>
			<button class="btn btn-primary" type="submit" id="btnBuscar" name = "btnBuscar">Buscar</button></br>
		</form>
		<div class="row">
			<?php
			if(isset($_POST['btnBuscar'])){
	
				$strBuscar = trim($_POST["txtBuscar"]);
				//echo "Criterio de busqueda " . $strBuscar;
				$numIndices = ceil($numResultados/3);
				iniciarBusqueda(1, $strBuscar);
	
			}

			if(isset($_POST['numIndices'])){//Si ya existe el hidden, osea que ya se hizo una busqueda y mostro resultados
	
				$numIndices = $_POST['numIndices'];
				$strBuscar = trim($_POST['strLoQueBusco']);
				//echo "Criterio de busqueda " . $strBuscar;
				for ($i = 1; $i <= $numIndices; $i++) {
					if(isset($_POST['btnIrA'.$i])){
						iniciarBusqueda($i, $strBuscar);
						break;			
					}
				}
				if(isset($_POST['btnIrAPrimero'])){
					iniciarBusqueda(1, $strBuscar);
				}

				if(isset($_POST['btnIrAUltimo'])){
					iniciarBusqueda($numIndices, $strBuscar);
				}
	
			}

			function iniciarBusqueda($numSeccion, $paramStrBuscar){
				require_once('Clases/Global.php');
				$global = new G();
				$busqueda = new pictotimeBusqueda();
				echo '<input type="hidden" name="strLoQueBusco" value="'. $paramStrBuscar . '" />';
				$cursor = $busqueda->buscar($paramStrBuscar, $numSeccion, $numResultados, $strRespuesta);
				foreach ($cursor as $elemento) {
					echo '<div class="col-sm-12 col-md-4 col-lg-4"><div class="thumbnail">';
					echo '<img style=width:200px;height:200px; class="img-responsive img-circle" src="ftp://'
						.$global->getFtpServer().'/files/'.$elemento['url'].'">';
					echo '<div class="caption">';
					echo "<h3>" . implode(" ", $elemento['nombreImagen'])."</h3>";
					echo '<p><a href="image.php?image='.$elemento['_id']
						.'" class="btn btn-primary" role="button">Ver</a></p>';
					echo '</div></div></div>';
				}
				$numIndices = ceil($numResultados/3);
				echo '</div>';
				echo '<div class="row"><div class="col-md-12 col-lg-12 col-sm-12">';
				echo '<input type="hidden" name="numIndices" value= '. $numIndices .' />';
				echo '<button class="btn btn-default" type="submit" id="btnIrAPrimero" name = "btnIrAPrimero">First</button>';
				for ($i = 1; $i <= $numIndices; $i++) {
					echo '<button class="btn btn-default" type="submit" id="btnIrA'. $i
						.'" name = "btnIrA'.$i.'" value = '.$i.'>'.$i.'</button>';
				}
				echo '<button class="btn btn-default" type="submit" id="btnIrAUltimo" name = "btnIrAUltimo">Last</button>';
				echo '</div></div>';
			}	
			?>

	</div>
	</form>
</div>
<?php
foot();		
?>
