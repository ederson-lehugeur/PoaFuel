<!DOCTYPE html>
<?php  
	// Verifica se há um usuario logado.
	session_start();
	unset($_SESSION['email']);
	unset($_SESSION['password']);
?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="../css/loginStyle.css">
</head>
<body>
	<div id="logo">
	</div>
	<div id="formulario">
		<div id="header">
			<h1>Faça seu login</h1>
		</div>

		<div id="conteudo">
			<form name="formulario-login" method="post" action="verificaLogin.php">
				<br><br>
				<input class="w3-input w3-border" type="email" name="email" placeholder="E-mail">
				<input class="w3-input w3-border" type="password" name="password" placeholder="Senha"><br>
				<input class="botao" type="submit" value="Entrar">
				<input class="botao" type="reset" value="Limpar">
			</form>
		</div>
			<div id="footer">
				<p>Ainda não possui cadastro? Cadastre-se <a href="cadastro.php">aqui</a>.</p>
			</div>
	</div>
</body>
</html>