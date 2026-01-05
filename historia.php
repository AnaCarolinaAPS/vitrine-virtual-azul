<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Descrição da Página para o google-->
	<meta name="description" content="Tienda de muebles, ventas y financiacion de comodas cuotas.">
	<!-- Palavras Chave da Página para o google-->
	<meta name="keywords" content="vitrina virtual, muebles, electrodomésticos, ciudad del este">	
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/head.php'; ?>
	<!-- /.FIN DEL HEADER -->
	<title>Vitrine Virtual - Historia</title>
</head>
<body>
	<!-- INICIO DEL HEADER -->
	<?php include 'includes/header.php'; ?>
	<!-- /.FIN DEL HEADER -->
	
	<?php include_once "admin/objs/index.php";?>
	<!-- INICIO DEL CONTENIDO -->
	<main class="">
        <section class="historia">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
						<h2><?php echo $info['titulo_pagina'];?></h2>
						<?php echo $info['conteudo_pagina'];?>                        
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