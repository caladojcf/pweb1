<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }

	header('Content-Type: text/html; charset=utf-8');
	include_once "conexaoPDO.php";
	$id = $_GET['id'];

	$stmt = $bd->exec('DELETE FROM resposta WHERE id_postagem_respondida="'.$id.'"');
	$stmt2 = $bd->exec('DELETE FROM minhas_postagens WHERE fk_postagem="'.$id.'"');
	
	$excluir = $entityManager->find('br\com\app\model\postagem\Postagem', $id);
	$entityManager->remove($excluir);
	$entityManager->flush();

	//Buscando perfil do usuário para redirecionar à tela correta (de admin ou postador)
	$stmt3 = $bd->query('SELECT perfil FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = "'.$_SESSION['email'].'"');
	$p = $stmt3->fetchObject();
	$perfil = $p->perfil;

	// var_dump($_SESSION['email']);
	// var_dump($perfil);exit;

	echo ($perfil == 1) ? header("Location: telaAdmin.php?msg=Postagem%20removida%20com%20sucesso") : header("Location: telaPostador.php?msg=Postagem%20removida%20com%20sucesso");
?>