<?php 
	class uploadImage
	{
		var $respOk = "Se ha cargado correctamente el archivo con exito. ";
		var $respError = "No se cargo correctamente";
		function check_params($tamanhoArchivo, $isset, $tipoArchivo, &$strRespuesta){
			
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



		function upload($nombreUsuario, $nombreOriginal,$tipoArchivo, $tamanhoArchivo, $isset, $nombreTemporal, &$strRespuesta, &$strUbicacion)
		{
		 	require_once('Global.php');
			$global = new G();
			$rutaArchivo = $directorioTmp . $nombreOriginal;
			//echo $rutaArchivo;
			$datetime = time();
			$nombreMd5 = md5($nombreOriginal);
			$rutaArchivoTmp = $nombreMd5 . $datetime;
			$nombreImagenTemporal = $rutaArchivoTmp.".".$tipoArchivo;
			if($tamanhoArchivo > 5000000){
				$strRespuesta = $this->respError . ": La imagen no debe de pesar más de 5Mbytes";
			}
			if($isset){
				$strRespuesta = $this->respError . ": Debe de subir algo";
				return false;
			}
			if($tipoArchivo == 'jpg' || $tipoArchivo == 'jpeg' || $tipoArchivo == 'png')
			{
				$rutaArchivoTmp = $global->getDirectorioTmp() . $rutaArchivoTmp . "." . $tipoArchivo;
			}
			else
			{
				$strRespuesta = $this->respError . ": Formato " . $formatioArchivo . " invalido";
				return false;
			}

			if (move_uploaded_file($nombreTemporal, $rutaArchivoTmp)) 
    		{

				$rutaServidor = $_SERVER['DOCUMENT_ROOT']."/PICTOTIMES/.TempImages/".$nombreImagenTemporal;
				if(!copy($rutaArchivoTmp, $rutaServidor)){
					echo "<br>Error";
				}
				unlink($rutaArchivoTmp);
				//$fecha = getdate();
				//$fechaHoy = $fecha['year'].$fecha['mon'].$fecha['mday'];
				$image_dir = ".TempImages/".$nombreImagenTemporal;
				$strUbicacion = $image_dir;
				$strRespuesta = "Imagen cargada exitosamente<br><br>";
				return true;
    	 	}
    	 	 else 
    	 	{	
    	 		$strRespuesta = $respError;
    	 		return false;
        	}
		}
		function deletetmps($strimage)
		{
			unlink($strimage);
			
		}	
	}	
 ?>
