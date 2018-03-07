<?php
  session_start();

  try{
    if($_POST['cpf'] == "" || $_POST['nome'] == "" || $_POST['email'] == "" ||
      $_POST['senha'] == ""){
      header("Location:formCadastroUsuario.php?&msg=Dados em branco. Preencha todos os campos corretamente.");
    }
    else{
      include_once "conexaoPDO.php";

      $cpf = $_POST['cpf'];
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = sha1($_POST['senha']);
      $perfil = '2';

      $stmt = $bd->query('SELECT * FROM usuario WHERE email="'.$email.'"');
      $teste = $stmt->fetchObject();

      if ($teste == false) {

        $cadUsuario = "INSERT INTO usuario (id_usuario, email, cpf, nome_usuario, senha, perfil) values(null, '$email', '$cpf','$nome','$senha','$perfil')";
        $bd->exec($cadUsuario);
          
        header("Location:index.php?&msg=".ucwords($nome).", seu cadastro foi realizado com sucesso como comentarista.");
        }
      else
          header("Location:index.php?sucesso=false&msg=".ucwords($nome).", o e-mail '".$email."' já está cadastrado e por isso indisponível.");
    } 
  }catch (Exception $e) {
    echo "<br/><br/>".$e->getMessage();
  }
?>