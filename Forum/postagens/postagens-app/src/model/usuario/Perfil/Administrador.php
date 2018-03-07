<?php
	namespace app\src\model\usuario\tipo;

	/**
	 * @Entity
	 */
	class Administrador extends app\src\model\usuario\Usuario
	{
	  function __construct($email, $cpf, $nome, $senha, $perfil) {
	    parent::__construct($email, $cpf, $nome, $senha, $perfil);
	  }
	}
?>