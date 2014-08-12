<script type="text/javascript" charset="utf-8" src="js/logoff.js"></script>
<!-- Metro UI CSS JavaScript plugins -->

<link rel="stylesheet" href="css/metro-bootstrap.css">
<script src="js/jquery/jquery.min.js"></script>
<script src="js/jquery/jquery.widget.min.js"></script>
<script src="js/metro.min.js"></script>

<header class="bg-dark"><div class="navigation-bar dark fixed-top shadow">
	<div class="navigation-bar-content container">
		<a href="main.php" class="element"><span class="icon-grid-view"></span> Painel administrativo</a>
		<span class="element-divider"></span>
			<?php 
			    $idpessoa =0;
			    if (!empty($_SESSION['idpessoa'])) {
					?>
					
					<a title="Desconectar" href="#" class="element place-right" onclick="f_Desconectar()">Desconectar</a>
					<span class="element-divider place-right"></span>
					<div class="">
					<div title="" href="#" class="element place-right">
					<?php
					$idpessoa = $_SESSION['idpessoa'];
					$retorno = mysql_query("SELECT nome FROM pessoa WHERE idpessoa=$idpessoa",$conexao) or die(error());
					if($retorno) {
						while ($linha=mysql_fetch_array($retorno)) {
							$nome = $linha["nome"];
						}
						echo $nome;
					}
					?>
					</a> 
					</div>
					<?php
				}
			?>
		<?php 
		if ($idpessoa>0){
			if (sessao('tipo')==1){
			?>
			<a href="#" class="element place-right fg-orange">Administrador</a>
			<?php 
			}
		}
		?>
	   </div>
		
	</div>
</header>