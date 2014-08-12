<?php
$hostname_conexao = "localhost";
$database_conexao = "u128784088_prtal";
$username_conexao = "root";
$password_conexao = "454338";

$conexao = mysql_connect($hostname_conexao, $username_conexao, $password_conexao);
mysql_select_db($database_conexao, $conexao);

?>
