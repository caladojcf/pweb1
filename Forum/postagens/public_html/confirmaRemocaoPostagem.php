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
$stmt = $bd->query('SELECT id_postagem, titulo, descricao, data_postagem, nome_tema FROM postagem JOIN tema ON postagem.fk_tema = tema.id_tema WHERE id_postagem = "'.$id.'"');

$stmt2 = $bd->query('SELECT * FROM resposta JOIN usuario ON email = email_postador WHERE id_postagem_respondida = "'.$id.'"');

$stmt3 = $bd->query('SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = "'.$_SESSION['email'].'"');
$user_cookie = $stmt3->fetchObject();
$email_usuario = $user_cookie->email;
setcookie('id_postagem', $id, time() + 36000);
setcookie('id_user', $email_usuario, time() + 36000);

$stmt4 = "SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = '".$_COOKIE['ultimoLogin']."'";
$result = $bd->query($stmt4);
$usuario = $result->fetchObject();

$teste = $usuario->id_perfil;
// $p = $usuario->tipo_perfil;

$tela = ($teste == 1) ? 'telaAdmin.php?' : 'telaPostador.php?';
$exibePostagem = ($teste == 1) ? 'exibePostagemAdmin.php?' : 'exibePostagemPostador.php?';
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
        <!-- <a href="telaAdmin.php?" class="navbar-brand" title="Você está na tela inicial" style="color: white;"><STRONG>Forum.net</STRONG></a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de postador">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Perfil: <?= $user_cookie->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp; &nbsp; &nbsp;<?= ucwords($user_cookie->nome_usuario) ?></a> -->
        <a href="<?= $tela ?>" class="navbar-brand" title="Voltar à tela inicial" style="color: white;"><span class="glyphicon glyphicon-book"></span> <STRONG>Forum.net</STRONG></a>
        <a href="<?= $tela ?>" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
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
      <p align="justify"><br/>Essa é a seção onde você poderá eliminar essa postagem do forum.</p>
    </div>
  </div>

  <div class="container">
    <div class="row">            
      <?php $postagem = $stmt->fetchObject() ?>
      <h1 id="h2">Atenção! Área de exclusão da postagem.</h1>
      <hr>
      <div class="col-sm-6 col-md-4">
        <div class="container marketing">
          <table>
            <tr>
              <td>
                <!-- <img src="postagem.php?id=<?= $postagem->id_postagem ?>" width="250" height="400" /> -->
                <?php if (empty($postagem->foto)): ?>
                  <img class="img" src="../img/semImagem2.png" width="50%"/> </a>
                <?php else: ?>
                  <img class="img" src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100%"/> </a>
                <?php endif ?>
              </td>
              <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
              <td>
                <div class="caption">
                  <h1 class="h3" align="center">Deseja mesmo excluir a postagem "<?= $postagem->titulo ?>" ?</h1>
                  <br/><br/><br/><br/>

                  <br/>&nbsp;<a href="<?= $exibePostagem ?>id=<?= $postagem->id_postagem ?>" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

                  &nbsp; &nbsp; &nbsp; <a href="removerPostagem.php?id=<?= $postagem->id_postagem ?>" class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span> Remover</button></a>
                </div>
              </td>
            </tr>
          </table>
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