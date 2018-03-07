<?php
session_start();
if(!$_SESSION['logado']){
  header("Location: index.php");
}

// Incluindo arquivo de conexão e Estilo
include_once "conexaoPDO.php";
include_once "styles.php";

// Selecionando postagem
$stmt = "SELECT * FROM tema WHERE id_tema = '".$_GET['id']."'";
$resultado = $bd->query($stmt);
$tema = $resultado->fetchObject();

$stmt4 = "SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = '".$_COOKIE['ultimoLogin']."'";
$result = $bd->query($stmt4);
$usuario = $result->fetchObject();

// $teste = $usuario->id_perfil;
// $p = $usuario->tipo_perfil;

// if ($teste == 1) 
//   $tela = 'telaAdmin.php?';
// else
//   $tela = 'telaPostador.php?';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastra Tema</title>
</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="telaAdmin.php?" class="navbar-brand" title="Voltar à tela inicial" style="color: white;"><span class="glyphicon glyphicon-book"></span> <STRONG>Forum.net</STRONG></a>
        <a href="telaAdmin.php?" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de <?= $p ?>">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;<?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp;<?= ucwords($usuario->nome_usuario) ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
          <!-- <a href="telaAdmin.php?"><button class="btn btn-success">Tela Inicial</button></a> -->
          <!-- <a class="btn btn-success" href="sair.php">Sair</a> -->
          <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
        </div>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h2 id="h2" align="center"><br/>Área exclusiva do administrador para cadastro de temas</h2>
    </div>
  </div>
  <div class="form-group">
    <h1 id="h1h4" align="center"><strong>Cadastro de Temas</strong></h1>
    <?php if (@$_GET['sucesso'] == 'true'): ?>
    <div class="alert alert-success msg" id="centro" align="center">Tema cadastrado com sucesso! Deseja cadastrar outr tema?</div>
    <?php endif ?>
    <?php if (@$_GET['sucesso'] == 'false'): ?>
    <div class="alert alert-danger msg" id="centro" align="center"><?=@$_GET['msg']?></div>
    <?php endif ?>
    <hr>
  </div>
  <div class="container" id="centro">
    <form id="formulario" action="editarTema.php" method="post">
        <div class="form-group">
          <div class="form-group">
            <label class="form-label">Título do Tema</label>
            <input class="form-control" type="text" value="<?= $tema->nome_tema ?>" name="tema" required/>
            <input class="form-control" type="hidden" value="<?= $tema->id_tema ?>" name="id">
          </div>
        </div>
      <button id="salvar" class="btn btn-primary" type="submit" value="Salvar"/><span class="glyphicon glyphicon-floppy-disk"></span> Salvar</button>
      &nbsp; &nbsp; <button type="button" class="btn btn-primary" value="Voltar" onClick="history.go(-1)"/><span class="glyphicon glyphicon-arrow-left"></span> Voltar</button>
    </form>
  </div>
  <?= include_once "modalSenha.php" ?>
</body>
</html>