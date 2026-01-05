<?php 
	//Cerrar Session
	session_start();
	session_destroy();
	
	$connection = null;
	header('location: login.php');
?>