<?php
	require_once 'searchAccion.php';

class testSearchAccion extends PHPUnit_Framework_TestCase{

	public function testBuscarNull(){
		$respuesta = new pictotimeBusqueda();
		$criterioBusqueda = "no";
		$numSeccion = 1;
		$numResultados = 0;
		$strRespuesta = "no confies";
		$cursor = $respuesta->buscar($criterioBusqueda,$numSeccion, $numResultados, $strRespuesta);
		$this->assertNotNull($cursor);		
	
	}
}
?>
