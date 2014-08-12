<?php
	// prepara os dados da janela CRUD
	$tabela 		  = 'tipo_pessoa';
	$placeholderBusca = 'Buscar por descrição';
    $titulo			  = 'Tipos de usuário'; 
	$query			  = 'Upper(descricao) like "%chaveBusca%"  or idtipo=cast("chaveBusca" AS SIGNED INTEGER)';
	$exclusao		  = 1;
	$permissao        = 'crudtipo'; // a descrição da permissão necessária para acessar esta página
	// Composição dos campos do cadastro(o primeiro deve ser obrigatoriamente chave primária)
	//           campo		título		PK 		tipo			validacao   		  			 msg Validação								Tam. Campo(px)      Multiseleção               				 		Valor Default  	PlaceHolder               		  Visível    subselect
	$campos = [['idtipo',	'Código',	true,	'int',			[], 				  			 [],											'50px',					[]                     				   		   ,''            ,	''                		, true      ,[] ],
			   ['descricao','Descrição',false,	'char(50)',		['descricao.trim().length==0'],  ['Informe a descrição '],						'',						[]                    			       		   ,''            ,	'Descrição do tipo'  	 , true      ,[] ],
			 ];
	// validação antes da gravação do registro(as variáveis $ serão substituidos os valores no momento de execução)
	$validaGravacao = 'SELECT * FROM tipo_pessoa WHERE idtipo<>$idtipo AND upper(trim(descricao))=upper(trim("$descricao"))|Tipo já cadastrado.';
	
	include "crud.php";
?>
