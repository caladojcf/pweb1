<?php
// Incluindo arquivo de conexão
header('Content-Type: text/html; charset=utf-8');
include_once "conexaoPDO.php";
include_once "styles.php";
include_once "saudacao.php";
$id = (int) $_GET['id'];

if (!empty($_COOKIE['ultimoLogin'])){
    $emailCoookie = $_COOKIE['ultimoLogin'];
  }
  else{
    $emailCoookie = "";
  }

// Selecionando postagem
$stmt = $bd->query('SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE id_postagem = "'.$id.'"');

$stmt2 = $bd->query('SELECT * FROM resposta WHERE fk_postagem_respondida = "'.$id.'"');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Postagens - Visitante</title>
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <!-- <a href="index.php?" class="navbar-brand" title="Você está na tela inicial de visitante" style="color: white;"><STRONG>Forum.net</STRONG></a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de Visitante">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Perfil: Visitante</a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp; &nbsp;<?= $saudacao ?></a> -->
        <a href="index.php?" class="navbar-brand" title="Você está na tela inicial de visitante" style="color: white;"><span class="glyphicon glyphicon-book"></span><STRONG> Forum.net</STRONG></a>
        <a href="index.php?" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de Visitante">&nbsp;<span class="glyphicon glyphicon-user"></span> Visitante</a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp; &nbsp;<?= $saudacao ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <!-- <a href="formCadastroUsuario.php"><button class="btn btn-success">Criar conta</button></a> -->
          <!-- <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal">Cadastre-se</button></a> -->
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cadastre-se</button></a>
        </div>
        <form class="navbar-form navbar-right" action="login.php" method="post">
          <div class="form-group">
            <input type="text" placeholder="E-mail"  name = "email" class="form-control" value= "<?= $emailCoookie?>">
          </div>
          <div class="form-group">
            <input type="password" placeholder="Senha" name="senha" class="form-control">
          </div>
          <!-- &nbsp;&nbsp;<button type="submit" class="btn btn-success">Entrar</button> -->
          &nbsp;&nbsp;<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Entrar</button>
        </form>
        </div>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container-fluid">
      <a name="topo"></a>
      <h1 id="h1h4" align="center"><br/>Nesta seção você poderá conferir as informações da postagem e visualizar suas respostas</h1>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <?php $postagem = $stmt->fetchObject() ?>
      <p align="center">Tema ou categoria da postagem:</p>
      <h1 id="h1h4" align="center"><em><strong><?= $postagem->nome_tema ?></strong></em></h1>
      <hr>
      <div class="col-sm-6 col-md-4">
        <div class="container marketing">
          <table>
            <tr>
              <td>
                <!-- <img src="postagem.php?id=<?= $postagem->id_postagem ?>" width="250" height="350"/> -->
                <?php if (empty($postagem->foto)): ?>
                  <img class="img" src="../img/semImagem2.png" width="100" height="100"/> </a>
                  <p align="center"><?= ucwords($postagem->nome_usuario) ?></p><br/>
                <?php else: ?>
                  <img class="img" src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100" height="100"/> </a>
                  <p align="center"><?= ucwords($postagem->nome_usuario) ?></p><br/>
                <?php endif ?>
              </td>
              <td>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
              </td>
              <td>
                <div class="caption">
                  <table>
                    <tr>
                      <td><strong>Título: </strong></td>
                      <td><b><?= $postagem->titulo ?></b></td>
                    </tr>
                    <tr>
                      <td><strong>Postado em: </strong></td>
                      <td><?= $data = date("d-m-Y à\s H:i:s", strtotime($postagem->data_postagem)); ?></td>
                    </tr>
                    <tr>
                      <td><strong>Dúvida: </strong></td>
                    </tr>
                    <td></td>
                    <td><?= "<p align='justify'>$postagem->descricao</p>" ?></td>
                  </table>
                </div>
              </td>
            </tr>
          </table>
          <hr>

          <!-- Comentários do postagem -->
          <p style="font-size: 20; font-family: Comic sans MS">&nbsp; &nbsp; <i>Respostas...</i></p>
          <?php if(!$stmt2):
          echo "<p><br/>Não há respostas para esta postagem</p>"; ?>
          <?php else: ?>
          <?php while ($resposta = $stmt2->fetchObject()): ?>
          <?php $stmt3 = $bd->query('SELECT * FROM Usuario WHERE email = "'.$resposta->email_postador.'"');
            $usuario = $stmt3->fetchObject();
          ?>

          <div class="col-sm-5">
            <div class="panel panel-default">
              <div class="panel-heading">
                <?php
                  if (!empty($resposta)){
                    $data = date("d-m-Y à\s H:i:s", strtotime($resposta->data_resposta));
                    echo "
                    <br/><strong>".ucwords($usuario->nome_usuario)."</strong> <span class='text-muted'> em $data<br/>$resposta->descricao</span><br/>";
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
                    <!-- <div class="modal-body">
                      <iframe width="100%" height="445" src="https://www.youtube.com/embed/<?= $postagem->linkTrailer ?>?controls=1">
                      </iframe>
                    </div> -->
                    <!-- <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          <hr>
        </div>
      </div>
    </div>
    <?= include_once "modal.php" ?>
    <?= include_once"rodapeVazio.html" ?>
  </body>
</html>