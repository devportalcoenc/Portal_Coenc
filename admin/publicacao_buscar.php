<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
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
	<script type="text/javascript" charset="utf-8" src="js/index.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/obj_getxmlhttp.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/publicacao_buscar.js"></script>
    
	<title>Portal Informática UTFPR</title>
	
</head>
<body class="metro" onload="f_BuscarPublicacao('')">
	<?php include("cabecalho.php"); ?>
	<br><br><br><br>
    <div class="container">
	   <table >
	     <tr><td><h2 id="__table__">Buscar publicação</h2><td><td valign="center" style="padding-top: 8px;"><img id="imgCarregando" style="width: 20px; height:20px" src="img/loading.gif"></td><tr>
	    </table>
		<div class="input-control text" data-role="input-control">
			<input id="chaveBusca" type="text" placeholder="Buscar por título" 
				oninput="f_BuscarPublicacao(this.value.trim())">
			<button class="btn-search"></button>
		</div>
						

	<table class="table striped bordered hovered" id="tbResults">
                <thead>
                <tr>
                    <th class="text-left">Título</th>
                    <th class="text-left">Categoria</th>
					<th class="text-left" style="width:200px" >Data de publicação</th>
					<th class="text-center" style="width:140px"></th>
                </tr>
                </thead>

            <tbody> 
   		     
			</tbody>
            </table>		
			
			<div id="msgBusca"></div>
    </div> <!-- End of container -->


</body>
</html>