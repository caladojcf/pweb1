<?php
namespace br\com\app\model\livro\imagem;

  /**
  * @Entity
  */
  class Imagem
  {
    /** 
     * @Id
     * @Column(name="id_imagem", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id_imagem;
    
    /** 
     * @Column(name="imagem", type="blob") 
     */
    private $imagem;
    
    function __construct($imagem) {
        $this->imagem = $imagem;
    }
    
    public function getId_imagem(): int
    {
        return $this->id_imagem;
    }
    public function setId_imagem($id)
    {
        $this->id_imagem = $id;
    }
    
    public function getImagem(): blob
    {
        return $this->imagem;
    }
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }
    
    public function __toString() {
        return "id_imagem: ".$this->id_imagem."<br>Imagem: ".$this->imagem."<br>";
    }
  }
?>