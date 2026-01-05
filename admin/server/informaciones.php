<?php 
	include_once "conn.php";
	// include_once "./objs/funcoes.php";

	function getInformaciones () {
		$connection = conn();
		$sql = "SELECT * FROM tb_informaciones";
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

	function saveInfo ($whatsapp, $facebook, $instagram, $email, $titulo_pagina, $conteudo_pagina, $horario_lunesviernes, $horario_sabado) {
		$connection = conn();
		try {
			$sql = "SELECT * from tb_informaciones WHERE codigo = 1";
			$query = $connection->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				$sql = "UPDATE tb_informaciones SET whatsapp = '$whatsapp', facebook = '$facebook', instagram = '$instagram', email = '$email', titulo_pagina = '$titulo_pagina', conteudo_pagina = '$conteudo_pagina', horario_lunesviernes = '$horario_lunesviernes', horario_sabado = '$horario_sabado'
	 					WHERE codigo = 1";
				$query = $connection->prepare($sql);
				$query->execute();

				if ($query->rowCount() > 0) {
					$result = 1;
				} else {
					$result = 1; //Sem alteração
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