var idMsg = 1;
 // abre o link selecionado
 function f_Navegar(url){
	document.location = url;
 }
 
 function f_if(expressao, vTrue, vFalse){
	if (expressao){
		return vTrue;
	}else{
		return vFalse;
	}
 }
 
 // mostra a mensagem de validação
function f_MensagemValidacao(msg, x, y, tempo){
	var divMsg = document.createElement("div");
	divMsg.id = 'msg'+idMsg;
	divMsg.innerHTML = '<div class="notice marker-on-top bg-amber" style="position: fixed; top: '+y+'px; left: '+x+'px; opacity:0.9"><div class="fg-white">'+msg+'</div></div>';
	document.body.appendChild(divMsg);
	var tmr = setInterval("document.getElementById('msg"+idMsg+"').innerHTML=''", tempo*1000);
	idMsg ++;
}

 // redimensiona os campos da tabela de acordo com o tamanho dos títulos do cabecalho
 // a tabela deve ter uma propriedade "cabecalho" que é o id da tabela de cabecalho
 function f_ResizeCells(tabela){
	tab = document.getElementById(tabela); // recupera a tabela 
	cab = document.getElementById(tab.getAttribute('cabecalho')); // recupera o cabecalho(uma table também)
	var i;
	for (i=0; i<cab.tHead.rows[0].cells.length; i++){
	   wid = cab.tHead.rows[0].cells[i].style.width; // recupera a largura da coluna 
       tam = wid.replace(/[^0-9]/gi,''); // recupera o valor, ignorando a unidade 	
       uni = wid.replace(/[^a-z%]/gi,''); // recupera a unidade	   
	   
	   // altera no corpo 
	   if (tab.tBodies[0].rows.length>0){
		tab.tBodies[0].rows[0].cells[i].style.width = tam+uni;
	   }
	}
 }
 
