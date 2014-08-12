<?php
	session_start();
	include "config.php";
	include "conexao.php";
	
	header('Access-Control-Allow-Origin: *');
    
	$hoje = date("y") ."/". date("m") ."/". date("d");
	$maxTentativas = 5;
	$tentativas	   = 0;
	$idpessoa	   = 0;
	if (!empty($email)) {
		$sql = "select idpessoa,senha,ativo,idtipo, coalesce(tentativalogin,0) tentativalogin from pessoa p  where email = '$email'";
		$senhabase = "";
		$retorno = mysql_query($sql,$conexao) or die(error());
		if($retorno) {
			while ($linha=mysql_fetch_array($retorno)) {
				$idpessoa	= $linha["idpessoa"];
				$senhabase	= trim($linha["senha"]);
				$ativo 		= trim($linha["ativo"]);
				$tipo 		= $linha["idtipo"];
				$tentativas = $linha["tentativalogin"];
				
			}	
			
			if ($tentativas<=$maxTentativas) {
				//echo "base: $senhabase arg: $senha";
				if (($senhabase == $senha) and (!empty($senha))){
					if ($ativo=='T') {
						$_SESSION['logado'] = 'sim';
						$_SESSION['idpessoa'] = $idpessoa;
						$_SESSION['email'] = $email;
						$_SESSION['tipo']  = $tipo;
						
						$texto = "Logado"; // mensagem retornada para reload
						// Zera o número de tentativas 
						$query = mysql_query("UPDATE pessoa SET tentativalogin = 0 WHERE idpessoa=$idpessoa") or die(mysql_error());						
						escreve_retorno($idpessoa,$texto);
					}
					else {
						zera_var_globais();

						$texto = "Usuário inativo!"; // mensagem retornada para reload
						escreve_retorno(0,$texto);					
					}
				} 
				else {
					zera_var_globais();
					
					// Atualiza o contador de tentativas
					$query = mysql_query("UPDATE pessoa SET tentativalogin = coalesce(tentativalogin,0)+1 WHERE idpessoa=$idpessoa") or die(mysql_error());	
					if ($tentativas==$maxTentativas){
						$texto = "Nº de tentativas excedido! Verifique seu email.";
						escreve_retorno(0,$texto);
						// envia o email para redefinição de senha 
						$aviso 		= "O número máximo de tentativas de login foi excedido. Por motivos de segurança, para que você consiga acessar o painel é necessário redefinir a senha.";
						$incluido	= true;
						include "recuperar_senha.php";
					}else{ 
						$texto = "Login e/ou senha inválidos!";
						escreve_retorno(0,$texto);
					}					
				}
			}else{ 
				zera_var_globais();
				$texto = "Nº de tentativas excedido! Verifique seu email.";
				escreve_retorno(0,$texto);
			}
		}

	} else {
		$texto = 'email não informado para efetuar login.';
		escreve_retorno(0,$texto);
	}

	mysql_close();
// fim do corpo principal
/////////////////////////

function escreve_retorno($id,$texto) {
    global $email;
	f_log("Login -> $email Retorno-> $id - $texto");
	//echo $texto;
	echo trim(json_encode(array('id'=>$id, 'texto'=>$texto)));
}


function zera_var_globais() {
	// ao não se logar zera variaveis globais
	$_SESSION['logado'] = 'não';
	$_SESSION['idpessoa'] = 0;
}

?>

