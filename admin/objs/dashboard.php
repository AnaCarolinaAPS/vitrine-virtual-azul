<?php
	include_once "./server/producto.php";
	include_once "./server/visitas.php";

    $ctd_productos = getProductosActivos ();
    $ctd_productos = $ctd_productos['productos_activos'];
    if ($ctd_productos == null) {
        $ctd_productos = 0;
    }
    $visitors = getUniqueVisist ('vitrine');
    if ($visitors == null) {
        $visitors = 0;
    } else {
        $visitors = $visitors['unique_hits'];
    }

    $informaciones = getUniqueVisist ('producto.php');    
    if ($informaciones == null) {
        $informaciones = 0;
    } else {
        $informaciones = $informaciones['unique_hits'];
    }

    $ventas = getUniqueVisist ('ventas');
    if ($ventas == null) {
        $ventas = 0;
    } else {
        $ventas = $ventas['unique_hits'];    
    }

    $productos =  getProdMenosEstoque();
    $categorias = getMasVistosCat();
    $masvisitados = getMasVistos();
    $maspreguntados = getMasPreguntados();

    // var_dump($ctd_productos);
?>