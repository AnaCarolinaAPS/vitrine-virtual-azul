<?php
    include_once "./server/promociones.php";
    include_once "./server/categoria.php";
    include_once "./server/producto.php";
    include_once "./server/uploads.php";

    $promocion = getPromocion ($_GET['cod']);
    $productos = getProds($promocion['codigo']);
    $categorias = getMenu ();

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['guardarpr'])){
            if (basename($_FILES["fileToUpload"]["name"]) != "") {
                $fondoname = "fondo-promo".$promocion['codigo']."-".basename($_FILES["fileToUpload"]["name"]);
                $fondo = saveImg ("img/promociones/", $fondoname, "fileToUpload"); //intenta salvar la imagen en la carpeta

                //Verifica se hubo la inclusión de la imagem
                if (substr($fondo,0,11) == "fondo-promo") {
                    $fondoP = promoFondo($promocion['codigo'], $fondo); //actualiza el fondo para el eligido 
                    if ($fondoP != $promocion['codigo']) {
                        $tipomensaje = 'error';
                        $mensaje = '<h3>Error - Inclusión de la Imagen de Fondo</h3><p>'.$fondoP.'</p>';
                        $ok = 0;
                    }
                } else {
                    $tipomensaje = 'error';
                    $mensaje = '<h3>Error - Imagen de Fondo</h3><p>'.$fondo.'</p>';
                    $ok = 0;
                }
            }
            if (basename($_FILES["fileToUpload2"]["name"]) != "") {
                $promoname = "promo".$promocion['codigo']."-".basename($_FILES["fileToUpload2"]["name"]);
                $promo = saveImg ("img/promociones/", $promoname, "fileToUpload2"); //intenta salvar la imagen en la carpeta

                //Verifica se hubo la inclusión de la imagem
                if (substr($promo,0,5) == "promo") {
                    $promoP = promoImg($promocion['codigo'], $promo);//actualiza la imagen el eligido 
                    if ($promoP != $promocion['codigo']) {
                        $tipomensaje = 'error';
                        $mensaje = '<h3>Error - Inclusión de la Imagen</h3><p>'.$promoP.'</p>';
                        $ok = 0;
                    }
                } else {
                    $tipomensaje = 'error';
                    $mensaje = '<h3>Error - Imagen</h3><p>'.$promo.'</p>';
                    $ok = 0;
                }
            }
			$activo = null;
			if(!isset($_POST['activo'])) {
				$activo = 0;
			} else {
				$activo = 1;
			}
			$guardar = savePromo ($promocion['codigo'], $_POST['titulo'], $_POST['orden'], $activo);
			if ($guardar == $promocion['codigo']) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron actualizados correctamente.</p>';
                $productos = getProds($promocion['codigo']);
			} else if ($guardar == null) {
				$tipomensaje = 'success';
				$mensaje = '<h3>Perfecto!</h3><p>No hubo alteración en los datos.</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
			}
        } else if (isset($_POST['excluirpr'])){
			$excluir = deletePromo ($promocion['codigo']);

			if ($excluir == $promocion['codigo']) {
				$_SESSION['action'] = "drop";
				echo "<script type='text/javascript'>document.location.href='promociones.php';</script>";
			} else if ($excluir == null) {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$excluir.'"</p>';
			}
		} else if (isset($_POST['nuevo'])){
            $codigo = $promocion['codigo'];
            $tipomensaje = '';
			foreach ($_POST['producto'] as $prod) {
				$guardar = newProdPromo ($codigo, $prod);
				if ($guardar == $prod OR $guardar == NULL) {
					$tipomensaje = '';
				} else {
					$tipomensaje = 'error';
					$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
				}
			}

			if ($tipomensaje == '') {
				$tipomensaje = 'success';
                $mensaje= '<h3>Perfecto!</h3><p>Los Productos fueron agregados correctamente en la Promoción.</p>';
                $productos = getProds($promocion['codigo']);  
            }
        } else if (isset($_POST['guardar'])){
            if ($_POST['valor'] > 0) {
				$valor = str_replace(".", "", $_POST['valor']);
			} else {
				$valor = "NULL";
			}
			if ($_POST['cuota'] > 0) {
				$cuota = str_replace(".", "", $_POST['cuota']);
			} else {
				$cuota = "NULL";
			}
			if ($_POST['precio'] > 0) {
				$precio = str_replace(".", "", $_POST['precio']);
			} else {
				$precio = "NULL";
            }
            $promo = $promocion['codigo'];
            $producto = $_POST['codigo'];

            $guardar = saveProdPromo ($promo, $producto, $precio, $cuota, $valor);
			if ($guardar == $producto) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron actualizados correctamente.</p>';
                $productos = getProds($promocion['codigo']);
			} else if ($guardar == null) {
                $tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
				// $tipomensaje = 'success';
				// $mensaje = '<h3>Perfecto!</h3><p>No hubo alteración en los datos.</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
			}
		} else if (isset($_POST['excluir'])){
            $promo = $promocion['codigo'];
            $producto = $_POST['codigo'];
			$excluir = deleteProdPromo ($promo, $producto);

			if ($excluir == $producto) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>El Producto fue eliminado correctamente.</p>';
				$productos = getProds($promocion['codigo']);
			} else if ($excluir == null) {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$excluir.'"</p>';
			}
		}
    }
?>