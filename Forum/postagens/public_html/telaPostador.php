<?php
  session_start();
  if(!$_SESSION['logado']){
    header("Location: index.php");
  }
  // elseif ($_COOKIE['testaPerfil'] == '1')
  //   header("Location: telaAdmin.php");
  // else
  //   header("Location: telaPostador.php");

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

  //Trazendo o nome do usuário
  // $consulta3 = "SELECT nome_usuario FROM usuario JOIN postagem ON id_usuario = fk_postador";
  // $res = $bd->query($consulta3);
  // $user = $res->fetchObject();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Postador</title>
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
        <a href="telaPostador.php?" class="navbar-brand" title="Você está na tela inicial do Postador" style="color: white;"><span class="glyphicon glyphicon-book"></span><STRONG> Forum.net</STRONG></a>
        <a href="index.php?" class="navbar-brand" title="Permanecer na tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a class="navbar-brand" title="Você está acessando com perfil de Postador">&nbsp; &nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp; <?= $usuario->tipo_perfil ?></a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp;<?= $saudacao ?>, <?= ucwords($usuario->nome_usuario) ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Alterar Senha</button></a>&nbsp;
          <a href="formCadastroPostagem.php"><button class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span>&nbsp; Cadastrar Postagem</button></a>
          <!-- <a class="btn btn-success" href="telaFavoritos.php">Meus Favoritos</a>&nbsp; -->
          <a href="telaMinhas_postagens.php"><button class="btn btn-success"><span class="glyphicon glyphicon-th-list"></span>&nbsp; Minhas Postagens</button></a>&nbsp;
          <!-- <a class="btn btn-success" href="sair.php">Sair</a> -->
          <a href="sair.php"><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span>&nbsp; Sair</button></a>
        </div>
      </div>
    </div>
  </nav>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <a name="topo"></a>
        <!-- <h1 id="h1h4"><strong><?= $saudacao ?>, <?= ucwords($usuario->nome) ?></strong></h1> -->
        <h2 id="h2">Fique à vontade para compulsar a variada seleção das melhores postagens da web. Você também pode respondê-las, além de visualizar sua lista de postagens</h2>
        <!-- <form class="navbar-form navbar-right" action="" method="post">
          <input type="text" id="busca" name="busca" class="form-control" title="Busca por trecho ou por todo o título ou autor do postagem" placeholder="Buscar por título ou autor...">
        </form> -->
        <form class="navbar-form navbar-right" action="" method="post">
          <div class="col-sm-12">
            <div class="input-group">
              <input type="text" id="busca" name="busca" class="form-control" title="Busca por trecho ou por todo o título ou autor do postagem" placeholder="Busca por título ou autor..." />
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
      <?php if(@$_GET['sucesso'] == 'false'): ?>
      <div class="alert alert-danger" align="center" id="centro"><?=$_GET['msg']?></div>
      <?php elseif (@$_GET['msg']): ?>
      <div class="alert alert-success" align="center" id="normal2"><?=$_GET['msg']?></div>
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
      <h2 align="center" id="h2"><strong>Lista de postagens</strong></h2>
      <hr>
      <?php while ($postagem = $resultado->fetchObject()): ?>
      <div class="col-sm-4 col-md-4">
        <br/>
        <div class="container-fluid" id="div_content">
          <div align="center">
            <!-- <br/><a href="formInserirPostagem.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="postagem.php?id=<?= $postagem->id_postagem ?>" width="200" height="250" title="Clique na imagem e veja mais informações do postagem. Faça seus comentários e o adicione aos seus favoritos"/> </a><br/> -->
            <?php if (empty($postagem->foto)): ?>
              <br/><a href="formInserirResposta.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="../img/semImagem2.png" width="100" height="100" title="Clique na imagem e veja mais informações da postagem e suas respostas"/> </a><br/>
              <p><?= ucwords($postagem->nome_usuario) ?></p>
            <?php else: ?>
              <br/><a href="formInserirResposta.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100" height="100" title="Clique na imagem e veja mais informações da postagem e suas respostas"/> </a><br/>
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
  <?=include_once "rodaPeCheio.html" ?>
</body>
</html>