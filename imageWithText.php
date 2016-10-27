<?php
 	include("Clases/editorAction.php"); 
 	$strRepuesta = "";
	include('header.php');
	head('pictotime', 'Editor');	
?>
<script type="text/javascript" src="./js/jquery.js"></script>
<script src="./js/jscolor.js"></script>
<script>
function realizaProceso(valorRuta, valorTexto, valorTexto2,valorFuente, valorSize, valorAlineacionTexto1,
	valorAlineacionTexto2, valorMargen1, valorMargen2){
        var parametros = {
                "valorRuta" : valorRuta,
                "valorTexto" : valorTexto,
                "valorTexto2" : valorTexto2,
                "RGB1" : document.getElementById('rgb').innerHTML,
                "RGB2" : document.getElementById('rgb2').innerHTML,
                "valorFuente" : valorFuente,
                "valorSize" : valorSize,
                "valorAlineacionTexto1" : valorAlineacionTexto1,
                "valorAlineacionTexto2" : valorAlineacionTexto2,
                "valorMargen1" : valorMargen1,
                "valorMargen2" : valorMargen2
        };
        $.ajax({
                data:  parametros,
                url:   'ImageEditor.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
</script>
<script>
function update1(picker) {

    document.getElementById('rgb').innerHTML =
        Math.round(picker.rgb[0]) + ',' +
        Math.round(picker.rgb[1]) + ',' +
        Math.round(picker.rgb[2]);
    
}
function update2(picker) {

    document.getElementById('rgb2').innerHTML =
        Math.round(picker.rgb[0]) + ',' +
        Math.round(picker.rgb[1]) + ',' +
        Math.round(picker.rgb[2]);
    
}
</script>
<<br>
<br>
<div class="panel panel-default">
	<div class="panel-heading">
		Subir imagenes
	</div>
	<div class="panel-body">
		<form action = "imageWithText.php" method = "post" enctype="multipart/form-data">
			<div class="form-group">
				<input type="file" name = "btnSeleccionar" class="form-control" id="btnSeleccionar" value="Elegir archivo"><br>
		    </div>
		    <div class="form-group">
				<button type="submit" class="btn btn-primary" id="btnSubir" name = "btnSubir">Cargar Archivo</button>
				<button type="reset" class="btn btn-default" id="btnCancelar" name="btnCancelar">Cancelar</button>


	<?php
		$nombreArchivo = basename($_FILES["btnSeleccionar"]["name"]);
		$tipoArchivo =  pathinfo($nombreArchivo,PATHINFO_EXTENSION);
		$nombreTemporal = $_FILES["btnSeleccionar"]["tmp_name"];
		$tamanhoArchivo = $_FILES["btnSeleccionar"]["size"];

		if(isset($_POST['btnSubir'])){
			$Imagen = new uploadImage();
			$status = $Imagen->upload($_COOKIE['nombre'], $nombreArchivo, $tipoArchivo, $tamanhoArchivo, isset($_POST["submit"]), $nombreTemporal, $strRepuesta, $strUbicacion);
			echo "<br><br>".$strRepuesta . "</div> </div>";
//********************************************************
			if($strRepuesta == "Imagen cargada exitosamente<br><br>"){
				echo "</form>";

				$texto = "<div class='panel panel-default'>
						  <div class='panel-heading'>
								<label>Edición de imágen</label>
						  </div>
					<form class='form-inline'>
							<div class='form-group'>
								<label >Texto Superior:</label>
							  	<input width: 200px; class='form-control' type='text' name='texto' id='texto' value='Texto 1'/>
						      	<label>Colores RGB:</label>
						      	<div style='display:none'  <span id='rgb'>255,204,0,</span></div>
							  	<input id=pick1 class='jscolor {onFineChange:'update1(this)'}' value='ffcc00' class ='form-control'>
							  	<label>Alineacion:</label>
								<SELECT class='selectpicker' name='alineacionTexto1' id='alineacionTexto1'>
									<option>Center</option><option>Left</option><option>Right</option>
								</SELECT>
							  	<label>Margen Superior:</label>
							  	<input type='number' min='0' max='200' style='width:50px;'  name='margen1' id='margen1' value='20'/>
								<br>
							</div>
							<div class='form-group'>
								<label >Texto Superior:</label>
								<input class='form-control' type='text' name='texto2' id='texto2' value='Texto 2'/>
								<label>Colores RGB:</label>
								<div style='display:none' <span id='rgb2'>255,204,0,</span>
								</div>
								<input class='jscolor {onFineChange:'update2(this)'}' value='ffcc00'>
								<label>Alineacion:</label>
								<SELECT name='alineacionTexto2' id='alineacionTexto2' class='selectpicker'>
									<option>Center</option><option>Left</option><option>Right</option>
								</SELECT>
								<label>Margen Inferior:</label>
							  	<input type='number' min='0' max='200' style='width:50px;'  name='margen2' id='margen2' value='20'/>
							</div>

							<div class='form-group'>
							  	<label>Fuente:</label>
								<SELECT name='fuente' id='fuente' class='selectpicker'>
									<option style=font-family:'arial'>arial</option>
									<option style=font-family:'123'>123</option>
									<option style=font-family:'hy'>hyHappywing</option>
									<option style=font-family:'bella'>Bella_Donna</option>
									<option style=font-family:'lackey';>Lackey</option>
									<option style=font-family:'lactam'>Lactam</option>
									<option style=font-family:'lb'>Ladybug</option>
									<option style=font-family:'lbi'>Lady bug Italic</option>
									<option style=font-family:'la'>LA Outline DB</option>
									<option style=font-family:'larson'>Larson</option>
									<option style=font-family:'lav'>Lava Vision</option>
									<option style=font-family:'lcd'>Lcdd</option>
									<option style=font-family:'lavi'>Lavi</option>
									<option style=font-family:'tyni'>TynineSans</option>
									<option style=font-family:'schoolbully'>schoolbully</option>
									<option style=font-family:'miranda'>Miranda25</option>
									<option style=font-family:'quick'>Quicksand</option>
									<option style=font-family:'seven'>sevenpoints</option>
									<option style=font-family:'swing'>swin</option>
									<option>LunasolC</option>
								</SELECT>
								Size:<input type='number' min='5' max='100' style='width:50px;' name='size' id='size' value='50' class= 'form-data'/>
							</div>
					</form>

					<input class='btn btn-primary' type=\"button\" href=\"javascript:;\" onclick=\"realizaProceso($('#ruta').val(), $('#texto').val(), $('#texto2').val(),$('#fuente').val(), $('#size').val(), $('#alineacionTexto1').val(), $('#alineacionTexto2').val(), $('#margen1').val(),$('#margen2').val() );return false;\" value=\"Visualizar\"/>";
				echo $texto;
	//********************************************************
				echo "<input type=\"hidden\" name=\"valor_ruta\" id=\"ruta\" value=\"".$strUbicacion."\"/>";
				echo "<span id=\"resultado\"></span><br>";
			}
		} 
	?>

<?php
	foot();
?>
