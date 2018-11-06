<?php

	session_start();
	
	require_once 'class/UsuarioDAO.php';
	require_once 'class/GrupoAcessoDAO.php';

	$operacao = $_GET["operacao"];

	$usuarioDAO = new UsuarioDAO();
	$grupoAcessoDAO = new GrupoAcessoDAO();

	switch($operacao) 
	{
        case 'autenticar':

			$login = $_POST["login"];
			$senha = $_POST["senha"];        
			
			$usuario = $usuarioDAO->autenticar($login, $senha);

			/*
			if(($usuario->getIdUsuario() > 0) || (($login == 'admin') && ($senha=='12345')) ){
				
				if(($login == 'admin') && ($senha=='12345')){
					
					$usuario->setLogin('admin');
				}
			*/

			if($usuario->getIdUsuario() > 0){

				$usuarioDAO->registrarAutenticacao($usuario);

				$grupoAcesso = $grupoAcessoDAO->listarPorGrupo($usuario->getGrupo()->getIdGrupo());

				$_SESSION["USUARIO_ATUAL"]= serialize($usuario);	
				$_SESSION["GRUPOACESSO_USUARIO_ATUAL"]= serialize($grupoAcesso);	
									
				echo "<script>location.href='Menu.php';</script>"; 
			}else{
				echo "<script>alert('Usuário ou senha inválido!'); location.href='Login.php';</script>"; 			
			}

        	break; 

        case 'encerrar':

			session_unset();	
			session_destroy();	
				
			header('Location: Login.php');	

        	break;         	

        	          	
	}
			
?>