<?php

	require_once 'class/ProdutoDAO.php';
	require_once 'class/CategoriaDAO.php';

	$operacao = $_GET["operacao"];
	$produtoDAO = new ProdutoDAO();
	$categoriaDAO = new CategoriaDAO();
	$produto = new Produto();
	$categoria = new Categoria();

	switch($operacao) 
	{
        case 'salvar':
			
			$produto->setIdProduto($_POST['idProduto']);
			$produto->setNome($_POST['nome']);
			$produto->setDescricao($_POST['descricao']);
			$produto->setValor($_POST['valor']);
			$produto->setQuantidade($_POST['quantidade']);
			
			$foto = $_FILES['foto'];
			$fotoNome = uniqid().$foto["name"];
			move_uploaded_file($foto["tmp_name"],"imagens/".$fotoNome);		
			$produto->setFoto($fotoNome);
			
			$categoria = $categoriaDAO->buscarPorId($_POST['idCategoria']);
			$produto->setCategoria($categoria);
			
			$resultado = $produtoDAO->salvar($produto);
	
			if($resultado == TRUE){
			
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='ProdutoTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='ProdutoTabela.php';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$resultado = $produtoDAO->excluirPorId($_GET["idProduto"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='ProdutoTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='ProdutoTabela.php';</script>"; 			
			}			
        	break;        	      	
         	
	}
			
?>