<?php 
	include_once "conn.php";

	function getAllVisists () {
		$connection = conn();
		$sql = "SELECT * FROM tb_visitas ORDER BY tabla ASC";
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
    
    function getUniqueVisist ($tabla) {
		$connection = conn();
		$sql = "SELECT SUM(unique_hits) AS unique_hits FROM tb_visitas WHERE tabla = '$tabla' GROUP BY tabla ORDER BY tabla ASC";
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

	function getMasVistosCat () {
		$connection = conn();
		$sql = "SELECT tb_visitas.unique_hits, tb_visitas.total_hits, tb_categoria.nombre AS categoria FROM tb_visitas 
		LEFT JOIN tb_categoria ON tb_visitas.cod_ref = tb_categoria.codigo
		WHERE tb_visitas.tabla = 'catalogo.php' ORDER BY unique_hits DESC LIMIT 5";
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

	function getMasVistos () {
		$connection = conn();
		$sql = "SELECT tb_visitas.unique_hits, tb_visitas.total_hits, tb_producto.nombre AS producto FROM tb_visitas 
		LEFT JOIN tb_producto ON tb_visitas.cod_ref = tb_producto.codigo
		WHERE tb_visitas.tabla = 'producto.php' ORDER BY unique_hits DESC LIMIT 5";
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

	function getMasPreguntados () {
		$connection = conn();
		$sql = "SELECT tb_visitas.unique_hits, tb_visitas.total_hits,  tb_producto.nombre AS producto FROM tb_visitas 
		LEFT JOIN tb_producto ON tb_visitas.cod_ref = tb_producto.codigo
		WHERE tb_visitas.tabla = 'ventas' ORDER BY unique_hits DESC LIMIT 5";
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

	function visit ($tabla, $ref) {
		$connection = conn();
		
		try {
            $withref = "";
            if ($ref != null) {
                $withref = "AND cod_ref = '$ref'";    
            } else {
                $withref = "";
            }
            $sql = "SELECT * from tb_visitas WHERE tabla = '$tabla'".$withref;
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
                $result= $query->fetch();
                $total = $result['total_hits'] + 1;
                $unique = $result['unique_hits'];
                if (isNewVisitor($tabla, $ref)) {
                    $unique = $unique + 1;
                }
				$sql = "UPDATE tb_visitas SET total_hits = $total, unique_hits = $unique
	 					WHERE tabla = '$tabla'".$withref;
				$query = $connection->prepare($sql);
				$query->execute();
			} else {
                $withref = "";
                $withref2 = "";
                if ($ref != null) {
                    $withref = ", cod_ref";   
                    $withref2 = ", '$ref'"; 
                } else {
                    $withref = "";
                    $withref2 = "";
                }
                $sql = "INSERT INTO tb_visitas (tabla, total_hits, unique_hits".$withref.") VALUES ('$tabla', 1, 1".$withref2.")";
                $query = $connection->prepare($sql);
                $query->execute();
                isNewVisitor($tabla, $ref); //registra a visita
			}			
		} catch (\Exception $e) {
			$result = $e;
		}
		$connection = disconn($connection);
		// return $result;
    }
    
    function isNewVisitor ($tabla, $ref) {
        $visited = array_key_exists('visited'.$tabla.$ref, $_SESSION);
        if ($visited == false) {
            $_SESSION['visited'.$tabla.$ref] = true;
        }
        return !$visited;
    }
?>