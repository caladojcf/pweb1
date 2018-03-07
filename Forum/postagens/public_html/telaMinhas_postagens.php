<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }

  header('Content-Type: text/html; charset=utf-8');
  include_once "conexaoPDO.php";
  include_once "saudacao.php";
  include_once "styles.php";
  
  // $id_user = $_COOKIE['id_user'];
  $id_user = $_COOKIE['ultimoLogin'];
  // $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE usuario.email = '$id_user' ORDER BY titulo";
  // $resultado = $bd->query($consulta);

  // $consulta2 = "SELECT * FROM usuario WHERE email = '".$id_user."'";
  $consulta2 = "SELECT * FROM usuario JOIN perfil on perfil = id_perfil WHERE email = '".$_SESSION['email']."'";
  $result = $bd->query($consulta2);
  $usuario = $result->fetchObject();

  if (!empty($_POST)) {
    // Selecionando postagem
    if (isset($_POST['busca'])) {
      $busca=$_POST['busca'];
      if (empty($busca)) {
        $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE usuario.email = '$id_user' ORDER BY nome_tema, titulo";
        $resultado = $bd->query($consulta);
      }
      else{
        $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE usuario.email = '$id_user' AND CASE WHEN '$busca' IS NOT NULL THEN titulo LIKE '%$busca%' OR nome_tema LIKE '%$busca%' ELSE true END ORDER BY nome_tema, titulo";
        $resultado = $bd->query($consulta);
      }
    }
  }
  else{
    $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE usuario.email = '$id_user' ORDER BY nome_tema, titulo";
    $resultado = $bd->query($consulta);
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Minhas Postagens</title>
  <script type="text/javascript">
    function goFocus(elementID){
      document.getElementById(elementID).focus();
    }
  </script>
</head>
<body onload="goFocus('busca')">
  <nav class="navbar navbar-inverse navbar-fixed-top navbar-left">
    <div class="container-fluid">
      <div class="col-sm-12 col-md-12">
        <div class="navbar-header">
          <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> -->
          <a href="telaPostador.php?" class="navbar-brand" title="Vooltar para a tela inicial do Postador" style="color: white;"><span class="glyphicon glyphicon-book"></span><STRONG> Forum.net</STRONG></a>
          <a href="telaPostador.php?" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
          <a id="msg" class="navbar-brand" title="Você está acessando com perfil de Postador"><span class="glyphicon glyphicon-user"></span> <?= $usuario->tipo_perfil ?></a>
          <a id="h1h4" class="navbar-brand" style="color: white;"><?= $usuario->nome_usuario ?></a>
        </div>
        <!-- <div id="navbar" class="navbar-collapse collapse"> -->
          <div class="navbar-form navbar-right">
            <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
            <a href="formCadastroPostagem.php"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cadastrar Postagem</button></a>
            <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
          </div>
        <!-- </div> -->
      </div>
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <!-- <h2><?= $saudacao ?>, <?= $usuario->nome ?></h2> -->
      <!-- <h1 id="h1h4"><strong><?= $usuario->nome ?></strong></h1> -->
      <h2 id="h2">Essa seção é destinada à exibição de sua lista de postagens</h2>
      <form class="navbar-form navbar-right" action="" method="post">
        <div class="col-sm-12">
          <div class="input-group">
            <input type="text" id="busca" name="busca" class="form-control" title="Busca por trecho ou por todo o título ou tema da postagem" placeholder="Busca por título ou tema..." />
            <span class="input-group-addon">
              <button style="background:transparent;border:none; border-radius: 10px;">&#128269;</button>
            </span>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <h2 align="center" id="h2"><strong>Minhas Postagens</strong></h2>
      <hr>
      <?php while ($postagem = $resultado->fetchObject()): ?>
        <div class="col-sm-4 col-md-4">
          <br/>
          <div class="container-fluid" id="div_content">
            <div align="center">
              <!-- <br/><a><img class="img" src="postagem.php?id=<?= $postagem->id_postagem ?>" width="180" height="250" /></a><br/> -->
              <!-- <br/><a href="formInserirComentario.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="postagem.php?id=<?= $postagem->id_postagem ?>" width="150" height="200" title="Clique na imagem e veja mais informações do postagem e faça seus comentários"/> </a><br/> -->

            <?php if (empty($postagem->foto)): ?>
              <br/><a href="exibePostagemPostador.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="../img/semImagem2.png" width="100" height="100" title="Clique na imagem e veja mais informações da postagem e suas respostas"/> </a><br/>
              <p><?= ucwords($postagem->nome_usuario) ?></p>
            <?php else: ?>
              <br/><a href="exibePostagemPostador.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100" height="100" title="Clique na imagem e veja mais informações da postagem e suas respostas"/> </a><br/>
              <p><?= ucwords($postagem->nome_usuario) ?></p>
            <?php endif ?>
            </div>
            <div class="caption">
              <div>
                <strong><br/>Tema:&nbsp
                <?= $postagem->nome_tema ?></strong>
              </div>
              <div>
                <strong>Título: </strong>
                <?= $postagem->titulo ?>
              </div>
              <!-- <div>
                <strong>Autor: </strong>
                <td><?= ucwords($postagem->nome_usuario) ?></td>
              </div> -->
              <div>
                <strong>Postado em: </strong>
                <?= $data = date("d-m-Y à\s H:i:s", strtotime($postagem->data_postagem)); ?>
                <p></p>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  </div>
  <?=include_once "modalSenha.php" ?>
  <?=include_once"rodapeVazio.html" ?>
</body>
</html>