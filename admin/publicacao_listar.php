<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
	
	$idusuario = sessao('idpessoa');
	
	// recupera a lista de publicações do usuário
	$sql = "SELECT idpublicacao, titulo, dtpublicacao, pc.descricao as categoria FROM publicacao p, categoria_publicacao pc WHERE pc.idcategoria = p.idcategoria AND upper(titulo) like upper('%$busca%') AND idpessoa = $idusuario";

	$json = queryToJson($sql, $conexao);
	
    echo $json;
?>         
