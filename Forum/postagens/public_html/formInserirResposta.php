<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }
  
  // Incluindo arquivos de conexão e de estilos
  include_once "conexaoPDO.php";
  include_once "styles.php";

  $id = (int) $_GET['id'];

  // Selecionando Postagem
  $stmt = $bd->query('SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE id_postagem = "'.$id.'"');

  // $dsn = mysql_set_charset("UTF8");
  $stmt2 = $bd->query("SELECT * FROM resposta JOIN usuario ON email_postador = email WHERE fk_postagem_respondida = '$id'");

  $stmt3 = $bd->query('SELECT * FROM usuario WHERE email = "'.$_SESSION['email'].'"');
  $userCookie = $stmt3->fetchObject();
  $email_usuario = $userCookie->email;
  setcookie('id_postagem', $id, time() + 36000);
  setcookie('id_user', $email_usuario, time() + 36000);

  $consulta2 = "SELECT * FROM usuario JOIN perfil on perfil = id_perfil WHERE email = '".$_SESSION['email']."'";
  $result = $bd->query($consulta2);
  $usuario = $result->fetchObject();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" lang="pt-br">
  <title>Postagem do Postador</title>
  <script>
    if ($_COOKIE['addFavorito'] == 0) {
      alert("Postagem não adicionado!<br/>Já estava em sua lista de favorito.");
    }
  </script>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <!-- <a class="navbar-brand" href="telaComentarista.php" title="Voltar à tela inicial"><STRONG>postagem Social</STRONG></a> -->
        <a href="telaPostador.php?" class="navbar-brand" title="Voltar à Tela Inicial" style="color: white;"><span class="glyphicon glyphicon-book"></span><STRONG> Forum.net</STRONG></a>
        <a href="telaPostador.php?" class="navbar-brand" title="Ir para a tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a id="msg" class="navbar-brand" title="Você está acessando com perfil de Postador">&nbsp; &nbsp;<span class="glyphicon glyphicon-user"></span> <?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp;<?= ucwords($usuario->nome_usuario) ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Alterar Senha</button></a>&nbsp;
          <a href="formCadastroPostagem.php"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cadastrar Postagem</button></a>
          <a href="telaMinhas_postagens.php"><button class="btn btn-success"><span class="glyphicon glyphicon-th-list"></span>&nbsp;Minhas Postagens</button></a>&nbsp;
          <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp;Sair</button></a>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <div>
      <h2 align="justify" id="h2"><br/>Esta é a área onde você poderá adicionar esta postagem à sua lista de favoritos. Aqui você também poderá deixar sua resposta sobre ele, para que outros navegantes possam aumentar seus conhecimentos</h2>
      </div>
    </div>
  </div> <!-- /jumbotron -->
  <div class="container">
    <div class="row">
      <h3 id="h3" align="center">Logo abaixo você poderá adicionar esta postagem aos seus favoritos, caso ainda não o tenha feito, bem como deixar suas respostas</h3>
      <hr>
      <?php $postagem = $stmt->fetchObject() ?>
    <div class="col-sm-6 col-md-4">
      <div class="container marketing">
        <?php if (@$_GET['msg']): ?>
          <div class="alert alert-danger"  align="center" id="centroMenor"><?=$_GET['msg']?></div>
        <?php endif ?>
        <?php if (@$_GET['msgs']): ?>
          <div class="alert alert-success"  align="center" id="centroMenor"><?=$_GET['msgs']?></div>
        <?php endif ?>
        <!-- <?php 
          if ($_SESSION['mensagem']){
            if ($_SESSION['teste']) {
              $alert_type = "success";
            }
            else{
              $alert_type = "danger";
            } 
            echo '<div class="alert alert-'.$alert_type.'"  align="center" id="centroMenor">'.$_SESSION['mensagem'].'</div>';
            $_SESSION['mensagem'] = NULL;
            $_SESSION['teste'] = NULL;
          }
        ?> -->
        <table>
          <tr>
            <td>
              <div>
                <!-- <img src="postagem.php?id=<?= $postagem->id_postagem ?>" width="250" height="350" /> -->
                <?php if (empty($postagem->foto)): ?>
                  <img class="img" src="../img/semImagem2.png" width="100" height="100"/> </a>
                  <p align="center"><?= ucwords($postagem->nome_usuario) ?></p>
                <?php else: ?>
                  <img class="img" src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100" height="100"/> </a>
                  <p align="center"><?= ucwords($postagem->nome_usuario) ?></p>
                <?php endif ?>
              </div>
            </td>
            <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
            <td>
              <div class="caption">
                <h4 align="right" id="h1h4"><strong><em><?= $postagem->titulo ?></em></strong></h4>
                <br/><br/><br/><br/>
                <table>
                  <tr>
                    <td><b>Tema:</b></td>
                    <td><b><?= $postagem->nome_tema ?></b></td>
                  </tr>
                  <!-- <tr>
                    <td><b>Autor: </b></td>
                    <td><?= ucwords($postagem->nome_usuario) ?></td>
                  </tr> -->
                  <tr>
                    <td><b>Postado em: </b></td>
                    <td><?= $data = date("d-m-Y à\s H:i:s", strtotime($postagem->data_postagem)); ?></td>
                  </tr>
                  <tr>
                    <td><b>Dúvida:</b></td>
                  </tr>
                  <td></td>
                  <td><p align="justify"><?= $postagem->descricao ?></p></td>
                </table>
              </div>
            </td>
          </tr>
        </table>

        <!-- <br/><a href="addFavoritos.php"><button class="btn btn-primary" type="submit">AddFavoritos</button></a> -->
        <!-- <br/><a href="addMinhas_postagens.php"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-plus"></span> Add MinhasPostagens</button></a> -->
        <hr>
        <form action="addResposta.php" method="post">
          <div class='form-group'>
            <label style="font-size: 20; font-family: Comic sans MS"><i>Insira aqui sua resposta...</i></label>
            <textarea name="resposta" class="form-control" rows="5" style="width: 70%; height: 8%"></textarea>
            <!-- <br/><button class="btn btn-primary" type="submit">AddComentário</button> -->
            <br/><a href="addResposta.php"><button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-plus"></span> Add Resposta</button></a>
          </div>
        </form>
        <hr>

        <p style="font-size: 20; font-family: Comic sans MS">&nbsp; &nbsp; <em>Respostas...</em></p>
        <?php while ($resposta = $stmt2->fetchObject()): ?>
        <div class="col-sm-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <?php
                if (!empty($resposta)){
                  $data = date("d-m-Y à\s H:i:s", strtotime($resposta->data_resposta));
                  echo "
                  <br/><strong>".ucwords($resposta->nome_usuario)."</strong> <span class='text-muted'> em $data<br/>".ucfirst($resposta->descricao)."</span><br/>";
                }
                else{
                  echo "<p><br/>Não há comentários nesta seção</p>";
                }
              ?>
            </div> <!-- /panel-body -->
          </div> <!-- /panel panel-default -->
        </div> <!-- /col-sm-5 -->
        <?php endwhile ?>

      </div>
    </div>
  </div>
  </div>
  <?=include_once "modalSenha.php" ?>
  <?=include_once"rodaPeVazio.html" ?>
</body>
</html>