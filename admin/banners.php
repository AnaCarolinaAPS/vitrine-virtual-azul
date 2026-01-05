<?php 
	session_start();
	if (!isset($_SESSION['logueado'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vitrine Virtual - Banners</title>
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
					Banners
					<small>Registro de los banners de la portada de la pagina.</small>
				</h1>
			</section>

			<!-- Contenido Principal -->
			<section class="content">
				<?php include_once "objs/banner.php";?>
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
									<p> <?php echo $mensaje; ?></p>
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
									<th>Orden</th>
									<th>Imagen</th>
									<th>Link</th>
									<th>Texto Alternativo</th>
									<th>Activo</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ($banners != null) { 
										foreach ($banners as $row) {
								?>
								<tr data-toggle="modal" data-target="#AltModal" data-codigo="<?php echo $row['codigo'];?>" data-orden="<?php echo $row['orden'];?>" data-url="<?php echo $row['url'];?>" data-img="<?php echo $row['img'];?>" data-alternativo="<?php echo $row['alternativo'];?>" data-activo="<?php echo $row['activo'];?>">
									<td><?php echo $row['codigo'];?></td>
									<td><?php echo $row['orden'];?></td>
									<td><?php echo $row['img'];?></td>
									<td><?php echo $row['url'];?></td>
									<td><?php echo $row['alternativo'];?></td>
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
								<h4 class="modal-title">Nuevo Banner</h4>
							</div>
							<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12 text-center">
											<img src="img/banners/no-banner.png" class="img-fluid img-thumbnail banner-modal" alt="no-image" id="img" name="img">
										</div>
										<div class="col-md-12" style="margin-bottom:15px;">
											<div class="form-group">
												<!-- <label for="fileToUpload">Imagen</label> -->
												<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="tipo">Tipo de Link</label>
												<select class="selectpicker" id="linktype" name="linktype" data-width="100%" data-live-search="true">
													<option value="categoriatype">Categoría</option> 
													<option value="productotype">Producto</option> 
													<option value="promociontype">Promoción</option> 
													<option value="otrotype" selected>Otro</option> 
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype" style="display:none" id="categoriatype">
											<div class="form-group">
												<label for="tipo">Categoría</label>
												<select class="selectpicker show-tick" id="categoria" name="categoria" data-width="100%" data-live-search="true">
													<option value="ALL" style="font-weight: bold !important;">TODOS</option> 
													<?php
														if ($categorias != null) {
															foreach ($categorias as $row) {	
													?>
														<option value="<?php echo $row['codigo'];?>" style="font-weight: bold !important;"><?php echo $row['nombre'];?></option> 
														<?php
															 $subcategorias = getSubMenu ($row['codigo']);
															if ($subcategorias != null) {
																foreach ($subcategorias as $linea) {	
														?>
														<option value="<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></option> 
													<?php 
																	}//END FOREACH SUB
																}//END IF SUB
															} //END FOREACH
														} //END IF
													?>
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype" style="display:none" id="productotype">
											<div class="form-group">
												<label for="tipo">Producto</label>
												<select class="selectpicker show-tick" id="producto" name="producto" data-width="100%" data-live-search="true">
													<?php
														if ($categorias != null) {
															foreach ($categorias as $row) {	
													?>
														<optgroup label="<?php echo $row['nombre'];?>">
														<?php
															 $productos = getProdbyCategoria ($row['codigo']);
															if ($productos != null) {
																foreach ($productos as $linea) {	
														?>
														<option value="<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></option> 
													<?php 
																	}//END FOREACH SUB
																}//END IF SUB
													?>
														</optgroup>
													<?php 
															} //END FOREACH
														} //END IF
													?>
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype" style="display:none" id="promociontype">
											<div class="form-group">
												<label for="tipo">Promoción</label>
												<select class="selectpicker" id="promocion" name="promocion" data-width="100%" data-live-search="true">
													<?php
														if ($promociones != null) {
															foreach ($promociones as $row) {	
													?>
														<option value="<?php echo $row['codigo'];?>"><?php echo $row['nombre'];?></option> 
													<?php 
															} //END FOREACH
														} //END IF
													?>
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype" id="otrotype">
											<div class="form-group">
												<label for="link">Link Externo</label>
												<input type="text" class="form-control" id="link" name="link" placeholder="www.ejemplo.com.py" value="" maxlength="100">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="nombre">Orden</label>
												<input type="text" class="form-control" id="orden" name="orden" placeholder="99" onKeyUp="formatoNro(this, event)" maxlength="5" value="<?php echo $lastOrden;?>">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="descripcion">Activo</label>
												<div class="row">
													<div class="col-md-12">
														<input type="checkbox" name="activo" id="activo" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" checked>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="descripcion">Texto Alternativo</label>
												<textarea class="form-control" rows="2" id="alternativo" name="alternativo" placeholder="Texto Alternativo (caso la imagen no cargue en la página)" maxlength="100"></textarea>
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
								<h4 class="modal-title">Alterar Banner</h4>
							</div>
							<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">								
								<div class="modal-body">
									<input type="hidden" class="form-control" id="codigo" name="codigo" required>
									<input type="hidden" class="form-control" id="imgurl" name="imgurl" required>
									<div class="row">
										<div class="col-md-12 text-center">
											<img src="img/banners/no-banner.png" class="img-fluid img-thumbnail banner-modal" alt="no-image" id="img-alt" name="img-alt">
										</div>
										<div class="col-md-12" style="margin-bottom:15px;">
											<div class="form-group">
												<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="tipo">Tipo de Link</label>
												<select class="selectpicker" id="linktype-alt" name="linktype-alt" data-width="100%" data-live-search="true">
													<option value="categoriatype-alt">Categoría</option> 
													<option value="productotype-alt">Producto</option> 
													<option value="promociontype-alt">Promoción</option> 
													<option value="otrotype-alt" selected>Otro</option> 
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype-alt" style="display:none" id="categoriatype-alt">
											<div class="form-group">
												<label for="tipo">Categoría</label>
												<select class="selectpicker show-tick" id="categoria" name="categoria" data-width="100%" data-live-search="true">
													<option value="ALL" style="font-weight: bold !important;">TODOS</option> 
													<?php
														if ($categorias != null) {
															foreach ($categorias as $row) {	
													?>
														<option value="<?php echo $row['codigo'];?>" style="font-weight: bold !important;"><?php echo $row['nombre'];?></option> 
														<?php
															 $subcategorias = getSubMenu ($row['codigo']);
															if ($subcategorias != null) {
																foreach ($subcategorias as $linea) {	
														?>
														<option value="<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></option> 
													<?php 
																	}//END FOREACH SUB
																}//END IF SUB
															} //END FOREACH
														} //END IF
													?>
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype-alt" style="display:none" id="productotype-alt">
											<div class="form-group">
												<label for="tipo">Producto</label>
												<select class="selectpicker show-tick" id="producto" name="producto" data-width="100%" data-live-search="true">
													<?php
														if ($categorias != null) {
															foreach ($categorias as $row) {	
													?>
														<optgroup label="<?php echo $row['nombre'];?>">
														<?php
															 $productos = getProdbyCategoria ($row['codigo']);
															if ($productos != null) {
																foreach ($productos as $linea) {	
														?>
														<option value="<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></option> 
													<?php 
																	}//END FOREACH SUB
																}//END IF SUB
													?>
														</optgroup>
													<?php 
															} //END FOREACH
														} //END IF
													?>
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype-alt" style="display:none" id="promociontype-alt">
											<div class="form-group">
												<label for="tipo">Promoción</label>
												<select class="selectpicker" id="promocion" name="promocion" data-width="100%" data-live-search="true">
													<?php
														if ($promociones != null) {
															foreach ($promociones as $row) {	
													?>
														<option value="<?php echo $row['codigo'];?>"><?php echo $row['nombre'];?></option> 
													<?php 
															} //END FOREACH
														} //END IF
													?>
												</select>
											</div>
										</div>
										<div class="col-md-5 linktype-alt" id="otrotype-alt">
											<div class="form-group">
												<label for="link">Link Externo</label>
												<input type="text" class="form-control" id="link" name="link" placeholder="www.ejemplo.com.py" value="" maxlength="100">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="nombre">Orden</label>
												<input type="text" class="form-control" id="orden" name="orden" placeholder="99" onKeyUp="formatoNro(this, event)" maxlength="5">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="descripcion">Activo</label>
												<div class="row">
													<div class="col-md-12">
														<input type="checkbox" name="activo" id="activo" data-toggle="toggle" data-on="Sí" data-off="No" data-onstyle="success" data-offstyle="warning" data-width="100%" data-height="35" checked>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="descripcion">Texto Alternativo</label>
												<textarea class="form-control" rows="2" id="alternativo" name="alternativo" placeholder="Texto Alternativo (caso la imagen no cargue en la página)" maxlength="100"></textarea>
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
				<div class="modal fade" tabindex="-1" role="dialog" id="ExcModal">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title text-center" id="myModalLabel">¿Deseas eliminar el banner?</h4>
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
					<?php include_once "js/u_banner.js"; ?>
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