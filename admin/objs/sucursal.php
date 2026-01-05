<?php
	include_once "./server/sucursal.php";

	$sucursales = getAllSucursales();

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if (isset($_POST['nuevo'])){
			$activo = null;
			if(!isset($_POST['activo'])) {
				$activo = 0;
			} else {
				$activo = 1;
			}

			$incluir = newSucursal ($_POST['nombre'], $_POST['ubicacion'], $_POST['ciudad'], $_POST['celular'], $_POST['telefono'], $_POST['maps'], $activo);
			if ($incluir == $_POST['nombre']) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><pLa Sucursal fue insertada correctamente.</p>';
				$sucursales = getAllSucursales();
			} else if ($incluir == null) {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$incluir.'"</p>';
			}
		} else if (isset($_POST['excluir'])){
			$codigo =  $_POST['codigo'];
			$excluir = deleteSucursal ($codigo);

			if ($excluir == $codigo) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>La Sucursal fue eliminada correctamente.</p>';
				$sucursales = getAllSucursales();
			} else if ($excluir == null) {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$excluir.'"</p>';
			}
		} else if (isset($_POST['guardar'])){
			$activo = null;
			if(!isset($_POST['activo'])) {
				$activo = 0;
			} else {
				$activo = 1;
			}
			// var_dump($_POST);
			$guardar = saveSucursal ($_POST['codigo'], $_POST['nombre'], $_POST['ubicacion'], $_POST['ciudad'], $_POST['celular'], $_POST['telefono'], $_POST['maps'], $activo);
			if ($guardar == $_POST['codigo']) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron actualizados correctamente.</p>';
				$sucursales = getAllSucursales();
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