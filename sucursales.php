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
	<title>Vitrine Virtual</title>
</head>
<body>
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/header.php'; ?>
	<!-- /.FIN DEL HEADER -->
	
	<?php include_once "admin/objs/sucursales.php";?>
	<!-- INICIO DEL CONTENIDO -->
	<main class="">
        <section class="sucursales">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Nuestras Sucursales</h2>
                    </div>
                </div>
                <div class="row">
                   <?php
                        if ($sucursales != NULL) {
                            foreach($sucursales as $row) {
                    ?>
                    <div class="col-md-4 text-center">
                        <?php echo boxBranchs($row);?>
                    </div>
                    <?php
                            }//END FOR 
                        }//END IF NULL
                    ?>
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