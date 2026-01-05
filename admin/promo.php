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

        <?php include_once "objs/promo.php";?>

        <!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Cabicera de Contenido (Título) -->
			<section class="content-header">
				<h1>
					Promocion - <?php echo $promocion['titulo'];?>
					<small>Registro de promociones y productos.</small>
				</h1>
			</section>

			<!-- Contenido Principal -->
			<section class="content">
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
                <!-- Caja de Texto de color gris (Default) -->
				<div class="box">
                    <!-- Corpo de Caja -->
					<div class="box-body">
						<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="row">
                                <div class="col-md-5 text-center">
                                    <img src="img/promociones/<?php echo $promocion['img_fondo'];?>" class="img-fluid img-thumbnail banner-modal" alt="no-image" id="img-fondo">
                                </div>
                                <div class="col-md-3">
                                    <img src="img/promociones/<?php echo $promocion['img'];?>" class="img-fluid img-thumbnail img-modal" alt="no-image" id="img-promo">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titulo">Titulo</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Promoción" value="<?php echo $promocion['titulo'];?>" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nombre">Orden</label>
                                        <input type="text" class="form-control" id="orden" name="orden" placeholder="99" onKeyUp="formatoNro(this, event)" maxlength="5" value="<?php echo $promocion['orden'];?>">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="descripcion">Activo</label>
                                        <?php
                                            $activo = "";
                                            if ($promocion['activo'] == 0) {
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
                                <div class="col-md-5" style="margin-bottom:15px;">
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-bottom:15px;">
                                    <div class="form-group">
                                        <input type="file" class="form-control-file" name="fileToUpload2" id="fileToUpload2">
                                    </div>
                                </div>
                            </div> <!-- /.row -->
                            <div class="pull-right">
                                <button type="button" class="btn btn-danger pull-left" name="excluir" id="btn-confirmarpr" style="margin-right: 10px;">Excluir</button>
                                <button type="submit" class="btn" name="excluirpr" id="btn-excluirpr" style="display: none;">Submit Excluir</button>
                                <button type="submit" class="btn btn-primary pull-right" name="guardarpr">Guardar</button>
                            </div>
                            <button type="button" class="btn btn-default" onclick="window.location.href = 'promociones.php';">Cerrar</button>
                        </form>
					</div> <!-- /.box-body -->
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
                            <table class="table table-striped table-bordered display nowra" id="tabladatos">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Precio Promocional</th>
                                        <!-- <th>Activo</th> -->
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										if ($productos != null) { 
											foreach ($productos as $row) {
									?>
                                    <tr data-toggle="modal" data-target="#AltModal" data-codigo="<?php echo $row['cod_producto'];?>" data-producto="<?php echo $row['producto'];?>" data-prodprecio="<?php echo $row['prod_precio'];?>" data-prodcuota="<?php echo $row['prod_cuota'];?>" data-prodvalor="<?php echo $row['prod_valor'];?>" data-promoprecio="<?php echo $row['precio'];?>" data-promocuota="<?php echo $row['cuota'];?>" data-promovalor="<?php echo $row['valor'];?>">
                                        <td><?php echo $row['producto'];?></td>
                                        <td>
										<?php
											$precio = "";
											if ($row['prod_precio'] == "" && $row['prod_cuota'] == "" && $row['prod_valor'] == "") {
												$precio = "Sob Consulta";
											} else {
												if ($row['prod_cuota'] != "" && $row['prod_valor'] != "") {
													$precio = $row['prod_cuota']." cuotas de ".number_format($row['prod_valor'], 0, ',', '.')." gs";
												} else if ($row['prod_precio'] != "") {
													$precio = number_format($row['prod_precio'], 0, ',', '.')." gs al contado";
												} else {
													$precio = "Sob Consulta";
												}
											}
											echo $precio;
										?>
										</td>
                                        <td>
										<?php
											$promocional = "";
											if ($row['precio'] == "" && $row['cuota'] == "" && $row['valor'] == "") {
												$promocional = "Sob Consulta";
											} else {
												if ($row['cuota'] != "" && $row['valor'] != "") {
													$promocional = $row['cuota']." cuotas de ".number_format($row['valor'], 0, ',', '.')." gs";
												} else if ($row['precio'] != "") {
													$precio = number_format($row['precio'], 0, ',', '.')." gs al contado";
												} else {
													$promocional = "Sob Consulta";
												}
											}
											echo $promocional;
										?>
										</td>
                                        <!-- <td></td> -->
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
								<h4 class="modal-title">Nuevo Producto en Promoción</h4>
							</div>
							<form action="" method="POST" autocomplete="off">
								<div class="modal-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="tipo">Producto</label>
												<select class="selectpicker show-tick" id="producto" name="producto[]" data-width="100%" data-live-search="true" multiple>
													<?php
														if ($categorias != null) {
															foreach ($categorias as $row) {	
													?>
														<optgroup label="<?php echo $row['nombre'];?>">
														<?php
															 $promoprod = getProdbyCategoria ($row['codigo']);
															if ($promoprod != null) {
																foreach ($promoprod as $linea) {
																	$ok = 1;
																	foreach ($productos as $test) {
																		if ($test['cod_producto'] == $linea['codigo']) {
																			$ok = 0;
																		}
																	}
																	if ($ok == 1) {
														?>
														<option value="<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></option> 
													<?php 
																	}//END IF OK
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
								<h4 class="modal-title">Promoción de Producto</h4>
							</div>
							<form action="" method="POST" autocomplete="off">
								<div class="modal-body">
									<div class="row">
										<input type="hidden" class="form-control" id="codigo" name="codigo" required>
										<div class="col-md-12">
											<div class="form-group">
												<label for="producto">Producto</label>
												<input type="text" class="form-control" id="producto" name="producto" placeholder="Nombre de la Categoría" maxlength="80" readonly>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label for="precio">Precio Total</label>
												<input type="text" class="form-control" id="prodprecio" name="prodprecio" placeholder="999.999.999.999" onKeyUp="formatoMoneda(this, event)" maxlength="20" readonly>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="cuota">Cuotas</label>
												<input type="text" class="form-control" id="prodcuota" name="cuota" placeholder="99" onKeyUp="formatoNro(this, event)" maxlength="5" readonly>
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label for="valor">Precio</label>
												<input type="text" class="form-control" id="prodvalor" name="valor" placeholder="999.999.999" onKeyUp="formatoMoneda(this, event)" maxlength="15" readonly>
											</div>
										</div>

										<div class="col-md-5">
											<div class="form-group">
												<label for="precio">Precio Promocional</label>
												<input type="text" class="form-control" id="precio" name="precio" placeholder="999.999.999.999" onKeyUp="formatoMoneda(this, event)" maxlength="20">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="cuota">Cuotas</label>
												<input type="text" class="form-control" id="cuota" name="cuota" placeholder="99" onKeyUp="formatoNro(this, event)" maxlength="5">
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label for="valor">Precio Promocional</label>
												<input type="text" class="form-control" id="valor" name="valor" placeholder="999.999.999" onKeyUp="formatoMoneda(this, event)" maxlength="15">
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
								<h4 class="modal-title text-center" id="myModalLabel">¿Deseas eliminar la Promoción?</h4>
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
								<h4 class="modal-title text-center" id="myModalLabel">¿Deseas eliminar el Producto?</h4>
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