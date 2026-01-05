<?php
	include_once "./server/producto.php";
	include_once "./server/categoria.php";
	include_once "./server/banner.php";
	include_once "./server/uploads.php";

	$categorias = getMenu ();
	$promociones = null;

	$banners = getAllBanners();
	$lastOrden = getLastOrder();
	if ($lastOrden['orden'] >= 0) {
		$lastOrden = $lastOrden['orden'] + 1;
	} else {
		$lastOrden = $lastOrden['orden'];
	}

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if (isset($_POST['nuevo'])){
			if (basename($_FILES["fileToUpload"]["name"]) == "") {
				$img = "no-banner.png";
			} else {
				$imgname = "banner-".date("Y-m-d")."-".basename($_FILES["fileToUpload"]["name"]);
				$img = saveImg ("img/banners/", $imgname, "fileToUpload");
			}

			if (substr($img,0,6) == "banner" OR $img == "no-image.png") {
				$activo = null;
				if(!isset($_POST['activo'])) {
					$activo = 0;
				} else {
					$activo = 1;
				}

				$link = "";
				if($_POST['linktype'] == "categoriatype"){
					$link = "catalogo.php?categoria=".$_POST['categoria'];
				} else if($_POST['linktype'] == "productotype"){
					$link = "producto.php?cod=".$_POST['producto'];
				} else if($_POST['linktype'] == "promociontype"){
					$link = "#promo-".$_POST['promocion'];
				} else {
					$link = $_POST['link'];
				}

				$incluir = newBanner ($img, $_POST['alternativo'], $link, $_POST['orden'], $activo);

				if ($incluir == $img) {
					$tipomensaje = 'success';
					$mensaje= '<h3>Perfecto!</h3><p>El banner fue insertado correctamente.</p>';
					$banners = getAllBanners();
					$lastOrden = getLastOrder();
					$lastOrden = $lastOrden['orden'] + 1;
				} else if ($incluir == null) {
					$tipomensaje = 'error';
					$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
				} else {
					$tipomensaje = 'error';
					$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$incluir.'"</p>';
				}
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>'.$img.'</p>';
			}
		} else if (isset($_POST['excluir'])){
			$codigo =  $_POST['codigo'];
			$excluir = deleteBanner ($codigo);

			if ($excluir == $codigo) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>La imagen fue eliminada correctamente.</p>';
				$banners = getAllBanners();
				$lastOrden = getLastOrder();
				if ($lastOrden['orden'] > 0) {
					$lastOrden = $lastOrden['orden'] + 1;
				} else {
					$lastOrden = $lastOrden['orden'];
				}
			} else if ($excluir == null) {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$excluir.'"</p>';
			}
		} else if (isset($_POST['guardar'])){
			if (basename($_FILES["fileToUpload"]["name"]) == "") {
				$img = $_POST['imgurl'];
			} else {
				$imgname = "banner-".date("Y-m-d")."-".basename($_FILES["fileToUpload"]["name"]);
				$img = saveImg ("img/banners/", $imgname, "fileToUpload");
			}

			$activo = null;
			if(!isset($_POST['activo'])) {
				$activo = 0;
			} else {
				$activo = 1;
			}

			$link = "";
			if($_POST['linktype-alt'] == "categoriatype-alt"){
				$link = "catalogo.php?categoria=".$_POST['categoria'];
			} else if($_POST['linktype-alt'] == "productotype-alt"){
				$link = "producto.php?cod=".$_POST['producto'];
			} else if($_POST['linktype-alt'] == "promociontype-alt"){
				$link = "#promo-".$_POST['promocion'];
			} else {
				$link = $_POST['link'];
			}

			$guardar = saveBanner ($_POST['codigo'], $img, $_POST['alternativo'], $link, $_POST['orden'], $activo);
			if ($guardar == $_POST['codigo']) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron actualizados correctamente.</p>';
				$banners = getAllBanners();
				$lastOrden = getLastOrder();
				if ($lastOrden['orden'] > 0) {
					$lastOrden = $lastOrden['orden'] + 1;
				} else {
					$lastOrden = $lastOrden['orden'];
				}
			} else if ($guardar == null) {
				$tipomensaje = 'success';
				$mensaje = '<h3>Perfecto!</h3><p>No hubo alteración en los datos.</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
			}
		} 
	}
?>