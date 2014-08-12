<?php
include("dbconnect.php");
?>
<!DOCTYPE HTML>
<html>

<head>
  <title>Pagina de portugues</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>
<div id="site_content">
<div id="sidebar_container">
        <div class="sidebar">
          <h3>Ultimas Noticias</h3>
          <h4>Pode ser deixado uma previa de uma noticia do portal da utf aqui com um link direto</h4>
          <h5>DATA dd/mm/aa</h5>
        </div>
        </div>
       <div class="content">
<?php


$sql = lersql("select * from publicacao order by idpublicacao DESC");
while( $exibe = mysql_fetch_assoc($sql)):
echo '<br><h1>';
echo $exibe["titulo"];
echo '</h1>';
echo $exibe["corpo_formatado"];

endwhile ;

 
?>
       </div>
      <div><p>&nbsp;</p></div>
    </div>
 