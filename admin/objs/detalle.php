<?php
	include_once "./server/producto.php";
	include_once "./server/categoria.php";
	include_once "./server/image.php";
	include_once "./server/uploads.php";

	if (isset($_SESSION['action'])) {
		if ($_SESSION['action'] == "new") {
			$_SESSION['action'] = "";
			$tipomensaje = 'success';
			$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron insertados correctamente.</p>';
		}
	}
	$producto = getProducto($_GET['producto']);
	$categorias = getCategoriasActivas();
	$imagenes = getImages($_GET['producto']);
	$lastOrden = getLastOrder($_GET['producto']);

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if (isset($_POST['nuevo'])){
			if (basename($_FILES["fileToUpload"]["name"]) == "") {
				$img = "no-image.png";
			} else {
				$imgname = "cod".$_GET['producto']."-".date("Y-m-d")."-".basename($_FILES["fileToUpload"]["name"]);
				$img = saveImg ("img/productos/", $imgname, "fileToUpload");
			}

			if (substr($img,0,3) == "cod" OR $img == "no-image.png") {
				$activo = null;
				if(!isset($_POST['activo'])) {
					$activo = 0;
				} else {
					$activo = 1;
				}
				$incluir = newImage ($img, $_GET['producto'], $_POST['orden'], $activo);

				if ($incluir == $img) {
					$tipomensaje = 'success';
					$mensaje= '<h3>Perfecto!</h3><p>Las imagenes fueran insertadas correctamente.</p>';
					$imagenes = getImages($_GET['producto']);
					$lastOrden = getLastOrder($_GET['producto']);
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
			$excluir = deleteImage ($codigo);

			if ($excluir == $codigo) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>La imagen fue eliminada correctamente.</p>';
				$imagenes = getImages($_GET['producto']);
				$lastOrden = getLastOrder($_GET['producto']);
			} else if ($excluir == "inactivo") {
				$tipomensaje = 'warning';
				$mensaje= '<h3>Atención!</h3><p>No se pudo eliminar el registro devido a productos y subcategorias pendientes.<br>La categoría fue INACTIVADA.</p>';
				$categorias = getAllCategorias();
				$categoriasS = getCategorias();
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
				$imgname = "cod".$_GET['producto']."-".date("Y-m-d")."-".basename($_FILES["fileToUpload"]["name"]);
				$img = saveImg ("img/productos/", $imgname, "fileToUpload");
			}

			$activo = null;
			if(!isset($_POST['activo'])) {
				$activo = 0;
			} else {
				$activo = 1;
			}
			$guardar = saveImage ($_POST['codigo'], $img, $_POST['orden'], $activo);
			if ($guardar == $_POST['codigo']) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron actualizados correctamente.</p>';
				$imagenes = getImages($_GET['producto']);
				$lastOrden = getLastOrder($_GET['producto']);
			} else if ($guardar == null) {
				$tipomensaje = 'success';
				$mensaje = '<h3>Perfecto!</h3><p>No hubo alteración en los datos.</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
			}
		} else if (isset($_POST['guardarpr'])){ 
			$activo = null;
			if(!isset($_POST['activo'])) {
				$activo = 0;
			} else {
				$activo = 1;
			}
			$destacado = null;
			if(!isset($_POST['destacado'])) {
				$destacado = 0;
			} else {
				$destacado = 1;
			}

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

			$guardar = saveProducto ($_POST['codigo'], $_POST['nombre'], $_POST['descripcion'], $_POST['estoque'], $precio, $cuota, $valor, $_POST['categoria'], $destacado, $activo);
			if ($guardar == $_POST['codigo']) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron actualizados correctamente.</p>';
				$producto = getProducto($_GET['producto']);
			} else if ($guardar == null) {
				$tipomensaje = 'success';
				$mensaje = '<h3>Perfecto!</h3><p>No hubo alteración en los datos.</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
			}
		} else if (isset($_POST['excluirpr'])){
			$excluir = deleteProducto ($_POST['codigo']);

			if ($excluir == $_POST['codigo']) {
				$_SESSION['action'] = "drop";
				echo "<script type='text/javascript'>document.location.href='productos.php';</script>";
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