<?php
$hostname_conexao = "mysql.hostinger.com.br";
$database_conexao = "u128784088_prtal";
$username_conexao = "u128784088_prtal";
$password_conexao = "qwe123";

$conexao = mysql_connect($hostname_conexao, $username_conexao, $password_conexao);
mysql_select_db($database_conexao, $conexao);

?>