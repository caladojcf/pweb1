<?php
	session_start();
	if(!$_SESSION['logado']){
    header("Location: index.php");
  }
	date_default_timezone_set('America/Recife');
	// Incluindo arquivo de conexão
	include_once "conexaoPDO.php";

	$titulo = trim($_POST['titulo']);
	$descricao = trim($_POST['descricao']);

	if(empty($titulo) || empty($descricao)){
		header("Location: formCadastroPostagem.php?sucesso=false&msg=O campo Título e/ou Descrição do formulário está vazio. Escreva uma resposta válida.");
		// $_SESSION['teste'] = FALSE;
		// $_SESSION['mensagem'] = "O formulário tem ao menos um campo vazio. Escreva um resposta válido.";
	}
	else{

		// Recupera os dados dos campos
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$data = date('Y-m-d h:i:s');//do sistema
		$tema = $_POST['tema'];
		$email = $_COOKIE['ultimoLogin'];

		$stmt = $bd->query('SELECT id_usuario FROM usuario WHERE email ="'.$email.'"');
		$postador = $stmt->fetchObject()->id_usuario;//do sistema
			
		$stmt2 = $bd->query('SELECT titulo FROM postagem WHERE titulo="'.$titulo.'"');
		$teste = $stmt2->fetchObject();

		  // Testando se o título da postagem já existe
		if ($teste == false) {
			// Preparando comando
			$stmt3 = $bd->prepare('INSERT INTO postagem (id_postagem, titulo, descricao, data_postagem, fk_tema, fk_postador) VALUES (null, :titulo, :descricao, :data, :tema, :postador)');

			// Definindo parâmetros
			$stmt3->bindParam(':titulo', $titulo, PDO::PARAM_STR);
			$stmt3->bindParam(':descricao', $descricao, PDO::PARAM_STR);
			$stmt3->bindParam(':data', $data, PDO::PARAM_STR);//pegar do sistema
			$stmt3->bindParam(':tema', $tema, PDO::PARAM_INT);
			$stmt3->bindParam(':postador', $postador, PDO::PARAM_INT);//pegar do sistema

			// Executando e exibindo resultado
			echo ($stmt3->execute()) ? header("Location: formCadastroPostagem.php?sucesso=true") : header("Location: formCadastroPostagem.php?sucesso=false&msg=Erro ao cadastrar a postagem!");
		}
		else
			header("Location: formCadastroPostagem.php?sucesso=false&msg=Essa postagem já foi cadastrada");
	}
?>