<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }

  header('Content-Type: text/html; charset=utf-8');
	include_once "conexaoPDO.php";

  $stmt3 = $bd->query('SELECT perfil FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = "'.$_SESSION['email'].'"');
	$p = $stmt3->fetchObject();
	$perfil = $p->perfil;

  if ($perfil != 1) {
  	if ($perfil == 2)
  		header("Location: telaPostador.php");
  	else
  		header("Location: index.php");
  }

	$id = $_GET['id'];

	try{
		$stmt = $bd->exec('DELETE FROM tema WHERE id_tema="'.$id.'"');
		
		$excluir = $entityManager->find('br\com\app\model\postagem\tema\Tema', $id);
		$entityManager->remove($excluir);
		$entityManager->flush();

		$stmt2 = $bd->exec('DELETE FROM postagem WHERE fk_tema="'.$id.'"');

		$excluir = $entityManager->find('br\com\app\model\postagem\Postagem', $id);
		$entityManager->remove($excluir);
		$entityManager->flush();

		header("Location: formCadastroTema.php?sucesso=true&msg=Tema removido com sucesso");
	}catch(Exception $e){
		header("Location: formCadastroTema.php?sucesso=true&msg=Tema removido com sucesso");
	}
?>