results = null; // resultado da busca
var busca = getXmlHttp();

function f_EditarPublicacao(id){
	f_Navegar('publicacao.php?id='+id);
}

function f_ExcluirPublicacao(id){
	var tabela	= document.getElementById("tbResults");
	tabela.rows.forEach=[].forEach;
	tabela.rows.forEach(
		function(a,i){
			if (a.getAttribute('id')==id){
				tabela.deleteRow(i);	
			}
		});
	
	var req = getXmlHttp();
	
	req.open("POST", "publicacao_excluir.php", true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send("id="+id);
	req.onreadystatechange = retorno;
	function retorno(){
		if(req.readyState == 4){
			if (req.status==200){	
				if (req.responseText!=''){
					ss = req.responseText;
				}
			}
		}
	}	
}
function f_MostrarPublicacoes(){
	// remove as linhas da tabela
	var tabela	= document.getElementById("tbResults");
	while (tabela.rows.length>1){
		tabela.deleteRow(1);
	}
	
	// atualiza os registros na janela
	for (i=0; i<results.length; i++){
		var r = tabela.tBodies[0].insertRow(tabela.tBodies[0].rows.length);
		r.setAttribute('class', '');
		r.setAttribute('id', results[i].idpublicacao);
		c = [];
		for (y=0; y<3; y++){c[y]=r.insertCell(y); c[y].setAttribute('class', '');}
		c[0].innerHTML = results[i].titulo;
	
		data = new Date(results[i].dtpublicacao.split('-').join('/'));     
		data = ("00" + data.getDate()).slice(-2)+"/"+("00" + (data.getMonth()+1)).slice(-2)+"/"+data.getFullYear()+" "+data.toLocaleTimeString();
	
		c[1].innerHTML = data;
		c[2].setAttribute('class', 'text-center');
		c[2].innerHTML ='<img style="width: 20px; height:20px; cursor:pointer;margin-right:20px" src="img/edit.png" onclick=f_EditarPublicacao('+results[i].idpublicacao+')><img style="width: 20px; height:20px;cursor:pointer" src="img/delete.png" onclick=f_ExcluirPublicacao('+results[i].idpublicacao+')>';
	}
}

function f_BuscarPublicacao(chaveBusca){
	document.getElementById("imgCarregando").style.visibility="visible";
	chaveBusca = chaveBusca.toUpperCase();
	document.getElementById('msgBusca').innerHTML = '';
	
	busca.open("POST", "publicacao_listar.php", true);
	busca.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	busca.send("busca="+encodeURIComponent(chaveBusca));
	busca.onreadystatechange = retorno;
	function retorno(){
		if(busca.readyState == 4){
			if (busca.status==200){	
			    document.getElementById("imgCarregando").style.visibility="hidden";
				//document.getElementById("img"+idpessoa+idaluno).style.visibility = "hidden";
				if (busca.responseText!=''){
					results = JSON.parse(busca.responseText);
					f_MostrarPublicacoes();
				}
			}
		}
	}		
	
}
function f_Autorizacao(idpessoa, idaluno, status){
	var req = getXmlHttp();
	document.getElementById("img"+idpessoa+idaluno).style.visibility = "visible";
	req.open("POST", "relacionamento_atualizar.php", true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	req.send(encodeURI("idresp="+idpessoa+"&idaluno="+idaluno+'&status='+status));
	req.onreadystatechange = retorno;
	function retorno(){
		if(req.readyState == 4){
			if (req.status==200){	
				document.getElementById("img"+idpessoa+idaluno).style.visibility = "hidden";
				if (req.responseText!=''){
					results = JSON.parse(req.responseText);
				}
			}
		}
	}	
}