<?php
        require_once ("Clases/deleteAction.php");
        require_once('Clases/Archivo.php');
        include('header.php');
        

        $archivo = new Archivo();
        $cursor = $archivo->getArchivo($_GET['image']);
        $eliminar = new eliminarContenido();
        $dato = array();
        foreach($cursor as $fila){
            $dato = $fila;
        }
        if(isset($_POST['btnEliminar'])){
        if($eliminar->eliminarArchivo($_GET['image'], 'files/'.$dato['url'], $strRespuesta))
        {
            echo $strRespuesta;
            header('location: index.php');
        }else{
            echo $strRespuesta;

        }
    }
        head('Pictotime', implode(' ', $dato['nombreImagen']));

?>
        <div class="panel">
                <h3><?php
                        echo implode(' ', $dato['nombreImagen']);
                    ?>
                    
                </h3>               
        

<?php
       
        require_once('Clases/Global.php');
        $global = new G();
        $ubicacion = $dato['url'];
        //Obteniendo la url de la imagen (actual)
        $host= $_SERVER["HTTP_HOST"];
        $url= $_SERVER["REQUEST_URI"];
        $direccion = "http://" . $host . $url;
        echo '<div class="">';
        //Mostrar la imagen
        echo '<img src="ftp://'.$global->getFtpServer().'/files/'.$ubicacion.'" width="500" height="400">';
        //Boton compartir a fb
        echo '<div class="fb-share-button" data-href='. $direccion.' data-layout="button" data-size="large" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u='. $direccion .'&amp;src=sdkpreparse">Compartir</a></div>';
        echo '</div>';

?>
            <div class="panel-body">        
                    <form name="formEliminar" action="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" method="post">
                        <input class="btn btn-danger" type='submit' name='btnEliminar' value="Eliminar Meme">
                    </form>
                
            </div>
        </div>
                        


<?php
foot();         
?>
