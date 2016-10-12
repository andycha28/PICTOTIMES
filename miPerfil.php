<?php
  include('header.php');
  head('pictotime','Mi Perfil');
  include('Clases/perfilAction.php');
  include('Clases/Global.php');
  $global = new G();
?>

<?php 
try {
     $perfil = new verPerfil();
     $cursor=$perfil->buscarUsuario($_COOKIE['id_fb'],5);
     $cantidad= count($cursor);
     if ($cantidad==0){
      echo 'No has subido ninguna imagen. Ve a la seccion Subir Fichero';
     }else{
      foreach($cursor as $elemento){
        //print_r($elemento);
        echo '<h3>'.$elemento['nombreImagen'][0].'</h3>';
        echo '</br>';
        echo '<img style ="width:250px;"src="ftp://'.$global->getFtpServer().'/files/'.$elemento['url'].'" /> ';
        echo  '<p><a href="imagedel.php?image='.$elemento["_id"].'" class="btn btn-primary" role="button">Ver</a></p>'; 
        echo '</br>';
      }
     
     }
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
 
  
?>

<?php
  foot();
?>

