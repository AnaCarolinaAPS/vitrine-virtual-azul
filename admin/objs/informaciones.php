<?php
    include_once "./server/informaciones.php";

    $informaciones = getInformaciones ();

    if($_SERVER['REQUEST_METHOD'] == "POST") {
		if (isset($_POST['guardar'])){
            $guardar = saveInfo ($_POST['whatsapp'], $_POST['facebook'], $_POST['instagram'], $_POST['email'], $_POST['titulo'], $_POST['editor'],$_POST['lunesviernes'],$_POST['sabados']);
			if ($guardar == 1) {
				$tipomensaje = 'success';
				$mensaje= '<h3>Perfecto!</h3><p>Los datos fueron actualizados correctamente.</p>';
				$informaciones = getInformaciones ();
			} else if ($guardar == null) {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Registro NO ENCONTRADO</p>';
			} else {
				$tipomensaje = 'error';
				$mensaje = '<h3>Error!</h3><p>Consulte al administrador de sistemas.<br>Error->"'.$guardar.'"</p>';
			}
        }
    }
?>