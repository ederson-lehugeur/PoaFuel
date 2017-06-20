<?php  
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "postos";

	$connect = mysqli_connect($host,$user,$password,$database);

	$valor = $_POST['valorAlterado'];
	$name = $_POST['selecionaMarker'];

	$sql = "UPDATE markers SET price='$valor' WHERE name='$name'";
	
	$salvar = mysqli_query($connect,$sql);

	$linhas = mysqli_affected_rows($connect);

	if($linhas > 0)
	{
		echo "Preço atualizado com sucesso.";
		header("refresh:2; url=index.php");
	}
	else
	{
		echo "Erro ao atualizar o preço.Favor tente novamente.";
		header("refresh: 2; url=index.php");
	}


	mysqli_close($connect);
?>