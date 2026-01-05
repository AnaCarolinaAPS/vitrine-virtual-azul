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

		<?php include_once "objs/detalle.php";?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Cabicera de Contenido (Título) -->
			<section class="content-header">
				<h1>
					<?php echo "[COD.".$producto['codigo']."] ".$producto['nombre'];?>
					<small>Detalle del producto y sus imagenes.</small>
				</h1>
			</section>

			<!-- Contenido Principal -->
			<section class="content">
				<!-- Caja de Texto de color gris (Default) -->
				<div class="box">
					<!-- Modal de Mensagns Sucess and Error -->
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
						<form action="" method="POST"  autocomplete="off">
							<div class="modal-body">
								<div class="row">
									<input type="hidden" name="usuario" value="<?php echo $_SESSION['user'];?>">
									<!-- <input type="hidden" class="form-control" id="codigo" name="codigo" required> -->
									<div class="col-md-2">
										<div class="form-group">
											<label for="nombre">Código</label>
											<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo" maxlength="20" value="<?php echo $producto['codigo'];?>" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="tipo">Categoría</label>
											<select class="selectpicker" id="categoria" name="categoria" data-width="100%" data-live-search="true">
												<?php
													if ($categorias != null) {
														$selected = "";
														foreach ($categorias as $row) {	
															if ($row['codigo'] == $producto['cod_categoria']) {
																$selected = " selected";
															} else {
																$selected = "";
															}
												?>
													<option value="<?php echo $row['codigo'];?>" <?php echo $selected;?>><?php echo $row['nombre'];?></option> 
												<?php 
														} //END FOREACH
													} //END IF
												?>
											</select>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="nombre">Estoque</label>
											<input type="text" class="form-control" id="estoque" name="estoque" placeholder="0" value="<?php echo $producto['estoque'];?>" onKeyUp="formatoNro(this, event)" maxlength="5" required>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="nombre">Cuotas</label>
											<input type="text" class="form-control" id="cuota" name="cuota" placeholder="99" value="<?php echo $producto['ctd_cuota'];?>" onKeyUp="formatoNro(this, event)" maxlength="5">
										</div>
									</div>
									<div class="col-md-2">
										<?php 
											if ($producto['valor_cuota'] > 0) {
												$valor = number_format($producto['valor_cuota'], 0, ',', '.');
											} else {
												$valor = "";
											}
										?>
										<div class="form-group">
											<label for="nombre">Precio</label>
											<input type="text" class="form-control" id="valor" name="valor" placeholder="999.999.999.999" value="<?php echo $valor;?>" onKeyUp="formatoMoneda(this, event)" maxlength="15">
										</div>
									</div>
									<div class="col-md-2">
										<?php 
											if ($producto['precio'] > 0) {
												$precio = number_format($producto['precio'], 0, ',', '.');
											} else {
												$precio = "";
											}
										?>
										<div class="form-group">
											<label for="nombre">Precio Total</label>
											<input type="text" class="form-control" id="precio" name="precio" placeholder="999.999.999.999" value="<?php echo $precio;?>" onKeyUp="formatoMoneda(this, event)" maxlength="20">
										</div>
									</div>
									<div class="col-md-10">
										<div class="form-group">
											<label for="nombre">Nombre</label>
											<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del Producto" maxlength="80" value="<?php echo $producto['nombre'];?>" required>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="descripcion">Destacado</label>
											<?php
												$destacado = "";
												if ($producto['destaque'] == 0) {
													$destacado = "";
												} else {
													$destacado = " checked";
												}
											?>
											<div class="row">
												<div class="col-md-12">
													<input type="checkbox" name="destacado" id="toggle-destacado" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" <?php echo $destacado;?>>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label for="descripcion">Activo</label>
											<?php
												$activo = "";
												if ($producto['activo'] == 0) {
													$activo = "";
												} else {
													$activo = " checked";
												}
											?>
											<div class="row">
												<div class="col-md-12">
													<input type="checkbox" name="activo" id="toggle" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" <?php echo $activo;?>>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="descripcion">Descripción</label>
											<textarea class="form-control" rows="4" id="descripcion" name="descripcion" placeholder="Descripción del Producto" maxlength="200"><?php echo $producto['descripcion'];?></textarea>
										</div>
									</div>
								</div> <!-- row -->

								<div class="pull-right">
									<button type="button" class="btn btn-danger pull-left" name="excluir" id="btn-confirmarpr" style="margin-right: 10px;">Excluir</button>
									<button type="submit" class="btn" name="excluirpr" id="btn-excluirpr" style="display: none;">Submit Excluir</button>
									<button type="submit" class="btn btn-primary pull-right" name="guardarpr">Guardar</button>
								</div>
								<button type="button" class="btn btn-default" onclick="window.location.href = 'productos.php';">Cerrar</button>
							</div> <!-- modal-body -->
						</form>
					</div> <!-- box-body -->
				</div>
				<!-- /.Caja de Texto de color gris (Default) -->

				<!-- Caja de Texto de color gris (Default) -->
				<div class="box">
					<div class="box-header with-border">
						<!-- Botón para crear más cursos -->
						<div class="col-md-3 pull-left">
							<button id="btnAdd" type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddModal" style="margin-bottom: 5px;">+ Nuevo</button>
						</div>
					</div>

					<!-- Corpo de Caja -->
					<div class="box-body">
						<div class="box-body table-responsive">
							<table class="table table-striped table-bordered display nowra table-image" id="tabladatos">
							<thead>
								<tr>
									<th>Orden</th>
									<th>Imagen</th>
									<th>URL</th>
									<th>Activo</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($imagenes != null) { 
										foreach ($imagenes as $row) {
								?>
								<tr data-toggle="modal" data-target="#AltModal" data-codigo="<?php echo $row['codigo'];?>" data-orden="<?php echo $row['orden'];?>" data-url="<?php echo $row['url'];?>" data-activo="<?php echo $row['activo'];?>">
									<td><?php echo $row['orden'];?></td>
									<td><img src="img/productos/<?php echo $row['url'];?>" class="img-fluid img-thumbnail" alt="producto"></td>
									<td><?php echo $row['url'];?></td>
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
								<?php 
									}//FOR
								}//IF
								?>
							</tbody>
							</table>
						</div>
					</div> <!-- /.box-body -->
				</div><!-- /.Caja de Texto de color gris (Default) -->

				<!-- AddModal -->
				<div class="modal fade" tabindex="-1" role="dialog" id="AddModal">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Nueva Imagen</h4>
							</div>
							<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
								<div class="modal-body">
									<div class="row">
										<div class="col-md-6 text-center">
											<img src="img/productos/no-image.png" class="img-fluid img-thumbnail img-modal" alt="no-image" id="img">
										</div>
										<div class="col-md-3">
											<label for="orden">Orden</label>
											<input type="text" class="form-control" id="orden" name="orden" placeholder="0" maxlength="15" value="<?php echo $lastOrden['orden']+1;?>" required>
										</div>
										<div class="col-md-3">
											<label for="activo">Activo</label>
											<div class="row">
												<div class="col-md-12">
													<input type="checkbox" name="activo" id="toggle" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" checked>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<input type="file" name="fileToUpload" id="fileToUpload">
										</div>
									</div>
								</div><!-- modal-body -->
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
								<h4 class="modal-title">Alterar Imagen</h4>
							</div>
							<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
								<div class="modal-body">
									<input type="hidden" class="form-control" id="codigo" name="codigo" required>
									<input type="hidden" class="form-control" id="imgurl" name="imgurl" required>
									<div class="row">
										<div class="col-md-6 text-center">
											<img src="img/productos/no-image.png" class="img-fluid img-thumbnail img-modal" alt="no-image" id="img-alt">
										</div>
										<div class="col-md-3">
											<label for="orden">Orden</label>
											<input type="text" class="form-control" id="orden" name="orden" placeholder="0" maxlength="15" required>
										</div>
										<div class="col-md-3">
											<label for="activo">Activo</label>
											<div class="row">
												<div class="col-md-12">
													<input type="checkbox" name="activo" id="toggle-activo" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35">
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<input type="file" name="fileToUpload" id="fileToUpload">
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
								<h4 class="modal-title text-center" id="myModalLabel">¿Deseas eliminar el producto <?php echo $producto['codigo'];?>?</h4>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" id="modal-btn-si">Sí</button>
								<button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Confirmación Modal (para excluisiones) -->

				<!-- Confirmación Modal (para excluisiones) -->
				<div class="modal fade" tabindex="-1" role="dialog" id="ExcModal">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title text-center" id="myModalLabel">¿Deseas eliminar la imagen?</h4>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" id="excmodal-btn-si">Sí</button>
								<button type="button" class="btn btn-primary" id="excmodal-btn-no">No</button>
							</div>
						</div>
					</div>
				</div>
				<!-- Confirmación Modal (para excluisiones) -->

				<script type="text/javascript">
					<?php include_once "js/u_detalle.js"; ?>
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