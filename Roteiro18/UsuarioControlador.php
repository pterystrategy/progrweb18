<?php

	require_once 'class/UsuarioDAO.php';
	require_once 'class/GrupoDAO.php';

	$operacao = $_GET["operacao"];
	$usuarioDAO = new UsuarioDAO();
	$grupoDAO = new GrupoDAO();
	$usuario = new Usuario();
	$grupo = new Grupo();

	switch($operacao) 
	{
        case 'salvar':

			$usuario->setIdUsuario($_POST["idUsuario"]);
			$usuario->setNome($_POST["nome"]);
			$usuario->setLogin($_POST["login"]);
			$usuario->setSenha($_POST["senha"]);
			$usuario->setEmail($_POST["email"]);
			$usuario->setSituacao($_POST["situacao"]);

			$foto = $_FILES['foto'];
			$fotoNome = uniqid().$foto["name"];
			move_uploaded_file($foto["tmp_name"],"imagens/".$fotoNome);		
			$usuario->setFoto($fotoNome);
				
			$grupo = $grupoDAO->buscarPorId($_POST["idGrupo"]);
			$usuario->setGrupo($grupo);

			$resultado = $usuarioDAO->salvar($usuario);

			if(isset($_POST["salvar"])){		
				$pagina = "UsuarioFormulario.php?operacao=editar&idUsuario={$usuario->getIdUsuario()}";
			}else{
				if(isset($_POST["salvarVoltar"])){
					$pagina = "UsuarioTabela.php";
				}			
			}			

			if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='{$pagina}';</script>"; 
 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='{$pagina}';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$resultado = $usuarioDAO->excluirPorId($_GET["idUsuario"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='UsuarioTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='UsuarioTabela.php';</script>"; 			
			}			
        	break;   

        case 'verificarLogin':
			
			$login = $_POST["login"];
			$idUsuario = $_GET["idUsuario"];

			$resultado = $usuarioDAO->verificarLogin($idUsuario, $login);

			echo json_encode( $resultado );

		
        	break;          	      	
         	
	}
			
?>