
<?php
require_once('editorAction.php');
class testEditorAction extends PHPUnit_Framework_TestCase
{
	
	/**
	 * @expectedException PHPUnit_Framework_Error
	 */
	public function testDeleteImageFAIL(){
		$Imagen = new uploadImage();
		$res = $Imagen->deletetmps("89kpjouomoo");
	}
         /** 
	  *  @expectedException PHPUnit_Framework_Error 
	  */
        public function testFailingIncludeOK()
        {
     		include 'editrAction.php';
        } 
	 /** 
	   * Prueba unitaria, para la verificación de parametros 
	   */
	public function testCheckParamsOK(){
		$testPT = new uploadImage();
		$tamanhoArchivo = 500;
		$isset = false;
		$tipoArchivo = "jpg";
		$strRespuesta = "";
		$this->assertTrue($testPT->check_params($tamanhoArchivo, $isset, $tipoArchivo, $strRespuesta)==true);
	}
	 /** 
	   * Prueba unitaria, para el fallo en los parametros 
	   */
	public function testCheckParamsFAIL(){
                $testPT = new uploadImage();
                $tamanhoArchivo = 10000000;
                $isset = false;
                $tipoArchivo = "jpg";
                $strRespuesta = "";
                $this->assertTrue($testPT->check_params($tamanhoArchivo, $isset, $tipoArchivo, $strRespuesta)==false);
        }
}
?>