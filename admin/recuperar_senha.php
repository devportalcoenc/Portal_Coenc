<?php
	include_once "config.php";
	include_once "conexao.php";
	
	$msg = "";
	// Este arquivo pode ser chamado por requisicao ou ser incluido por include
	if (empty($incluido)){
		$incluido = false;
	}
	
	if (!$incluido){
		header('Access-Control-Allow-Origin: *');
	}
	
	if (!empty($email)) {
		$sql = "select idpessoa from pessoa where email='$email'";
		f_log("Recuperar senha : $email");
		
		$retorno = mysql_query($sql,$conexao) or die(error());
		$id = 0;
		while ($linha=mysql_fetch_array($retorno)) {
			$id = $linha["idpessoa"];
		}
			
		if($id==0) {
			$msg = "Email não cadastrado";
		} else {
			
			$sql_requisicao = "insert into requisicao (idpessoa,ativo,msg) values ($id,'T','Redefinir senha.')";
			$retorno = mysql_query($sql_requisicao,$conexao) or die(error());
			$id = mysql_insert_id();
			if (empty($aviso)){
				$mensagem = 'Nossa política de segurança não permite o envio de senha por email, sendo assim segue link para redefinição de senha. Favor acessar o link abaixo e definir uma nova senha.' ;
			} else{
				$mensagem = $aviso;
			}
			$mensagem = '<html>
			<head><meta http-equiv="Content-type" content="text/html; charset=utf-8"></head>
			<body>'.$mensagem.'<br><br> <a href="'.$dominio.'/redefinir_senha.php?token='.urlencode(criptografar($id)).'">Redefinir senha.</a> <br><br><br>Equipe Appipoka.
			</body>
			</html>';			
			
			include("enviar_email.php");
			enviar_email($email,'Agenda - Redefinir senha',$mensagem);
		}

	} else {
		$msg = 'Email não informado';
	}
    // se foi um include não irá fechar a transação
	if (!$incluido){
		mysql_close();	
		if ($msg==""){
			echo json_encode(array('status' => 1));	
		}	else{
			echo json_encode(array('status' => -1, 'msg' => $msg));
		}
   	}
	
?>



