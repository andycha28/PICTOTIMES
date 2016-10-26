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
     $cursor=$perfil->buscarUsuario($_COOKIE['id_fb']);
     $cantidad= count($cursor);
     if ($cantidad==0){
      echo 'No has subido ninguna imagen. Ve a la seccion Subir Fichero';
     }else{

      foreach($cursor as $elemento){
         echo '<div class="col-sm-12 col-md-4 col-lg-4"><div class="thumbnail">';
          echo '<img style=width:200px;height:200px; class="img-responsive img-circle" src="ftp://'
            .$global->getFtpServer().'/files/'.$elemento['url'].'">';
          echo '<div class="caption">';
          echo "<h3>" . implode(" ", $elemento['nombreImagen'])."</h3>";
          echo '<p><a href="imagedel.php?image='.$elemento['_id']
            .'" class="btn btn-primary" role="button">Ver</a></p>';
          echo '</div></div></div>';
      }
     
     }
  }
       

 catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
 
  
?>

<?php
  foot();
?>

