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
        <div class="panel">
                <h3>Vista Previa</h3>
        </div>

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
        echo '<img src="ftp://'
             .$global->getFtpServer().'/files/'.$ubicacion.'" width="500" height="400">';
<<<<<<< HEAD
=======

>>>>>>> master
?>
    
                        


<?php
foot();         
?>
