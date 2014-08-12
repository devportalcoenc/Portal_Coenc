<?php
	session_start();

	$_SESSION['logado'] = 'não';
	$_SESSION['idpessoa'] = 0;
	$_SESSION['email'] = '';

	echo 'deslogado';
?>
