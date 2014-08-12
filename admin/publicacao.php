<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
	$script = "";
	if (!empty($id)){
		$idpessoa = sessao('idpessoa');
		$sql = "SELECT * FROM publicacao WHERE idpublicacao = $id AND idpessoa = $idpessoa LIMIT 1";
		$json = queryToJson($sql, $conexao);
		$script = "<script>publicacao = JSON.parse('$json'); f_CarregarPublicacao();</script>"; 
	}
	
	$sql = "select * from categoria_publicacao";

	$categoria = mysql_query($sql,$conexao) or die(error());
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="img/logo.png">
	<link href="css/iconFont.css" rel="stylesheet">
	<link href="css/metro-bootstrap.css" rel="stylesheet">
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
	<script type="text/javascript" charset="utf-8" src="js/obj_getxmlhttp.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/index.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/publicacao.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script> 
	<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script> 
	<title>Portal Informática - Publicação</title>
</head>
<body class="metro" onload="f_ValidarBotoes();">
	<?php include("cabecalho.php"); ?>
	<br><br><br><br>
    <div class="container">
	<h2 id="__table__">Publicação</h2>
	  <div class="example">
	   <table width="100%" cellpadding="5px" style="background: transparent;">
	    <tr>
		   <td  height="100%">
		    <div class="input-control text" data-role="input-control">
			
			<select id="categoria" style="width: 100%;height:100%">
			<option value="0" selected="">(Selecione a categoria)</option>
			
			<?php 
			if($categoria) {
				while ($linha=mysql_fetch_array($categoria)) {
					?>
					<option value="<?= $linha["idcategoria"] ?>"><?= $linha["descricao"] ?></option>
					<?php
				}
			}
			?>
			</select>
			</div>
			 <div class="input-control text" data-role="input-control">
				<input id="tituloMsg" type="text" placeholder="Título do post"></div>
		     <div class="input-control textarea"><textarea width="400px" id="editor1" name="editor1" height="100%" data-transform="input-control" placeholder="Mensagem"></textarea></div>
            <input id="flagvisivel" type="checkbox" checked="checked"/>Publicado
			<script>
                CKEDITOR.replace( 'editor1' );
            </script>
			</td>
		</tr>
	   </table>
	   <legend></legend>
	   <table width="100%" style="background: transparent;">
	   <tr><td><button class="button primary" onclick="f_ProcurarPublicacao()">Buscar</button><button id="novo" class="button primary" onclick="f_NovaPublicacao()" style="margin-left: 20px; visibility:hidden">Nova publicação</button><img id="imgCarregando" style="visibility:hidden; width: 20px; height:20px" src="img/loading.gif"><strong id="msgEnvio"></strong></td><td align="right"><button class="button success" onclick="f_GravarPublicacao()">Salvar</button></td></tr>
	   </table>
	   </div>
	  </div> <!-- End of container -->
	
	  <?=$script?>	
</body>
</html>