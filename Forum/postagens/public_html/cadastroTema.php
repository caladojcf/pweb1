<?php
	session_start();
	if(!$_SESSION['logado']){
    header("Location: index.php");
  }
	// Incluindo arquivo de conexão
	include_once "conexaoPDO.php";

	$tema = trim($_POST['tema']);

	if(empty($tema)){
		header("Location: formCadastroTema.php?sucesso=false&msg=O campo Tema está vazio. Escreva um tema válido.");
		// $_SESSION['teste'] = FALSE;
		// $_SESSION['mensagem'] = "O formulário tem ao menos um campo vazio. Escreva um resposta válido.";
	}
	else{

		// Recupera os dados dos campos
		// $data = date('Y-m-d h:i:s');//do sistema
		// $email = $_COOKIE['ultimoLogin'];
		$tema = $_POST['tema'];
			
		$stmt2 = $bd->query('SELECT nome_tema FROM tema WHERE nome_tema="'.$tema.'"');
		$teste = $stmt2->fetchObject();

		  // Testando se o título da postagem já existe
		if ($teste == false) {
			// Preparando comando
			$stmt3 = $bd->prepare('INSERT INTO tema (id_tema, nome_tema) VALUES (null, :tema)');
			// Definindo parâmetros
			$stmt3->bindParam(':tema', $tema, PDO::PARAM_STR);
			// Executando e exibindo resultado
			echo ($stmt3->execute()) ? header("Location: formCadastroTema.php?sucesso=true&msg=Tema cadastrado com sucesso") : header("Location: telaAdmin.php?sucesso=false&msg=Erro ao cadastrar o tema!");
		}
		else
			header("Location: formCadastroTema.php?sucesso=false&msg=Esse tema já está cadastrado");
	}
?>