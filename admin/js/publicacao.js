tmr = null; // timer para limpar a mensagem
idpublicacao = 0;
function f_CarregarPublicacao(){
	idpublicacao								= publicacao[0].idpublicacao;
	texto = publicacao[0].corpo_formatado;
	texto = texto.split('.EcMA.').join('"');
	document.getElementById('tituloMsg').value	= publicacao[0].titulo;
	CKEDITOR.instances.editor1.setData(texto);
	document.getElementById('flagvisivel').checked=(publicacao[0].flagvisivel=='T');
	document.getElementById("categoria").value	= publicacao[0].idcategoria;
	f_ValidarBotoes();
}

function f_NovaPublicacao(){
	idpublicacao = 0;
	CKEDITOR.instances.editor1.setData("");
	document.getElementById('tituloMsg').value = '';
	document.getElementById('tituloMsg').focus();
	document.getElementById('msgEnvio').style.visibility = "hidden";
	f_ValidarBotoes();
}

function f_ValidarBotoes(){
	document.getElementById('novo').style.visibility = ["hidden", "visible"][Number(idpublicacao>0)];
}

function f_ProcurarPublicacao(){
	f_Navegar('publicacao_buscar.php');
}

function f_SetMsgPublicacao(msg){
   document.getElementById("msgEnvio").innerHTML = msg;
   tmr = setTimeout("f_SetMsgPublicacao('')", 20*1000);
}

function f_GravarPublicacao(){
    f_SetMsgPublicacao("");
	texto 		= CKEDITOR.instances.editor1.getData().trim();
	flagvisivel	= document.getElementById('flagvisivel').checked;
	d = document.createElement("div");
	
	if (flagvisivel){
		flagvisivel = 'T';
	}else{
		flagvisivel = 'F';
	}
	
	// caso não tenha conseguido carregar o CKEDITOR 
	if (texto.length==0){
		texto = document.getElementById('editor1').value.trim();
	}
	// substitui o & por .EcM.
	texto  = texto.replace(/&/gi, ".EcM.");
	texto  = texto.split('+').join('.EcMS.');
	texto  = texto.split('"').join('.EcMA.');
	
	categoria = document.getElementById("categoria").value;
	if (categoria==0){
		f_SetMsgPublicacao("Informe a categoria.");
		document.getElementById('categoria').focus();
		return;
	}
	titulo = document.getElementById('tituloMsg').value.trim();
	
	if (titulo.length==0){
		f_SetMsgPublicacao("Informe o título.");
		document.getElementById('tituloMsg').focus();
		return;
	}
	if (titulo.length<5){
		f_SetMsgPublicacao("O título deve conter no mínimo 5 letras.");
		document.getElementById('tituloMsg').focus();
		return;
	}
	if (texto.length==0&&texto.indexOf("img")<0){
		f_SetMsgPublicacao("Digite o corpo da publicação.");
		CKEDITOR.instances.editor1.focus();
		return;
	}
	
	document.getElementById('imgCarregando').style.visibility = 'visible';
	var req = getXmlHttp();
	req.open("POST", "publicacao_gravar.php", true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	args = "id="+idpublicacao+"&texto="+encodeURIComponent(texto)+"&titulo="+encodeURIComponent(titulo)+"&flagvisivel="+flagvisivel+"&idcategoria="+categoria;
	req.send(args);
	req.onreadystatechange = retorno;
	function retorno(){
		if(req.readyState == 4){
			if (req.status==200){	
				document.getElementById("imgCarregando").style.visibility = "hidden";
				if (req.responseText!=''){
					ss = req.responseText;
					obj = JSON.parse(req.responseText);
					if (obj.status==1){
						idpublicacao = obj.id;
						f_SetMsgPublicacao("Publicação gravada com sucesso!");
					}else{
						f_SetMsgPublicacao("");
					}
					f_ValidarBotoes();
				}
			}
		}
	}		
}