<?php 
	session_start();
	if (!isset($_SESSION['logueado'])) {
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vitrine Virtual - Informaciones de Página</title>
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

		<?php include_once "objs/informaciones.php";?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Cabicera de Contenido (Título) -->
			<section class="content-header">
				<h1>
					Informaciones de Página
					<small>Informaciones fijas en el site.</small>
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
									<div class="col-md-2">
										<div class="form-group">
											<label for="nombre">Nro do Whatsapp</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>
												<input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="+595 999 999999" maxlength="20" value="<?php echo $informaciones['whatsapp'];?>" required>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="nombre">Link para Facebook</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
												<input type="text" class="form-control" id="facebook" name="facebook" placeholder="https://www.facebook.com/VitrineVirtual" maxlength="80" value="<?php echo $informaciones['facebook'];?>" required>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="nombre">Link para Instagram</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-instagram"></i></span>
												<input type="text" class="form-control" id="instagram" name="instagram" placeholder="https://www.instagram.com/vitrinevirtual" maxlength="80" value="<?php echo $informaciones['instagram'];?>" required>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="nombre">Atención de Lunes a Viernes</label>
											<input type="text" class="form-control" id="lunesviernes" name="lunesviernes" placeholder="00:00 a 00:00 hs" maxlength="20" value="<?php echo $informaciones['horario_lunesviernes'];?>" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="nombre">Título página Historia</label>
											<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nuestra História" maxlength="80" value="<?php echo $informaciones['titulo_pagina'];?>" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="nombre">Email de Contacto</label>
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
												<input type="text" class="form-control" id="email" name="email" placeholder="contactos@vitrine-virtual.com.py" maxlength="80" value="<?php echo $informaciones['email'];?>" required>
											</div>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="nombre">Atención los Sábados</label>
											<input type="text" class="form-control" id="sabados" name="sabados" placeholder="00:00 a 00:00 hs" maxlength="20" value="<?php echo $informaciones['horario_sabado'];?>" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="descripcion">Contenido de la pagina Historia</label>
											<textarea class="form-control" rows="4" id="editor" name="editor" placeholder="Ramírez Ramírez S.A. Inicio sus actividades en 1.987..." maxlength="200"><?php echo "";?><?php echo $informaciones['conteudo_pagina'];?></textarea>
										</div>
									</div>
								</div> <!-- row -->

								<div class="pull-right">
									<button type="submit" class="btn btn-primary pull-right" name="guardar">Guardar</button>
								</div>
							</div> <!-- modal-body -->
						</form>
					</div> <!-- box-body -->
				</div>
				<!-- /.Caja de Texto de color gris (Default) -->
				<script type="text/javascript">
					<?php include_once "js/u_informaciones.js"; ?>
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
	<script>
		initSample();
	</script>
</body>
</html>