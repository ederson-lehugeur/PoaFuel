<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="../css/cadastroStyle.css">
</head>
<body>
	<div id="logo"></div>

	<div id="formulario">
		<div id="header">
			<h1>Formulário de Cadastro de Usuário</h1>
		</div>

		<div id="conteudo">
			<form method="post" action="insereUsuarios.php">
			<br><br>
				<input class="w3-input w3-border" type="text" name="name" maxlength="30" require autofocus placeholder="Nome">
				<input class="w3-input w3-border" type="text" name="last_name" maxlength="50" required placeholder="Sobrenome">
				<input class="w3-input w3-border" type="email" name="email" maxlength="50" required placeholder="E-mail">
				<input class="w3-input w3-border" type="password" name="password" maxlength="64" required placeholder="Senha">
				<input class="w3-input w3-border" type="text" name="cpf" maxlength="11" required placeholder="CPF">
			<br>
				<input class="botao" type="submit" value="Salvar">
				<input class="botao" type="reset" value="Limpar">
			</form>
		</div>

		<div id="footer">
			<p>Já possui cadastro? Faça login <a href="login.php">aqui</a>.</p>
		</dir>
	</div>
</body>
</html>