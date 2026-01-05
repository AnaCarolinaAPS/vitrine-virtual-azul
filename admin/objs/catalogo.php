<?php
	include_once "includes/funciones.php";
	include_once "admin/server/producto.php";
	include_once "admin/server/categoria.php";
	include_once "admin/server/visitas.php";
	
	visit("ramirezramirez", null); //por si haya venido por algún link y no pasó por index.php
	if (isset($_GET['categoria'])) {
		$categoria = $_GET['categoria'];
		$cod_padre = getPadre($categoria);
		$bc_categoria = getCategoria($categoria);
		$productos = getProductosBy ("categoria", $categoria);//getProdbyCategoria ($categoria);
		$breadcrumb = breadcrumbMenu ($bc_categoria);
		visit("catalogo.php", $categoria);
	} else {
		$cod_padre = NULL;
		$breadcrumb = breadcrumbMenu(NULL);
		$productos = getProductosBy ("search", $_GET['q']);//getProdbySearch($_GET['q']);
		visit("catalogo.php", "search");
	}
?>