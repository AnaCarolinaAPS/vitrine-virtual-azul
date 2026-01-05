<?php 
	session_start();
	if (!isset($_SESSION['logueado'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vitrine Virtual - Promociones</title>
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

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Cabicera de Contenido (Título) -->
			<section class="content-header">
				<h1>
					Promociones
					<small>Registro de promociones en la pagina.</small>
				</h1>
			</section>

			<!-- Contenido Principal -->
			<section class="content">
				<?php include_once "objs/promociones.php";?>
				<!-- Caja de Texto de color gris (Default) -->
				<div class="box">
					<div class="box-header with-border">
						<!-- Botón para crear más cursos -->
						<div class="col-md-3 pull-left">
							<button id="btnAdd" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal" style="margin-bottom: 5px;">+ Nuevo</button>
						</div>
					</div>
					<div class="modal fade modal-mensaje" id="modal-mensaje" tabindex="-1" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header modal-mensaje-<?php echo $tipomensaje;?>" > <!-- modal-mensaje-success or modal-mensaje-error -->
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<h1 class="modal-title text-center">
										<?php if ($tipomensaje == 'success') {?>
											<img src="img/success-icon.png"> 
										<?php } else { ?>
											<img src="img/error-icon.png">
										<?php }?>
									</h1>
								</div>
								<div class="modal-body text-center">
									<p>  <?php echo $mensaje; ?></p>
								</div>
							</div>
						</div>
					</div>
					<!-- Corpo de Caja -->
					<div class="box-body">
						<div class="box-body table-responsive">
							<table class="table table-striped table-bordered display nowra" id="tabladatos">
							<thead>
								<tr>
									<th>Orden</th>
									<th>Image</th>
									<th>Titulo</th>
									<th>Ctd Productos</th>
									<th>Activo</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($promociones != null) { 
										foreach ($promociones as $row) {
								?>
								<tr onclick="window.location.href = 'promo.php?cod=<?php echo $row['codigo'];?>';">
									<td><?php echo $row['orden'];?></td>
									<td>
                                    <?php
										$img = "";
										if ($row['img'] == "" OR $row['img'] == NULL) {
											$img = "no-promo.png";
										} else {
											$img = $row['img'];
										}
									?>
                                        <img src="img/promociones/<?php echo $img;?>" class="img-fluid img-thumbnail" alt="promocion" style="width: 200px;">
                                    </td>
									<td><?php echo $row['titulo'];?></td>
									<td>
                                    <?php
										$ctd = "";
										if ($row['productos'] == NULL) {
											$ctd = 0;
										} else {
											$ctd = $row['productos'];
										}
										echo $ctd;
									?>
                                    </td>
									<td>
									<?php
										$activo = "";
										if ($row['activo'] == 0) {
											$activo = "Inactivo";
										} else {
											$activo = "Activo";
										}
										echo $activo;
									?>
									</td>
								</tr>
								<?php }}?>
							</tbody>
							</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.Caja de Texto de color gris (Default) -->

				<!-- AddModal -->
				<div class="modal fade" tabindex="-1" role="dialog" id="AddModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Nueva Promoción</h4>
							</div>
							<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12 text-center">
											<img src="img/promociones/no-fondo-promo.png" class="img-fluid img-thumbnail banner-modal" alt="no-image" id="img-fondo">
										</div>
										<div class="col-md-12" style="margin-bottom:15px;">
											<div class="form-group">
												<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
											</div>
                                        </div>
                                        <div class="col-md-5">
											<img src="img/promociones/no-promo.png" class="img-fluid img-thumbnail img-modal" alt="no-image" id="img-promo">
										</div>
										<div class="col-md-7">
											<div class="form-group">
												<label for="titulo">Titulo</label>
												<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Promoción" value="" maxlength="100">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombre">Orden</label>
												<input type="text" class="form-control" id="orden" name="orden" placeholder="99" onKeyUp="formatoNro(this, event)" maxlength="5" value="<?php echo $lastOrden;?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="descripcion">Activo</label>
												<div class="row">
													<div class="col-md-12">
														<input type="checkbox" name="activo" id="activo" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" checked>
													</div>
												</div>
											</div>
                                        </div>
                                        <div class="col-md-12" style="margin-bottom:15px;">
											<div class="form-group">
												<input type="file" class="form-control-file" name="fileToUpload2" id="fileToUpload2">
											</div>
                                        </div>
									</div> <!-- row -->
								</div> <!-- modal-body -->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary" name="nuevo">Guardar</button>
								</div>
							</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- ./AddModal -->	

				<script type="text/javascript">
					<?php include_once "js/u_promociones.js"; ?>
				</script>
			</section>
		</div> <!-- /.content-wrapper -->

		<!-- FOOTER -->
		<?php include "includes/footer.php"; ?>
		<!-- ./FOOTER -->
	</div>
	<!-- ./Contenido -->

	<!-- SCRIPTS (js) -->
	<?php include "includes/scripts.php"; ?>
	<!-- ./SCRIPTS (js) -->
</body>
</html>