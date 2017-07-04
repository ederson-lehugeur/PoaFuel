<?php  
	include("conexao.php");
	
	$mySQL = new MySql();
	$name = $_POST['name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpf = $_POST['cpf'];
	
	$mySQL->connect();
	$mySQL->executeQuery("INSERT INTO user(name, last_name, email, password, cpf) VALUES('$name', '$last_name', '$email', '$password', '$cpf')");
	
	if (mysql_affected_rows() > 0) {
		echo "Cadastro realizado com sucesso.";
		header("refresh:2; url=login.php");
	}
	else {
		echo "Cadastro não realizado. Email ou CPF já estão em uso.";
		header("refresh: 2; url=cadastro.php");
	}	
	$mySQL->disconnect();
?>