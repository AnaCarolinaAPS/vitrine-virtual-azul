<?php
	include_once "admin/server/informaciones.php";
	if($_SERVER['REQUEST_METHOD'] == "GET") {
		if (isset($_GET['search'])){
			echo "<script type='text/javascript'>document.location.href='catalogo.php?q=".$_GET['search']."';</script>";			
		}
	}
	$info = getInformaciones ();
?>
<!-- <header> -->
	<div class="d-none d-md-block d-lg-block">
		<nav class="navbar navbar-expand-md navbar-light barra-superior">
			<!-- Social Menu -->
			<div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
				<ul class="navbar-nav mr-auto menu-social">
					<li class="nav-item">
						<a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $info['whatsapp']);?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
					</li>
					<li class="nav-item">
						<a href="mailto:<?php echo $info['email'];?>" target="_blank"><i class="fa fa-envelope-o"></i></a>
					</li>
					<li class="nav-item">
						<a href="<?php echo $info['facebook'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
					</li>
					<li class="nav-item">
						<a href="<?php echo $info['instagram'];?>" target="_blank"><i class="fa fa-instagram"></i></a>
					</li>
				</ul>
			</div>
			<!-- Menu -->
			<div class="mx-auto order-0">
				<ul class="navbar-nav mx-auto">
					<li class="barra-vertical">|</li>
					<li class="nav-item">
						<a class="nav-link" href="historia.php"><?php echo $info['titulo_pagina'];?></a>
					</li>
					<li class="barra-vertical">|</li>
					<li class="nav-item">
						<a class="nav-link" href="sucursales.php">Sucursales</a>
					</li>
					<li class="barra-vertical">|</li>
				</ul>
			</div>
			<!-- Menu de accesso -->
			<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="admin/login.php"><i class="fa fa-user-o"></i> Acceder</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>

	<!-- Logo para visualización mediana + grande -->
	<div class="barra-busca sticky-top d-none d-md-block d-lg-block" id="barra-busca">
		<div class="row">
			<!-- Logo -->
			<div class="col-md-3">
				<a href="index.php"><img src="admin/img/logo.png" class="img-responsive logo"></a> 	
			</div>
			<!-- Caixa de Busca -->
			<div class="col-md-9 caixa-busca d-flex align-items-center">
				<form action="" method="GET" autocomplete="off" style="width: 100%;">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Buscar por productos" aria-label="Buscar por productos" aria-describedby="basic-addon2" name="search">
						<div class="input-group-append">
							<button class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Logo para visualización mediana + grande -->
	<div class="barra-busca d-block d-md-none" id="barra-busca">
		<div class="row">
			<!-- Logo -->
			<div class="col-md-3">
				<a href="index.php"><img src="admin/img/logo.png" class="img-responsive logo"></a> 	
			</div>
			<!-- Caixa de Busca -->
			<div class="col-md-9 caixa-busca d-flex align-items-center">
				<div class="input-group mb-3">
					<input type="text" class="form-control" placeholder="Buscar por productos" aria-label="Buscar por productos" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-info" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<nav class="navbar navbar-expand-lg navbar-light menu-categoria">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mx-auto">
				<?php
					include_once "admin/server/categoria.php";
					$menu = getMenu();
					$max = 10;
					// $menu = null;
					if ($menu != NULL) {
						$dropdown = "";

						if (count($menu) < $max) {
							$max = count($menu);
						}
						
						// foreach ($menu as $row) {
						for ($i = 0; $i < $max; $i++) {
							$row = $menu[$i];
							$submenu = getSubMenu($row['codigo']);
							if ($submenu == NULL) {
				?>
					<li class="nav-item">
						<a class="nav-link" href="catalogo.php?categoria=<?php echo $row['codigo'];?>"><?php echo $row['nombre'];?></a>
					</li>
				<?php 
							} else {
				?>	
					<li class="nav-item dropdown">
					<!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> -->
						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo $row['nombre'];?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php 
							foreach ($submenu as $linea) {
						?>
							<a class="dropdown-item" href="catalogo.php?categoria=<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></a>
						<?php 
							}
						?>
						</div>
					</li>
				<?php 
							}
						}
					}
				?>	
				<li class="nav-item dropdown">
					<a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="navbar-toggler-icon">
					</a>
					<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<?php
							for ($i = $max; $i < count($menu); $i++) {
								$row = $menu[$i];
								$submenu = null; //getSubMenu($row['codigo']);
								if ($submenu == NULL) {
						?>
						<li class="nav-item">
							<a class="nav-link" href="catalogo.php?categoria=<?php echo $row['codigo'];?>"><?php echo $row['nombre'];?></a>
						</li>
						<?php 
								} else {
						?>	
						<!-- <li class="dropdown-submenu dropleft">
							<a class="dropdown-item dropdown-toggle" href="#"><?php echo $row['nombre'];?></a>
							<ul class="dropdown-menu dropleft">
							<?php 
								//foreach ($submenu as $linea) {
							?>
								<li><a class="dropdown-item" href="catalogo.php?categoria=<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></a></li>
							<?php 
								//}
							?>
							</ul>
						</li> -->
						<?php 
								}
							}
						?>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
<!-- </header> -->