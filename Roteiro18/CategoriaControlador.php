<?php

	require_once 'class/CategoriaDAO.php';
	$categoriaDAO = new CategoriaDAO();
	$categoria = new Categoria();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':

			$categoria->setIdCategoria($_POST["idCategoria"]);
			$categoria->setDescricao($_POST["descricao"]);
			$resultado = $categoriaDAO->salvar($categoria);

			if(isset($_POST["salvar"])){		
				$pagina = "CategoriaFormulario.php?operacao=editar&idCategoria={$categoria->getIdCategoria()}";
			}else{
				if(isset($_POST["salvarVoltar"])){
					$pagina = "CategoriaTabela.php";
				}			
			}			

			if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='{$pagina}';</script>"; 
 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='{$pagina}';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$resultado = $categoriaDAO->excluirPorId($_GET["idCategoria"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='CategoriaTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='CategoriaTabela.php';</script>"; 			
			}			
        	break;         	
	}
			
?>