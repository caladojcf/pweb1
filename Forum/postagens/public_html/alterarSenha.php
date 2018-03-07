<?php
	session_start();
	if(!$_SESSION['logado']){
    header("Location: index.php");
  }
	include_once "conexaoPDO.php";
	header('Content-Type: text/html; charset=utf-8');

	if (!empty($_POST['novaSenha'])) {

		$atual = sha1($_POST['senhaAtual']);
		$senha = sha1($_POST['novaSenha']);
		$email = $_COOKIE['ultimoLogin'];

		$stmt = "SELECT email, perfil, id_perfil FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = '".$_COOKIE['ultimoLogin']."'";
		$result = $bd->query($stmt);
		$usuario = $result->fetchObject();
		$teste = $usuario->id_perfil;
		$tela = ($teste == 1) ? 'telaAdmin.php?' : 'telaPostador.php?';

		$consulta = "SELECT senha FROM usuario WHERE email = '$email'";
    $resultado = $bd->query($consulta);
    $senhaBanco = $resultado->fetchObject();

		if ($senhaBanco->senha == $atual) {
			$stmt = $bd->prepare("UPDATE usuario SET senha=:senha WHERE email='".$email."'");
			// Definindo parâmetros
			$stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
			$stmt->execute();
			// Executando e retornando mensagem
			echo ($stmt->execute()) ? header("Location: ".$tela."sucesso=true&msg=Senha alterada com sucesso") : header("Location: ".$tela."sucesso=false&msg=Erro ao alterar a senha!");
			// $_SESSION['teste'] = TRUE;
			// $_SESSION['mensagem'] = "Senha alterada com sucesso.";
		}
		else
			header("Location: ".$tela."sucesso=false&msg=A senha atual do usuario está errada!");
			// $_SESSION['teste'] = FALSE;
			// $_SESSION['mensagem'] = "A senha atual do usuario que foi informada está errada!";
	}
	else{
	 	header("Location: ".$tela."msg=O campo 'Senha' está vazio. Informe uma senha válida");
	 // 	$_SESSION['teste'] = FALSE;
		// $_SESSION['mensagem'] = "O campo 'Senha' está vazio. Informe uma senha válida.";
	}
?>