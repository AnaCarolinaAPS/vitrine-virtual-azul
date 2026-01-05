<?php ?>

<header class="main-header">
	<a href="index.php" class="logo">
		<span class="logo-mini"><span class="primer">V</span><span class="segundo">V</span></span>
		<span class="logo-lg"><span class="primer">Vitrine</span><span class="segundo">Virtual</span></span><!-- <img src="img/logo.png" class="img-responsive" alt="RamirezRamirez"> -->
	</a>

	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="img/logouser.png" class="user-image" alt="User Image">
						<span class="hidden-xs"><?php echo $_SESSION['nome_usuario'];?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="img/logouser.png" class="img-circle" alt="User Image">
							<p>
								<?php echo $_SESSION['nome_usuario'];?>
								<!-- <small>Member since Nov. 2012</small> -->
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="#" class="btn btn-default btn-flat">Perfil</a>
							</div>
							<div class="pull-right">
								<a href="salir.php" class="btn btn-default btn-flat">Salir</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>