<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Descrição da Página para o google-->
	<meta name="description" content="Tienda de muebles, ventas y financiacion de comodas cuotas.">
	<!-- Palavras Chave da Página para o google-->
	<meta name="keywords" content="vitrine virtual, muebles, electrodomésticos, ciudad del este">	
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/head.php'; ?>
	<!-- /.FIN DEL HEADER -->
	<title>Vitrine Virtual - Producto</title>
</head>
<body>
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/header.php'; ?>
	<!-- /.FIN DEL HEADER -->
	
	<?php include_once "admin/objs/producto.php";?>
	<!-- INICIO DEL CONTENIDO -->
	<main class="">
		<section class="producto">
			<div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
						<?php echo breadcrumbMenu ($categoria);?>
                    </div>
				</div>
				<?php
					if ($producto != null){

				?>
				<div class="row">
					<!-- solamente en pantallas grandes -->
					<div class="col-md-1 d-none d-md-block d-lg-block" >
						<?php 
							if ($images != NULL) {
								foreach($images as $row) {
						?>
						<img class="img-fluid img-thumbnail" src="admin/img/productos/<?php echo $row['url'];?>" alt="Imagem de capa do card" style="margin-bottom: 10px;" onclick="changeImage('<?php echo $row['url'];?>')">
                        <?php 
								}
							} else {
								$images[0]['url'] = "/no-image.png";
						?>
						<img class="img-fluid img-thumbnail" src="admin/img/productos/no-image.png" alt="Imagem de capa do card" style="margin-bottom: 10px;" onclick="changeImage('no-image.png')">
						<?php

							}
						?>
					</div>
					<!-- solamente en pantallas grandes -->
                    <div class="col-md-3 d-none d-md-block d-lg-block" style="margin-right: 50px;">
                        <img class="img-fluid img-thumbnail" src="admin/img/productos/<?php echo $images[0]['url'];?>" alt="Imagem de capa do card" id="imgMaxSize" data-toggle="modal" data-target="#Modal" data-nombre="<?php echo $producto['nombre'];?>">
					</div>

					<!-- solamente en pantallas chicas -->
                    <div class="col-md-12 d-block d-md-none">
                        <img class="img-fluid img-thumbnail" src="admin/img/productos/<?php echo $images[0]['url'];?>" alt="Imagem de capa do card" id="imgMaxSize2" data-toggle="modal" data-target="#Modal" data-nombre="<?php echo $producto['nombre'];?>">
					</div>
					<div class="col-md-12 mini-prod d-block d-md-none" >
						<?php 
							if ($images != NULL) {
								foreach($images as $row) {
						?>
						<img class="img-fluid img-thumbnail mini-img" src="admin/img/productos/<?php echo $row['url'];?>" alt="Imagem de capa do card" onclick="changeImage2('<?php echo $row['url'];?>')">
                        <?php 
								}
							}
						?>
					</div>

					<!-- <div class="col-md-1"></div> -->
					<div class="col-md-7">
                        <h3><?php echo $producto['nombre'];?></h3>
                        <div class="col-md-12 producto-codigo">
                            <p><?php echo $producto['categoria'];?><br>
                            CÓDIGO: <?php echo $producto['codigo'];?></p>
                        </div>
                        <!-- <div class="row"> -->
							<h4><b>
								<?php
									$precio = "";
									if ($producto['ctd_cuota'] > 0 && $producto['valor_cuota'] > 0) {
										$precio = $producto['ctd_cuota']." cuotas de ".number_format($producto['valor_cuota'], 0, ',', '.')." gs";
									} else {
										$precio = "Al contado ".number_format($producto['precio'], 0, ',', '.')." gs";
									}
									echo $precio;
								?>
							</b></h4>
							<p class="desc"><?php echo $producto['descripcion'];?></p>
						<!-- </div> -->
						<br>
						<input type="hidden" id="whatsventas" value="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $info['whatsapp']);?>/?text=<?php echo $urlencode;?>">
						<form action="" method="post">
							<button type="submit" name="contactoventas" class="btn btn-outline-info" onclick="newPage();"><i class="fa fa-whatsapp"></i> Contacto en ventas</button>
						</form>
						<!-- <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $info['whatsapp']);?>/?text=<?php echo $urlencode;?>" target="_blank" class="btn btn-outline-info">
							<i class="fa fa-whatsapp"></i> Contacto en ventas
						</a> -->
						<!-- <a href="https://wa.me/595974400000" target="_blank" class="btn btn-outline-info">Más informaciones</a> -->
					</div>
				</div> <!-- row -->
				<?php
					} else { 
						$otros = getProductosBy ("destacados", null);
				?>
				<div class="row">
					<div class="col-md-12 text-center">
						<h2><b>Producto no encontrado</b></h2>
					</div>
					<div class="col-md-12 text-center">
						<p>La página solicitada no existe o ha sido cambiada.</p>
					</div>
				</div>
				<?php
					}
				?>
				<br>
				<?php
					if ($otros != NULL) {
				?>
				<div class="row">
					<div class="col-md-12"><h4><br><b>Productos que te pueden interesar</b></h4></div>
					<div class="col-md-12" style="margin-top: 20px;">						
						<div class="owl-carousel owl-theme prod-carousel1 d-none d-md-block d-lg-block">
							<?php
								// if ($otros != NULL) {
									foreach($otros as $prod) {
										if ($prod['codigo'] != $cod_producto){
							?>
							<div class="item">
								<?php echo createCard ($prod);?>
							</div>
							<?php
										}//END IF COD
									}//END FOR 
								// }//END IF NULL
							?>
						</div>
						<div class="owl-carousel owl-theme prod-carousel2 d-block d-md-none">
							<?php
								// if ($otros != NULL) {
									foreach($otros as $prod) {
										if ($prod['codigo'] != $cod_producto){
							?>
							<div class="item">
								<?php echo createCard ($prod);?>
							</div>
							<?php
										}//END IF COD
									}//END FOR 
								// }//END IF NULL
							?>
						</div>
					</div>	
				</div> <!-- row -->
				<?php
					}//END IF NULL
				?>
			</div>			
		</section>

		<!-- Modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="Modal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Codigo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8">
								<img src="admin/img/productos/no-image.png" alt="" id="imgproducto" class="img-fluid">
							</div>
						</div> <!-- row -->
					</div> <!-- modal-body -->
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- ./Modal -->	
	</main>
	<!-- /.FIN DEL CONTENIDO -->

	<?php include 'includes/scripts.php'; ?>
	<script type="text/javascript">
		<?php include_once "admin/js/u_prod.js"; ?>
		function newPage() {
			var urlwhats = document.getElementById("whatsventas").value;
			window.open(urlwhats);
		}
	</script>

	<!-- INICIO DEL FOOTER -->
	<?php include 'includes/footer.php'; ?>
	<!-- /.FIN DEL FOOTER -->	

</body>
</html>