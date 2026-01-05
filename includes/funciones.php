<?php

function createCard ($product){
    if ($product['img'] == null) {
        $product['img'] = "no-image.png";
    }

    $precio = "";
    if ($product['ctd_cuota'] > 0 && $product['valor_cuota'] > 0) {
        $precio = $product['ctd_cuota']." cuotas de ".number_format($product['valor_cuota'], 0, ',', '.')." gs";
    } else if ($product['precio'] > 0) {
        $precio = "Al contado ".number_format($product['precio'], 0, ',', '.')." gs";
    } else {
        $precio = "Sob consulta";
    }
        
    $promo = "";
    if ($product['promo_cuota'] > 0 && $product['promo_valor'] > 0) {
        $promo = $product['promo_cuota']." cuotas de ".number_format($product['promo_valor'], 0, ',', '.')." gs";
    } else if ($product['promo_precio'] > 0) {
        $promo = "Al contado ".number_format($product['precio'], 0, ',', '.')." gs";
    } else {
        $promo = ""; //producto no está en promoción
    }
    $card = '<div class="card border-info">';
        if ($promo != "") {
            $card .= '<span class="badge badge-info" style="position: absolute; top: 5px; left: 5px;font-size: 1rem;">Promoción</span>';
        }
        $card .= '<img class="card-img-top" src="admin/img/productos/'.$product['img'].'" alt="Imagem de capa do card">';
        $card .= '<div class="card-body align-items-center d-flex justify-content-center">';
        if ($promo != "") {
            $card .= '<h5 class="card-title"> <span style="font-size: 10pt;">De '.$precio.'<br></span> Por '.$promo.'</h5>';
        } else {
            $card .= '<h5 class="card-title">'.$precio.'</h5>';
        }

        $card .= '</div>';
        $card .= '<div class="card-body align-items-center d-flex justify-content-center">';
            $card .= '<p class="card-text">'.$product['nombre'].'</p>';
        $card .= '</div>';
        $card .= '<div class="card-footer">';
            $card .= '<a href="producto.php?cod='.$product['codigo'].'" class="btn btn-outline-info">Más informaciones</a>';
        $card .= '</div>';
    $card .= '</div>';								
    
    return $card;
}

// function createCard2 ($product){
//     $card = '<div class="card border-info">';
//         $card .= '<img class="card-img-top" src="admin/img/productos/'.$product['img'].'" alt="Imagem de capa do card">';
//         $card .= '<div class="card-body">';
//             if (strlen($product['precio']) < 15) {
//                 $style = "";//' style="margin-bottom: 35px;"';
//             } else {
//                 $style = '';
//             }
//             $precioa = "";
//             if ($product['prod_cuota'] > 0 && $product['prod_valor'] > 0) {
//                 $precioa = $product['prod_cuota']." cuotas de ".number_format($product['prod_valor'], 0, ',', '.')." gs";
//             } else if ($product['prod_precio'] > 0) {
//                 $precioa = "Al contado ".number_format($product['prod_precio'], 0, ',', '.')." gs";
//             } else {
//                 $precioa = "Sob consulta";
//             }

//             $precio = "";
//             if ($product['ctd_cuota'] > 0 && $product['valor_cuota'] > 0) {
//                 $precio = $product['ctd_cuota']." cuotas de ".number_format($product['valor_cuota'], 0, ',', '.')." gs";
//             } else if ($product['precio'] > 0) {
//                 $precio = "Al contado ".number_format($product['precio'], 0, ',', '.')." gs";
//             } else {
//                 $precio = "Sob consulta";
//             }
									
//             $card .= '<h5 class="card-title"'.$style.'> <span style="font-size: 10pt;">De '.$precioa.'</span> Por '.$precio.'</h5>';
//             if (strlen($product['nombre']) < 25) {
//                 $style = '';//' style="margin-bottom: 25px;"';
//             } else {
//                 $style = '';
//             }
//             $card .= '<p class="card-text"'.$style.'>'.$product['nombre'].'</p>';
//         $card .= '</div>';
//         $card .= '<div class="card-footer">';
//             $card .= '<a href="producto.php?cod='.$product['codigo'].'" class="btn btn-outline-info">Más informaciones</a>';
//         $card .= '</div>';
//     $card .= '</div>';								
    
//     return $card;
// }

function breadcrumbMenu ($categoria){
    // var_dump($categoria);
    if ($categoria != NULL) {
        $nav = '<nav aria-label="breadcrumb">';
            $nav .= '<ol class="breadcrumb breadcrumb-catalogo">';
                $nav .= '<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>';
                if ($categoria['cod_padre'] != NULL) { //es subcategoria
                    $nav .= '<li class="breadcrumb-item"><a href="catalogo.php?categoria='.$categoria['cod_padre'].'">'.$categoria['padre'].'</a></li>';
                }
                $nav .= '<li class="breadcrumb-item active">'.$categoria['nombre'].'</li>';
            $nav .= '</ol>';
        $nav .= '</nav>';
    } else {
        $nav = '<nav aria-label="breadcrumb">';
            $nav .= '<ol class="breadcrumb breadcrumb-catalogo">';
                $nav .= '<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>';
                $nav .= '<li class="breadcrumb-item active">Todos</li>';
            $nav .= '</ol>';
        $nav .= '</nav>';
    }
    return $nav;
}

function boxBranchs ($sucursal){
    // var_dump($sucursales);
    $branch = '<h3>'.$sucursal['nombre'].'</h3>';
    $branch .= '<p><iframe src="'.$sucursal['maps'].'" width="80%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></p>';
    $branch .= '<p class="ubicacion">';
        $branch .= $sucursal['ubicacion'].'<br>';
        $branch .= $sucursal['ciudad'].'<br>';
        if ($sucursal['telefono'] != NULL) {
            $branch .= 'Tel '.$sucursal['telefono'].'<br>';
        }
        if ($sucursal['celular'] != NULL) {
            $branch .= 'Cel '.$sucursal['celular'].'<br>';
        }        
    $branch .= '</p>';
    return $branch;
}
?>