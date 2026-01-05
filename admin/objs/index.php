<?php
	include_once "admin/server/producto.php";
	include_once "admin/server/banner.php";
	include_once "admin/server/promociones.php";
	include_once "admin/server/visitas.php";
	include_once "includes/funciones.php";

	$destacados = getProductosBy ("destacados", "");//getDestacados();
	$banners = getBanners();
	$promociones = getPromociones();

	visit("vitrine", null); 
	visit("index.php", null);
?>