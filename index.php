<!DOCTYPE HTML>
<html>
<head>
  <title>Pagina de portugues</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js">
  </script>
  
  
  
  <script>
function limpa(objeto){ objeto.value="";}
function reload(){
document.autentica.recarrega.value="OK";
document.autentica.sub_form.value="reload"
document.autentica.submit();
//window.location.reload()
}

</script>

  <script>
  
  function home(){ 


}
    
  }
  function teste(){

  
  }
  
  
  </script>



  
  
  
  
</head>
 <body>
  <div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php">Centro Academico<span class="logo_colour"> Pagina teste</span></a></h1>
          <h2>Desenvolvido por alunos</h2>
        </div>
      </div>
       <!-- Futuramente pode ser feito implementação automatizada em php da barra-->
       <nav>
        <div id="menu_container">
       
          <ul class="sf-menu" id="nav">
          
          
                      <!-- Aqui to fazendo teste e pode dar bosta -->
                      
                      
                      
            <li><a href="index.php?menu=home.php">Home</a></li>

            

 <!-- poderia ser feito usando um href e na beta usar um $_get mas vai ficar feio -->
            
            
	   <li>	<a href="index.php?menu=grade.php">Grade dos Curso</a></li>
	

	    
	    
	     
	    <!-- Aqui to fazendo teste e pode dar bosta -->
            <li><a href="index.php?menu=professores.php">Professores</a></li>
            <li><a href="#">Teste</a>
	      <ul>
		<li><a href="index.php?menu=examples.html">Exemplo</a></li>
	     </ul>	     
         <!--   <li><a href="#">Example Drop Down</a>
              <ul>
                <li><a href="#">Drop Down One</a></li>
                <li><a href="#">Drop Down Two</a>
                  <ul>
                    <li><a href="#">Sub Drop Down One</a></li>
                    <li><a href="#">Sub Drop Down Two</a></li>
                    <li><a href="#">Sub Drop Down Three</a></li>
                    <li><a href="#">Sub Drop Down Four</a></li>
                    <li><a href="#">Sub Drop Down Five</a></li>
                  </ul>
                </li>
                <li><a href="#">Drop Down Three</a></li>
                <li><a href="#">Drop Down Four</a></li>
                <li><a href="#">Drop Down Five</a></li>
              </ul>
            </li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul> -->
        </div>
      </nav>
     </header>
     <body>
      <!-- aqui coloca-se uma chamada em php para uma nova pagina de auto implementação que sera determinada
      quantos textos serão exibidos sobre novidades. -->
      <?PHP
      include ("beta.php") ;
      ?>
      </body>
     <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    }
  </script>
  <script>
  
  function home(){ 
 
   var objMeuId =  document.getElementById("meuid");

  var objeMeuForm = document.getElementById("meuForm");

  <?php $chamada='index.html'; ?>

  return false; // cancela o submit do form

}
    
  }
  function teste(){

  
  }
  
  
  </script>
</html>