<?php
session_start();

if (empty($_SESSION['logado'])) {
	$_SESSION['logado'] = 'não';
}
$logado = $_SESSION['logado'];
if ($logado == 'não') {
	echo "<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=index.php\">";
	die;
}
?>