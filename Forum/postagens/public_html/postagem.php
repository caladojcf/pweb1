<?php
// Incluindo arquivo de conexão
header('Content-Type: text/html; charset=utf-8');
include_once "conexaoPDO.php";

$id = (int) $_GET['id'];

// Selecionando postagems
$stmt = $bd->prepare('SELECT id_postagem, fk_postador FROM postagem JOIN usuario ON fk_postador = id_usuario WHERE id_postagem = :id');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Se executado
if ($stmt->execute()){
  // Alocando foto
  $postagem = $stmt->fetchObject();
    
  // Se existir
  if ($postagem != null){ 
    // Retornando conteudo
    echo $postagem->foto;
  }
}
?>