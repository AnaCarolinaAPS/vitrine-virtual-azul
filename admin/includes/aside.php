<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="img/logouser.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $_SESSION['nome_usuario'];?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<?php 
			$inicio = "";

			$catastro = "";
			$subcategoria1 = "";
			$subcategoria2 = "";
			$subproducto1 = "";
			$subproducto2 = "";
			$subpromociones1 = "";
			$subpromociones2 = "";

			$site = "";
			$subbanner1 = "";
			$subbanner2 = "";
			$subhistoria1 = "";
			$subhistoria2 = "";
			$subsucursales1 = "";
			$subsucursales2 = "";

			if (strpos($_SERVER['REQUEST_URI'], 'categorias.php') !== false){
				$catastro = "active";
				$subcategoria1= "active";
				$subcategoria2 = "text-aqua";
			} else if (strpos($_SERVER['REQUEST_URI'], 'productos.php') !== false OR strpos($_SERVER['REQUEST_URI'], 'detalle.php') !== false){
				$catastro = "active";
				$subproducto1 = "active";
				$subproducto2 = "text-aqua";
			} else if (strpos($_SERVER['REQUEST_URI'], 'promociones.php') !== false OR strpos($_SERVER['REQUEST_URI'], 'promo.php') !== false){
				$catastro = "active";
				$subpromociones1 = "active";
				$subpromociones2 = "text-aqua";
			} else if (strpos($_SERVER['REQUEST_URI'], 'banners.php') !== false) {
				$site = "active";
				$subbanner1 = "active";
				$subbanner2 = "text-aqua";
			} else if (strpos($_SERVER['REQUEST_URI'], 'sucursales.php') !== false) {
				$site = "active";
				$subsucursales1 = "active";
				$subsucursales2 = "text-aqua";
			} else if (strpos($_SERVER['REQUEST_URI'], 'informaciones.php') !== false) {
				$site = "active";
				$subhistoria1 = "active";
				$subhistoria2 = "text-aqua";
			}else {
				$inicio = "active";
			}
		?>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">Menu de Navegación</li>
			<li class="<?php echo $inicio;?>">
				<a href="index.php">
					<i class="fa fa-home"></i> <span>Inicio</span>
				</a>
			</li>
			<li class="<?php echo $catastro;?> treeview">
				<a href="#">
					<i class="fa fa-pencil"></i> <span>Catastros</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo $subcategoria1;?>"><a href="categorias.php"><i class="fa fa-circle-o <?php echo $subcategoria2;?>"></i> Categorias</a></li>
					<li class="<?php echo $subproducto1;?>"><a href="productos.php"><i class="fa fa-circle-o <?php echo $subproducto2;?>"></i> Productos</a></li>
					<li class="<?php echo $subpromociones1;?>"><a href="promociones.php"><i class="fa fa-circle-o <?php echo $subpromociones2;?>"></i> Promociones</a></li>
				</ul>
			</li>
			<li class="<?php echo $site;?> treeview">
				<a href="#">
					<i class="fa fa-laptop"></i> <span>Site</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?php echo $subbanner1;?>"><a href="banners.php"><i class="fa fa-circle-o <?php echo $subbanner2;?>"></i> Banners</a></li>
					<li class="<?php echo $subhistoria1;?>"><a href="informaciones.php"><i class="fa fa-circle-o <?php echo $subhistoria2;?>"></i> Informaciones</a></li>
					<li class="<?php echo $subsucursales1;?>"><a href="sucursales.php"><i class="fa fa-circle-o <?php echo $subsucursales2;?>"></i> Sucursales</a></li>
				</ul>
			</li>
		</ul>
	</section>
<!-- /.sidebar -->
</aside>