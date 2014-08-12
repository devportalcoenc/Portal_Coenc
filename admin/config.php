<?php
 include_once "log/log.php";
// pega as colunas e resultados da query e devolve um Json
function queryToJson($sql, $conexao) {
	$retorno = mysql_query($sql,$conexao) or die(error());
	$linhas  = array();
	if($retorno) {
		while ($row = mysql_fetch_object($retorno)) { // passa por cada registro	
			$linhas[sizeof($linhas)] = $row; // Adiciona ao array de objetos
		}
	}
	return json_encode($linhas); 
}

// função que recebe um array de colunas e dados, pode ser uma inserção ou atualização(os atributos do objeto tem que conferir com as colunas)
function atualizarRegistros($tabela, $colunas, $dados, $conexao){
	// concatena os dados 
	for ($x=0; $x<sizeof($dados);$x++){
		$campos = [];
		$updt   = [];
		for ($i=0; $i<sizeof($dados[$x]);$i++){ 
			$valor = $dados[$x][$i];
			array_push($campos, "'$valor'");
			array_push($updt, $colunas[$i]."='$valor'");
			
		}
		// prepara o comando 
		$d	 = implode(',', $campos); // dados do insert
		$u	 = implode(',', $updt); // sintaxe do udpdate
		$c	 = implode(',', $colunas);// colunas do insert
		
		$cmd = "INSERT INTO $tabela($c) VALUES ($d) ON DUPLICATE KEY UPDATE $u";
		$query = mysql_query($cmd) or die(mysql_error());
	}

}

// Formata os dados que vieram por argumento
function formatarParam($p){
	// Troca as aspas por ´
	$p = str_replace("%27", "''", $p);
	$p = str_replace("'", "''", $p);
	return $p;
}

// recupera um valor da sessão 
function sessao($variavel){
	return $_SESSION[$variavel];
}

// verifica se o usuário logado tem permissao para acessar determinada pagina
function permissaoPagina($pagina, $redirecionar){
	// por enquanto irá validar somente se é root 
    if (sessao('tipo')==1){
		return true;
    }else{
	    if ($redirecionar){
			echo "<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=main.php\">";
			die;
		}
		return false;
	}	
}
// Formata os parametros de GET
$parms = $_SERVER['QUERY_STRING'];
if (!empty($parms)){
	$parms = formatarParam($parms);	
	// Transforma os argumentos em variáveis
	parse_str($parms);
}
// Formata os parametros do POST
foreach ($_POST as $key => $val) {
    // transforma em variavel
	parse_str($key."=".formatarParam($val));
}

// função auxiliar de criptografia
$chave ='Xdb4io/WGoG45123';
function criptografar($text)
{
    global $chave;
	return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $chave, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
}
function descriptografar($text)
{
	global $chave;
	return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $chave, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
}
?>
