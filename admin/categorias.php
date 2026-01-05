<?php 
	session_start();
	if (!isset($_SESSION['logueado'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vitrine Virtual - Categorías</title>
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
					Categorías
					<small>Registro de las categorías usadas para separar los productos.</small>
				</h1>
			</section>

			<!-- Contenido Principal -->
			<section class="content">
				<?php include_once "objs/categoria.php";?>
				<!-- Caja de Texto de color gris (Default) -->
				<div class="box">
					<div class="box-header with-border">
						<!-- Botón para crear más cursos -->
						<div class="col-md-3 pull-left">
							<button id="btnAdd" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal" style="margin-bottom: 5px;">+ Nueva</button>
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
									<th>Categoría</th>
									<th>Subcategoría</th>
									<th>En el Menu</th>
									<th>Activo</th>
									<!-- <th>Ctd. productos</th> -->
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($categorias != null) { 
										foreach ($categorias as $row) {
								?>
								<tr data-toggle="modal" data-target="#AltModal" data-codigo="<?php echo $row['codigo'];?>" data-nombre="<?php echo $row['nombre'];?>" data-activo="<?php echo $row['activo'];?>" data-categoria="<?php echo $row['cod_padre'];?>" data-menu="<?php echo $row['menu'];?>">
									<td>
									<?php
										$padre = "";
										if ($row['padre'] == "") {
											$padre = $row['nombre'];
										} else {
											$padre = $row['padre'];
										}
										echo $padre;
									?>
									</td>
									<td>
									<?php
										$nombre = "";
										if ($row['padre'] == "") {
											$nombre = "-";
										} else {
											$nombre = $row['nombre'];
										}
										echo $nombre;
									?>
									</td>
									<td>
									<?php
										$menu = "";
										if ($row['menu'] == 0) {
											$menu = "No";
										} else {
											$menu = "Sí";
										}
										echo $menu;
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
									<!-- <td>0</td> -->
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
								<h4 class="modal-title">Nueva Categoría</h4>
							</div>
							<form action="" method="POST" autocomplete="off">
								<div class="modal-body">
									<input type="hidden" name="usuario" value="<?php echo $_SESSION['user'];?>">
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="nombre">Nombre</label>
												<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Categoría" maxlength="80" required>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="tipo">Subcategoria de</label>
												<select class="selectpicker" id="categoria" name="categoria" data-width="100%" data-live-search="true">
													<option value="NULL">Ninguna Categoría</option>
													<?php
														if ($categoriasS != null) {
															foreach ($categoriasS as $row) {	
													?>
														<option value="<?php echo $row['codigo'];?>"><?php echo $row['nombre'];?></option> 
													<?php 
															} //END FOREACH
														} //END IF
													?>
												</select>
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

				<!-- AltModal -->
				<div class="modal fade" tabindex="-1" role="dialog" id="AltModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Alteración Categoría</h4>
							</div>
							<form action="" method="POST" autocomplete="off">
								<div class="modal-body">
									<div class="row">
										<input type="hidden" class="form-control" id="codigo" name="codigo" required>
										<div class="col-md-12">
											<div class="form-group">
												<label for="nombre">Nombre</label>
												<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Categoría" maxlength="80" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="tipo">Subcategoria de</label>
												<select class="selectpicker" id="categoria" name="categoria" data-width="100%" data-live-search="true">
													<option value="NULL">Ninguna Categoría</option>
													<?php
														if ($categoriasS != null) {
															foreach ($categoriasS as $row) {	
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
											<label for="menu">Menu</label>
											<div class="row">
												<div class="col-md-12">
													<input type="checkbox" name="menu" id="menu" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" checked>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<label for="activo">Activo</label>
											<div class="row">
												<div class="col-md-12">
													<input type="checkbox" name="activo" id="activo" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" checked>
												</div>
											</div>
										</div>
									</div> <!-- row -->
								</div> <!-- modal-body -->
								<div class="modal-footer">
									<button type="button" class="btn btn-danger pull-left" name="excluir" id="btn-confirmar">Excluir</button>
									<button type="submit" class="btn" name="excluir" id="btn-excluir" style="display: none;">Submit Excluir</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
								</div>
							</form>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- ./AltModal -->	

				<!-- Confirmación Modal (para excluisiones) -->
				<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">¿Deseas eliminar este registro?</h4>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" id="modal-btn-si">Sí</button>
								<button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Confirmación Modal (para excluisiones) -->

				<script type="text/javascript">
					<?php include_once "js/u_categoria.js"; ?>
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