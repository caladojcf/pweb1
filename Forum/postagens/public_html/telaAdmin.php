<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }
  // elseif ($_COOKIE['testaPerfil'] == '1')
  //   header("Location: telaAdmin.php");
  // else
  //   header("Location: telaPostador.php");

  // Incluindo arquivo de conexão, saudaão e estilos
  header('Content-Type: text/html; charset=utf-8');
  include_once "conexaoPDO.php";
  include_once "saudacao.php";
  include_once "styles.php";

  if (!empty($_POST)) {
    // Selecionando postagem
    if (isset($_POST['busca'])) {
      $busca=$_POST['busca'];
      if (empty($busca)) {
        $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario ORDER BY nome_tema, titulo";
        $resultado = $bd->query($consulta);
      }
      else{
        $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE CASE WHEN '$busca' IS NOT NULL THEN titulo LIKE '%$busca%' OR nome_tema LIKE '%$busca%' ELSE true END ORDER BY nome_tema, titulo";
        $resultado = $bd->query($consulta);
      }
    }
  }
  else{
    $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario ORDER BY nome_tema, titulo";
    $resultado = $bd->query($consulta);
  }
      
    $consulta2 = "SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = '".$_SESSION['email']."'";
    $result = $bd->query($consulta2);
    $usuario = $result->fetchObject();

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <?php
      mb_internal_encoding("UTF-8");
      mb_http_output("UTF-8");
      ob_start("mb_output_handler");
      header("Content-Type: text/html; charset=UTF-8", true);
    ?>
    <title>Administrador</title>
    <script type="text/javascript">
      function goFocus(elementID){
      document.getElementById(elementID).focus();
      }
    </script>
  </head>
<body onload="goFocus('busca')">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="telaAdmin.php?" class="navbar-brand" title="Voltar à tela inicial" style="color: white;"><span class="glyphicon glyphicon-book"></span> <STRONG>Forum.net</STRONG></a>
        <a href="telaAdmin.php?" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de <?= $usuario->tipo_perfil ?>">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;<?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp;<?= ucwords($usuario->nome_usuario) ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <a href="#modalSenha"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
          <!-- <a href="#modal"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cadastrar Tema</button></a> -->
          <a href="formCadastroTema.php"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cadastrar Temas</button></a>&nbsp;
          <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
        </div>
  </nav>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <a name="topo"></a>
        <h2 id="h2">Esta é a área em que você poderá organizar o arcevo de postagens do sistema</h2>
        <!-- <form class="navbar-form navbar-right" action="" method="post">
          <input type="text" id="busca" name="busca" class="form-control" title="Busca por trecho ou por todo o título ou autor do postagem" placeholder="Buscar por título ou autor...">
        </form> -->
        <form class="navbar-form navbar-right" action="" method="post">
          <div class="col-sm-12">
            <div class="input-group">
              <input type="text" id="busca" name="busca" class="form-control" title="Busca por trecho ou por todo o título ou descrição ou autor da postagem" placeholder="Busca por título ou autor..." />
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
      <!-- <?php if (@$_GET['msg'] == 'true'): ?>
        <div class="alert alert-success" align="center" id="centro"><?=$_GET['msg'] ?></div>
      <?php else :?>
      <div class="alert alert-danger" align="center" id="centro"><?=@$_GET['msg'] ?></div>
      <?php endif ?> -->
      <?php if(@$_GET['sucesso'] == 'false'): ?>
      <div class="alert alert-danger" align="center" id="centro"><?=$_GET['msg']?></div>
      <?php elseif (@$_GET['msg']): ?>
      <div class="alert alert-success" align="center" id="normal2"><?=$_GET['msg']?></div>
      <?php endif ?>

      <h2 id="h2" align="center"><strong>Lista de Postagens</strong></h1>
      <hr>
      <?php while ($postagem = $resultado->fetchObject()):?>
      <div class="col-sm-4 col-md-4">
        <br/>
        <div class="container-fluid" id="div_content">
          <div align="center">
            <!-- <br/><a href="exibepostagemAdmin.php?id=<?= $postagem->id_postagem ?>"> <img class="img" src="postagem.php?id=<?= $postagem->id_postagem ?>" width="200" height="280" title="Clique na imagem e veja mais informações do postagem. Edite ou remova-o do nosso acervo"/></a><br/> -->
            <?php if (empty($postagem->foto)): ?>
              <br/><a href="exibePostagemAdmin.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="../img/semImagem2.png" width="100" height="100" title="Clique na imagem e veja mais informações da postagem e suas respostas"/> </a>
              <p align="center"><?= ucwords($postagem->nome_usuario) ?></p><br/>
            <?php else: ?>
              <br/><a href="exibePostagemAdmin.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100" height="100" title="Clique na imagem e veja mais informações da postagem e suas respostas"/> </a>
              <p><?= ucwords($postagem->nome_usuario) ?></p><br/>
            <?php endif ?>
          </div>
          <div class="caption">
            <div>
              <strong>Tema:&nbsp
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
            </div><br/>
          </div>
        </div>
      </div>
      <?php endwhile ?>
    </div>
  </div>
  <?= include_once "modalSenha.php" ?>
  <?=include_once"rodapeCheio.html" ?>
</body>
</html>