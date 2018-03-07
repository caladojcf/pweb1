<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }
	// Incluindo arquivo de conexão
	include_once "conexaoPDO.php";

	// Recupera os dados dos campos
	$id = (int) $_GET['id'];
	$titulo = $_POST['titulo'];
	// $tema= $_POST['tema'];
	$descricao = $_POST['descricao'];

	if (!empty($titulo) || !empty($descricao)) {

		$consulta = "SELECT titulo, descricao FROM postagem WHERE id_postagem = '$id'";
    $cons = $bd->query($consulta);
		$teste = $cons->fetchObject();

    // var_dump($t->descricao); exit;

		if ($teste->titulo != $titulo || $teste->descricao != $descricao) {

			// Preparando comando
			$stmt = $bd->prepare("UPDATE postagem SET titulo=:titulo, descricao=:descricao WHERE id_postagem='".$id."'");

			// Definindo parâmetros
			$stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
			$stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);

			// Executando e exibindo resultado
			echo ($stmt->execute()) ? header("Location: exibePostagemAdmin.php?id=".$id."&sucesso=true&msg=Postagem editada com sucesso") : header("Location: formEditarPostagem.php?busca=".$id."&sucesso=false&msg=Erro ao editar a postagem!");
	}
	else
		header("Location: formEditarPostagem.php?busca=".$id."&sucesso=false&msg=Esse título e/ou descriçao da postagem já existe");
	}
	else
		header("Location: formEditarPostagem.php?busca=".$id."&sucesso=false&msg=O título da postagem não pode ser vazio!");
?>