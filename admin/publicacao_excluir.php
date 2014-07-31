<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
	header('Access-Control-Allow-Origin: *');
	
	$retorno = mysql_query("DELETE FROM publicacao WHERE idpublicacao = $id ") or die(mysql_error());
	
	mysql_close();
	echo json_encode(array('status' => 1));	

   	
?>   





