<?php
	function putMySQlToData($mysqldata) {
		$data = "";
		$data = substr($mysqldata, 8,2)."/".substr($mysqldata, 5,2)."/".substr($mysqldata, 0,4);
		return $data;
	}

	function putDataToMySQl($data) {
		$mysqldata = "";
		$mysqldata = substr($data, 6,4)."-".substr($data, 3,2)."-".substr($data, 0,2);
		return $mysqldata;
	}

	function getMesporEscrito($data) {
		$mes = "";
		$data = substr($data, 5,2);//mês de uma data de visualização
		if ($data == "01") {
			$mes = "Janeiro";
		} else if ($data == "02") {
			$mes = "Fevereiro";
		} else if ($data == "03") {
			$mes = "Março";
		} else if ($data == "04") {
			$mes = "Abril";
		} else if ($data == "05") {
			$mes = "Maio";
		} else if ($data == "06") {
			$mes = "Julho";
		} else if ($data == "07") {
			$mes = "Junho";
		} else if ($data == "08") {
			$mes = "Agosto";
		} else if ($data == "09") {
			$mes = "Setembro";
		} else if ($data == "10") {
			$mes = "Outubro";
		} else if ($data == "11") {
			$mes = "Novembro";
		} else if ($data == "12") {
			$mes = "Dezembro";
		} 
		return $mes;
	}

	function getPorcentagem($menor, $maior) {
		$aumento = $maior - $menor;
		$percentual = $aumento/$maior;
		$percentual = $percentual * 100;

		return number_format((float)$percentual, 2, '.', '');
	}

	function putMoneda($valor, $tipo) {
		if ($tipo == "U$") {
			$moeda = "U$ ".number_format($valor, 2, ',', '.');
		} else if ($tipo == "R$") {
			$moeda = "R$ ".number_format($valor, 2, ',', '.');
		} else if ($tipo == "G$") {
			$moeda = "G$ ".number_format($valor, 0, '', '.');
		}
		return $moeda;
	}

	function uploadImage () {
		$target_dir = "../img/producto/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

		if ($check !== true) {
			return "File is not an image.";
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			return "Sorry, file already exists.";
		}

		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			return "Sorry, your file is too large.";
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		}

		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	}
?>