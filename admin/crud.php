<?php
 include "valida_sessao.php";
 include "config.php";
 include "conexao.php";
 // verifica se o usuário tem permissão para acessar a página
 permissaoPagina($permissao, true);

 // recebe os campos do cadastro e adiciona os títulos na tabela
 function mostrarTitulos($campos){
    global $conexao;
	$pks=[];
	for ($i=0; $i<count($campos); $i++){
		$tam    = $campos[$i][6];
		$titulo = $campos[$i][1];
		$style  = '';
		if ($tam!=''){
			$style = "style='width:$tam'";
		}
		
		if ($campos[$i][10]){
			echo "<th class='text-left' $style >$titulo</th>";
		}
		
		if ($campos[$i][2]){
			array_push($pks, "'".$campos[$i][0]."'");
		}
	}
	// adiciona a coluna de ação
	echo "<th class='text-center' style='width:80px'>
	       <img src='img/add.png' style='width:20px; height:20px; cursor:pointer' onclick='f_IncluirRegistro()'>
	     </th>"; 
	// verifica se tem campos que são dropdown com subselects, irá mandar os dados 
	for ($i=0; $i<count($campos); $i++){
		// tem subselect 
		if (count($campos[$i][11])>0){
			$campoID 	 = $campos[$i][11][1];
			$campoDescri = $campos[$i][11][2];
			$tab         = $campos[$i][11][0];
			
			// não irá listar o usuário padrão appipoka
			if (strtoupper($tab)=='PESSOA'){
				// monta o select com a tabela, a coluna id e a coluna descrição
				$sql = "SELECT $campoID, $campoDescri FROM $tab WHERE idpessoa<> 1 ORDER by $campoDescri";
			}else{
				// monta o select com a tabela, a coluna id e a coluna descrição
				$sql = "SELECT $campoID, $campoDescri FROM $tab ORDER by $campoDescri";				
			}
			
			$retorno = mysql_query($sql, $conexao) or die(error());	
			
            if($retorno) {
				while ($linha=mysql_fetch_array($retorno)) {
				    // adiciona os dados nos arrays 
					array_push($campos[$i][7][1], str_replace("'", "´",$linha[$campoID]));
					array_push($campos[$i][7][0], str_replace("'", "´",$linha[$campoDescri]));
				}	
            }
		
		}
	}
	
	global $tabela, $validaGravacao, $query, $exclusao;
	
	// escreve os dados dos campos como variaveis javascript para os arquivos js usarem
	$s = json_encode($campos);
	$validacao = criptografar($validaGravacao);
	$tabela    = criptografar($tabela);
	$query     = criptografar($query);
	
	// exceção de caracteres com progblemas na hora de post
	$query = str_replace("&",".EcM.",$query);
	$query = str_replace("+",".EcMS.",$query);
	$query = str_replace("'",".EcMA.",$query);
	$query = str_replace('"',".EcMD.",$query);
	
	$tabela = str_replace("&",".EcM.",$tabela);
	$tabela = str_replace("+",".EcMS.",$tabela);
	$validacao = str_replace("&",".EcM.",$validacao);
	$validacao = str_replace("+",".EcMS.",$validacao);
	
	
	echo "<script>tabela='$tabela'; campos=JSON.parse('$s'); qry='$query'; exclusao=$exclusao; validacao='$validacao'; colPks=[".implode(',',$pks)."]</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="img/logo.png">
	<link href="css/metro-bootstrap.css" rel="stylesheet">
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
	<link href="css/iconFont.css" rel="stylesheet">
	<link href="css/index.css" rel="stylesheet">   
	<script type="text/javascript" charset="utf-8" src="js/obj_getxmlhttp.js"></script>
	<script type="text/javascript" src="js/md5.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/index.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/crud.js"></script>
	<title>Portal Informática UTFPR - <?=$titulo?></title>
	
</head>
<body class="metro" onload="">
	<?php include("cabecalho.php"); ?>
	<br><br><br><br>
    <div class="container">
	   <table >
	     <tr><td><h2 id="__table__"><?=$titulo?></h2><td><td valign="center" style="padding-top: 8px;"><img id="imgCarregando" style="width: 20px; height:20px; visibility:hidden" src="img/loading.gif"></td><tr>
	    </table>
		<div class="input-control text" data-role="input-control">
			<input id="chaveBusca" type="text" placeholder="<?=$placeholderBusca?>" 
				oninput="f_Buscar(this.value.trim())">
			<button class="btn-search" onclick="f_Buscar(document.getElementById('chaveBusca').value.trim())"></button>
		</div>
	   <table class="table striped bordered hovered" id="tbResults">
                <thead>
                <tr>
				<?php mostrarTitulos($campos);?>
				</tr>
                </thead>
            <tbody> 
			</tbody>
      </table>
	  <div id="msgBusca"></div>
    </div>
</body>
</html>