<?php

	require_once 'class/PedidoProdutoDAO.php';
	$pedidoProdutoDAO = new PedidoProdutoDAO();
	$pedidoDAO = new PedidoDAO();
	$produtoDAO = new ProdutoDAO();
	

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':

			$pedidoProduto = new PedidoProduto();

			$pedido = $pedidoDAO->buscarPorId($_POST["idPedido"]);
			$produto = $produtoDAO->buscarPorId($_POST["idProduto"]);

			$pedidoProduto->setPedido($pedido);
			$pedidoProduto->setProduto($produto);
			$pedidoProduto->setQuantidade($_POST["quantidade"]);
			$pedidoProduto->setValor($_POST["valor"]);
			
			
			$resultado = $pedidoProdutoDAO->salvar($pedidoProduto);

			if($resultado == 1){
				echo "<script>location.href='PedidoFormulario.php?operacao=editar&idPedido={$_POST["idPedido"]}';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='PedidoFormulario.php?operacao=editar&idPedido={$_POST["idPedido"]}';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$idPedido = $_GET["idPedido"];
			$resultado = $pedidoProdutoDAO->excluirPorId($_GET["idPedidoProduto"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='PedidoFormulario.php?operacao=editar&idPedido={$idPedido}';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='PedidoFormulario.php?operacao=editar&idPedido={$idPedido}';</script>"; 			
			}			
        	break;         	
	}
			
?>