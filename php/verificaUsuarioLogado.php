<?php
	// Verifica se há um usuario logado.
	session_start();
	if((!isset($_SESSION['email'])) and (!isset($_SESSION['password']))) 
	{
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		header('location:php/login.php');
	}

	$logado = $_SESSION['email'];
?>