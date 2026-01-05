<?php
	include_once "admin/server/producto.php";
	include_once "admin/server/categoria.php";
	include_once "admin/server/promociones.php";
	include_once "admin/server/image.php";
	include_once "admin/server/visitas.php";
	include_once "includes/funciones.php";

	visit("ramirezramirez", null); //por si haya venido por algún link y no pasó por index.php
	$cod_producto = $_GET['cod'];
	visit("producto.php", $cod_producto);
	
	$producto = getProducto ($cod_producto);
	$promo = getProductosBy ("producto", $cod_producto);//getProdPromo($cod_producto);
	$categoria = getCategoria($producto['cod_categoria']);
	$images = getImages ($cod_producto);
	$otros = getProductosBy ("categoria", $producto['cod_categoria']);//getProdbyCategoria($producto['cod_categoria']);

	$urlencode = urlencode("Quisiera más información acerca del producto *COD " . $producto['codigo'] . "* " . $producto['nombre']);

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if (isset($_POST['contactoventas'])){
			visit("ventas", $cod_producto);
		}
	}
?>