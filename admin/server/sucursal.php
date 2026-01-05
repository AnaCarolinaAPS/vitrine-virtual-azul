<?php 
	include_once "conn.php";

	function getAllSucursales () {
		$connection = conn();
		$sql = "SELECT * FROM tb_sucursales ORDER BY nombre ASC";
		$query = $connection->prepare($sql);
		$query->execute();

		if ($query->rowCount() > 0) {
			$result= $query->fetchAll();
		} else {
			$result = null;
		}

		$connection = disconn($connection);
		return $result;
	}

	function getSucursales () {
		$connection = conn();
		$sql = "SELECT * FROM tb_sucursales WHERE activo = 1 ORDER BY nombre ASC";
		$query = $connection->prepare($sql);
		$query->execute();

		if ($query->rowCount() > 0) {
			$result= $query->fetchAll();
		} else {
			$result = null;
		}

		$connection = disconn($connection);
		return $result;
	}

	function newSucursal ($nombre, $ubicacion, $ciudad, $celular, $telefono, $maps, $activo) {
		$connection = conn();
		try {
			$sql = "INSERT INTO tb_sucursales (nombre, ubicacion, ciudad, celular, telefono, maps, activo)
		 			VALUES ('$nombre', '$ubicacion', '$ciudad', '$celular', '$telefono', '$maps', $activo)";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$result = $nombre;//$connection->lastInsertId();
			} else {
				$result = null;
			}
		} catch (\Exception $e) {
			$result = $e;
		}

		$connection = disconn($connection);
		return $result;
	}

	function saveSucursal ($codigo, $nombre, $ubicacion, $ciudad, $celular, $telefono, $maps, $activo) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_sucursales WHERE codigo = $codigo";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_sucursales SET nombre = '$nombre', ubicacion = '$ubicacion', ciudad = '$ciudad', celular = '$celular', telefono = '$telefono', maps = '$maps', activo = $activo
	 					WHERE codigo = $codigo";
				$query = $connection->prepare($sql);
				$query->execute();

				if ($query->rowCount() > 0) {
					$result = $codigo;
				} else {
					$result = $codigo; //Sem alteração
				}
			} else {
				$result = null;
			}			
		} catch (\Exception $e) {
			$result = $e;
		}
		$connection = disconn($connection);
		return $result;
	}

	function deleteSucursal ($codigo) {
		$connection = conn();
		try {			
			$sql = "DELETE FROM tb_sucursales WHERE codigo = '$codigo'";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$result = $codigo;
			} else {
				$result = null;
			}
		} catch (\Exception $e) {
			$result = $e;
		}

		$connection = disconn($connection);
		return $result;
	}
?>