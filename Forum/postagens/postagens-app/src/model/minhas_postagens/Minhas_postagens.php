<?php

namespace br\com\app\model\minhas_postagens;
/**
 * Discription of postagem
 * @Entity
 * @Table(name="postagem")
 */
class Minhas_postagens
{         
    /**
     * @Id
     * @Column(name="id_minhas_postagens", type="integer")
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id_minhas_postagens;
    
    /**
     * @Column(name="id_postagem", type="integer")
     */
    private $id_postagem;

    /**
    *@Column(name="id_usuario", type="integer")
    */
    private $id_usuario;
    
    /** 
     * @Column(name="email_usuario", type="string")
     */
    private $email_usuario; 
            
    function __construct($id_minhas_postagens, $id_postagem, $id_usuario, $email_usuario) 
    {
        $this->id_minhas_postagens = $id_minhas_postagens;
        $this->id_postagem = $id_postagem;
        $this->id_usuario = $id_usuario;
        $this->email_usuario = $email_usuario;
    }
    
    public function getId_minhas_postagens(): int
    {
        return $this->id_postagem;
    }
    public function setId_minhas_postagens($id_postagem)
    {
        $this->id_postagem = $id_postagem;
    }

    public function getEmail_usuario(): string
    {
        return $this->email_usuario;
    }
    public function setEmail_usuario($email_usuario)
    {
        $this->email_usuario = $email_usuario;
    }
}