<?php 
	session_start();
	if (!isset($_SESSION['logueado'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vitrine Virtual - Productos</title>
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
					Productos
					<small>Registro de los productos.</small>
				</h1>
			</section>

			<!-- Contenido Principal -->
			<section class="content">
				<?php include_once "objs/productos.php";?>
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
									<th>Codigo</th>
									<th>Categoría</th>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Estoque</th>
									<th>En Destaque</th>
									<th>Activo</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($productos != null) { 
										foreach ($productos as $row) {
								?>
								<tr onclick="window.location.href = 'detalle.php?producto=<?php echo $row['codigo'];?>';">
									<td><?php echo $row['codigo'];?></td>
									<td><?php echo $row['categoria'];?></td>
									<td><?php echo $row['nombre'];?></td>
									<td>
									<?php
										$precio = "";
										if ($row['ctd_cuota'] > 0 && $row['valor_cuota'] > 0) {
											$precio = $row['ctd_cuota']." cuotas de ".number_format($row['valor_cuota'], 0, ',', '.')." gs";
										} else if ($row['precio'] > 0) {
											$precio = "Al contado ".number_format($row['precio'], 0, ',', '.')." gs";
										} else {
											$precio = "Sob consulta ";
										}
										echo $precio;
									?>
									</td>
									<td><?php echo $row['estoque'];?></td>
									<td>
									<?php
										$destaque = "";
										if ($row['destaque'] == 0) {
											$destaque = "No";
										} else {
											$destaque = "Sí";
										}
										echo $destaque;
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
								<h4 class="modal-title">Nuevo Producto</h4>
							</div>
							<form action="" method="POST" autocomplete="off">
								<div class="modal-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="nombre">Código</label>
												<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo" maxlength="20" required>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label for="tipo">Categoría</label>
												<select class="selectpicker" id="categoria" name="categoria" data-width="100%" data-live-search="true">
													<?php
														if ($categorias != null) {
															foreach ($categorias as $row) {	
													?>
														<option value="<?php echo $row['codigo'];?>"><?php echo $row['nombre'];?></option> 
													<?php 
															} //END FOREACH
														} //END IF
													?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="descripcion">Destacado</label>
												<div class="row">
													<div class="col-md-12">
														<input type="checkbox" name="destacado" id="toggle" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="115" data-height="35">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-9">
											<div class="form-group">
												<label for="nombre">Nombre</label>
												<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Producto" maxlength="80" required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombre">Estoque</label>
												<input type="text" class="form-control" id="estoque" name="estoque" placeholder="0" onKeyUp="formatoNro(this, event)" maxlength="5" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="nombre">Precio Total</label>
												<input type="text" class="form-control" id="precio" name="precio" placeholder="999.999.999.999" onKeyUp="formatoMoneda(this, event)" maxlength="20">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="nombre">Cuotas</label>
												<input type="text" class="form-control" id="cuota" name="cuota" placeholder="99" onKeyUp="formatoNro(this, event)" maxlength="5">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nombre">Precio</label>
												<input type="text" class="form-control" id="valor" name="valor" placeholder="999.999.999" onKeyUp="formatoMoneda(this, event)" maxlength="15">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="descripcion">Activo</label>
												<div class="row">
													<div class="col-md-12">
														<input type="checkbox" name="activo" id="activo" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="115" data-height="35" checked>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="descripcion">Descripción</label>
												<textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripción del Producto" maxlength="1000"></textarea>
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
					<?php include_once "js/u_producto.js"; ?>
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