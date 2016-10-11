<?php
	include('header.php');
	head('pictotime','Inicio');
	require_once('Clases/Archivo.php');
	require_once('Clases/Global.php');
	$global = new G();
?>
		<h2 id="TituloIndex">Pictotime</h2>

<div class="row">
<?php
	$archivos = new Archivo();
	$cursor = $archivos->getArchivos(12);
	foreach($cursor as $fila){
		//echo $fila['url'] ;
?>
<div class="col-sm-12 col-md-4 col-lg-4">
	<div class="thumbnail">
		<?php 
		$styl = "width:204px;height:204px;"; 
			echo '<img style= "'.$styl.'" src="ftp://'.$global->getFtpServer().'/files/'.$fila['url'].'">';
		?>
		<div class="caption">
			<h3><?php echo implode(' ', $fila["nombreImagen"]); ?></h3>
			<?php echo '<p><a href="image.php?image='.$fila["_id"].'" class="btn btn-primary" role="button">Ver</a></p>'; ?>
		</div>
	</div>
</div>
<?php
	}
?>
</div>
<?php
	foot();
?>
