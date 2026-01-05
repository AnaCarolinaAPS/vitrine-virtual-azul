<?php
    include_once "./server/promociones.php";
    include_once "./server/uploads.php";

    $promociones = getAllPromociones ();
    $lastOrden = getPromoLastOrder();
	if ($lastOrden['orden'] >= 0) {
		$lastOrden = $lastOrden['orden'] + 1;
	} else {
		$lastOrden = $lastOrden['orden'];
    }

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['nuevo'])){
            $activo = null;
            if(!isset($_POST['activo'])) {
                $activo = 0;
            } else {
                $activo = 1;
            }
                
            $fondo = "no-fondo-promo.png";
            $promo = "no-promo.png";
            $incluir = newPromo ($_POST['titulo'], $_POST['orden'], $fondo, $promo, $activo);
            // var_dump(is_numeric($incluir));

            $ok = 1;
            if (is_numeric($incluir)) { //si retorna un codigo
                if (basename($_FILES["fileToUpload"]["name"]) != "") {
                    $fondoname = "fondo-promo".$incluir."-".basename($_FILES["fileToUpload"]["name"]);
                    $fondo = saveImg ("img/promociones/", $fondoname, "fileToUpload"); //intenta salvar la imagen en la carpeta

                    //Verifica se hubo la inclusión de la imagem
                    if (substr($fondo,0,11) == "fondo-promo") {
                        $fondoP = promoFondo($incluir, $fondo); //actualiza el fondo para el eligido 
                        if ($fondoP != $incluir) {
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
                    $promoname = "promo".$incluir."-".basename($_FILES["fileToUpload2"]["name"]);
                    $promo = saveImg ("img/promociones/", $promoname, "fileToUpload2"); //intenta salvar la imagen en la carpeta

                    //Verifica se hubo la inclusión de la imagem
                    if (substr($promo,0,5) == "promo") {
                        $promoP = promoImg($incluir, $promo);//actualiza la imagen el eligido 
                        if ($promoP != $incluir) {
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

                if ($ok == 1) {
                    $_SESSION['action'] = "imgPromo";
				    echo "<script type='text/javascript'>document.location.href='promo.php?cod=".$incluir."';</script>";
                } else {
                    $_SESSION['action'] = "noimgPromo";
				    echo "<script type='text/javascript'>document.location.href='promo.php?cod=".$incluir."';</script>";
                }
            } else if ($incluir == null) {
                $tipomensaje = 'error';
                $mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
            } else {
                $tipomensaje = 'error';
                $mensaje = '<h3>Error!</h3><p>'.$incluir.'</p>';
            }
		} 
    }
?>