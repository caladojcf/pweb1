<?php

namespace br\com\app\model\descricao;

/**
 * @Entity
 */
class descricao
{   
  /**
    *@Id
    *@Column(name="id_descricao", type="integer")
    *@GeneratedValue(strategy="IDENTITY")
    */
  private $id_descricao;

  /**
  *@Column(name="data_descricao")
  *@Column(type="DateTime")
  */
  private $data_descricao;

  /** 
  *@Column(name="id_postagem_respondida", type="integer")
  */
  private $id_postagem_respondida;

  /** 
  * @Column(name="email_postador", type="string")
  */
  private $email_postador;
    
  /** 
  * @Column(name="descricao", type="string")
  */
  private $descricao;
  
  /** 
  *@Column(name="id_postador", type="integer")
  */
  private $id_postador;
    
  function __construct($id_descricao, $data_descricao, $id_postagem_respondida, $email_postador, $descricao, $id_postador) 
  {
    // $this->data_descricao = DateTime();
    $this->id_descricao = $id_descricao;
    $this->data_descricao = $data;
    $this->id_postagem_respondida = $id_postagem_respondida;
    $this->email_postador = $email_postador;
    $this->descricao = $descricao;
	$this->id_postador = $id_postador;
  }
    
  public function getId_descricao()
  {
    return $this->id_descricao;
  }

  public function getData_descricao()
  {
    return $this->data_descricao;
  }

  public function getId_postagem_respondida(): int
  {
    return $this->id_postagem_respondida;
  }

  public function getEmail_postador(): string
  {
    return $this->email_postador;
  }

  public function getdescricao(): string
  {
    return$this->descricao;
  }

  public function setdescricao($descricao)
  {
    $this->descricao = $descricao;
  }
    
  public function __toString() {
    return "id da Resposta: ".$this->id_descricao."<br>Data: ".$this->data_descricao.
    "<br>id da Postagem Respondida: ".$this->id_postagem_respondida."<br>E-mail do postador: ".$this->email_postador."<br>Comentário: ".$this->descricao."<br>";
  }
}

