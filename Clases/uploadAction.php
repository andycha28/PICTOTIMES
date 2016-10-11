<?php 
	/**
	* 
	*/
	
	class Pictotimefile
	{
		var $respOk = "Se ha cargado correctamente el archivo con exito. ";
		var $respError = "Ha ocurrido un error al cargar el archivo. ";

		function check_params($nombrePublicado, $tamanhoArchivo, $isset, $tipoArchivo, &$strRespuesta){
			if($nombrePublicado == ""){
				$strRespuesta = $strRespuesta . $this->respError . " : Es necesario indicar un nombre a la publicacion";
				return false;
			}
			if($tamanhoArchivo > 5000000){
				$strRespuesta = $strRespuesta . $this->respError . ": La imagen no debe de pesar más de 5Mbytes";
                                return false;
                        }
                        if($isset){
                                $strRespuesta = $strRespuesta . $this->respError . ": No se ha seleccionado ninguna imagen";
                       		return false;
			}
                        if(!($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png' || $tipoArchivo == 'gif'|| $tipoArchivo == 'bmp'))
                        {
                                $strRespuesta = $strRespuesta .  $this->respError . ": Formato " . $formatioArchivo . " invalido";
				return false;
                        }
			return true;			
		}

		function upload($nombreUsuario, $nombreOriginal, $nombrePublicado, $tipoArchivo, $tamanhoArchivo, $isset, $nombreTemporal, &$strRespuesta)
		{
		 	require_once('Global.php');
			$global = new G();
			$rutaArchivo =$global->getDirectorioTmp() . $nombreOriginal;
			$datetime = time();
			$nombreMd5 = md5($nombreOriginal);
			$rutaArchivoTmp = $global->getDirectorioTmp() . $nombreMd5 . $datetime;


			//** Verificando parametros...
			if(!($this->check_params($nombrePublicado, $tamanhoArchivo, $isset, $tipoArchivo, $strRespuesta))){
			   return false;
			}
			//** Los parametros son correctos...
			$rutaArchivoTmp = $rutaArchivoTmp . "." . $tipoArchivo;			
			//echo $rutaArchivoTmp;

			// Subida de Archivo a carpeta temporal
			if (!(move_uploaded_file($nombreTemporal, $rutaArchivoTmp))) {
				$strRespuesta = $this->$respError;
                        	return false;
			}
	    		
			$originalname = "files/".$nombreMd5.".".$tipoArchivo;
			//echo $originalname;
    			
    			if(!($this->sendtoFtp($rutaArchivoTmp,$originalname,$strRespuesta)))
    			{
				$strRespuesta = '<div class="alert alert-danger">' 
							. $this->respError."no subi ftp"
						.'</div>';
				return false;				
			}
			require_once 'conexionMongo.php';
                        $conexion = new conexionMongo();
                        $conexion->insertarRegistro($nombreUsuario,trim($nombrePublicado),$nombreMd5 . "." . $tipoArchivo);
                        $strRespuesta = '<div class="alert alert-success">'
                                            .$strRespuesta
                                            .'</div>';

                        $image_dir= 'ftp://' . $global->getFtpServer() ."/files/". $nombreMd5 . "." . $tipoArchivo ; 
                        $strRespuesta = $strRespuesta ."<img src=".$image_dir ." style='width:304px;height:228px;'>";
                        return true;
		}

		function connect_ftp(&$conFtp){
                        require_once("Global.php");
                        $global = new G();
                        $conFtp = ftp_connect($global->getFtpServer()) or die ("Error de conexion servidor de archivos");
                        $loginResultado = ftp_login($conFtp, $global->getFtpUserName(), $global->getFtpUserPass()) or die ("Error de login");

                        if(!$conFtp || !$loginResultado)
                        {
                          die("La conexión a servido ftp no funciono!!");
                          return false;
                        }
			return true;
		}
   
		function sendtoFtp($rutaArchivoTmp,$rutaArchivoFtp,&$strRespuesta)
    		{
			$conFtp;
			if(!($this->connect_ftp($conFtp))){
				return false;
			}

			ftp_pasv($conFtp, true);
			if(ftp_put($conFtp, $rutaArchivoFtp, $rutaArchivoTmp, FTP_BINARY)){
				unlink($rutaArchivoTmp);
				$strRespuesta = $this->respOk
						.": Archivo subido al repositorio";
				return true;
			}else {
				$strRespuesta = $this->respError
					.": Problemas con el servidor de archivos";
				return false;
			}
    		}

	 }
 ?>
