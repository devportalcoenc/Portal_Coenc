<?php
	session_start();
	include "config.php";
	include "conexao.php";
	if (empty($_SESSION['logado'])) {
		$_SESSION['logado'] = 'não';
	}
	$logado = $_SESSION['logado'];
	if ($logado == 'sim') {
		echo "<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=main.php\">";
		die;
	}

	if (empty($_SESSION['idpessoa'])) {
		$_SESSION['idpessoa'] = 0;
	}
	$idpessoa = $_SESSION['idpessoa'];
?>

<!doctype html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Login - UTFPR</title>
	<link rel="stylesheet" href="css/login_styles.css">
	<link rel="shortcut icon" href="img/logo.png">
	<script type="text/javascript" src="js/obj_getxmlhttp.js"></script>
	<script type="text/javascript" src="js/md5.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="js/redefinicao_senha.js"></script>
</head>		
	<body class="metro" style="font-family: 'Helvetica Neue', Helvetica, sans-serif;font-size: 12px;">
		<?php include("cabecalho.php"); ?>
		<br><br><br><br>
		<h2 style="text-align: center">Login</h2>
		<div id="container">
			<form>
			  <input id="email" type="email" placeholder="Email" autofocus onkeypress="f_KeyLogin(event.keyCode)" style="margin-top: 25px">
			  <input id="senha" type="password"  placeholder="Senha" onkeypress="f_KeyLogin(event.keyCode)">
			 <input type="button" value="Login" style="width:88%; padding-left: 0px; margin: 10px 19px 0px 0px" onclick="f_Logar()">		  
			  <div style="text-align:center;" id="divMsg"><label style="visibility: hidden; text-align: center; position: absolute; margin-top: 35px; width:328px" id="msg"> </label></div>
			  <div style="visibility: hidden" id="divCarregando">
			    <img src="img/black.png" class="blackImg">
			    <img src="img/carregando.gif" class="imgCarregando" >
			  </div>
			   <div style="width: 94%" align="right"><a  style="position: absolute; margin-top: 70px; margin-left: 200px;" href="#" onclick="f_RecuperarSenha()">Recuperar senha</a></div>
			</form>		
		</div>
	</body>
</html>
	
	
	
	
	
		
	