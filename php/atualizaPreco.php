<?php  
	include("conexao.php");
	
	$mySQL = new MySql();
	$new_price = $_POST['valorAlterado'];
	$name = $_POST['selecionaMarker'];
	
	$mySQL->connect();
	$mySQL->executeQuery("SELECT price FROM marker WHERE name='$name'");
	$fetch = mysql_fetch_row($mySQL->getResult());
	$old_price = $fetch[0];
	
	if ($old_price != $new_price) {
		$mySQL->executeQuery("UPDATE marker SET price='$new_price' WHERE name='$name'");

		if (mysql_affected_rows() > 0) {
			echo "Preço atualizado com sucesso.";
			header("refresh: 2; url=../index.php");
		}
		else {
			echo "Erro ao atualizar o preço. Por favor tente novamente.";
			header("refresh: 2; url=../index.php");
		}
	}
	else {
		echo "Preço não atualizado. Atualize com um preço diferente!";
			header("refresh: 2; url=../index.php");
	}
	$mySQL->disconnect();
?>