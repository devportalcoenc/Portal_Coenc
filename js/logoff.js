
var request = getXmlHttp();

function f_Desconectar(){

  var url= "logoff.php";

  request.open("GET", url, true);
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(null);
  
  request.onreadystatechange = f_RetornoLogoff;
  
}

function f_RetornoLogoff(){
  if(request.readyState == 4){
    var response = request.responseText;
	if (response == 'deslogado') {
		// se o retorno for "deslogado", dar reload na página main.PHP, para que seja redirecionado ao index.php
		location.reload(); 	
	}
   }
}
