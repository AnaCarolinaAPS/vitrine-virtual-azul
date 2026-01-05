<?php 
	session_start();
	if (!isset($_SESSION['logueado'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vitrine Virtual - Inicio</title>
	<?php include 'includes/head.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		<!-- MAIN HEADER -->
		<?php include 'includes/header.php'; ?>
		<!-- MAIN HEADER END -->

		<!-- ASIDE BAR -->
		<?php include 'includes/aside.php'; ?>
		<!-- ASIDE BAR END -->

		<?php include_once "objs/dashboard.php";?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Cabicera de Contenido (Título) -->
			<section class="content-header">
				<h1>
					Dashboard 
					<small>Panel administrativo.</small>
				</h1>
			</section>

			<!-- Contenido Principal -->
			<section class="content">
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $ctd_productos;?></h3>
								<p>Total de Produtos</p>
							</div>
							<div class="icon">
								<i class="fa fa-bar-chart"></i>
							</div>
							<a href="productos.php" class="small-box-footer">Ver Productos <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $visitors;?></h3>
								<p>Visitantes</p>
							</div>
							<div class="icon">
								<i class="fa fa-user"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $informaciones;?></h3>
								<p>Buscaron más informaciones</p>
							</div>
							<div class="icon">
								<i class="fa fa-star-o"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3><?php echo $ventas;?></h3>
								<p>Intentaron contacto en ventas</p>
							</div>
							<div class="icon">
								<i class="fa fa-star"></i>
							</div>
							<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>
					<div class="col-md-6">
						<!-- Caja de Texto de color gris (Default) -->
						<div class="box">
							<div class="box-header with-border">
								<h3>Los 5 productos con menor stock</h3>
							</div>
							<!-- Corpo de Caja -->
							<div class="box-body">
								<div class="box-body table-responsive">
									<table class="table table-striped table-bordered display nowra" id="tabladatos">
									<thead>
										<tr>
											<th>Productos</th>
											<th>stock</th>
										</tr>
									</thead>
									<tbody>
										<?php
											if ($productos != null) {
												foreach ($productos as $row) {	
										?>
										<tr>
											<td><?php echo $row['producto'];?></td>
											<td><?php echo $row['estoque'];?></td>
										</tr>
										<?php 
												} //END FOREACH
											} //END IF
											else {
										?>
										<tr>
											<td colspan="3" class="text-center">Sin informaciones de productos todavía.</td>
										</tr>
										<?php }?>
									</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.Caja de Texto de color gris (Default) -->
					</div>
					<div class="col-md-6">
						<!-- Caja de Texto de color gris (Default) -->
						<div class="box">
							<div class="box-header with-border">
								<h3>Las 5 categorías más visitadas</h3>
							</div>
							<!-- Corpo de Caja -->
							<div class="box-body">
								<div class="box-body table-responsive">
									<table class="table table-striped table-bordered display nowra" id="tabladatos">
									<thead>
										<tr>
											<th>Categorías</th>
											<th>Ctd de Visitas</th>
											<th>Ctd de Cliques</th>
										</tr>
									</thead>
										<tbody>
											<?php
												if ($categorias != null) {
													foreach ($categorias as $row) {	
														if ($row['categoria'] == "") {
															$row['categoria'] = "Todos los productos";
														}
											?>
											<tr>
												<td><?php echo $row['categoria'];?></td>
												<td><?php echo $row['unique_hits'];?></td>
												<td><?php echo $row['total_hits'];?></td>
											</tr>
											<?php 
													} //END FOREACH
												} //END IF
												else {
											?>
											<tr>
												<td colspan="3" class="text-center">Sin informaciones de visualización todavía.</td>
											</tr>
											<?php }?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.Caja de Texto de color gris (Default) -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<!-- Caja de Texto de color gris (Default) -->
						<div class="box">
							<div class="box-header with-border">
								<h3>Los 5 productos más vistos</h3>
							</div>
							<!-- Corpo de Caja -->
							<div class="box-body">
								<div class="box-body table-responsive">
									<table class="table table-striped table-bordered display nowra" id="tabladatos">
										<thead>
											<tr>
												<th>Productos</th>
												<th>Ctd de Visitas</th>
												<th>Ctd de Cliques</th>
											</tr>
										</thead>
										<tbody>
											<?php
												if ($masvisitados != null) {
													foreach ($masvisitados as $row) {
											?>
											<tr>
												<td><?php echo $row['producto'];?></td>
												<td><?php echo $row['unique_hits'];?></td>
												<td><?php echo $row['total_hits'];?></td>
											</tr>
											<?php 
													} //END FOREACH
												} //END IF
												else {
											?>
											<tr>
												<td colspan="3" class="text-center">Sin informaciones de visualización todavía.</td>
											</tr>
											<?php }?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.Caja de Texto de color gris (Default) -->
					</div>
					<div class="col-md-6">
						<!-- Caja de Texto de color gris (Default) -->
						<div class="box">
							<div class="box-header with-border">
								<h3>Los 5 productos más preguntados</h3>
							</div>
							<!-- Corpo de Caja -->
							<div class="box-body">
								<div class="box-body table-responsive">
									<table class="table table-striped table-bordered display nowra" id="tabladatos">
										<thead>
											<tr>
												<th>Productos</th>
												<th>Ctd de Visitas</th>
												<th>Ctd de Cliques</th>
											</tr>
										</thead>
										<tbody>
											<?php
												if ($maspreguntados != null) {
													foreach ($maspreguntados as $row) {	
											?>
											<tr>
												<td><?php echo $row['producto'];?></td>
												<td><?php echo $row['unique_hits'];?></td>
												<td><?php echo $row['total_hits'];?></td>
											</tr>
											<?php 
													} //END FOREACH
												} //END IF
												else {
											?>
											<tr>
												<td colspan="3" class="text-center">Sin informaciones de visualización todavía.</td>
											</tr>
											<?php }?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.Caja de Texto de color gris (Default) -->
					</div>
				</div>
			</section>
		</div> <!-- /.content-wrapper -->

		<!-- FOOTER -->
		<?php include "includes/footer.php"; ?>
		<!-- ./FOOTER -->
	</div> <!-- ./Contenido -->
	
	<!-- SCRIPTS (js) -->
	<?php include "includes/scripts.php"; ?>
	<!-- ./SCRIPTS (js) -->
</body>
</html>