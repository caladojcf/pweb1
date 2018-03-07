<?php
	session_start();
	if(!$_SESSION['logado']){
    header("Location: index.php");
  }
	include_once "conexaoPDO.php";
	date_default_timezone_set('America/Recife');

	$posta = trim($_POST['resposta']);

	if(empty($posta)){
		header("Location: formInserirResposta.php?id=".$_COOKIE['id_postagem']."&msg=O formulário está vazio. Escreva uma resposta válida.");
		// $_SESSION['teste'] = FALSE;
		// $_SESSION['mensagem'] = "O formulário está vazio. Escreva um resposta válido.";
	}
	else{
		$consulta = "SELECT id_usuario FROM usuario WHERE email = '".$_COOKIE['id_user']."'";
		$result = $bd->query($consulta);
		$id_posta = $result->fetchObject();

	  $id_postagem = $_COOKIE['id_postagem'];
	  $email_posta = $_COOKIE['id_user'];
	  $id_postador = $id_posta->id_usuario;
	  $resposta = $_POST['resposta'];
		$data = Date('Y-m-d H:i:s');

	  // $c = new \br\com\app\model\resposta\resposta(null, $data, $id_postagem, $id_user, $resposta);
	  // $entityManager->persist($c);
	  // $entityManager->flush();
	  $addResp = "INSERT INTO resposta values(null, '$id_postagem', '$data', '$id_postador', '$email_posta','$resposta')";
    $bd->exec($addResp);

	  header("Location: formInserirResposta.php?id=".$_COOKIE['id_postagem']."&msgs=A resposta foi inserida abaixo, próximo ao rodapé.");
	 //  $_SESSION['teste'] = TRUE;
		// $_SESSION['mensagem'] = "A resposta foi inserido abaixo, próximo ao rodapé.";
	}
	// header("Location: formInserirResposta.php?id=".$_COOKIE['id_postagem']);
?>