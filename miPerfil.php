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
?>
        <div class="col-sm-12 col-md-4 col-lg-4">
          <div class="thumbnail">
              <?php echo '<img style=width:200px;height:200px;class="img-responsive img-circle" src="ftp://'.$global->getFtpServer().'/files/'.$elemento['url'].'">'; ?>
              <div class="caption">
                <h3><?php echo implode(' ', $elemento["nombreImagen"]); ?></h3>
                    <?php echo '<p><a href="imagedel.php?image='.$elemento["_id"].'" class="btn btn-primary" role="button">Ver</a></p>'; ?>
              </div>
          </div>
        </div>


<?php
       
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

