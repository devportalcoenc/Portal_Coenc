<?php
$host = "localhost";
$user = "root";
$password = "454338";
$database = "u128784088_prtal";

/* Connect to the db and select a database*/
$dbLink  = mysql_connect($host,$user, $password) or die("Não foi possivel a conexão");
$success = mysql_select_db($database) or die("Error Selecionando a Base De dados! <br> ".mysql_error());

function lersql($sqlcomando){
    static $dados;
	$dados=mysql_query("$sqlcomando") or die("Erro de localizacao de dados !<br> $sqlcomando<br>".mysql_error());
    return $dados;
}
?>