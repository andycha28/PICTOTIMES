<?php
require_once('deleteAction.php');
class testDeleteAction extends PHPUnit_Framework_TestCase
{

        /**
         * @expectedException PHPUnit_Framework_Error
         */
        public function testDeleteImageError(){
                $testPT = new eliminarContenido();
		$idArchivo = "";
		$rutaArchivo = "";
		$respuesta = "";
                $testPT->eliminarArchivo($idArchivo, $rutaArchivo, $respuesta);
        }
        /**
         * Prueba unitaria eliminar imagen OK
         */
        public function testDeleteImageOK(){
                $testPT = new eliminarContenido();
                $idArchivo = "5989898e98r9e";
                $rutaArchivo = "89178270994788791287394.png";
                $respuesta = "";
                $this->assertTrue($testPT->eliminarArchivo($idArchivo, $rutaArchivo, $respuesta)==true);
        }
        /**
         * Prueba unitaria eliminar imagen FAIL
         */
        public function testDeleteImageFAIL(){
                $testPT = new eliminarContenido();
                $idArchivo = "7347508083048";
                $rutaArchivo = "18723797683903I0I0.png";
                $respuesta = "";
                $this->assertFalse($testPT->eliminarArchivo($idArchivo, $rutaArchivo, $respuesta)==false);
        }


    }
?>
