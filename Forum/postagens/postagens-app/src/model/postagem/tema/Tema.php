<?php
namespace br\com\app\model\postagem\tema;

  /**
  * @Entity
  */
  class Tema
  {
    /** 
     * @Id
     * @Column(name="id_tema", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id_tema;
    
    /** 
     * @Column(name="nome_tema", type="string") 
     */
    private $nome_tema;
    
    function __construct($nome_tema) {
        $this->nome_tema = $nome_tema;
    }
    
    public function getId_tema(): int
    {
        return $this->id_tema;
    }
    
    public function getNome_tema(): string
    {
        return $this->nome_tema;
    }
    public function setNome_tema($nome_tema)
    {
        $this->nome_tema = $nome_tema;
    }
    
    public function __toString() {
        return "id_tema: ".$this->id_tema."<br>Nome: ".$this->nome_tema."<br>";
    }
  }
?>