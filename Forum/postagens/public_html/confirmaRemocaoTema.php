<?php
session_start();
if(!$_SESSION['logado']){
    header("Location: index.php");
  }
  
// Incluindo arquivo de conexão e estilos
header('Content-Type: text/html; charset=utf-8');
include_once "conexaoPDO.php";
include_once "styles.php";
$id = (int) $_GET['id'];

// Selecionando Postagem
$stmt = $bd->query('SELECT * FROM tema WHERE id_tema = "'.$id.'"');

$stmt2 = "SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = '".$_COOKIE['ultimoLogin']."'";
$result = $bd->query($stmt2);
$usuario = $result->fetchObject();

$teste = $usuario->id_perfil;
// $p = $usuario->tipo_perfil;

// $tela = ($teste == 1) ? 'telaAdmin.php?' : 'telaPostador.php?';
// $exibePostagem = ($teste == 1) ? 'exibePostagemAdmin.php?' : 'exibePostagemPostador.php?';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Exclusao de Postagens</title>
</head>
<body>
  
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
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
          <?= ($teste == 1) ? "<a href='formCadastroTema.php'><button class='btn btn-success'><span class='glyphicon glyphicon-pencil'></span>&nbsp;Cadastrar Tema</button></a>" : "
          <a href='formCadastroPostagem.php'><button class='btn btn-success'><span class='glyphicon glyphicon-pencil'></span>&nbsp; Cadastrar Postagem</button></a>
          <a href='telaMinhas_postagens.php'><button class='btn btn-success'><span class='glyphicon glyphicon-th-list'></span>&nbsp; Minhas Postagens</button></a>&nbsp;"
           ?>
          <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
        </div>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <p align="center"><br/>Essa é a seção onde você poderá eliminar um tema do forum.</p>
    </div>
  </div>

  <div class="container">
    <div class="row">            
      <?php $tema = $stmt->fetchObject() ?>
      <h1 id="h2" align="center">Atenção! Área de exclusão de tema.</h1>
      <hr>
      <div class="col-sm-6 col-md-4">
        <div class="container marketing">
          <div class="caption" align="center">
            <h1 class="h3" align="center">Deseja mesmo excluir o tema "<?= $tema->nome_tema ?>" ?<br/><br/>Se esse tema for excluído, todas as postagens associadas a ele serão perdidas!</h1>
            <br/><br/><br/>
            <a href="formCadastroTema.php" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            &nbsp; &nbsp; &nbsp; <a href="removerTema.php?id=<?= $tema->id_tema ?>" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span> Remover</button></a>
          </div>
          <hr>
        </div>
        <hr>
        </div>
      </div>
    </div>
    <?= include_once "modalSenha.php" ?>
    <?=include_once"rodapeVazio.html" ?>
  </body>
</html>