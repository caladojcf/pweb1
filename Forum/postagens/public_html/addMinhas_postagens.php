<?php
	session_start();
	if(!$_SESSION['logado']){
    header("Location: index.php");
  }
	include_once "conexaoPDO.php";
	// header('Content-Type: text/html; charset=utf-8');

	$id_postagem = $_COOKIE['id_postagem'];
	$email = $_COOKIE['id_user'];// ultimoLogin ?

	$consulta = "SELECT * FROM minhas_postagens WHERE email_usuario = '$email' AND fk_postagem = '$id_postagem'";
	$result = $bd->query($consulta);
	$minhas_postagens = $result->fetchObject();

	if (!$minhas_postagens) {
		$consulta = "SELECT * FROM usuario WHERE email = '$email'";
		$id_user = $bd->query($consulta)->fetchObject()->id_usuario;
		// $id_user = $result->fetchObject()->id_usuario;

		$minhas_postagens = new br\com\app\model\minhas_postagens\minhas_postagens(null, $id_postagem, $id_user, $email);
		$entityManager->persist($minhas_postagens);
		$entityManager->flush();

		// $_SESSION['teste'] = TRUE;
		// $_SESSION['mensagem'] = "postagem adicionada às minhas postagens.";

		header("Location: formInserirResposta.php?id=".$id_postagem."&msgs=Postagem adicionada às minhas postagens.");
	}
	else{
		// $_SESSION['teste'] = FALSE;
		// $_SESSION['mensagem'] = "Ação desnecessária. Essa postagem já está na sua lista de postagens.";

		header("Location: formInserirResposta.php?id=".$id_postagem."&msg=Ação desnecessária. Essa postagem já está na sua lista de postagens.");
	}
	// header("Location: formInserirResposta.php?id=".$id_postagem);
?>