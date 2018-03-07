<?php
	date_default_timezone_set('America/Recife');
	$hora = date("H");
	if ($hora < 12) {
		$saudacao = 'Bom dia';
	}
	elseif ($hora < 18) {
		$saudacao = 'Boa tarde';
	}
	else
		$saudacao = 'Boa noite';
	echo $saudacao;
?>