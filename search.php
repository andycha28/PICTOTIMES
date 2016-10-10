<?php
	include ("Clases/searchAction.php");
	include('header.php');
	head('Pictotime', 'Busqueda');
?>
	<div class="panel">
		<h3>Buscar Imagenes</h3>
	</div>

	<form action = "search.php" method = "post" enctype="multipart/form-data">

				<label>&iquest;Que necesitas?</label>
				<input name="txtBuscar" type="text"><br>
				<button type="submit" id="btnBuscar" name = "btnBuscar">Buscar imagen</button></br>

				<?php
				if(isset($_POST['btnBuscar']))
				{
	
					$strBuscar = trim($_POST["txtBuscar"]);
					require_once("Clases/conexionMongo.php"); 
					$cone = new conexionMongo();
					$numResultados = $cone->getConteoColeccionImagenesTotal($strBuscar);
					$numIndices = ceil($numResultados/3);
					iniciarBusqueda(1, $strBuscar);
				}
				if(isset($_POST['numIndices']))
				{
	
					$numIndices = $_POST['numIndices'];
					$strBuscar = trim($_POST['strLoQueBusco']);
					for ($i = 1; $i <= $numIndices; $i++) 
					{
						if(isset($_POST['btnIrA'.$i]))
						{
						iniciarBusqueda($i, $strBuscar);
						break;			
						}
					}
				if(isset($_POST['btnIrAPrimero']))
				{
					iniciarBusqueda(1, $strBuscar);
				}

				if(isset($_POST['btnIrAUltimo']))
				{
					iniciarBusqueda($numIndices, $strBuscar);
				}
	
				
				}
			function iniciarBusqueda($numSeccion, $paramStrBuscar)
			{
				require_once('Clases/Global.php');
				$global = new G();
				$busqueda = new pictotimeBusqueda();
				echo '<input type="hidden" name="strLoQueBusco" value="'. $paramStrBuscar . '" />';
				$cursor = $busqueda->buscar($paramStrBuscar, $numSeccion, $numResultados, $strRespuesta);
				foreach ($cursor as $elemento) {
					echo '<div class=""><div class="thumbnail">';
					echo '<img src="ftp://'
						.$global->getFtpServer().'/files/'.$elemento['url'].'"width="150" height="150">';
					echo '<div class="caption">';
					echo "<h3>" . implode(" ", $elemento['nombreImagen'])."</h3>";
					echo '<p><a href="image.php?image='.$elemento['_id']
						.'" class="btn" role="button">Ver</a></p>';
					echo '</div></div></div>';
				}
				$numIndices = ceil($numResultados/3);
				echo '</div>';
				echo '<div class="row"><div>';
				echo '<input type="hidden" name="numIndices" value= '. $numIndices .' />';
				echo '<button class="btn btn-default" type="submit" id="btnIrAPrimero" name = "btnIrAPrimero">First</button>';
				for ($i = 1; $i <= $numIndices; $i++) {
					echo '<button type="submit" id="btnIrA'. $i
						.'" name = "btnIrA'.$i.'" value = '.$i.'>'.$i.'</button>';
				}
				echo '<button  type="submit" id="btnIrAUltimo" name = "btnIrAUltimo">Last</button>';
				echo '</div></div>';
			}	

				?>
		</form>
	</form>
</div>
<?php
foot();		
?>
