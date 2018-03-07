<?php
session_start();
if(!$_SESSION['logado']){
  header("Location: index.php");
}

// Incluindo arquivo de conexão e Estilo
include_once "conexaoPDO.php";
include_once "styles.php";

// Selecionando postagem
$stmt = $bd->query('SELECT * FROM tema ORDER BY nome_tema');

$stmt4 = "SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = '".$_COOKIE['ultimoLogin']."'";
$result = $bd->query($stmt4);
$usuario = $result->fetchObject();

$teste = $usuario->id_perfil;
$p = $usuario->tipo_perfil;

$tela = ($teste == 1) ? 'telaAdmin.php?' : 'telaPostador.php?';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastra Postagem</title>
</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="<?= $tela ?>" class="navbar-brand" title="Voltar à tela inicial" style="color: white;">&nbsp; &nbsp;<span class="glyphicon glyphicon-book"></span><STRONG> Forum.net</STRONG></a>
        <a href="<?= $tela ?>" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de <?= $p ?>"><span class="glyphicon glyphicon-user"></span> <?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;"><?= ucwords($usuario->nome_usuario) ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
          <a href="telaMinhas_postagens.php"><button class="btn btn-success"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Minhas Postagens</button></a>&nbsp;
          <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
        </div>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h2 id="h2" align="justify">Realize o cadastro das postagens para que o acervo esteja sempre atualizado</h2>
    </div>
  </div>
  <div class="form-group">
    <h1 id="h1h4" align="center"><strong>Cadastro de Postagens</strong></h1>
    <?php if (@$_GET['sucesso'] == 'true'): ?>
    <div class="alert alert-success msg" id="centro" align="center">Postagem cadastrada com sucesso! Deseja cadastrar outra postagem?</div>
    <?php endif ?>
    <?php if (@$_GET['sucesso'] == 'false'): ?>
    <div class="alert alert-danger msg" id="centro  " align="center"><?=@$_GET['msg']?></div>
    <?php endif ?>
    <hr>
  </div>
  <div class="container" id="centro">
    <form  enctype="multipart/form-data" id="formulario" action="cadastroPostagem.php" method="post">
        <div class="form-group">
          <div class="form-group">
            <label class="form-label">Tema</label>
            <select class="form-control" name="tema" required>
              <option value="">Selecione um Tema</option>
              <?php while ($tema = $stmt->fetchObject()): ?>
                <option value=" <?=$tema->id_tema ?>"><?=$tema->nome_tema ?></option>
              <?php endwhile ?>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Título</label>
            <input class="form-control" type="text" name="titulo" required/>
          </div>
          <div class="form-group">
            <label class="form-label">Descreva sua dúvida associada ao tema escolhido</label>
            <textarea class="form-control" name="descricao"></textarea>
          </div>
        </div>
      <button id="salvar" class="btn btn-primary" type="submit" value="Salvar"/><span class="glyphicon glyphicon-floppy-disk"></span> Enviar</button>
      &nbsp; &nbsp; <button type="button" class="btn btn-primary" value="Voltar" onClick="history.go(-1)"/><span class="glyphicon glyphicon-arrow-left"></span> Voltar</button>
    </form>
  </div>
  <?= include_once "modalSenha.php" ?>
  <?=include_once"rodapeVazio.html" ?>
</body>
</html>