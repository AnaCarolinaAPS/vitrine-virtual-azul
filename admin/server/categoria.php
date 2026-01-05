<?php 
	include_once "conn.php";
	// include_once "./objs/funcoes.php";

	function getAllCategorias () {
		$connection = conn();
		$sql = "SELECT a.*, b.nombre as padre FROM tb_categoria a LEFT JOIN tb_categoria b ON b.codigo = a.cod_padre ORDER BY padre ASC, a.nombre ASC";
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

	function getCategorias () {
		$connection = conn();
		$sql = "SELECT * FROM tb_categoria WHERE tb_categoria.cod_padre IS NULL ORDER BY nombre ASC";
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

	function getCategoriasActivas () {
		$connection = conn();
		$sql = "SELECT * FROM tb_categoria WHERE activo = 1 ORDER BY nombre ASC";
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

	function getMenu () {
		$connection = conn();
		$sql = "SELECT * FROM tb_categoria WHERE activo = 1 AND menu = 1 AND cod_padre IS NULL ORDER BY nombre ASC";
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

	function getSubMenu ($categoria) {
		$connection = conn();
		$sql = "SELECT * FROM tb_categoria WHERE activo = 1 AND cod_padre = '$categoria' ORDER BY nombre ASC";
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

	function getPadre ($subcategoria) {
		$connection = conn();
		$sql = "SELECT cod_padre FROM tb_categoria WHERE codigo = '$subcategoria'";
		$query = $connection->prepare($sql);
		$query->execute();

		if ($query->rowCount() > 0) {
			$result= $query->fetch();
		} else {
			$result = null;
		}

		$connection = disconn($connection);
		return $result;
	}

	function getCategoria ($categoria) {
		$connection = conn();
		$sql = "SELECT a.*, b.nombre as padre FROM tb_categoria a LEFT JOIN tb_categoria b ON b.codigo = a.cod_padre WHERE a.codigo = '$categoria'";
		// $sql = "SELECT * FROM tb_categoria WHERE codigo = '$categoria'";
		$query = $connection->prepare($sql);
		$query->execute();

		if ($query->rowCount() > 0) {
			$result= $query->fetch();
		} else {
			$result = null;
		}

		$connection = disconn($connection);
		return $result;
	}


	function newCategoria ($nombre, $padre) {
		$connection = conn();
		try {
			$sql = "INSERT INTO tb_categoria (nombre, cod_padre, activo, menu)
		 			VALUES ('$nombre', $padre, 1, 1)";
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

	function saveCategoria ($codigo, $nombre, $padre, $menu, $activo) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_categoria WHERE codigo = $codigo";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_categoria SET nombre = '$nombre', cod_padre = $padre, activo = '$activo', menu = '$menu'
	 					WHERE codigo = $codigo";
				$query = $connection->prepare($sql);
				$query->execute();

				if ($padre == "NULL") { //Categoria
					if ($activo == 0) { //se desactivar hace falta desactivar las subcategorias
						$sql = "UPDATE tb_categoria SET activo = 0, menu = 0
	 			 		WHERE cod_padre = $codigo";
					}
				} else { //Subcategoria
					if ($activo == 1) { //se activar hace falta activar la categoría padre						
						if ($menu == 0) {
							$sql = "UPDATE tb_categoria SET activo = 1
							WHERE codigo = $padre";
						} else {  //si se activa el menu, también tiene que activarse el menu del padre
							$sql = "UPDATE tb_categoria SET activo = 1, menu = 1
							WHERE codigo = $padre";
						}
					}					
				}
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

	function deleteCategoria ($codigo) {
		$connection = conn();
		try {
			$sql = "SELECT cod_padre from tb_categoria WHERE cod_padre = '$codigo'";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_categoria SET activo = 0, menu = 0
	 					WHERE codigo = $codigo OR cod_padre = $codigo";
				$query = $connection->prepare($sql);
				$query->execute();
				return "inactivo";
			}

			$sql = "SELECT codigo from tb_producto WHERE cod_categoria = '$codigo'";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_categoria SET activo = 0, menu = 0
	 					WHERE codigo = $codigo OR cod_padre = $codigo";
				$query = $connection->prepare($sql);
				$query->execute();
				return "inactivo";
			}

			$sql = "DELETE FROM tb_categoria WHERE codigo = '$codigo'";
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