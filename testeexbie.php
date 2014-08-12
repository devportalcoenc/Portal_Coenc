<?php
include("dbconnect.php");


$sql = lersql("select * from publicacao order by idpublicacao");


while( $exibe = mysql_fetch_assoc($sql)):

echo $exibe["titulo"];


endwhile ;


?>
