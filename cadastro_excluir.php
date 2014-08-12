<?php
	include "config.php";
	include "conexao.php";
	header('Access-Control-Allow-Origin: *');
	
	$tabela 	= str_replace(".EcM.", '&', $tabela);
	$tabela 	= str_replace(".EcMS.", '+', $tabela);
	
	$tabela = descriptografar($tabela);
	
	$sql = "DELETE FROM $tabela WHERE $filtro";
	$retorno = mysql_query($sql) or die(mysql_error());
	mysql_close();
	
	echo json_encode(array('status' => 1));	
?>   





