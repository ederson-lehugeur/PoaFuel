<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "postos";

	$connect = mysqli_connect($host,$user,$password,$database);


	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$sql = "select * from usuarios where email = '$email' and senha = '$senha'";

	$salvar = mysqli_query($connect, $sql);

	$row = mysqli_num_rows($salvar);

	if($row > 0)
	{
		header("Location: index.php");
	}
	else
	{
		echo "Email ou Senha informados inválidos.";
		header("refresh: 2; url=login.php");
	}
?>