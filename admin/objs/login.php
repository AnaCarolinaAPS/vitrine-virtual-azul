<?php
require "./server/login.php";

if(isset($_POST['usuario']) || isset($_POST['contrasena'])) {
	if(isset($_POST['usuario']) && $_POST['usuario'] != '' && isset($_POST['contrasena']) &&  $_POST['contrasena'] != '' ) {
		$usuario = $_POST['usuario'];
		$contrasena = md5($_POST['contrasena']); //md5 para encriptar

		$login = login ($usuario, $contrasena);
		// if ($login == null) {
		// 	$loginc = loginc ($usuario, $contrasena);

		// 	if ($loginc == null) {
		// 		$mensaje = '<p class="alert alert-danger">Datos Incorrectos!</p>';
		// 	} else {
		// 		$_SESSION['logueado'] = 'logueado';
		// 		$_SESSION['nome_usuario'] = $loginc['nombre_compl'];
		// 		$_SESSION['usuario'] = $loginc['codigo'];
		// 		$_SESSION['role'] = 4; //0 Master //1 Logistico //2 Financeiro //3 cliente
		// 		header('Location: index.php');
		// 	}
			
		// } else {
			// foreach ($login as $row) {
				$_SESSION['logueado'] = 'logueado';
				$_SESSION['nome_usuario'] = $login['nombre'];
				$_SESSION['usuario'] = $login['usuario'];
				$_SESSION['user'] = $login['codigo'];
				$_SESSION['role'] = $login['papel']; //0 Master //1 Logistico //2 Financeiro //3 cliente
				header('Location: index.php');
			// }
		// }
	} else { //Si no encontró apresenta error
		$mensaje = '<p class="alert alert-danger">Por favor, Ingrese Todos los Datos!</p>';
	}
}
?>