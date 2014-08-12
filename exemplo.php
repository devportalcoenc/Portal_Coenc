<?php
	session_start();
	include "admin/config.php";
	include "admin/conexao.php";
	function ExibirPosts(){
		global $conexao;
		$sql = "SELECT 
					p.* ,
					pes.nome autor
				FROM 
					publicacao p, pessoa pes  
				WHERE 
					p.idpessoa = pes.idpessoa AND 
					p.flagvisivel='T' 
				ORDER BY dtpublicacao DESC";
			
		$retorno = mysql_query($sql,$conexao) or die(error());
		if($retorno) {
			while ($linha=mysql_fetch_array($retorno)) {
				$idpublicacao	= $linha["idpublicacao"];
				$titulo			= trim($linha["titulo"]);
				$texto	 		= $linha["corpo_formatado"];/// Atenção aqui, no banco de dados foi gravado .EcMA. no lugar das aspas duplas
				$texto			= str_replace('.EcMA.', '"', $texto);// substituindo as aspas duplas 
				$data	 		= $linha["dtpublicacao"];
				$autor			= $linha["autor"];
				
				/// apresentando os dados 
				?>
				T&iacute;tulo: <?=$titulo?><br> 
				Autor: <?=$autor?><br>
				Data de publica&ccedil;&atilde;o: <?=$data?><br> 
				Corpo do post:<br>
				<?=$texto?>
				<hr>
				<?php
			}	
		}
		mysql_close();
	}
?>

<html>
<head>
<title>Posts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
	<?php 
		ExibirPosts();
	?>
</body>
</html>
