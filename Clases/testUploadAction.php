<?php
require_once('Global.php');
require_once('uploadAction.php');
class testUploadAction extends PHPUnit_Framework_TestCase
{
	public function setUp(){}
	public function tearDown(){}
	/**
	 * Prueba unitaria, para la verificación de parametros 
	 */
	public function testCheckParamsOK(){
		$testPT = new Pictotimefile();
		$nombrePublicado = "namePublicado";
		$tamanhoArchivo = 500;
		$isset = false;
		$tipoArchivo = "jpg";
		$strRespuesta = "";
		$this->assertTrue($testPT->check_params($nombrePublicado, $tamanhoArchivo, $isset, $tipoArchivo, $strRespuesta)==true);
	}
	/** 
	 * Prueba unitaria, para el fallo en los parametros 
	 */
	public function testCheckParamsFAIL(){
                $testPT = new Pictotimefile();
                $nombrePublicado = "";
                $tamanhoArchivo = 500;
                $isset = false;
                $tipoArchivo = "jpg";
                $strRespuesta = "";
                $this->assertEquals($testPT->check_params($nombrePublicado, $tamanhoArchivo, $isset, $tipoArchivo, $strRespuesta),false);
        }
	/** 
	 * Prueba unitaria, para subir el archivo al ftp, valida la conexión al ftp 
	 */
        public function testConnectFtpOK(){
		$testPT = new Pictotimefile();
		$this->assertTrue($testPT->connect_ftp($tmp)==true);
	}
	/** 
	 * Prueba unitaria, comprobando un nombre vacio para el archcivo
	 */
	public function testNombreVacioOK(){
		$nombrePublicado = "";
		$this->assertSame($nombrePublicado,"");
	}
}
?>
