<?php
/* Código para integrar no portal SENAQuiz*/
session_start();

//Para testar o controle de acesso comentar/descomentar a linha abaixo
//$_SESSION['codProfessor'] = 123;
//$_SESSION['showMenu'] = true;



require('integracao/loginFunc.php');
lidaBasicAuthentication('../../portal/naoautorizado.php');

if(!isset($_SESSION['codProfessor']) || @!is_numeric($_SESSION['codProfessor'])){
	echo "Acesso Negado";
	exit();
}
/* FIM Código para integrar no portal SENAQuiz*/

include('/db/db.php');

$erro = '';
$msg = '';

//Update após receber os dados de Form para Editar
if(isset($_POST['editado'])){
	if(is_numeric($_POST['cod_area'])){
		$area = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['area']);
		if(odbc_exec($db,"	UPDATE
								Area
							SET
								descricao = '$area'
							WHERE
								codArea = {$_GET['ecod']}")){
			$msg = '&Aacute;rea atualizada com sucesso';
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
								codArea, descricao
							FROM
								Area
							WHERE
								codArea ='.$_GET['ecod']);
	$result = odbc_fetch_array($query);

	$cod_area = $result['codArea'];
	$area = $result['descricao'];

	include('templates/index_edit_tpl.php');
	exit();
}

//Apaga
if(isset($_GET['dcod'])){
	if(is_numeric($_GET['dcod'])){
		//verifica se existe dependencia
		$query = odbc_exec($db,'SELECT descricao FROM
									Assunto
								WHERE
									codArea ='.$_GET['dcod']);
		if(odbc_num_rows($query) > 0){
			$erro = 	'ERRO: Existe Assunto
						Relacionado a esta &Aacute;rea';
		}else{
			if(!odbc_exec($db,'	DELETE FROM
									Area
								WHERE
									codArea ='.$_GET['dcod'])){
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
	$area = preg_replace(	"/[^a-zA-Z0-9 ]/",
							'',
							$_POST['area']);
	if(odbc_exec($db,"	INSERT INTO
							Area (descricao)
						VALUES
							('$area')")){
		$msg = '&Aacute;rea: '.$area.',
				inserida com sucesso';
	}else{
		$erro = 'ERRO: N&atilde;o foi poss&iacute;vel
				inserir a &aacute;rea: '.$area;
	}

}

//Lista
$query = odbc_exec($db,'SELECT
							codArea,
							descricao
						FROM
							Area');

while($result = odbc_fetch_array($query)){
	$areas[$result['codArea']] = utf8_encode($result['descricao']);
}

include('templates/index_tpl.php');
?>
