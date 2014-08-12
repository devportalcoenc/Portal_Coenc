<?php
	// prepara os dados da janela CRUD
	$tabela 		  = 'categoria_publicacao';
	$placeholderBusca = 'Buscar por categoria';
    $titulo			  = 'Categoria de publicações'; 
	$query			  = 'Upper(descricao) like "%chaveBusca%" or idcategoria=cast("chaveBusca" AS SIGNED INTEGER)';
	$exclusao		  = 1;
	$permissao        = 'crudcategoria'; // a descrição da permissão necessária para acessar esta página
	// Composição dos campos do cadastro(o primeiro deve ser obrigatoriamente chave primária)
	//           campo		título		PK 		tipo			validacao   		  			 msg Validação								Tam. Campo(px)      Multiseleção               				 		Valor Default  	PlaceHolder               		  Visível    subselect
	$campos = [['idcategoria','Código',	true,	'int',			[], 				  			 [],											'50px',					[]                     				   		   ,''            ,	''                		, true      ,[] ],
			   ['descricao',  'Categoria',false,	'char(60)',		['descricao.trim().length==0'],  ['Informe a categoria'],					'',						[]                    			       		   ,''            ,	'Descrição da categoria', true      ,[] ],
			  ];
	// validação antes da gravação do registro(as variáveis $ serão substituidos os valores no momento de execução)
	$validaGravacao = 'SELECT * FROM categoria_publicacao WHERE idcategoria<>$idcategoria AND upper(trim(descricao))=upper(trim("$descricao"))|Categoria já cadastrada.';
	
	include "crud.php";
?>
