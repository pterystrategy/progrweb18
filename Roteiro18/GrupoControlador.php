<?php

	require_once 'class/GrupoDAO.php';
	$grupoDAO = new GrupoDAO();
	

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':

			$grupo = new Grupo();

			$grupo->setIdGrupo($_POST["idGrupo"]);
			$grupo->setDescricao($_POST["descricao"]);
			$resultado = $grupoDAO->salvar($grupo);

			if(isset($_POST["salvar"])){		
				$pagina = "GrupoFormulario.php?operacao=editar&idGrupo={$grupo->getIdGrupo()}";
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
			
			$resultado = $grupoDAO->excluirPorId($_GET["idGrupo"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='GrupoTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='GrupoTabela.php';</script>"; 			
			}			
        	break;     

	}
			
?>