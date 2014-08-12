<?php
	include "valida_sessao.php";
	include "config.php";
	include "conexao.php";
	
	
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="img/logo.png">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="css/metro-bootstrap.css" rel="stylesheet">
    <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
	<link href="css/iconFont.css" rel="stylesheet">
	<script type="text/javascript" charset="utf-8" src="js/obj_getxmlhttp.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/index.js"></script>
    <title>Portal Informática UTFPR</title>
	
</head>
<body class="metro">
	<?php include("cabecalho.php"); ?>
	<br><br><br><br>
    <div class="container">
        <h2 id="botoes"></h2>
          <div class="example" >
            <div style="margin-top: 20px">
			
				<div class="tile bg-blue" style="width: 200px">
				   <button class="shortcut primary" style="width:100%; height: 100%" onclick="f_Navegar('publicacao.php')">
						Publicação
					</button>
				</div>
			
		    
				<?php 
				if(sessao('tipo')==1){
				?>
					<div class="tile bg-blue" style="width: 200px">
					   <button class="shortcut warning" style="width:100%; height: 100%" onclick="f_Navegar('usuario.php')">
						 Usuários
						</button>
					</div>
					
					<div class="tile bg-blue" style="width: 200px">
					   <button class="shortcut success" style="width:100%; height: 100%" onclick="f_Navegar('tipos_usuario.php')">
						 Tipos de usuário
						</button>
					</div>
					
					<div class="tile bg-blue" style="width: 200px">
					   <button class="shortcut danger" style="width:100%; height: 100%" onclick="f_Navegar('categoria.php')">
						 Categoria de publicações
						</button>
					</div>
				<?php 
				}
				?>
          </div>
        </div>
    </div> <!-- End of container -->


</body>
</html>