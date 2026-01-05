<?php 
	include_once "conn.php";

	function login ($usuario, $contrasena) {
		$connection = conn();

		$sql= "SELECT * from tb_usuario WHERE usuario = '$usuario' AND password = '$contrasena'";
		$query= $connection->prepare($sql);
		$query->execute();
		$result = null;

		if ($query->rowCount() > 0) {
			$result = $query->fetch();
		} else {
			$result = null;
		}

		$connection = disconn($connection);

		return $result;
	}

	function loginc ($usuario, $contrasena) {
		$connection = conn();

		$sql= "SELECT * from tb_cliente WHERE codigo = '$usuario' AND csenha = '$contrasena'";
		$query= $connection->prepare($sql);
		$query->execute();
		$result = null;

		if ($query->rowCount() > 0) {
			$result = $query->fetch();
		} else {
			$result = null;
		}

		$connection = disconn($connection);

		return $result;
	}
?>