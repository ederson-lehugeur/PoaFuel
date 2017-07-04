<?php
	session_start();
	include("conexao.php");
	
	$mySQL = new MySql();
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$mySQL->connect();
	$mySQL->executeQuery("SELECT * FROM user WHERE email='$email' AND password='$password'");
	$mySQL->disconnect();
	
	if(mysql_num_rows($mySQL->getResult()) > 0) {
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		header("Location: ../index.php");
	}
	else {
		unset ($_SESSION['email']);
		unset ($_SESSION['password']);
		echo "Email ou senha informados inválidos.";
		header("refresh: 2; url=login.php");
	}
?>