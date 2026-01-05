<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Descrição da Página para o google-->
	<meta name="description" content="Tienda de muebles, ventas y financiacion de comodas cuotas.">
	<!-- Palavras Chave da Página para o google-->
	<meta name="keywords" content="vitrine virtual, muebles, electrodomésticos, ciudad del este">	
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/head.php'; ?>
	<!-- /.FIN DEL HEADER -->
	<title>Vitrine Virtual - Catálogo</title>
</head>
<body>
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/header.php'; ?>
	<!-- /.FIN DEL HEADER -->
	
	<?php include_once "admin/objs/catalogo.php";?>
	<!-- INICIO DEL CONTENIDO -->
	<main class="">
		<section class="catalogo">
			<div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $breadcrumb;?>
                    </div>
				</div>
				<div class="row">
                    <div class="col-md-3">
                        <ul class="nav flex-column menu-catalogo">
                        <?php
                            $activo = "";
                            if(!isset($_GET['categoria'])){
                                $activo = " active";
                            }                                    
                        ?>   
                            <li class="nav-item">
                                <a class="nav-link <?php echo $activo;?>" href="catalogo.php?categoria=ALL">Todos</a>
                            </li>
                            <div class="separador"></div>
                        <?php
                            $menu = getMenu();

                            if ($menu != NULL && $activo == '') {
                                $dropdown = "";
                                $activo = "";
                                $x = 0;
                                $submenu = null;
                                foreach ($menu as $row) {
                                    if(isset($_GET['categoria'])){
                                        if ($cod_padre) {
                                            if ($cod_padre['cod_padre'] == $row['codigo'] OR $row['codigo'] == $_GET['categoria']) {
                                                $submenu = getSubMenu($row['codigo']);
                                            } else {
                                                $submenu = null;
                                            }
                                            if ($row['codigo'] == $_GET['categoria']) {
                                                $activo = " active";
                                            } else {
                                                $activo = "";
                                            }    
                                        }                    
                                    }                                       
                        ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $activo;?>" href="catalogo.php?categoria=<?php echo $row['codigo'];?>"><?php echo $row['nombre'];?></a>
                            </li>
                        <?php 
                                    if ($submenu != NULL) {
                                        $y = 0;
                                        foreach ($submenu as $linea) {
                                            if ($linea['codigo'] == $_GET['categoria']) {
                                                $activo = " active";
                                            } else {
                                                $activo = "";
                                            }
                        ?>	
                            <li class="sub-nav-item">
                                <a class="nav-link <?php echo $activo;?>" href="catalogo.php?categoria=<?php echo $linea['codigo'];?>"><?php echo $linea['nombre'];?></a>
                            </li>
                            <?php
                                $y++;
                                if ($y < sizeof($submenu)) { 
                            ?>    
                            <div class="sub-separador"></div>
                            <?php
                                }
                                        }
                                    }
                                $x++;
                                if ($x < sizeof($menu)) { 
                            ?>
                            <div class="separador"></div>
                        <?php
                            }
                                }
                            } 
                        ?>
                        </ul>
                    </div>
					<div class="col-md-9">
                        <!-- <div class="row"> -->
                            <?php
                                $qtd = 0;
                                if ($productos != NULL) {
                                    foreach($productos as $producto) {
                                        if ($qtd == 0) {
                                            echo '<div class="row catalog-prod">';
                                        }
                            ?>
                                <div class="col-md-3">
                                    <?php echo createCard ($producto);?>
                                </div>
                            <?php
                                        $qtd++;
                                        if ($qtd == 4) {
                                            echo "</div>";
                                            $qtd = 0;
                                        }
                                    }//END FOR 
                                }//END IF
                                if ($qtd <> 0) { 
                                    echo "</div>";
                                }
                            ?>	
                        <!-- </div> -->
					</div>
				</div>
			</div>			
		</section>
		
	</main>
	<!-- /.FIN DEL CONTENIDO -->

	<!-- INICIO DEL FOOTER -->
	<?php include 'includes/footer.php'; ?>
	<!-- /.FIN DEL FOOTER -->	

	<?php include 'includes/scripts.php'; ?>
</body>
</html>