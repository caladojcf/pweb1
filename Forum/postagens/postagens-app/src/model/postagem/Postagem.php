<?php

namespace br\com\app\model\postagem;
//GeneratedValue(strategy = "SEQUENCE")
//GeneratedValue(strategy = "AUTO")
//GeneratedValue(strategy = "IDENTITY")

/**
 * @Entity
 */
 class Postagem
 {
    /** 
     * @Id 
     * @Column(name="id_postagem", type="integer")
     * GeneratedValue(strategy = "IDENTITY")
     */
    private $id_postagem;
    
    /** 
     * @Column(name="titulo", type="string") 
     */
    private $titulo;
    
    /** 
     * @Column(name="descricao", type="string") 
     */
    private $descricao;
    
    /** 
     * @Column(name="data_postagem", type="datetime")
     */
    private $data_postagem;
    
    /** 
     * @Column(name="fk_tema", type="integer") 
     */
    private $fk_tema;
	
	/** 
     * @Column(name="fk_postador", type="integer") 
     */
    private $fk_postador;
     
    function __construct($titulo, $descricao, $data_postagem, $fk_tema, $fk_postador)
    {
       $this->titulo = $titulo;
       $this->descricao = $descricao;
       $this->data_postagem = $data_postagem;
       $this->fk_tema = $fk_tema;
	   $this->fk_postador = $fk_postador;
    }
     
    public function getId_postagem(): int
    {
        return $this->id_postagem;
    }
    // public function setId_postagem(int $id)
    // {
    //    $this->id_postagem = $id; 
    // }
     
    public function getTitulo(): string
    {
        return $this->titulo;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
     
    public function getDescricao(): string
    {
        return $this->descricao;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
     
    public function getData_postagem(): int
    {
        return $this->data_postagem;
    }
    public function setData_postagem($data_postagem)
    {
        $this->data_postagem = $data_postagem;
    }
     
    public function getFk_tema(): int
    {
       return $this->fk_tema;
    }
    public function setFk_Tema($fk_tema)
    {
        $this->fk_tema = $fk_tema;
    }
     
    public function getResposta(): array
    {
        return $this->resposta;
    }
    public function addResposta($resposta)
    {
        array_push($this->resposta, $resposta);
    }
    public function removerResposta($resposta)
    {
        $key = array_search($resposta, $this->resposta);
        if($key!==false){
            unset($this->resposta[$key]);
        }
        else{
            //throw new minhasExceptions("Resposta inexistente!");
        }
    }
    
    public function __toString() {
        return "Id: ".$this->id_postagem."<br>Título: ".$this->titulo."<br>descricao: ".$this->descricao."<br>data_postagem: ".$this->data_postagem
                ."<br>";
    }
}
