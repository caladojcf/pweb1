<?php
  try{
    if($_POST['cpf'] == "" || $_POST['nome'] == "" || $_POST['email'] == "" || $_POST['senha'] == ""){
      header("Location:index.php?&msg=Dados em branco. Preencha todos os campos corretamente.");
    }
    else{
      include_once "conexaoPDO.php";

      define('TAMANHO_MAXIMO', (1 * 1024 * 1024));

      // Recupera os dados dos campos
      $cpf = $_POST['cpf'];
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = sha1($_POST['senha']);
      $perfil = '2';
      $foto = $_FILES['foto'];
      $tipo = $foto['type'];
      $tamanho = $foto['size'];

      if (!empty($foto['name'])) {
        // Validações básicas
        // Formato
        if(!preg_match('/^image\/(pjpeg|jpeg|jpg|png|bmp)$/', $tipo)){
          header("Location: index.php?sucesso=false&msg=Isso não é uma imagem válida");
          exit;
        }
        // Tamanho
        if ($tamanho > TAMANHO_MAXIMO){
          header("Location: index.php?sucesso=false&msg=A imagem deve possuir no máximo 2 MB");
          exit;
        }
        // Transformando foto em dados (binário)
        $image = file_get_contents($foto['tmp_name']);

        $stmt = $bd->query('SELECT email FROM usuario WHERE email="'.$email.'"');
        $teste = $stmt->fetchObject();

        if ($teste == false) {
          //$usuario = new \br\com\app\model\usuario\Usuario($email, $cpf, $nome, $senha, $perfil);
          //$entityManager->persist($usuario);
          //$entityManager->flush();
///inicio
          // $cadUsuario = "INSERT INTO usuario (cpf,email,nome,senha,perfil) values('$cpf','$email','$nome','$senha','$perfil')";
          // $bd->exec($cadUsuario);
            
          // header("Location:index.php?&msg=".ucwords($nome).", seu cadastro foi realizado com sucesso como postador. Faça seu login para realizar suas postagens.");
  ///fim
          // $_SESSION['teste'] = TRUE;
          // $_SESSION['mensagem'] = ucwords($nome).", seu cadastro foi realizado com sucesso como comentarista. Faça seu login para realizar seus comentários.";
  //////começa
          $stmt = $bd->prepare('INSERT INTO usuario (id_usuario, email, cpf, nome_usuario, senha, perfil) VALUES (null, :email, :cpf, :nome_usuario, :senha, :perfil)');

          // Definindo parâmetros
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
          $stmt->bindParam(':nome_usuario', $nome_usuario, PDO::PARAM_STR);
          $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
          $stmt->bindParam(':perfil', $perfil, PDO::PARAM_INT);
          // $stmt->bindParam(':foto', $image, PDO::PARAM_LOB);

          // Executando e exibindo resultado
          echo ($stmt->execute()) ? header("Location: index.php?sucesso=true") : header("Location: index.php?sucesso=false&msg=Erro ao cadastrar usuário!");
//////termina
        }
        else{
            header("Location:index.php?sucesso=false&msg=".ucwords($nome).", o e-mail '".$email."' já está cadastrado e por isso indisponível.");
        }
      }
      else{
        $stmt2 = $bd->query('SELECT email FROM usuario WHERE email="'.$email.'"');
        $teste = $stmt2->fetchObject();

        // Testando se o usuário já existe (e-mail)
        if ($teste == false) {
          // Preparando comando
          $stmt = $bd->prepare('INSERT INTO usuario (id_usuario, email, cpf, nome_usuario, senha, perfil) VALUES (null, :email, :cpf, :nome_usuario, :senha, :perfil)');

          // Definindo parâmetros
          $stmt->bindParam(':email', $email, PDO::PARAM_STR);
          $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
          $stmt->bindParam(':nome_usuario', $nome_usuario, PDO::PARAM_STR);
          $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
          $stmt->bindParam(':perfil', $perfil, PDO::PARAM_INT);

          // Executando e exibindo resultado
          echo ($stmt->execute()) ? header("Location: index.php?sucesso=true") : header("Location: index.php?sucesso=false&msg=Erro ao cadastrar usuário!");
        }
        else{
          header("Location: index.php?sucesso=false&msg=Esse usuário já foi cadastrado");
        }
      }
    }
  }catch (Exception $e) {
    // echo "Cadastro não realizado<br/><br/>";
    // echo "<a href='formCadastroUsuario.php'>Voltar</a>";
    echo "<br/><br/>".$e->getMessage();
    // echo "<br/>".$e->getCode();
    // echo "<br/><br/>".$e->getTraceAsString();
  }
?>