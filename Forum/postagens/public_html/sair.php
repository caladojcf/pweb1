<?php
	session_start();
	$_SESSION['logado'] = null;
	$_SESSION['email'] = null;
	// $_SESSION['testaPerfil'] =  null;
	session_destroy();
	header("Location: index.php");
?>