<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
	header('Access-Control-Allow-Origin: *');

	// tratamento dos caracteries especiais
	$texto 	= str_replace(".EcM.", '&', $texto);
	$texto 	= str_replace(".EcMS.", '+', $texto);
	
	$idpessoa = sessao('idpessoa');
	
	if ($id=='0'){
		$id='null';
	}
	$sql = "INSERT INTO publicacao(idpublicacao, titulo, corpo_formatado, flagvisivel, idpessoa, idcategoria) values ($id, '$titulo', '$texto', '$flagvisivel', '$idpessoa', $idcategoria)
			ON DUPLICATE KEY UPDATE titulo='$titulo', corpo_formatado='$texto', flagvisivel='$flagvisivel', idcategoria=$idcategoria; ";

	
	// inclui a pessoa no banco de dados
	$retorno = mysql_query($sql) or die(mysql_error());
	
	// recupera o id da publicacao que foi inserida
	$idpub = mysql_insert_id();
	if ($idpub==0){
		$idpub = $id;
	}
	
	mysql_close();
	echo json_encode(array('status' => 1, 'id' => $idpub));	

   	
?>   





