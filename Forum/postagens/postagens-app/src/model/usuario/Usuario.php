<?php
//@GeneratedValue (strategy="AUTO")

namespace br\com\app\model\usuario;
//GeneratedValue(strategy = "SEQUENCE")
//GeneratedValue(strategy = "AUTO")
//GeneratedValue(strategy = "IDENTITY")

/**
* @Entity
*/
class Usuario
{
  /** 
   * @Id 
   * @Column(name="id_postagem", type="integer")
   * GeneratedValue(strategy = "IDENTITY")
   */
  private $id_usuario;

  /** 
   * @Column(name="email", type="string")
   */
  private $email;

  /** 
   * @Column(name="cpf", type="string")
   */
  private $cpf;
    
  /** 
   * @Column(name="nome", type="string")
   */
  private $nome;
    
  /** 
   * @Column(name="senha", type="string")
   */
  private $senha;
    
  /** 
   * @Column(name="perfil", type="integer")
   */
  private $perfil;
    
  /**
	* @Column(name="foto", type="blob")
	*/
  private $foto;
            
  function __construct($email, $cpf, $nome, $senha, $perfil, $foto) 
  {
    $this->email = $email;
    $this->cpf = $cpf;
    $this->nome = $nome;
    $this->senha = $senha;
    $this->perfil = $perfil;
	$this->foto = $foto;
  }
    
  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getCpf(): string
  {
    return $this->cpf;
  }

  public function setCpf($cpf)
  {
    $this->cpf = $cpf;
  }
    
  public function getNome(): string
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }
    
  public function getSenha(): string{
    return $this->senha;
  }

  public function setSenha($senha)
  {
    $this->senha = $senha;
  }
    
  public function getPerfil(): integer
  {
    return $this->perfil;
  }

  public function setPerfil($perfil)
  {
    $this->perfil = $perfil;
  }
    
  public function getFoto(): blob
  {
    return $this->foto;
  }
  public function setFoto($foto)
  {
    $this->foto = $foto;
  }
    
  public function __toString() {
    return "<br>Email: ".$this->email."Cpf: ".$this->cpf."<br>Nome: ".$this->nome."<br>Perfil: ".$this->perfil."<br>";
  }
}