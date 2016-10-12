<?php
 	include("Clases/editorAction.php"); 
 	$strRepuesta = "";
	include('header.php');
	head('pictotime', 'Editor');	
?>
<script type="text/javascript" src="./js/jquery.js"></script>
<script>
function realizaProceso(valorRuta, valorTexto, valorTexto2, valorRojo1, valorVerde1, valorAzul1,
	valorRojo2, valorVerde2, valorAzul2, valorFuente, valorSize, valorAlineacionTexto1,
	valorAlineacionTexto2, valorMargen1, valorMargen2){
        var parametros = {
                "valorRuta" : valorRuta,
                "valorTexto" : valorTexto,
                "valorTexto2" : valorTexto2,
                "valorRojo1" : valorRojo1,
                "valorVerde1" : valorVerde1,
                "valorAzul1" : valorAzul1,
                "valorRojo2" : valorRojo2,
                "valorVerde2" : valorVerde2,
                "valorAzul2" : valorAzul2,
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
<br>
<br>
<label >Cargar imagen a editar</label><br>
<form action = "imageWithText.php" method = "post" enctype="multipart/form-data">
	<input type="file" name = "btnSeleccionar" id="btnSeleccionar" value="Elegir archivo"><br>
	<!--<label >Nombre: </label><input type="text" id="txtNombre" name = "txtNombre"><br>-->
	<button type="submit" id="btnSubir" name = "btnSubir">Cargar Imagen</button>&nbsp&nbsp&nbsp

	<?php
		$nombreArchivo = basename($_FILES["btnSeleccionar"]["name"]);
		$tipoArchivo =  pathinfo($nombreArchivo,PATHINFO_EXTENSION);
		$nombreTemporal = $_FILES["btnSeleccionar"]["tmp_name"];
		$tamanhoArchivo = $_FILES["btnSeleccionar"]["size"];

		if(isset($_POST['btnSubir'])){
			$Imagen = new uploadImage();
			$status = $Imagen->upload($_COOKIE['nombre'], $nombreArchivo, $tipoArchivo, $tamanhoArchivo, isset($_POST["submit"]), $nombreTemporal, $strRepuesta, $strUbicacion);
			echo $strRepuesta;
//********************************************************
			if($strRepuesta == "Imagen cargada exitosamente<br><br>"){
				$texto = "<label><b>EDITE EL TEXTO PARA LA IMAGEN</b></label><br><br>
					
					Texto Superior:&nbsp&nbsp&nbsp<input type=\"text\" name=\"texto\" id=\"texto\" value=\"Texto 1\"/>
					&nbsp&nbsp&nbsp Colores RGB: &nbsp
					Rojo:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"255\" style=\"width:50px;\" name=\"rojo1\" id=\"rojo1\" value=\"0\"/>
					Verde:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"255\" style=\"width:50px;\" name=\"verde1\" id=\"verde1\" value=\"0\"/>
					Azul:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"255\" style=\"width:50px;\" name=\"azul1\" id=\"azul1\" value=\"0\"/>
					Alineacion:&nbsp&nbsp&nbsp
					<SELECT name=\"alineacionTexto1\" id=\"alineacionTexto1\">
						<option>Center</option><option>Left</option><option>Right</option>
					</SELECT>
					Margen Superior:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"200\" style=\"width:50px;\" name=\"margen1\" id=\"margen1\" value=\"20\"/>
					<br>

					Texto Inferior:&nbsp&nbsp&nbsp<input type=\"text\" name=\"texto2\" id=\"texto2\" value=\"Texto 2\"/>
					&nbsp&nbsp&nbsp Colores RGB: &nbsp
					Rojo:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"255\" style=\"width:50px;\" name=\"rojo2\" id=\"rojo2\" value=\"0\"/>
					Verde:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"255\" style=\"width:50px;\" name=\"verde2\" id=\"verde2\" value=\"0\"/>
					Azul:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"255\" style=\"width:50px;\" name=\"azul2\" id=\"azul2\" value=\"0\"/>
					Alineacion:&nbsp&nbsp&nbsp
					<SELECT name=\"alineacionTexto2\" id=\"alineacionTexto2\">
						<option>Center</option><option>Left</option><option>Right</option>
					</SELECT>
					Margen Inferior:&nbsp&nbsp&nbsp<input type=\"number\" min=\"0\" max=\"200\" style=\"width:50px;\" name=\"margen2\" id=\"margen2\" value=\"20\"/>
					<br>
					General: &nbsp
					<SELECT name=\"fuente\" id=\"fuente\">
						<option>arial</option><option>Lackey</option><option>Lactam</option><option>Ladybug</option>
						<option>Lady bug Italic</option><option>LA Outline DB</option><option>Larson</option>
						<option>Lava Vision</option><option>Lcdd</option><option>LunasolC</option>
					</SELECT>
					&nbsp&nbsp&nbsp Size: &nbsp&nbsp&nbsp<input type=\"number\" min=\"5\" max=\"100\" style=\"width:50px;\" name=\"size\" id=\"size\" value=\"50\"/>
					<br>

					<input type=\"submit\" href=\"javascript:;\" onclick=\"realizaProceso($('#ruta').val(), $('#texto').val(), $('#texto2').val(),$('#rojo1').val(),$('#verde1').val(),$('#azul1').val(),$('#rojo2').val(),$('#verde2').val(),$('#azul2').val(),$('#fuente').val(), $('#size').val(), $('#alineacionTexto1').val(), $('#alineacionTexto2').val(), $('#margen1').val(),$('#margen2').val() );return false;\" value=\"Visualizar\"/>";
				echo $texto;
	//********************************************************
				echo "<input type=\"hidden\" name=\"valor_ruta\" id=\"ruta\" value=\"".$strUbicacion."\"/>";
				
				echo "<span id=\"resultado\"></span><br>";
			}
		} 
	?>
</form>
<?php
	foot();
?>
