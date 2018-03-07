<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }
	// Incluindo arquivo de conexão
	include_once "conexaoPDO.php";

	// Recupera os dados dos campos
	$id = (int) $_POST['id'];
	$tema = $_POST['tema'];

	if (!empty($tema)) {
		$consulta = "SELECT * FROM tema WHERE id_tema = '$id'";
    $cons = $bd->query($consulta);
		$teste = $cons->fetchObject();

		if ($teste->nome_tema != $tema) {
			// Preparando comando
			$stmt = $bd->prepare("UPDATE tema SET nome_tema = :tema WHERE id_tema='".$id."'");

			// Definindo parâmetros
			$stmt->bindParam(':tema', $tema, PDO::PARAM_STR);

			// Executando e exibindo resultado
			echo ($stmt->execute()) ? header("Location: formCadastroTema.php?&sucesso=true&msg=Tema editado com sucesso") : header("Location: formEditarTema.php?id=".$id."&sucesso=false&msg=Erro ao editar o tema!");
		}
		else{
			header("Location: formEditarTema.php?id=".$id."&sucesso=false&msg=O título do tema já está cadastrado. Não necessita salvar novamente!");
		}
	}
	else
		header("Location: formEditarTema.php?id=".$id."&sucesso=false&msg=O título do tema não pode estar vazio!");
?>