<?php
	// prepara os dados da janela CRUD
	$tabela 		  = 'pessoa';
	$placeholderBusca = 'Buscar por nome ou email';
    $titulo			  = 'Usuários'; 
	$query			  = 'Upper(nome) like "%chaveBusca%" or Upper(email) like "%chaveBusca%" or idpessoa=cast("chaveBusca" AS SIGNED INTEGER)';
	$exclusao		  = 1;
	$permissao        = 'crudusuario'; // a descrição da permissão necessária para acessar esta página
	// Composição dos campos do cadastro(o primeiro deve ser obrigatoriamente chave primária)
	//           campo		título		PK 		tipo			validacao   		  			 msg Validação								Tam. Campo(px)      Multiseleção               				 		Valor Default  	PlaceHolder               		  Visível    subselect
	$campos = [['idpessoa',	'Código',	true,	'int',			[], 				  			 [],											'50px',					[]                     				   		   ,''            ,	''                		, true      ,[] ],
			   ['nome',		'Nome',		false,	'char(50)',		['nome.trim().length==0'],  	 ['Informe o nome '],							'',						[]                    			       		   ,''            ,	'Nome do usuário'   	 , true      ,[] ],
			   ['email',	'Email',	false,	'char(50)',		['email.trim().length==0'	],   ['Informe o email'],							'',		     			[]                      			   		   ,''            ,	'email do usuário'  	, true      ,[] ],
			   ['senha',	'Senha',	false,	'char(50)',		['senha.trim().length==0'	],   ['Informe a senha'],							'',		     			[]                      			   		   ,''            ,	'Senha do usuário' 		, true      ,[] ],
			   ['idtipo' ,	'Tipo',		false,	'char(100)',	['tipo==0'],					 ['Informe o tipo'],							'',						[['(Selecione o tipo)'],['0']]   			  , '0'           ,	''                		, true	    ,['tipo_pessoa', 'idtipo',  'descricao'] ],
			   ['ativo',	'Ativo',	false,	'char(1)',		[], 				  			 [],											'70px',					[["Sim","Não"],["T", "F"]]			   		   ,'T'  	      , ''                		, true      ,[] ],
			  ];
	// validação antes da gravação do registro(as variáveis $ serão substituidos os valores no momento de execução)
	$validaGravacao = 'SELECT * FROM pessoa WHERE idpessoa<>$idpessoa AND upper(trim(email))=upper(trim("$email"))|Email já cadastrado.';
	
	include "crud.php";
?>
