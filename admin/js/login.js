var request = getXmlHttp();
function f_KeyLogin(key){
	if (key==13) f_Logar();
}
function f_Validar(){
	// valida se os campos foram preenchidos
	if (document.getElementById("email").value.trim()==''){
	    f_SetMsg("Informe o email");
		document.getElementById("email").focus();
		return false;
	}
	if (document.getElementById("senha").value.trim()==''){
	    f_SetMsg("Informe a senha");
		document.getElementById("senha").focus();
		return false;
	}
	return true;
}
function f_SetCarregando(valor){
	if (valor){
		document.getElementById("divCarregando").style.visibility = "visible";
	}else{
		document.getElementById("divCarregando").style.visibility = "hidden";
	}
}
function f_SetMsg(msg){
	document.getElementById("msg").innerHTML = msg;
	document.getElementById('msg').style.color="#F55";
	document.getElementById("msg").style.visibility = "visible";
}

function f_Logar(){
	if (f_Validar()){
	    f_SetMsg("");
		f_SetCarregando(true);
		email = document.getElementById("email").value.trim();
		senha = CryptoJS.MD5(document.getElementById("senha").value).toString();
		
		url= "login_painel.php?&email="+email+"&senha="+senha;
		request.open("GET", url, true);
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send(null);
		request.onreadystatechange = f_Retorno;
	}
}

function f_Retorno(){
	if(request.readyState == 4){
	    f_SetCarregando(false);
		var response = request.responseText.trim();
		ss = response;
		var obj = JSON.parse(response);
		if (obj.texto == 'Logado') {
			// Entra no painel
			location.reload(); 
		}else{
			f_SetMsg(obj.texto);
		}
   }
}