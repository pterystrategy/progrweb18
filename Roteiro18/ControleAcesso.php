<?php

	require_once 'class/Usuario.php';
	require_once 'class/GrupoAcesso.php';

	$usuarioAtual = unserialize($_SESSION["USUARIO_ATUAL"]);
	$grupoAcessoUsuarioAtual = unserialize($_SESSION["GRUPOACESSO_USUARIO_ATUAL"]);

	$arquivoAtual = basename($_SERVER['PHP_SELF']);

	$permissao = 0;
	$menu = "";

	foreach ($grupoAcessoUsuarioAtual as $grupoAcesso){

		if($grupoAcesso->getAcesso()->getArquivo() == $arquivoAtual ){
			$permissao = $grupoAcesso->getPermissao();
			$menu = $grupoAcesso->getAcesso()->getMenu();
		}

  	}

	switch ($permissao) {
	    case 0:
	  		session_unset();	
			session_destroy();	
	  		echo "<script>alert('Aviso: acesso negado.'); location.href='Login.php';</script>";
	        break;
	    case 1:
	        break;
	    case 2:
	        break;
	}  	



?>




