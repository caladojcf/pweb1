<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }

  // Incluindo arquivo de conexão e estilos
  header('Content-Type: text/html; charset=utf-8');
  include_once "conexaoPDO.php";
  include_once "styles.php";

  // Selecionando postagem
  $stmt1 = $bd->query('SELECT * FROM tema');
  
  $id = (int) $_GET['busca'];
  $stmt2 = $bd->query('SELECT * FROM postagem JOIN usuario ON fk_postador = id_usuario  WHERE id_postagem="'.$id.'"');
  $postagem = $stmt2->fetchObject();

  $stmt3 = $bd->query('SELECT * FROM tema WHERE id_tema="'.$postagem->fk_tema.'"');
  $temaAtual = $stmt3->fetchObject();

  $stmt4 = "SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = '".$_COOKIE['ultimoLogin']."'";
  $result = $bd->query($stmt4);
  $usuario = $result->fetchObject();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" lang="pt-br">
    <title>Edição de Postagem</title>
    <style>
      .display{
        display: none;
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <!-- <a href="telaAdmin.php?" class="navbar-brand" title="Voltar à tela inicial" style="color: white;"><STRONG>Forum.net</STRONG></a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de Comentarista">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Perfil: <?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp; &nbsp; &nbsp;<?= ucwords($usuario->nome_usuario) ?></a> -->
        <a href="<?= $tela ?>" class="navbar-brand" title="Voltar à tela inicial" style="color: white;"><span class="glyphicon glyphicon-book"></span> <STRONG>Forum.net</STRONG></a>
        <a href="telaAdmin.php?" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de <?= $usuario->tipo_perfil ?>">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;<?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp;<?= ucwords($usuario->nome_usuario) ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div class="navbar-form navbar-right">
            <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
            <!-- <a href="formCadastropostagem.php?"><button class="btn btn-success">Cadastrar postagem</button></a> -->
            <!-- <a href="telaAdmin.php?"><button class="btn btn-success">Tela Inicial</button></a> -->
            <!-- <a class="btn btn-success" href="sair.php">Sair</a> -->
            <a href="formCadastropostagem.php"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cadastrar Postagem</button></a>
            <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
          </div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h2 id="h2" align="justify">Nesta seção você poderá editar as informações da postagem, de modo a deixá-la atualizada</h2>
      </div>
    </div>
    <div class="container">
      <?php if (@$_GET['sucesso'] == 'true'): ?>
      <div class="alert alert-success msg" id="centro">Postagem editada com sucesso!</div>
      <?php endif ?>
      <?php if (@$_GET['sucesso'] == 'false'): ?>
      <div class="alert alert-danger msg" id="centro"><?=@$_GET['msg']?></div>
    <?php endif ?>
      <h1 id="h1h4" align="center"><strong>Editar informações da postagem</strong></h1>
      <hr>
      <form enctype="multipart/form-data" id="formulario" action="editandoPostagem.php?id=<?= $postagem->id_postagem ?>" method="post">
        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <br><br/><br/>
              <!-- <img src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100%"/> -->
              <?php if (empty($postagem->foto)): ?>
                <img class="img" src="../img/semImagem2.png" width="50%"/> </a>
              <?php else: ?>
                <img class="img" src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100%"/> </a>
              <?php endif ?>
            </div>
            <div class="col-md-8">
              
             <!--  <div class="form-group">
                <label class="form-label">Imagem</label>
                <input class="form-control" type="file" name="foto"/>
              </div> -->
              <div class="form-group">
                <label class="form-label">Título</label>
                <input class="form-control" value="<?= $postagem->titulo ?>" type="text" name="titulo" required/>
              </div>
              <div class="form-group">
                <label class="form-label">Autor</label>
                <p class="form-control"><?= ucwords($postagem->nome_usuario) ?></p>
              </div>
              <div class="form-group">
                <label class="form-label">Data</label>
                <p class="form-control"><?= $data = date("d-m-Y à\s H:i:s", strtotime($postagem->data_postagem)) ?></p>
              </div>
              <div class="form-group">
                <label class="form-label">Tema atual:</label>
                <p class="form-control"><?= $temaAtual->nome_tema?></p>
              </div>
              <!-- <div class="form-group">
                <label class="form-label">Temas disponíveis para alteração:</label>
                <select class="form-control" name="tema">
                  <?php while ($tema = $stmt1->fetchObject()): ?>
                  <option value="<?= $tema->id_tema ?>"> <?= $tema->nome_tema ?> </option>
                  <?php endwhile ?>
                </select>
              </div> -->
              <div class="form-group">
                <label class="form-label">Descrição</label>
                <textarea class="form-control" name="descricao" rows="4" required=""><?=$postagem->descricao ?></textarea>
              </div>
              <button id="salvar" class="btn btn-primary" type="submit" value="Salvar"/><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
              &nbsp; &nbsp; <button type="button" class="btn btn-primary" value="Voltar" onClick="history.go(-1)"/><span class="glyphicon glyphicon-arrow-left"></span> Voltar</button>
            </div>
          </div>
        </div>
      </form><br/>
    </div>
    <?= include_once "modalSenha.php" ?>
    <?=include_once"rodapeVazio.html" ?>
  </body>
</html>