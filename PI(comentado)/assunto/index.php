<?php

/* Código para integrar no portal SENAQuiz*/
session_start();

//Para testar o controle de acesso comentar/descomentar a linha abaixo
//$_SESSION['codProfessor'] = 123;
//$_SESSION['showMenu'] = true;



require('../integracao/loginFunc.php');
lidaBasicAuthentication('../../portal/naoautorizado.php');

if(!isset($_SESSION['codProfessor']) || @!is_numeric($_SESSION['codProfessor'])){
	echo "Acesso Negado";
	exit();
}
/* FIM Código para integrar no portal SENAQuiz*/

include('../db/db.php');

$erro = '';
$msg = '';

//Update após receber os dados de Form para Editar
if(isset($_POST['editado'])){
	if(is_numeric($_POST['cod_assunto'])){
		$assunto = preg_replace(	"/[^a-zA-Z0-9 ]/", 
								'', 
								$_POST['assunto']);
		if(odbc_exec($db,"	UPDATE 
								Assunto
							SET  
								descricao = '$assunto'
							WHERE 
								codAssunto = {$_GET['ecod']}")){
			$msg = 'Assunto atualizado com sucesso';
		}else{
			$erro = 'ERRO: N&atilde;o foi poss&iacute;vel atualizar';
		}
	}else{
		$erro = 'ERRO: C&oacute;digo inv&aacute;lido';
	}
	

//Form para Editar
}elseif(isset($_GET['ecod']) && 
		is_numeric($_GET['ecod']) &&
		!isset($_POST['inserir'])){
	
	$query = odbc_exec($db,'SELECT 
								codAssunto, descricao
							FROM  
								Assunto
							WHERE 
								codAssunto ='.$_GET['ecod']);
	$result = odbc_fetch_array($query);
	
	$cod_assunto = $result['codAssunto'];
	$assunto = $result['descricao'];
	
	
	include('templates/index_edit_tpl.php');
	exit();
}

//Apaga
if(isset($_GET['dcod'])){
	if(is_numeric($_GET['dcod'])){
		$erro = "";
		//verifica se existe dependencia
		$query = odbc_exec($db,'SELECT codQuestao FROM  
									Questao
								WHERE 
									codAssunto ='.$_GET['dcod']);
		if(odbc_num_rows($query) > 0){
			$erro .= 	'ERRO: Existe um questão
						relacionado a esta assunto. <br>';
		}
		

		
		$query = odbc_exec($db,'SELECT codGrupo FROM  
									Grupo
								WHERE 
									codAssunto ='.$_GET['dcod']);
		if(odbc_num_rows($query) > 0){
			$erro .= 	'ERRO: Existe um grupo relacionada a esse assunto. ';
		}
		
		if (empty($erro)){
			 
			if(!odbc_exec($db,'	DELETE FROM  
									Assunto
								WHERE 
									codAssunto ='.$_GET['dcod'])){
				$erro = 'ERRO: Problema ao apagar o registro';
			}else{
				$msg = 'Registro apagado com sucesso';
			}	
		}		
	}else{
		$erro = 'ERRO: C&oacute;digo Inv&aacute;lido';
	}
}

//Inserir
if(isset($_POST['inserir'])){
	var_dump($_POST);
	$assunto = preg_replace(	"/[^a-zA-Z0-9 ]/", 
							'', 
							$_POST['assunto']);
	if(odbc_exec($db,"	INSERT INTO 
							Assunto (descricao, codArea)
						VALUES
							('$assunto', '{$_POST['selectarea']}')")){
	
		$msg = 'Assunto: '.$assunto.', 
				inserido com sucesso';
	}else{
		$erro = 'ERRO: N&atilde;o foi poss&iacute;vel 
				inserir o Assunto: '.$assunto;
	}
}

//Lista
$query = odbc_exec($db,'SELECT
							Assunto.codAssunto, 
							Assunto.descricao as assunto,
							Area.descricao as area
						FROM 
							Assunto join Area on Assunto.codArea = Area.codArea');

while($result = odbc_fetch_array($query)){
	$assuntos[$result['codAssunto']] = array('assunto' => utf8_encode($result['assunto']), 'area' => $result['area']);
}

//query das areas
$queryarea = odbc_exec($db, 'SELECT 
								codArea,
								descricao
							FROM
							Area');
echo odbc_errormsg($db);

while($result = odbc_fetch_array($queryarea)){
	$areas[$result['codArea']] = utf8_encode($result['descricao']);
}
include('templates/index_tpl.php');

?>