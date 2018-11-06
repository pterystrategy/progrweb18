<?php

	require_once 'class/PedidoDAO.php';
	require_once 'class/UsuarioDAO.php';
	$pedidoDAO = new PedidoDAO();
	$usuarioDAO = new UsuarioDAO();	

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
			$pedido = new Pedido();
			$pedido->setIdPedido($_POST["idPedido"]);			
			$usuario = $usuarioDAO->buscarPorId($_POST["idUsuario"]);			
			$pedido->setUsuario($usuario);	
			
			$pedido->setDataPedido($_POST["dataPedido"]);
			$resultado = $pedidoDAO->salvar($pedido);

			if(isset($_POST["salvar"])){		
				$pagina = "PedidoFormulario.php?operacao=editar&idPedido={$pedido->getIdPedido()}";
			}else{
				if(isset($_POST["salvarVoltar"])){
					$pagina = "PedidoTabela.php";
				}			
			}

			if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='{$pagina}';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='{$pagina}';</script>"; 			
			}
			

        	break; 

        case 'excluir':
			
			$resultado = $pedidoDAO->excluirPorId($_GET["idPedido"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='PedidoTabela.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='PedidoTabela.php';</script>"; 			
			}			
        	break;     

	}
			
?>