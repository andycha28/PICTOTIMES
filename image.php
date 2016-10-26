<?php
        include ("Clases/searchAccion.php");
        require_once('Clases/Archivo.php');
        include('header.php');
        head('Pictotime', 'Busqueda');

        $archivo = new Archivo();
        $cursor = $archivo->getArchivo($_GET['image']);
        $dato = array();
        foreach($cursor as $fila){
            $dato = $fila;
        }


?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-10 col-md-5 col-sm-5">
                        <h3>
                            <?php
                            echo implode(' ', $dato['nombreImagen']);
                            ?>
                        </h3>
                    </div>

    <?php
        require_once('Clases/Global.php');
        $global = new G();
        $ubicacion = $dato['url'];
        //Obteniendo la url de la imagen (actual)
        $host= $_SERVER["HTTP_HOST"];
        $url= $_SERVER["REQUEST_URI"];
        $direccion = "http://" . $host . $url;
    ?>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <div id="fb-root"></div>
                        <!-- Your share button code -->
                        <div class="fb-share-button" 
                            data-href="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" 
                            data-layout="button_count"></div>
                    </div>
                </div>
            </div>
   

            <div class="panel-body">
           <?php
                            echo '<img src="ftp://'
                            .$global->getFtpServer().'/files/'.$ubicacion.'" width="300" height="300">';
            ?>
            </div>


    
                        


<?php
foot();         
?>
