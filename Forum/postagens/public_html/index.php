<?php
 
  // Incluindo arquivo de conexão
  header('Content-Type: text/html; charset=utf-8');
  include_once "conexaoPDO.php";
  include_once "saudacao.php";
  include_once "styles.php";
      
  if (!empty($_COOKIE['ultimoLogin'])){
    $emailCoookie = $_COOKIE['ultimoLogin'];
  }
  else{
    $emailCoookie = "";
  }
  if (!empty($_POST)) {
    // Selecionando Postagem
    if (isset($_POST['busca'])) {
      $busca = $_POST['busca'];
      if (empty($busca)) {
        $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario ORDER BY nome_tema, titulo";
        $resultado = $bd->query($consulta);
      }
      else{
        // $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE CASE WHEN '$busca' IS NOT NULL THEN postagem.nome_tema LIKE '%$busca%' OR postagem.titulo LIKE '%$busca%' ELSE true END ORDER BY titulo";
        $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE CASE WHEN '$busca' IS NOT NULL THEN titulo LIKE '%$busca%' OR nome_tema LIKE '%$busca%' ELSE true END ORDER BY nome_tema, titulo";
        $resultado = $bd->query($consulta);
      }
    }
  }
  else{
    $consulta = "SELECT * FROM postagem JOIN tema ON fk_tema = id_tema JOIN usuario ON fk_postador = id_usuario WHERE fk_tema = id_tema ORDER BY nome_tema, titulo";
    $resultado = $bd->query($consulta);
  }
  // $stmt = $bd->prepare('SELECT id_postagem, fk_postador FROM postagem JOIN usuario ON fk_postador = id_usuario WHERE id_postagem = :id');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forum - Página inicial</title>

  <style> #esq{ float: left;} </style>

  <script type="text/javascript">
    function goFocus(elementID){
      document.getElementById(elementID).focus();
    }
  </script>

  <style>
    .figuras{
      display:inline-block;
      padding-left:24px;
      line-height:16px;
      background-position:2px center;
      background-repeat:no-repeat;
      background-image:url(../images/lupa.png);
    }
</style>
</head>
<body onload="goFocus('busca')">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="index.php?" class="navbar-brand" title="Você está na tela inicial de visitante" style="color: white;"><span class="glyphicon glyphicon-book"></span><STRONG> Forum.net</STRONG></a>
        <a href="index.php?" class="navbar-brand" title="Permanecer na tela inicial">&nbsp;<span class="glyphicon glyphicon-home"></span> Início</a>
        <a class="navbar-brand" title="Você está acessando com perfil de Visitante">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class="glyphicon glyphicon-user"></span> Visitante</a>
        <a id="h1h4" class="navbar-brand" style="color: white;">&nbsp; &nbsp;<?= $saudacao ?></a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-form navbar-right">
          <!-- <a href="formCadastroUsuario.php"><button class="btn btn-success">Criar conta</button></a> -->
          <a href="#modal"><button class="btn btn-primary" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Cadastre-se</button></a>
        </div>
        <form class="navbar-form navbar-right" action="login.php" method="post">
          <div class="form-group">
            <input type="text" placeholder="E-mail"   name="email" class="form-control" value="<?= $emailCoookie?>">
          </div>
          <div class="form-group">
            <input type="password"  placeholder="Senha" name="senha" class="form-control">
          </div>
          <!-- &nbsp;&nbsp;<button type="submit" class="btn btn-success">Entrar</button> -->
          &nbsp;&nbsp;<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;Entrar</button>
        </form>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container" >
      <a name="topo"></a>
      <!-- <h1 id="h1h4"><strong><?= $saudacao ?></strong></h1> -->
      <h2 id="h2" align="justify">Seja bem-vindo a esse ambiente de troca de conhecimentos e aprendiagem onde você poderá enriquecer seus conhecimentos e saber quais postagens foram mais lidas. Navegue à vontade, se cadastre e interaja através das postagens e também deixe o sua resposta sobre o tema que mais lhe agradou.</h2>
      <form class="navbar-form navbar-right" action="" method="post">
        <div class="col-sm-12">
          <div class="input-group">
            <input type="text" id="busca" name="busca" class="form-control" title="Busca por trecho ou por todo o título ou tema da postagem" placeholder="Busca por título ou tema..." />
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
        if (isset($_SESSION['mensagem'])){
          var_dump($_SESSION['mensagem']);
          if ($_SESSION['teste']) {
            $alert_type = "success";
          }
          else{
            $alert_type = "danger";
          } 
          echo '<div class="alert alert-'.$alert_type.'"  align="center" id="normal2">'.$_SESSION['mensagem'].'</div>';
          $_SESSION['mensagem'] = NULL;
          $_SESSION['teste'] = NULL;
        }
      ?> -->
      <h2 id="h2" align="center"><strong>Lista de Postagens</strong></h1>
      <hr>
      <?php while ($postagem = $resultado->fetchObject()):?>
      <div class="col-sm-4 col-md-4">
        <br/>
        <div class="container-fluid" id="div_content">
          <div align="center">
            <?php if (empty($postagem->foto)): ?>
              <br/><a href="exibePostagemVisitante.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="../img/semImagem2.png" width="100" height="100" title="Clique na imagem e veja mais informações do postagem e os comentários sobre ele"/> </a><br/>
              <p><?= ucwords($postagem->nome_usuario) ?></p>
            <?php else: ?>
              <br/><a href="exibePostagemVisitante.php?id=<?= $postagem->id_postagem ?>"> <img class="img " src="postagem.php?id=<?= $postagem->id_postagem ?>" width="100" height="100" title="Clique na imagem e veja mais informações da postagem e suas respostas"/> </a><br/>
              <p><?= ucwords($postagem->nome_usuario) ?></p>
            <?php endif ?>
          </div>
          <div class="caption">
            <div>
              <td><b><br/>Tema:&nbsp;</b></td>
              <td><b><?= $postagem->nome_tema ?></b></td>
            </div>
            <div>
              <td><b>Título: </b></td>
              <td><?= $postagem->titulo ?></td>
            </div>
            <!-- <tr>
              <td><b>Autor:</b></td>
              <td><?= ucwords($postagem->nome_usuario) ?></td>
            </tr> -->
            <tr> 
              <td><b>Postado em:</b></td>
              <td><?= $data = date("d-m-Y à\s H:i:s", strtotime($postagem->data_postagem)); ?></td>
              <p></p>
            </tr>
          </div> 
        </div>
      </div>
      <?php endwhile ?>
    </div>
  </div>
  <?= include_once "modal.php" ?>
  <?= include_once"rodapeCheio.html" ?>
</body>
</html>