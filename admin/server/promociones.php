<?php 
	include_once "conn.php";

	function getAllPromociones () {
		$connection = conn();
		$sql = "SELECT tb_promocion.*, prod.ctd AS productos
		FROM tb_promocion 
		LEFT JOIN (SELECT COUNT(tb_promo_producto.codigo) AS ctd, tb_promo_producto.cod_promocion AS promocion FROM tb_promo_producto LEFT JOIN tb_promocion ON tb_promocion.codigo = tb_promo_producto.cod_promocion GROUP BY tb_promo_producto.cod_promocion) AS prod
		ON tb_promocion.codigo = prod.promocion ORDER BY tb_promocion.activo ASC, tb_promocion.orden ASC";
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

    function getPromociones () {
		$connection = conn();
		$sql = "SELECT * FROM tb_promocion WHERE activo = 1 ORDER BY orden ASC";
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

    function getPromoLastOrder () {
		$connection = conn();
		$sql = "SELECT MAX(orden) as orden FROM tb_promocion";
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

	function getPromocion ($codigo) {
		$connection = conn();
		$sql = "SELECT * FROM tb_promocion WHERE codigo = $codigo  ORDER BY orden ASC";
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

	function newPromo ($titulo, $orden, $imgfondo, $imgpromo, $activo) {
		$connection = conn();
		try {
			$sql = "INSERT INTO tb_promocion (titulo, orden, img_fondo, img, activo)
		 			VALUES ('$titulo', $orden, '$imgfondo', '$imgpromo', $activo)";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$result = $connection->lastInsertId();
			} else {
				$result = null;
			}
		} catch (\Exception $e) {
			$result = $e;
		}

		$connection = disconn($connection);
		return $result;
	}

	function promoFondo ($codigo, $imgfondo) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_promocion WHERE codigo = $codigo";
			$query = $connection->prepare($sql);
			$query->execute();

			$promo = $query->fetch();

			//cambio de imagen
			if ($promo['img_fondo'] != $imgfondo && $promo['img_fondo'] != "no-fondo-promo.png") {
				unlink("img/promociones/".$promo['img_fondo']); //apaga imagen anterior
			}

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_promocion SET img_fondo = '$imgfondo'
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

	function promoImg ($codigo, $imgpromo) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_promocion WHERE codigo = $codigo";
			$query = $connection->prepare($sql);
			$query->execute();

			$promo = $query->fetch();

			//cambio de imagen
			if ($promo['img'] != $imgpromo && $promo['img'] != "no-promo.png") {
				unlink("img/promociones/".$promo['img']); //apaga imagen anterior
			}

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_promocion SET img = '$imgpromo'
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

	function savePromo ($codigo, $titulo, $orden, $activo) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_promocion WHERE codigo = $codigo";
			$query = $connection->prepare($sql);
			$query->execute();

			//actualiza las imagenes
			// promoImg ($codigo, $imgpromo);
			// promoFondo ($codigo, $imgfondo);

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_promocion SET titulo = '$titulo', orden = $orden, activo = $activo
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

	function deletePromo ($codigo) {
		$connection = conn();
		try {			
			$sql = "DELETE FROM tb_promo_producto WHERE cod_promocion = '$codigo'";
			$query = $connection->prepare($sql);
			$query->execute();

			$sql = "DELETE FROM tb_promocion WHERE codigo = '$codigo'";
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

	function getProds($codigo){
		$connection = conn();
		$sql = "SELECT tb_promo_producto.*, prod.nombre AS producto, prod.precio AS prod_precio, prod.ctd_cuota AS prod_cuota, prod.valor_cuota AS prod_valor
		FROM tb_promo_producto
		LEFT JOIN tb_producto AS prod ON tb_promo_producto.cod_producto = prod.codigo
		WHERE tb_promo_producto.cod_promocion = '$codigo'";
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

	function getProdsPromo($codigo){
		$connection = conn();
		$sql = "SELECT tb_promo_producto.precio, tb_promo_producto.cuota AS ctd_cuota, tb_promo_producto.valor AS valor_cuota, img.img AS img, prod.codigo AS codigo, prod.nombre AS nombre, prod.precio AS prod_precio, prod.ctd_cuota AS prod_cuota, prod.valor_cuota AS prod_valor
		FROM tb_promo_producto
		LEFT JOIN tb_producto AS prod ON tb_promo_producto.cod_producto = prod.codigo
		LEFT JOIN (SELECT tb_image.cod_producto as cod_producto, tb_image.url as img, tb_image.orden as orden FROM tb_image LIMIT 1) AS img ON tb_promo_producto.cod_producto = img.cod_producto 
		WHERE tb_promo_producto.cod_promocion = '$codigo'";
		$query = $connection->prepare($sql);
		$query->execute();

		$sql = "SELECT tb_producto.*, tb_image.url as img, tb_image.orden as orden ";
		
		if ($query->rowCount() > 0) {
			$result= $query->fetchAll();
		} else {
			$result = null;
		}

		$connection = disconn($connection);
		return $result;
	}

	function getProdPromo($codigo){
		$connection = conn();
		$sql = "SELECT tb_promo_producto.precio, tb_promo_producto.cuota AS ctd_cuota, tb_promo_producto.valor AS valor_cuota, img.img AS img, prod.codigo AS codigo, prod.nombre AS nombre, prod.precio AS prod_precio, prod.ctd_cuota AS prod_cuota, prod.valor_cuota AS prod_valor
		FROM tb_promo_producto
		WHERE tb_promo_producto.cod_producto = '$codigo'";
		$query = $connection->prepare($sql);
		$query->execute();

		$sql = "SELECT tb_producto.*, tb_image.url as img, tb_image.orden as orden ";
		
		if ($query->rowCount() > 0) {
			$result= $query->fetch();
		} else {
			$result = null;
		}

		$connection = disconn($connection);
		return $result;
	}

	function newProdPromo ($promo, $producto) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_producto WHERE codigo = '$producto'";
			$query = $connection->prepare($sql);
			$query->execute();
			
			if ($query->rowCount() > 0) {
				$sql = "INSERT INTO tb_promo_producto (cod_promocion, cod_producto)
				VALUES ('$promo', '$producto')";
				$query = $connection->prepare($sql);
				$query->execute();

				if ($query->rowCount() > 0) {
					$result = $producto;
				} else {
					$result = null;
				}
			} else {
				$result = "Erro! No se encontró ningún registro con el código: '".$producto."'";
			}	
		} catch (\Exception $e) {
			$result = $e;
		}

		$connection = disconn($connection);
		return $result;
	}

	function saveProdPromo ($promocion, $producto, $precio, $cuota, $valor) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_promo_producto WHERE cod_promocion = '$promocion' AND cod_producto = '$producto'";
			$query = $connection->prepare($sql);
			$query->execute();

			$codigo = $query->fetch();
			$codigo = $codigo['codigo'];

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_promo_producto SET precio = precio, cuota = $cuota, valor = $valor
	 					WHERE codigo = $codigo";
				$query = $connection->prepare($sql);
				$query->execute();

				if ($query->rowCount() > 0) {
					$result = $producto;
				} else {
					$result = $producto; //Sem alteração
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

	function deleteProdPromo ($promocion, $producto) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_promo_producto WHERE cod_promocion = '$promocion' AND cod_producto = '$producto'";
			$query = $connection->prepare($sql);
			$query->execute();

			$codigo = $query->fetch();
			$codigo = $codigo['codigo'];

			if ($query->rowCount() > 0) {
				$sql = "DELETE FROM tb_promo_producto WHERE codigo = '$codigo'";
				$query = $connection->prepare($sql);
				$query->execute();

				if ($query->rowCount() > 0) {
					$result = $producto;
				} else {
					$result = $producto; //Sem alteração
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
?>