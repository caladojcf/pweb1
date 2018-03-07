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
$stmt = $bd->query('SELECT id_postagem, titulo, fk_postador, descricao, data_postagem, fk_tema, usuario.nome_usuario, nome_tema FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE id_postagem = "'.$id.'"');

$stmt2 = $bd->query('SELECT * FROM resposta JOIN usuario ON resposta.email_postador = usuario.email WHERE fk_postagem_respondida = "'.$id.'"');

$stmt3 = $bd->query('SELECT * FROM usuario JOIN perfil ON perfil = id_perfil WHERE email = "'.$_SESSION['email'].'"');
$user_cookie = $stmt3->fetchObject();
$email_usuario = $user_cookie->email;
setcookie('id_postagem', $id, time() + 36000);
setcookie('id_user', $email_usuario, time() + 36000);

$consulta2 = "SELECT * FROM usuario JOIN perfil on perfil = id_perfil WHERE email = '".$_SESSION['email']."'";
$result = $bd->query($consulta2);
$usuario = $result->fetchObject();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Postagens - Postador</title>
</head>
<body>
  
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <!-- <a href="telaPostador.php?" class="navbar-brand" title="Você está na tela inicial" style="color: white;"><strong>Forum.net</strong></a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de Comentarista">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Perfil: <?= $user_cookie->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp; &nbsp; &nbsp;<?= ucwords($user_cookie->nome_usuario) ?></a> -->
        <a href="telaPostador.php?" class="navbar-brand" title="Voltar à tela inicial" style="color: white;"><span class="glyphicon glyphicon-book"></span> <STRONG>Forum.net</STRONG></a>
        <a href="telaPostador.php?" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de <?= $usuario->tipo_perfil ?>">&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;<?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp;<?= ucwords($usuario->nome_usuario) ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
          <a href="formCadastroPostagem.php"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Cadastrar Postagem</button></a>
          <a href="telaMinhas_postagens.php"><button class="btn btn-success"><span class="glyphicon glyphicon-th-list"></span>&nbsp; Minhas Postagens</button></a>&nbsp;
          <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
        </div>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <!-- <h1 id="h1h4"><?= $user_cookie->nome ?></h1> -->
      <h2 id="h2" align="justify"><br/>Nesta seção você poderá editar as informações da postagem, removê-la do sistema e visualizar as respostas</h2>
    </div>
  </div>

  <div class="container">
    <div class="row">            
      <?php $postagem = $stmt->fetchObject() ?>
      <!-- <h1><?= $postagem->titulo ?> </h1> -->
      <?php if (@$_GET['sucesso'] == 'true'): ?>
      <div class="alert alert-success" id="centroMenor" align="center"><?=@$_GET['msg']?></div><br/>
      <?php endif ?>
      <?php if (@$_GET['sucesso'] == 'false'): ?>
      <div class="alert alert-danger" id="centroMenor" align="center"><?=@$_GET['msg']?></div><br/>
      <?php endif ?>
      <h2 id="centro" align="center" style="font-size: 18px">Área de edição e remoção de postagem</h2>
      <hr>
      <div class="col-sm-6 col-md-4">
        <div class="container marketing">
          <table>
            <tr>
              <td>
                <!-- <img src="postagem.php?id=<?= $postagem->id_postagem ?>" width="250" height="400" /> -->

                <?php if (empty($postagem->foto)): ?>
                  <img class="img " src="../img/semImagem2.png" width="100" height="100"/> </a>
                  <p align="center"><?= ucwords($postagem->nome_usuario) ?></p>
                <?php else: ?>
                 <img class="img" src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100" height="100"/>
                 <p align="center"><?= ucwords($postagem->nome_usuario) ?></p> </a><br/>
                <?php endif ?>
              </td>
              <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
              <td>
                <div class="caption">
                  <h3 id="h2" align="justify"><?= $postagem->titulo ?></h3>
                  <br/><br/><br/><br/>
                <table>
                  <tr>
                    <td><b>Tema:</b></td>
                  <td><b><?= $postagem->nome_tema ?></b></td>
                  </tr>
<!--                   <tr>
                    <td><b>Autor:</b></td>
                    <td><?= ucwords($postagem->nome_usuario) ?></td>
                  </tr> -->
                  <tr>
                    <td><b>Data:</b></td>
                    <td><?= $data = date("d-m-Y à\s H:i:s", strtotime($postagem->data_postagem)); ?></td>
                  </tr>
                  <tr>
                    <td><b>Dúvida:</b></td>
                  </tr>
                  <td></td>
                </table>
                <p align="justify"><?= $postagem->descricao ?></p>
                </div>
              </td>
            </tr>
          </table>

          <!-- <br/>&nbsp;<a href="formEditarPostagem.php?busca=<?= $postagem->id_postagem ?>" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Editar</a> -->
          &nbsp; &nbsp; &nbsp; <a href="confirmaRemocaoPostagem.php?id=<?= $postagem->id_postagem ?>" class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-trash"></span> Remover</button></a>
          <hr>

          <p style="font-size: 20; font-family: Comic sans MS">&nbsp; &nbsp;<i>Respostas...</i></p>
        <?php if(!$stmt2):
          echo "<p><br/>Não há respostas para esta postagem</p>"; ?>
        <?php else: ?>
        <?php while ($resposta = $stmt2->fetchObject()): ?>
        <div class="col-sm-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <?php
                if (!empty($resposta)){
                  $data = date("d-m-Y à\s H:i:s", strtotime($resposta->data_resposta));
                  echo "
                  <br/><b>".ucwords($resposta->nome_usuario)."</b> <span class='text-muted'> em $data<br/>$resposta->descricao</span><br/>";
                }
                else{
                  echo "<p><br/>Não há respostas para esta postagem</p>";
                }
              ?>
            </div> <!-- /panel-body -->
          </div> <!-- /panel panel-default -->
        </div> <!-- /col-sm-5 -->
        <?php endwhile ?>
        <?php endif ?>
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $postagem->titulo ?></h4>
              </div>
            </div>
          </div>
        </div>  
        </div>
        <hr>
        </div>
      </div>
    </div>
    <?= include_once "modalSenha.php" ?>
    <?=include_once"rodapeVazio.html" ?>
  </body>
</html>