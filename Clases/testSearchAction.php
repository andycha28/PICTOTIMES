<?php
	require_once 'searchAction.php';
class testSearchAccion extends PHPUnit_Framework_TestCase{
	/**
	 * Verificando que la busqueda  no retorne null 
	 */
	public function testSearchNullFAIL(){
		$respuesta = new pictotimeBusqueda();
		$criterioBusqueda = "no";
		$numSeccion = 1;
		$numResultados = 0;
		$strRespuesta = "no confies";
		$cursor = $respuesta->buscar($criterioBusqueda,$numSeccion, $numResultados, $strRespuesta);
		$this->assertNotNull($cursor);			
	}
	/** 
	 * Verificando que una imagen no existe 
	 */
	public function testSearchImageNotExistOK(){
		require_once('Archivo.php');
		$archivo = new Archivo();
                $cursor = $archivo->getArchivo("id_falso");
		$resultado = isset($cursor);
                $this->assertSame($resultado,false);
	}
	/**
	 *  Verificando que la busqueda retorne null 
	 */
        public function testSearchNullOK(){
                require_once('Archivo.php');
                $archivo = new Archivo();
                $cursor = $archivo->getArchivos(0);
                $this->assertNull($cursor);
        }
}
?>