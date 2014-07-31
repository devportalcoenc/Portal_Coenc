<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
	
	$idusuario = sessao('idpessoa');
	
	// recupera a lista de publicações do usuário
	$sql = "SELECT idpublicacao, titulo, dtpublicacao FROM publicacao WHERE upper(titulo) like upper('%$busca%') AND idpessoa = $idusuario";

	$json = queryToJson($sql, $conexao);
	
    echo $json;
?>         
