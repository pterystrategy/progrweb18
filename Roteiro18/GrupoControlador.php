<?php

	require_once 'class/GrupoDAO.php';
	$vendaDAO = new GrupoDAO();
	

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':

			$venda = new Grupo();

			$venda->setIdGrupo($_POST["idGrupo"]);
			$venda->setDescricao($_POST["descricao"]);
			$resultado = $vendaDAO->salvar($venda);

			if(isset($_POST["salvar"])){		
				$pagina = "GrupoFormulario.php?operacao=editar&idGrupo={$venda->getIdGrupo()}";
			}else{
				if(isset($_POST["salvarVoltar"])){
					$pagina = "GrupoTabela.php";
				}			
			}

			if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='{$pagina}';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='{$pagina}';</script>"; 			
			}
			

        	break; 

        case 'excluir':
			
			$resultado = $vendaDAO->excluirPorId($_GET["idGrupo"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='GrupoTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='GrupoTabela.php';</script>"; 			
			}			
        	break;     

	}
			
?>