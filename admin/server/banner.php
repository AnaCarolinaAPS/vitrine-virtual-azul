<?php 
	include_once "conn.php";

	function getBanners () {
		$connection = conn();
		$sql = "SELECT tb_banner.* FROM tb_banner WHERE tb_banner.activo = 1 ORDER BY tb_banner.orden";
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

	function getAllBanners () {
		$connection = conn();
		$sql = "SELECT tb_banner.* FROM tb_banner ORDER BY tb_banner.orden";
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
	
	function getLastOrder () {
		$connection = conn();
		$sql = "SELECT MAX(orden) as orden FROM tb_banner";
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

	function newBanner ($img, $alternativo, $url, $orden, $activo) {
		$connection = conn();
		try {
			$sql = "INSERT INTO tb_banner (img, alternativo, url, orden, activo)
		 			VALUES ('$img', '$alternativo', '$url', $orden, $activo)";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$result = $img;//$connection->lastInsertId();
			} else {
				$result = null;
			}
		} catch (\Exception $e) {
			$result = $e;
		}

		$connection = disconn($connection);
		return $result;
	}

	function saveBanner ($codigo, $img, $alternativo, $url, $orden, $activo) {
		$connection = conn();
		
		try {
			$sql = "SELECT * from tb_banner WHERE codigo = $codigo";
			$query = $connection->prepare($sql);
			$query->execute();

			$banner = $query->fetch();

			//cambio de imagen
			if ($banner['img'] != $img && $banner['img'] != "no-banner.png") {
				unlink("img/banners/".$banner['img']); //apaga imagen anterior
			}

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_banner SET img = '$img', alternativo = '$alternativo', url = '$url', orden = $orden, activo = '$activo'
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

	function deleteBanner ($codigo) {
		$connection = conn();
		try {
			$sql = "SELECT * from tb_banner WHERE codigo = $codigo";
			$query = $connection->prepare($sql);
			$query->execute();
			$banner = $query->fetch();

			if ($banner['img'] != "no-banner.png") {
				if (!unlink("img/banners/".$banner['img'])) {  
					return $banner['img']." cannot be deleted due to an error";  
				}  
			}
			
			$sql = "DELETE FROM tb_banner WHERE codigo = '$codigo'";
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