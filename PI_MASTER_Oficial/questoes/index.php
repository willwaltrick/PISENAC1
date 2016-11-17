<?php
include('../db/db.php');

$erro = '';
$msg = '';


if(isset($_POST['editado'])){
	if(is_numeric($_POST['cod_professor'])){
		$questao = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['questao']);
		$assunto = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['assunto']);
		$professor = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['professor']);
		$imagem = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['imagem']);						
		
		$ativo = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['ativo']);

		$dificuldade = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['tipo']);


		if(odbc_exec($db,"	UPDATE
								Questao
							SET
								questao = '$questao', assunto = '$assunto', codImagem = $imagem, professor = '$professor', ativo = '$ativo', dificuldade = $dificuldade
							WHERE
								codQuestao = {$_GET['ecod']}")){
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
								codQuestao, textoQuestao, codAssunto, codImagem, codProfessor, ativo, dificuldade
							FROM
								Questao
							WHERE
								codQuestao ='.$_GET['ecod']);
	$result = odbc_fetch_array($query);

	$cod_professor = $result['codProfessor'];
	$questao = $result['questao'];
	$assunto = $result['assunto'];
	$imagem = $result['imagem'];
	$professor = $result['professor'];
	$ativo = $result['ativo'];
	$dificuldade = $result['dificuldade'];


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

	$questao = preg_replace(	"/[^a-zA-Z0-9 ]/",
							'',
								$_POST['questao']);
		$assunto = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['assunto']);
		$imagem = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['imagem']);
		$professor = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['professor']);
		$ativo = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['ativo']);
		$dificuldade = preg_replace(	"/[^a-zA-Z0-9 ]/",
								'',
								$_POST['dificuldade']);
		


echo "INSERT INTO
					 Questao (textoQuestao, codAssunto, codImagem, codProfessor, ativo, dificuldade)
				 VALUES
					 ('$questao', '$assunto', '$imagem', '$professor',$ativo,'$dificuldade')";

	 if(odbc_exec($db,"INSERT INTO
					 Questao (textoQuestao, codAssunto, codImagem, codProfessor, ativo, dificuldade)
				 VALUES
					 ('$questao', '$assunto', '$imagem', '$professor',$ativo,'$dificuldade')")){

		$msg = 'Questao: '.$questao.',
				inserido(a) com sucesso.';
	}else{
		$erro = 'ERRO: N&atilde;o foi poss&iacute;vel
				inserir questao : '.$questao;
	}
}

//Lista
$query = odbc_exec($db,'SELECT
							codQuestao,
							textoQuestao
							FROM
							Questao');
while($result = odbc_fetch_array($query)){
	$questaos[$result['codQuestao']] = utf8_encode($result['textoQuestao']);
}

//query das Professors
$queryProfessor = odbc_exec($db, 'SELECT
								codQuestao,
								textoQuestao,
								codAssunto,
								codImagem,
								codProfessor,
								ativo,
								dificuldade,
							FROM
							Questao');
echo odbc_errormsg($db);

while($result = odbc_fetch_array($queryProfessor)){
	$questaos[$result['codQuestao']] = $result;
}
include('templates/index_tpl.php');

?>
