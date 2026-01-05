<?php 
	include_once "conn.php";
	// include_once "./objs/funcoes.php";

	function getAllProductos () {
		$connection = conn();
		$sql = "SELECT tb_producto.*, tb_categoria.nombre AS categoria FROM tb_producto LEFT JOIN tb_categoria ON tb_producto.cod_categoria = tb_categoria.codigo ORDER BY codigo ASC";
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

	function getProdMenosEstoque () {
		$connection = conn();
		$sql = "SELECT tb_producto.nombre AS producto, tb_producto.estoque FROM tb_producto ORDER BY tb_producto.estoque ASC LIMIT 5";
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

	function getProductosBy ($by, $referencia) {
		$connection = conn();
		$sql = "SELECT tb_producto.codigo AS codigo, tb_producto.estoque, tb_producto.activo, tb_producto.nombre, tb_producto.descripcion, tb_producto.precio, tb_producto.ctd_cuota, tb_producto.valor_cuota, tb_categoria.codigo AS categoria, tb_categoria.activo AS catactivo, img.img, promo.promo_precio, promo.promo_cuota, promo.promo_valor
		FROM tb_producto 
		LEFT JOIN tb_categoria ON tb_producto.cod_categoria = tb_categoria.codigo
		LEFT JOIN (SELECT tb_image.url as img, tb_image.orden as orden, tb_image.cod_producto FROM tb_image WHERE tb_image.orden = 1) AS img
		ON tb_producto.codigo = img.cod_producto
		LEFT JOIN (SELECT tb_promo_producto.cod_promocion, tb_promo_producto.cod_producto, tb_promo_producto.precio AS promo_precio, tb_promo_producto.cuota AS promo_cuota, tb_promo_producto.valor AS promo_valor, tb_promocion.activo AS promoactiva FROM tb_promo_producto LEFT JOIN tb_promocion ON tb_promo_producto.cod_promocion = tb_promocion.codigo) AS promo
		ON tb_producto.codigo = promo.cod_producto WHERE ";

		switch ($by) {
			case "categoria":
				if ($referencia == "ALL") {
					$sql .= " tb_categoria.activo = 1";
				} else {
					$sql .= " ((tb_producto.cod_categoria = '$referencia' AND tb_categoria.activo = 1) OR tb_producto.cod_categoria IN (SELECT codigo FROM tb_categoria WHERE cod_padre = '$referencia'))";
				}
				break;
			case "destacados":
				$sql .= " tb_producto.destaque = 1";
				break;
			case "promocion":
				$sql .= " promo.cod_promocion = '$referencia'";
				break;
			case "search":
				$sql .= " tb_producto.nombre LIKE '%$referencia%'";
				break;
			case "producto":
				$sql .=  " tb_producto.codigo = '$referencia'";
				break;
			case "":
				$sql .=  " 1";
				break;
		}
		$sql .= " AND tb_producto.activo = 1 AND tb_producto.estoque > 0 ORDER BY codigo ASC";
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

	function getProductosActivos () {
		$connection = conn();
		$sql = "SELECT COUNT(tb_producto.codigo) AS productos_activos
		FROM tb_producto 
		LEFT JOIN tb_categoria ON tb_producto.cod_categoria = tb_categoria.codigo
		LEFT JOIN (SELECT tb_image.url as img, tb_image.orden as orden, tb_image.cod_producto FROM tb_image LIMIT 1) AS img
		ON tb_producto.codigo = img.cod_producto
		LEFT JOIN (SELECT tb_promo_producto.cod_promocion, tb_promo_producto.cod_producto, tb_promo_producto.precio AS promo_precio, tb_promo_producto.cuota AS promo_cuota, tb_promo_producto.valor AS promo_valor, tb_promocion.activo AS promoactiva FROM tb_promo_producto LEFT JOIN tb_promocion ON tb_promo_producto.cod_promocion = tb_promocion.codigo) AS promo
		ON tb_producto.codigo = promo.cod_producto WHERE tb_producto.activo = 1 AND tb_producto.estoque > 0";
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
	// function getProductosByCat ($categoria) {
	// 	$connection = conn();
	// 	$sql = "SELECT tb_producto.* WHERE tb_producto.activo = 1 AND tb_producto.cod_categoria = $categoria ORDER BY codigo ASC";
	// 	$query = $connection->prepare($sql);
	// 	$query->execute();

	// 	if ($query->rowCount() > 0) {
	// 		$result= $query->fetchAll();
	// 	} else {
	// 		$result = null;
	// 	}

	// 	$connection = disconn($connection);
	// 	return $result;
	// }

	function getProducto ($codigo) {
		$connection = conn();
		$sql = "SELECT tb_producto.*, tb_categoria.nombre AS categoria FROM tb_producto LEFT JOIN tb_categoria ON tb_producto.cod_categoria = tb_categoria.codigo WHERE tb_producto.codigo = '$codigo' AND tb_producto.activo = 1 AND tb_producto.estoque > 0";
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

	// function getDestacados () {
	// 	$connection = conn();
	// 	$sql = "SELECT tb_producto.*, tb_image.url as img, tb_image.orden as orden FROM tb_producto LEFT JOIN tb_image ON tb_image.cod_producto = tb_producto.codigo WHERE destaque = 1 AND tb_image.orden = 0 ORDER BY codigo ASC";
	// 	$query = $connection->prepare($sql);
	// 	$query->execute();

	// 	if ($query->rowCount() > 0) {
	// 		$result= $query->fetchAll();
	// 	} else {
	// 		$result = null;
	// 	}

	// 	$connection = disconn($connection);
	// 	return $result;
	// }

	function getProdbyCategoria ($categoria) {
		$connection = conn();
		if($categoria != 'ALL') {
			$sql = "SELECT tb_producto.*, tb_image.url as img, tb_image.orden as orden FROM tb_producto LEFT JOIN tb_image ON tb_image.cod_producto = tb_producto.codigo WHERE tb_producto.activo = 1 AND (tb_producto.cod_categoria = '$categoria' OR tb_producto.cod_categoria IN (SELECT codigo FROM tb_categoria WHERE cod_padre = '$categoria')) ORDER BY nombre ASC";
		} else {
			$sql = "SELECT tb_producto.*, tb_image.url as img, tb_image.orden as orden FROM tb_producto LEFT JOIN tb_image ON tb_image.cod_producto = tb_producto.codigo WHERE tb_producto.activo = 1 AND tb_producto.cod_categoria IN (SELECT codigo FROM tb_categoria WHERE tb_categoria.activo = 1) ORDER BY nombre ASC";
		}
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

	// function getProdbySearch ($busca) {
	// 	$connection = conn();
	// 	$sql = "SELECT tb_producto.*, tb_image.url as img, tb_image.orden as orden FROM tb_producto LEFT JOIN tb_image ON tb_image.cod_producto = tb_producto.codigo WHERE tb_producto.activo = 1 AND tb_producto.cod_categoria IN (SELECT codigo FROM tb_categoria WHERE activo = 1) AND tb_producto.nombre LIKE '%$busca%' ORDER BY codigo ASC";
	// 	$query = $connection->prepare($sql);
	// 	$query->execute();

	// 	if ($query->rowCount() > 0) {
	// 		$result= $query->fetchAll();
	// 	} else {
	// 		$result = null;
	// 	}

	// 	$connection = disconn($connection);
	// 	return $result;
	// }

	function newProducto ($codigo, $nombre, $descripcion, $estoque, $precio, $cuota, $valor, $cod_categoria, $destacado, $activo) {
		$connection = conn();
		
		try {
			$sql = "INSERT INTO tb_producto (codigo, nombre, descripcion, estoque, precio, ctd_cuota, valor_cuota, cod_categoria, activo, destaque)
		 			VALUES ($codigo, '$nombre', '$descripcion', $estoque, $precio, $cuota, $valor, $cod_categoria, $activo, $destacado)";
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

	function saveProducto ($codigo, $nombre, $descripcion, $estoque, $precio, $cuota, $valor, $cod_categoria, $destacado, $activo) {
		$connection = conn();
		try {
			$sql = "SELECT * from tb_producto WHERE codigo = '$codigo'";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_producto SET nombre = '$nombre', descripcion = '$descripcion', estoque = $estoque, precio = $precio, ctd_cuota = $cuota, valor_cuota = $valor, cod_categoria = $cod_categoria, activo = $activo, destaque = $destacado
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

	function deleteProducto ($codigo) {
		$connection = conn();
		try {
			$sql = "SELECT * from tb_image WHERE cod_producto = '$codigo'";
			$query = $connection->prepare($sql);
			$query->execute();
			$images = $query->fetchAll();

			//Apaga as imagens da pasta
			foreach ($images as $img) {
				if (!unlink("img/productos/".$img['url'])) {  
					return $img['url']." cannot be deleted due to an error";  
				} 
			}
			//Delete Imagenes
			$sql = "DELETE FROM tb_image WHERE cod_producto = '$codigo'";
			$query = $connection->prepare($sql);
			$query->execute();

			//Delete Producto
			$sql = "DELETE FROM tb_producto WHERE codigo = '$codigo'";
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