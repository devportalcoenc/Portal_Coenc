<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
    
	
	// tratamento dos caracteries especiais
	$filtro 	= str_replace(".EcM.", '&', $filtro);
	$filtro 	= str_replace(".EcMS.", '+', $filtro);

	$tabela 	= str_replace(".EcM.", '&', $tabela);
	$tabela 	= str_replace(".EcMS.", '+', $tabela);
	
	$tabela = descriptografar($tabela);
	
	if (empty($tipo)){
		$filtro = descriptografar($filtro);
		// substitui a chave de busca no filtro 
		$filtro = str_replace('chaveBusca', $busca, $filtro);
	}
//	echo $filtro;
	$sql = "SELECT * FROM $tabela WHERE $filtro";
	
   // echo $sql;
	$json = queryToJson($sql, $conexao);
	
    echo $json;
?>         
