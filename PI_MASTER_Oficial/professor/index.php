<?php
include('../db/db.php');

$erro = '';
$msg = '';


if(isset($_POST['editado'])){
	if(is_numeric($_POST['cod_professor'])){
		$professor = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['professor']);
		$email = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['email']);
		$senha = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['senha']);
		$idSenac = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['idSenac']);
		$tipo = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['tipo']);

		$idSenac = empty($idSenac) ? null : $idSenac;


		if(odbc_exec($db,"	UPDATE
								Professor
							SET
								nome = '$professor', email = '$email', senha = HASHBYTES('SHA1', '$senha'), idSenac = $idSenac , tipo = '$tipo'
							WHERE
								codProfessor = {$_GET['ecod']}")){
			$msg = 'professor atualizado com sucesso';
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
								codProfessor, nome, email, senha, idSenac, tipo
							FROM
								Professor
							WHERE
								codProfessor ='.$_GET['ecod']);
	$result = odbc_fetch_array($query);

	$cod_professor = $result['codProfessor'];
	$professor = $result['nome'];
	$email = $result['email'];
	$senha = $result['senha'];
	$idSenac = $result['idSenac'];
	$tipo = $result['tipo'];


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
									codProfessor ='.$_GET['dcod']);
		if(odbc_num_rows($query) > 0){
			$erro .= 	'ERRO: Existe um questão
						relacionado a este Professor. <br>';
		}





		if (empty($erro)){

			if(!odbc_exec($db,'	DELETE FROM
									Professor
								WHERE
									codProfessor ='.$_GET['dcod'])){
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

	$professor = preg_replace(	"/[^a-zA-Z0-9 ]/",
							'',
								$_POST['professor']);
		$email = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['email']);
		$senha = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['senha']);
		$idSenac = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['idSenac']);
		$idSenac = empty($idSenac) ? 'null' : $idSenac;
		$tipo = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['tipo']);


echo "INSERT INTO
					 Professor (nome, email, senha, idSenac, tipo)
				 VALUES
					 ('$professor', '$email', HASHBYTES('SHA1', '$senha'),$idSenac,'$tipo')";

	 if(odbc_exec($db,"	INSERT INTO
							Professor (nome, email, senha, idSenac, tipo)
						VALUES
							('$professor', '$email', HASHBYTES('SHA1', '$senha'),$idSenac,'$tipo')")){

		$msg = 'Professor: '.$professor.',
				inserido(a) com sucesso.';
	}else{
		$erro = 'ERRO: N&atilde;o foi poss&iacute;vel
				inserir o professor: '.$professor;
	}
}

//Lista
$query = odbc_exec($db,'SELECT
							codProfessor,
							nome
							FROM
							Professor');
while($result = odbc_fetch_array($query)){
	$professors[$result['codProfessor']] = utf8_encode($result['nome']);
}

//query das Professors
$queryProfessor = odbc_exec($db, 'SELECT
								codProfessor,
								nome,
								email,
								senha,
								idSenac,
								tipo
							FROM
							Professor');
echo odbc_errormsg($db);

while($result = odbc_fetch_array($queryProfessor)){
	$professors[$result['codProfessor']] = $result;
}
include('templates/index_tpl.php');

?>
