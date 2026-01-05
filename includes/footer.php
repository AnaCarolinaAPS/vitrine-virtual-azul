<footer class="footer">
	<div class="sucursales">
		<div class="row logo">
			<div class="col-md-1">
			</div>
			<div class="col-md-5">
				<a href="index.php"><img src="admin/img/logo.png" class="img-responsive logo" style="width:100%;"></a> 	
			</div>
			<div class="col-md-5 text-center">
				<div class="d-block d-md-none">
					<br>
				</div>
				<h3>HORARIO DE ATENCIÓN</h3>
				<p>Lunes a Viernes<br>
				<?php echo $info['horario_lunesviernes'];?><br>
				</p>
				<p>
				Sábados<br>
				<?php echo $info['horario_sabado'];?></p>
			</div>
			<div class="col-md-1">
			</div>
		</div>
		<div class="row d-block d-md-none"> <!-- solo aparece en pantallas chicas -->
			<div class="col-sm-12 text-center">
				<h3>Vitrine Virtual</h3>
				<a href="historia.php"><?php echo $info['titulo_pagina'];?></a>
				<a class="nav-link" href="sucursales.php">Sucursales</a>
				<a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $info['whatsapp']);?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
				<a href="mailto:<?php echo $info['email'];?>" target="_blank"><i class="fa fa-envelope-o"></i></a>
				<a href="<?php echo $info['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $info['instagram'];?>" target="_blank"><i class="fa fa-instagram"></i></a>
			</div>
		</div>
	</div>
	<div class="rodape">
		<div class="pull-right d-none d-md-block d-lg-block"> <!-- no aparece en pantallas chicas -->
			<span>Desarrollado por <a href="https://anadosanjos.com/">Ana dos Anjos</a>. <b>Version</b> 1.0.0</span>
		</div>
		<span>
			<strong>Copyright &copy; 2020</strong><a href="index.php"> Vitrine Virtual.</a> <!-- Todo los derechos reservados. -->
		</span>
	</div>
</footer>