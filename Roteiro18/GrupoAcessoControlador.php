<?php

	require_once 'class/GrupoAcessoDAO.php';
	$grupoAcessoDAO = new GrupoAcessoDAO();
	$vendaDAO = new GrupoDAO();
	$acessoDAO = new AcessoDAO();
	$grupoAcesso = new GrupoAcesso();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':

			$venda = $vendaDAO->buscarPorId($_POST["idGrupo"]);
			$acesso = $acessoDAO->buscarPorId($_POST["idAcesso"]);

			$grupoAcesso->setGrupo($venda);
			$grupoAcesso->setAcesso($acesso);
			$grupoAcesso->setPermissao($_POST["permissao"]);
			
			
			$resultado = $grupoAcessoDAO->salvar($grupoAcesso);

			if($resultado == 1){
				echo "<script>location.href='GrupoFormulario.php?operacao=editar&idGrupo={$_POST["idGrupo"]}';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='GrupoFormulario.php?operacao=editar&idGrupo={$_POST["idGrupo"]}';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$idGrupo = $_GET["idGrupo"];
			$resultado = $grupoAcessoDAO->excluirPorId($_GET["idGrupoAcesso"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='GrupoFormulario.php?operacao=editar&idGrupo={$idGrupo}';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='GrupoFormulario.php?operacao=editar&idGrupo={$idGrupo}';</script>"; 			
			}			
        	break;         	
	}
			
?>