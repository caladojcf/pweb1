<?php

namespace app\src\model\usuario\perfil;

/**
 * @Entity
 */
class Postador extends app\src\model\usuario\Usuario
{
  private $respostas = array();
    
  function __construct($email, $cpf, $nome, $senha, $perfil) {
    parent::__construct($email, $cpf, $nome, $senha, $perfil);
  }
    
  public function getRespostas(): array
  {
    return $this->respostas;
  }
  public function addResposta($resposta)
  {
    array_push($this->respostas, $resposta);
  }
  public function removerResposta($resposta)
  {
    $key = array_search($resposta, $this->respostas);
    if($key!==false){
      unset($this->respostas[$key]);
    }
    else{
      //throw new minhasExceptions("Resposta inexistente!");
    }
  }
}

