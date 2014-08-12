var idMsg=1; // id da div de msg gerado
// dados do campo que está sendo editado 
var idReg     = []; // id do registro 
var col       = '';// Nome da coluna 
var textoOrig = '';// Texto antes de clicar em editar
var idCol	   = 0; // id da coluna
var idtmp     = 0; // id temporário do registro incluído

results = null; // resultado da busca
var buscaP = getXmlHttp();

function f_Buscar(chaveBusca){
	document.getElementById("imgCarregando").style.visibility="visible";
	f_FecharEdicaoCampo();
	chaveBusca = chaveBusca.toUpperCase();
	document.getElementById('msgBusca').innerHTML = '';
	buscaP.open("POST", "cadastro_buscar.php", true);
	buscaP.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	args = "tabela="+encodeURIComponent(tabela)+"&filtro="+encodeURIComponent(qry)+"&busca="+encodeURIComponent(chaveBusca);
	buscaP.send(args);
	buscaP.onreadystatechange = retorno;
	function retorno(){
		if(buscaP.readyState == 4){
			if (buscaP.status==200){	
			    document.getElementById("imgCarregando").style.visibility="hidden";
				if (buscaP.responseText!=''){
					txtRet = buscaP.responseText;
					results = JSON.parse(buscaP.responseText);
					f_MostrarRegistros();
				}
			}
		}
	}		
	
} 
 // retorna a síntaxe das imagens laterais do registro(excluir, gravar, atualizar)
 function f_GetSintaxeBotoes(valPK){
    var imgExclusao;
    if (exclusao){
		imgExclusao = '<img id="img'+valPK.join('-')+'" style="cursor:pointer;width: 20px; height:20px" src="img/delete.png" onclick="f_ExcluirRegistro(['+valPK.join(',')+'])">';
	}else{ 
		imgExclusao = '<img id="img'+valPK.join('-')+'" style="visibility:hidden; width: 20px; height:20px" >';
    }	
	return imgExclusao+
	   	   '<div id="edit'+valPK.join('-')+'" style="width: 100%; display: table;visibility:hidden;position:fixed"><div style="display: table-row">'+
	   	   '<div style="width: 25; display: table-cell;"><img id="imgSalv'+valPK.join('-')+'" style="cursor:pointer;width: 20px; height:20px" src="img/ok.png" onclick="f_GravarRegistro(['+valPK.join(',')+'])"></div>'+
	   	   '<div style="display: table-cell;"><img id="imgRef'+valPK.join('-')+'" style="cursor:pointer;width: 20px; height:20px" src="img/refresh.png" onclick=f_RestaurarRegistro(['+valPK.join(',')+'])></div></div>';	
 }
 // retorna a sintaxe de um input do tipo select 
 function f_CampoSelect(id, captions, valores, valor){
    opcoes = "";
	for (ii=0; ii<captions.length; ii++){
		opcoes += "<option value='"+valores[ii]+"' "+f_if(valores[ii]==valor,'selected','')+">"+captions[ii]+"</option>";	
	}
   
	return '<select id="'+id+'">'+opcoes+"</select>";
 }
 
 // função genérica para mostrar os resultados de uma pesquisa nas telas CRUD
 function f_MostrarRegistros(){
	var i,y,j;
	// remove as linhas da tabela
	var tabela	= document.getElementById("tbResults");
	while (tabela.rows.length>1){
		tabela.deleteRow(1);
	}
	
	// atualiza os registros na janela
	for (i=0; i<results.length; i++){
		var r = tabela.tBodies[0].insertRow(tabela.tBodies[0].rows.length);
		r.setAttribute('class', '');

		c = [];
        var contCols = 0;
		for (y=0; y<campos.length; y++){		    
			if (campos[y][10]){
				c[y]=r.insertCell(contCols); 
				c[y].setAttribute('class', '');
				contCols++;
			}else{
				c[y] = document.createElement('div');
				c[y].setAttribute('class', 'colInvisivel');
				c[y].style.visibility = "hidden"; 
				document.body.appendChild(c[y]);
			}
		}
		c[y]=r.insertCell(contCols);c[y].setAttribute('class', '');// insere a coluna da imagem
		// recupera o valor das pks
		valPK = colPks.map(function(a){return eval("results[i]."+a)});
		r.setAttribute('id', 'row'+valPK.join('-'));
		for (j=0; j<campos.length; j++){
		    dado = eval("results[i]."+campos[j][0]);
			
			// verifica se o campo é do tipo select 
			if (campos[j][7].length>0){
				// mostra o caption de acordo com o valor do campo
				dado = campos[j][7][0][campos[j][7][1].indexOf(dado)];
			}
			c[j].valDefault = dado;// armazena o valor default, que veio do banco
			// tratamento para não mostrar a senha na tela		
			if (campos[j][0].toLowerCase()=='senha'){
				c[j].setAttribute('dado', dado);
				dado = "••••••";
			}
	
			// escreve no grid
			c[j].innerHTML = dado;
		
			// adiciona o ID da celula. Id do registro + Nome do campo
			c[j].setAttribute('id',valPK.join('-')+"_"+campos[j][0]);
		    c[j].linha   = i; 	
			c[j].coluna  = j; 
			c[j].idPk    = valPK; 
			c[j].nomeCol 	= campos[j][0];
			
			// se não é a pk 
			if (!campos[j][2]||colPks.length>1){
				// adiciona o evento onclick para quando clicar na coluna entrar no modo edição
				c[j].setAttribute('onclick',"f_EditarColuna(["+valPK.join(',')+"],this.coluna)");
			}
		}
		c[j].setAttribute('id','divImgs'+valPK.join('-'));
		// alinhamento da imagem
		c[j].setAttribute('class','text-center');
		// adiciona a imagem
		c[j].innerHTML = f_GetSintaxeBotoes(valPK);	
	}

}
    
// cancela a edição do campo retornando o texto original
function f_CancelarEdicaoCampo(){
	if (idReg.length>0){
		document.getElementById("col"+idReg.join('-')+'_'+col).value = textoOrig;
		f_FecharEdicaoCampo();
	}
}
// quando um campo está sendo editado e perde o foco
function f_FecharEdicaoCampo(){
    if (idReg.length>0){
		var campo = document.getElementById(idReg.join('-')+'_'+col);
		var dado = document.getElementById("col"+idReg.join('-')+'_'+col).value.trim();
		// recupera o dado digitado
		if (campos[idCol][7].length>0){
			if (dado.trim()==''){
				dado = document.getElementById(idReg.join('-')+'_'+col).valDefault;
			}else{
				// mostra o caption de acordo com o valor do campo
				dado = campos[idCol][7][0][campos[idCol][7][1].indexOf(dado)];
				document.getElementById(idReg.join('-')+'_'+col).valDefault = dado;
			}
			
		}
		
		if (campos[idCol][0].toLowerCase()=='senha'){
			if (campo.getAttribute('dado')!=dado){
				dado = CryptoJS.MD5(dado).toString();
				campo.setAttribute('dado', dado);
			}
			dado = "••••••";
		}
		// remove o campo e escreve o dado 
		campo.innerHTML = dado;
		// adiciona o evento onclick
		campo.setAttribute('onclick',"f_EditarColuna(["+idReg.join(',')+"], this.coluna)");
		// reseta as variaveis 
		idReg 		= [];
		col   		= '';
		textoOrig	= '';
		idCol		= 0;
	}
}
// função utilizada para editar uma celula no grid
function f_EditarColuna(id, numColuna){
	var coluna = campos[numColuna][0];
	// fecha a edição anterior
	f_FecharEdicaoCampo();
	var campo = document.getElementById(id.join('-')+'_'+coluna);
	var tam   = campo.getBoundingClientRect();
	var texto = f_GetDadoFormatado(campo.innerHTML, numColuna);
	var evento = 'oninput';
	idEdit = 'col'+id.join('-')+'_'+coluna;
	
	if (campos[numColuna][7].length>0){
	    // verifica a partir do texto o valor da coluna
		var valor = campos[numColuna][7][1][campos[numColuna][7][0].indexOf(texto)];
		// adiciona um combobox
		html = f_CampoSelect(idEdit, campos[numColuna][7][0], campos[numColuna][7][1], valor);
		evento = 'onchange';// o evento oninput não funciona em dropdowns no forefox
	}else{
	    if (coluna.toLowerCase()=='senha'){
			tipo = 'password';
			texto = campo.getAttribute('dado');
		} else {
			tipo = 'text';
		}
		// adiciona um textbox para edição	
		html = "<input style='width:"+tam.width+"px' id='"+idEdit+"' type='"+tipo+"' value='"+texto+"' placeholder='"+campos[numColuna][9]+"'>";
	}
	
	// seta os atributos do campo
	campo.innerHTML = html;
	campo.style.width = tam.width+'px';
	campoEdit = document.getElementById(idEdit);
	campoEdit.style.width = tam.width+'px';
	campoEdit.setAttribute('onkeydown','if (event.keyCode==27) f_CancelarEdicaoCampo(); if (event.keyCode==9) f_TabCampo(this.id);');
	campoEdit.setAttribute(evento,'f_CampoAlterado(true,['+id.join(',')+'],"'+coluna+'");'+'f_FormatarDadoCampo(this, '+numColuna+');');
	
	//campoEdit.setAttribute('onblur','f_FecharEdicaoCampo()');
	
	// remove o evento click
	campo.setAttribute('onclick', '');
	// seta o foco para o campo 
	document.getElementById(idEdit).focus();
	// salva os dados do campo atual 
	idReg 		= id;
	col   		= coluna;
	textoOrig   = texto; 
	idCol		= numColuna;
}
function f_MostrarBotoes(id, mostrar){
    var p = Number(mostrar);
	document.getElementById('img'+id.join('-')).style.visibility = ['hidden', 'visible'][p];
	document.getElementById('img'+id.join('-')).style.position   = ['fixed','relative' ][p];
	document.getElementById('edit'+id.join('-')).style.visibility   = ['visible','hidden' ][p];
	document.getElementById('edit'+id.join('-')).style.position	  = ['relative','fixed' ][p];
}
// quando o campo for alterado irá alterar a imagem do botão excluir para os botões gravar ou restaurar
function f_CampoAlterado(alterado, id, coluna){
	if (alterado){
		if (document.getElementById('col'+id.join('-')+'_'+coluna).value.trim()!=textoOrig.trim()){
			f_MostrarBotoes(id, false);
			}
	}else{
		f_MostrarBotoes(id, true);
	}
}
function f_SetImgDelete(id){
    if (exclusao){
		document.getElementById("img"+id.join('-')).src="img/delete.png";
	}else{
		document.getElementById("img"+id.join('-')).style.visibility = "hidden";
	}
}
// passa para o próximo campo quando for pressionado Tab
function f_TabCampo(idCampoEdit){
    campo = document.getElementById(String(idCampoEdit).split('col').join(''));
	nCol = campo.coluna + 1;
	
	if (nCol<campos.length){
		f_EditarColuna(campo.idPk, nCol);
	}
} 

// grava os registros no banco de dados
function f_GravarRegistro(id){
	// termina a edição do campo(caso esteja editando)
	f_FecharEdicaoCampo();
	if (f_ValidarRegistro(id)){
		// mostra a imagem de carregando 
		document.getElementById("img"+id.join('-')).src = 'img/loading.gif';
		// seta o formato para uma imagem nos botões 
		f_MostrarBotoes(id, true);
		var colunas = [];
		var dados = [];
		var i;
		tipo = 1; // 1- atualização 2-inserção
		// prepara os arrays com as colunas e os dados 
		for (i=0; i<campos.length; i++){
			colunas[colunas.length] = campos[i][0];
			camp 	= document.getElementById(id.join('-')+"_"+campos[i][0]); 
			dado    = camp.innerHTML;
			// tratar o campo senha
			if (campos[i][0].toLowerCase()=='senha'){
				dado = camp.getAttribute('dado');
			}
			// Tratar os campos multi-selecao 
			if (campos[i][7].length>0){
				dado = campos[i][7][1][campos[i][7][0].indexOf(dado)];
			}
			if (dado==''&&i==0){
				dado = 0;
			}
			// adiciona no array
			dados[dados.length] = dado;
		}
		// inclusão de um registro 
		if (id[0]<0){
			tipo = 2;
		}
		
		col  = encodeURIComponent(colunas.join('|'));
		dado = encodeURIComponent(dados.join('|'));
		// retorna os valores correspondentes a nova pk
		newPk = campos.map(function(a,b){if (colPks.indexOf(campos[b][0])>=0){return dados[b]}else{return null} }).filter(function(a){return a!=null});
		// prepara a requisição 
		var req = getXmlHttp();
		req.open("POST", "cadastro_atualizar.php", true);
		req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		req.send("tabela="+encodeURIComponent(tabela)+"&col="+col+"&dado="+dado+"&validacao="+encodeURIComponent(validacao)+'&pks='+encodeURIComponent(colPks.join(','))+'&valpk='+encodeURIComponent(id.join(','))+'&newpk='+encodeURIComponent(newPk.join(','))+'&tipo='+tipo);
		req.onreadystatechange = function(){
			if(req.readyState == 4){
				if (req.status==200){	
					f_SetImgDelete(id);
					if (req.responseText!=''){	
						var obj = JSON.parse(req.responseText);
						var novoId = -1;
						// Atualiza o id na linha 
						if (obj.status==1){
							// multiplas pks, podem ter sido alteradas 
							if (colPks.length>1){
								novoId = obj.pk.split(',');	
							}else{
								novoId = [obj.id]; // recebe o id do registro
								if (obj.id==0){
									novoId = -1;
								}
							}
						}
						if (novoId!=-1){
							for (ii=0; ii<campos.length; ii++){
								// Escreve na tela o id gerado, atualiza os campos html
								var c1 = document.getElementById(id.join('-')+"_"+campos[ii][0]);
								if (colPks.length<=1&&ii==0){
									c1.innerHTML	= novoId.join('-');
								}
								c1.id 			= novoId.join('-')+"_"+campos[ii][0];
								c1.idPk			= novoId;
								
								if (colPks.length>1||!campos[ii][2]){
									c1.setAttribute('onclick',"f_EditarColuna(["+novoId.join(',')+"],this.coluna)");
								}
							}
							
							 // altera o evento click das imagens 
							var imgs = document.getElementById('divImgs'+id.join('-'));
							imgs.id  = 'divImgs'+novoId.join('-');
							imgs.innerHTML = f_GetSintaxeBotoes(novoId);
							// altera o id da linha do grid
							var row1 = document.getElementById("row"+id.join('-'));
							row1.id  = "row"+novoId.join('-');	
								
						}
						if (obj.status<0){
						    var t2 = document.getElementById("row"+id.join('-')).getBoundingClientRect();
							f_MensagemValidacao(obj.msg, t2.left-100, t2.top+t2.height,5);	
						}
					}
				}
			}
		}		
	}
}



// grava os registros no banco de dados
function f_ExcluirRegistro(id){
	// termina a edição do campo(caso esteja editando)
	f_FecharEdicaoCampo();
	// mostra a imagem de carregando 
	document.getElementById("img"+id.join('-')).src = 'img/loading.gif';
	// seta o formato para uma imagem nos botões 
	f_MostrarBotoes(id, true);
	
	// prepara a requisição 
	var req = getXmlHttp();
	req.open("POST", "cadastro_excluir.php", true);
	req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	f = encodeURIComponent(id.map(function(a,i){return ' '+colPks[i]+'='+a+' '}).join('AND'));
	req.send("tabela="+tabela+"&filtro="+f);
	req.onreadystatechange = retorno;
	function retorno(){
		if(req.readyState == 4){
			if (req.status==200){	
			    // remove a linha da tabela na tela 
				tab = document.getElementById('tbResults');
				for (x=0; x<tab.tBodies[0].rows.length; x++){
					if (tab.tBodies[0].rows[x].id == 'row'+id.join('-')){
						tab.tBodies[0].deleteRow(x);
						break;
					}
				}
				if (req.responseText!=''){	
					txtRet = req.responseText;
				}
			}
		}
	}		
	
}

// função genérica para inclusão de registro no grid
function f_IncluirRegistro(){
	var tab = document.getElementById("tbResults");
	var r = tab.tBodies[0].insertRow(tab.tBodies[0].rows.length);
	r.setAttribute('class', '');
	c = [];
	var y;
	
	// gerar uma pk temporaria, para identificar o objeto na tela
	idtmp --;
	valPK = [idtmp];
	r.setAttribute('id', 'row'+valPK[0]);
	
	//cria as colunas 
	var contCols = 0;
	for (y=0; y<campos.length; y++){		    
		if (campos[y][10]){
			c[y]=r.insertCell(contCols); 
			c[y].setAttribute('class', '');
			contCols++;
		}else{
			c[y] = document.createElement('div');
			c[y].setAttribute('class', 'colInvisivel');
			c[y].style.visibility = "hidden"; 
			document.body.appendChild(c[y]);
		}
	}
	c[y]=r.insertCell(contCols);c[y].setAttribute('class', '');// insere a coluna da imagem
	
	for (j=0; j<campos.length; j++){
		
		// verifica se o campo é do tipo select 
		if (campos[j][7].length>0){
			// mostra o caption de acordo com o valor do campo
			dado = campos[j][7][0][campos[j][7][1].indexOf(campos[j][8])];
			c[j].valDefault = dado;// armazena o valor default, que veio do banco
			// escreve no grid
			c[j].innerHTML = dado;
		}
				
		// adiciona o ID da celula. Id do registro + Nome do campo
		c[j].setAttribute('id',valPK[0]+"_"+campos[j][0]);
		c[j].linha   = -1; 	
		c[j].coluna  = j; 
		c[j].idPk    = valPK; 
		c[j].nomeCol 	= campos[j][0];
		
		// se não é a pk 
		if (!campos[j][2]||colPks.length>1){
			// adiciona o evento onclick para quando clicar na coluna entrar no modo edição
			c[j].setAttribute('onclick',"f_EditarColuna(["+valPK[0]+"],this.coluna)");
		}
	}
	
	// alinhamento da imagem
	c[j].setAttribute('class','text-center');
	// adiciona a imagem
	c[j].innerHTML = f_GetSintaxeBotoes(valPK);
	c[j].setAttribute('id','divImgs'+valPK[0]);
	if (colPks.length>1){
		// seta o foco para a primeira coluna 
		f_EditarColuna(valPK, 0);
	}else{
		// seta o foco para a primeira coluna 
		f_EditarColuna(valPK, 1);
	}
}

// Recupera o registro do servidor
function f_RestaurarRegistro(id){
    f_FecharEdicaoCampo();
	// busca no servidor os dados do registro 
	var rec = getXmlHttp();
    f_MostrarBotoes(id, true);// deixa no formato de uma imagem só	
	document.getElementById("img"+id.join('-')).src="img/loading.gif";
	rec.open("POST", "cadastro_buscar.php", true);
	rec.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	f = encodeURIComponent(id.map(function(a,i){return ' '+colPks[i]+'='+a+' '}).join('AND'));
	rec.send("tabela="+tabela+"&filtro="+f+"&tipo=1");
	rec.onreadystatechange = retorno;
	function retorno(){
		if(rec.readyState == 4){
			if (rec.status==200){	
			    f_SetImgDelete(id);
				if (rec.responseText!=''){
					registro = JSON.parse(rec.responseText);
					// atualiza o registro na tabela 
					var i, dado;
					for (i=0; i<campos.length; i++){
						dado = eval("registro[0]."+campos[i][0]);
						// Multi - Seleção
						if (campos[i][7].length>0){
							dado = campos[i][7][0][campos[i][7][1].indexOf(dado)];		
						}
						if (campos[i][0].toLowerCase()=='senha'){
							document.getElementById(id.join('-')+"_"+campos[i][0]).setAttribute('dado', dado);
							dado = "••••••";
						}
						// restaura na linha da tabela 
						document.getElementById(id.join('-')+"_"+campos[i][0]).innerHTML = dado;
					}
				}
			}
		}
	}		
	
}

// faz a validação do registro(genérico, as regras de validação e mensagem de validação ficam no array na posição 4 e 5)
function f_ValidarRegistro(id){
	var i, j;
	var coluna, dado;
	var regras, msgs;
	// transforma os campos em variaveis locais 
	for (i=0; i<campos.length; i++){
	    // recupera as regras de validação daquele campo
		regras = campos[i][4];
		if (regras.length>0){
			msgs   = campos[i][5];
			coluna = campos[i][0];
			// formata os dados do campo
			document.getElementById(id.join('-')+"_"+coluna).innerHTML = f_GetDadoFormatado(document.getElementById(id.join('-')+"_"+coluna).innerHTML, i);	
			dado   = document.getElementById(id.join('-')+"_"+coluna).innerHTML;
			// irá pegar o value do drop down
			if (campos[i][7].length>0){
				// localiza o valor da coluna a partir do texto. Exemplo: dado='Sim' valor da coluna = 'T'
				dado = campos[i][7][1][campos[i][7][0].indexOf(dado)];
			}else{
				dado = "'"+dado+"'"
			}
			eval("var "+coluna+"="+dado);
			// percorre as regras de validação daquele campo
			for (j=0; j<regras.length; j++){
				// executa a expressão dinamicamente
				if (eval(regras[j])){
					f_EditarColuna(id, i);
					// recupera as dimensões do campo 
					var tam = document.getElementById("col"+id.join('-')+"_"+coluna).getBoundingClientRect();
				    f_MensagemValidacao(msgs[j], tam.left+(tam.width/2)-100, tam.top + tam.height+5, 4);
					return false;
				}
			}
		}
	}
	return true;
}

function f_GetDadoFormatado(dado, coluna){
	// recupera o tipo de dado da coluna 
	tipo = campos[coluna][3].toLowerCase().trim();

	// irá remover os caracteres que não são números
	if (tipo=='int'){
	    dado = dado.split(' ').join('a');
		var i, c, novo='';
		for (i=0; i<dado.length; i++){
			c = dado[i];
			if (isNaN(c)||dado==' '){
				c = '';
			}
			novo += c;
		}
		return novo;
	}
	return dado;
}
// função que irá tratar o tipo do campo e deixar somente os dados válidos
function f_FormatarDadoCampo(elemento, coluna){
    elemento.value = f_GetDadoFormatado(elemento.value, coluna);
}