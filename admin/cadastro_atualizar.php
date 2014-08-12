<?php
	include "config.php";
	include "conexao.php";
	header('Access-Control-Allow-Origin: *');
	
    // coloca as colunas e os campos em arrays
	$col  = explode("|", $col);
	$dado = explode("|", $dado);
	$pks  = explode(",", $pks);
	$valpk= explode(",", $valpk);
	
    $cmd = "";
	
	// tratamento dos caracteries especiais
	$tabela 	= str_replace(".EcM.", '&', $tabela);
	$tabela 	= str_replace(".EcMS.", '+', $tabela);
	
	$validacao 	= str_replace(".EcM.", '&', $validacao);
	$validacao 	= str_replace(".EcMS.", '+', $validacao);
	
	$tabela     = descriptografar($tabela);
	$validacao  = descriptografar($validacao);
	
	// substitui os valores no sql de validacao
	for ($i=0; $i<sizeof($col); $i++){
		$validacao = str_replace('$'.$col[$i], $dado[$i], $validacao);
	}
	
	// substitui os valores das pks (caso utilizadas) no sql de validacao 
	for ($i=0; $i<sizeof($valpk); $i++){
		$validacao = str_replace('$valpk'.$i, $valpk[$i], $validacao);
	}
	
	
	// separa o sql da mensagem 
	$valida = explode("|", $validacao);
	
	$t = sizeof($valida);
	// irá fazer a validacao
	if (sizeof($valida)>1){
		$sql = $valida[0];
		//echo "SQL -> ".$sql;
		//die;
		$ret = queryToJson($sql, $conexao);
		// Se o sql retornar algo significa que não passou na validacao
		if ($ret!="[]"){
			echo json_encode(array('status' => -1, 'msg' => $valida[1]));
			die;			
		}
	}
	
	// é uma atualização	
	if ($tipo==1){	
	    $where = [];
		// prepara o where das pks 
		for ($i=0; $i<sizeof($pks); $i++){
			array_push($where," $pks[$i]='$valpk[$i]' ");
			
		}
		// prepara a sintaxe do updade
		for ($i=0; $i<sizeof($col); $i++){
			$cmd = "$cmd$col[$i]='$dado[$i]',";
		}
		$cmd = substr($cmd, 0, -1);
		$where = implode('AND', $where);
		$sql = "UPDATE $tabela SET $cmd WHERE ".$where;
    }else{ // monta o insert
	    $i=0;
		$c=''; // colunas concatenadas
		$d=''; // dados concatenados 
		$ini=1;
		if (sizeof($pks)>1){
			$ini = 0;
		}
		// cocantena as colunas e os dados
		for ($i=$ini; $i<sizeof($dado); $i++){
			$c = "$c $col[$i],";
			$d = "$d '$dado[$i]',";			
		}
		$c = substr($c, 0, -1);
		$d = substr($d, 0, -1);
		
		$sql = "INSERT INTO $tabela ($c) VALUES ($d)";
	}
	
	//echo $sql;
	$retorno = mysql_query($sql) or die(mysql_error());
	
	// recupera o id inserido(em caso de insert)
	$idInsert = mysql_insert_id();
	
	mysql_close();
	
	echo json_encode(array('status' => 1, 'id' => $idInsert, 'pk'=> $newpk));	
?>   





