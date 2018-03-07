<?php
  date_default_timezone_set('America/Recife');
  
  define("DIR",__DIR__."/../");
  include_once (DIR.'/lib/Psr4AutoloaderClass.php');
  $autoload = new \Example\Psr4AutoloaderClass();
  $autoload->register();
  $autoload->addNamespace("br\com\app", DIR."/postagens-app/src");
  include_once DIR."/postagens-app/bootstrap.php";
  
  $dsn = "mysql: host=localhost; dbname=forum; charset=utf8; SET character_set_connection=utf8; SET character_set_client=utf8; SET character_set_results=utf8";
  $bd = new PDO($dsn, "root", "", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
  $bd->exec("set names utf8");

  
  // $dsn = mysql_connect("localhost", "root", ""); //("servidor", "usuário", "senha" definidos no banco) de dados)
  
  // mysql_query("SET NAMES 'utf8'");
  // mysql_query("SET character_set_connection=utf8");
  // mysql_query("SET character_set_client=utf8");
  // mysql_query("SET character_set_results=utf8");
  
  // if ($dsn){
  //   mysql_select_db("livro_social"); //seleção do banco de dados
  // }
  // else{
  // echo "Conexão com o banco de dados falhou, tente novamente.";
  // }
  

  // header('Content-Type: text/html; charset=utf-8');
  // mysql_query('SET character_set_connection=utf8');
  // mysql_query('SET character_set_client=utf8');
  // mysql_query('SET character_set_results=utf8');

    // mb_internal_encoding("UTF-8");
    // mb_http_output( "iso-8859-1" );
    // ob_start("mb_output_handler");
    // header("Content-Type: text/html; charset=ISO-8859-1",true);
?>