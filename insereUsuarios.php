<?php  
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "postos";

	$connect = mysqli_connect($host,$user,$password,$database);

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$cpf = $_POST['cpf'];

	$sql = "insert into usuarios (nome,sobrenome,email,senha,cpf) values ('$nome','$sobrenome','$email','$senha','$cpf')";
	
	$salvar = mysqli_query($connect,$sql);

	$linhas = mysqli_affected_rows($connect);

	if($linhas > 0)
	{
		echo "Cadastro realizado com sucesso.";
		header("refresh:2; url=login.php");
	}
	else
	{
		echo "Cadastro não realizado. Email ou CPF já estão em uso.";
		header("refresh: 2; url=cadastro.php");
	}


	mysqli_close($connect);
?>