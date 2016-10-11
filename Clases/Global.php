<?php
	class G{
		private $directorioTmp;
		private $direccionMongo;
		private $ftpServer;
		private $ftpUserName;
		private $ftpUserPass;
		private $DB;
		private $coleccion;
		function __construct(){
			$this->directorioTmp = "/tmp/";
			$this->direccionMongo = "mongodb://192.168.124.218:27017";
			$this->DB = "pictotime";
			$this->coleccion = "imagenes";
			

			$this->ftpServer = "192.168.124.226";
			$this->ftpUserName = "ubuntu";
			$this->ftpUserPass = "asdf";
		}
		function getDB(){
			return $this->DB;
		}
		function getColeccion(){
			return $this->coleccion;
		}
		function getDirectorioTmp(){
			return $this->directorioTmp;
		}
		function getDireccionMongo(){
			return $this->direccionMongo;
		}
		
		function getFtpServer(){
			return $this->ftpServer;	
		}
		function getFtpUserName(){
			return $this->ftpUserName;	
		}
		function getFtpUserPass(){
			return $this->ftpUserPass;	
		}


	}			
?>
