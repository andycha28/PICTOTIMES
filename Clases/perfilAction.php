<?php
class verPerfil{
	private $respOk;
	private $respError;
	public function __construct(){
		$this->respOk = "No ha Creado Imagenes";
	}
	
	public function buscarUsuario($idUsuario){			
		require_once('conexionMongo.php');
		$conMongo = new conexionMongo();
		return $conMongo->buscarUsuario($idUsuario);
    		
	}
}
?>
