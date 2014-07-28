<!DOCTYPE HTML>
<html>
  <script>
function limpa(objeto){ objeto.value="";}
function reload(){
document.autentica.recarrega.value="OK";
document.autentica.sub_form.value="reload"
document.autentica.submit();
//window.location.reload()
}
</script>
<head>
  <title>Pagina de portugues</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

  <body>
      
  
     
      <!-- aqui coloca-se uma chamada em php para uma nova pagina de auto implementação que sera determinada quantos textos serão exibidos sobre novidades. -->
      <?PHP
      $chamada=$_GET['menu'];
      if($chamada==null){
      $chamada='home.php';
      }
      include ("$chamada") ;?>
  </body>
