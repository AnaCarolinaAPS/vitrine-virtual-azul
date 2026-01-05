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
	<title>Vitrine Virtual</title>
</head>
<body>
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/header.php'; ?>
	<!-- /.FIN DEL HEADER -->
	
	<?php include_once "admin/objs/index.php";?>
	<!-- INICIO DEL CONTENIDO -->
	<main class="">
		<section id="banner">
			<div class="container-fluid">
				<div class="row">
					<div id="carousel" class="owl-carousel owl-theme">
					<?php
						if ($banners != NULL) {
							foreach($banners as $banner) {
					?>
						<div class="item"><a href="<?php echo $banner['url'];?>"><img src="admin/img/banners/<?php echo $banner['img'];?>" alt="<?php echo $banner['img'];?>"></div></a>						
					<?php
						}}
					?>
					</div> <!-- owl-carousel -->
				</div>
			</div>
		</section>
		<?php
			if ($destacados != NULL) {
		?>
		<section class="destacados" id="destacados">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3>Productos en destaque</h3>	
					</div>
				</div>
				<!-- <div class="row"> -->
				<?php
					$qtd = 0;
					foreach($destacados as $producto) {
						if ($qtd == 0) {
							echo '<div class="row catalog-prod">';
						}
				?>
					<div class="col-md-3"> <!-- Imprime cards de productos -->
						<?php echo createCard ($producto);?> 
					</div>
				<?php
						$qtd++;
						if ($qtd == 4) {
							echo "</div>";
							$qtd = 0;
						}
					}//END FOR 
					if ($qtd <> 0) { 
						echo "</div>";
					}
				?>
				<!-- </div> -->
			</div>			
		</section>
		<?php
			}//END IF
		?>

		<?php
			if ($promociones != NULL) {
				foreach($promociones as $promo) {
					$productos = getProductosBy ("promocion", $promo['codigo']);
		?>
		<section class="" id="promo<?php echo $promo['codigo'];?>">
			<div class="container-fluid">
				<div class="row promocion">
					<div class="col-md-12">
						<h3><?php echo $promo['titulo'];?></h3>	
					</div>
				</div>
				<div class="row promocion-background" style="background-image: url(admin/img/promociones/<?php echo $promo['img_fondo'];?>);">
					<!-- <div class="row"> -->
						<div class="col-md-5 col1">
							<!-- <h4>IMG</h4> -->
							<img class="img-fluid" src="admin/img/promociones/<?php echo $promo['img'];?>" alt="Promo <?php echo $promo['titulo'];?>">
						</div>
						<div class="col-md-7 col2 " style="margin-top: 20px;">
							<div class="owl-carousel owl-theme promo-carousel d-none d-md-block d-lg-block">
								<?php
									// var_dump($destacados);
									if ($productos != NULL) {
										foreach($productos as $prod) {
											// if ($prod['codigo'] != $destacados[0]['codigo']){
								?>
								<div class="item">
									<?php echo createCard($prod);?>
								</div>
								<?php
											// }//END IF COD
										}//END FOR 
									}//END IF NULL
								?>
							</div> <!-- owl-carousel -->
							<div class="owl-carousel owl-theme promo-carousel2 d-block d-md-none">
								<?php
									// var_dump($destacados);
									if ($productos != NULL) {
										foreach($productos as $prod) {
											// if ($prod['codigo'] != $destacados[0]['codigo']){
								?>
								<div class="item">
									<?php echo createCard ($prod);?>
								</div>
								<?php
											// }//END IF COD
										}//END FOR 
									}//END IF NULL
								?>
							</div> <!-- owl-carousel -->
						</div>
					<!-- </div> -->
				</div>
			</div>			
		</section>
		<?php
				}//END FOR 
			}//END IF
		?>
	</main>
	<!-- /.FIN DEL CONTENIDO -->

	<!-- INICIO DEL FOOTER -->
	<?php include 'includes/footer.php'; ?>
	<!-- /.FIN DEL FOOTER -->	

	<?php include 'includes/scripts.php'; ?>
	<script type="text/javascript">
		$(document).ready(function() { 
			$("#carousel").owlCarousel({
				navigation : true, // Show next and prev buttons
				slideSpeed : 300,
				paginationSpeed : 400,
				items : 1, 
				loop:true,
				autoplay:true,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				itemsDesktop : false,
				itemsDesktopSmall : false,
				itemsTablet: false,
				itemsMobile : false
			});
		});

		$(document).ready(function() { 
			$(".promo-carousel").owlCarousel({
				items:3,
				loop:true,
				margin:20,
				autoplay:true,
				autoplayTimeout:5000,
				autoplayHoverPause:true
			});
		});

		$(document).ready(function() { 
			$(".promo-carousel2").owlCarousel({
				items:1,
				loop:true,
				margin:20,
				autoplay:true,
				autoplayTimeout:5000,
				autoplayHoverPause:true
			});
		});
	</script>
</body>
</html>