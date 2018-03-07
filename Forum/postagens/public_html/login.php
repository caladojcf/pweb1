<?php
  // header('Content-Type: text/html; charset=utf-8');
  try {
    if($_POST['email'] == "" || $_POST['senha'] == ""){
       header("Location: index.php?sucesso=false&msg=O campo login e/ou senha está vazio!");
     // $_SESSION['teste'] = false;
     // $_SESSION['mensagem'] = "O campo login e/ou senha está vazio!";
     // header("location: index.php");
    }
    else{
      // $dsn = "mysql: host=localhost; dbname=livro_social";
      // $bd = new PDO($dsn, "root", "");
      include_once "conexaoPDO.php";
      $email = $_POST['email'];
      $senha = sha1($_POST['senha']);
      // setcookie('ultimoLogin', $email, time() + 360000);

      $consulta = "SELECT email, senha, perfil FROM usuario WHERE email = '$email'";
      $result = $bd->query($consulta);
      $resultado = $result->fetchObject();
      $p = $resultado->perfil;

      if($resultado->email == $email && $resultado->senha == $senha){
        session_start();
        setcookie('ultimoLogin', $email, time() + 360000);
        // setcookie('testaPerfil', $p, time() + 360000);
        $_SESSION['logado'] = true;
        $_SESSION['email'] = $email;

        if($resultado->perfil == "1"){
          header("location: telaAdmin.php");
        }
        else
          header("location: telaPostador.php");
      }
      else{
       // $_SESSION['teste'] = false;
       // $_SESSION['mensagem'] = "Login ou senha incorretos!";
        // header("location: index.php");
        header("location: index.php?sucesso=false&msg=Login ou senha incorretos!");
        session_destroy();
        setcookie('ultimoLogin', $email, time() - 360000);
      }
    }
  }catch (PDOException $ex) {
    // header("location: index.php?sucesso=false&msg=Não foi possivel realizar login");
  }
?>