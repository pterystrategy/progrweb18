<?php
    require_once 'Pedido.php';
    require_once 'Produto.php';

	class PedidoProduto
	{
        private  $idPedidoProduto;
        private  $pedido;
        private  $produto;
        private  $quantidade;        
        private  $valor;

        function __construct() {
            $this->setIdPedidoProduto(0);
            $pedido = new Pedido(); 
            $this->setPedido($pedido);
            $produto = new Produto(); 
            $this->setProduto($produto);
            $this->setValor(0);
            $this->setQuantidade(0);
        }

		function __toString() 
		{
			return $this->getPedido();
		}

        function getIdPedidoProduto(){
            return $this->idPedidoProduto;
        }
        function setIdPedidoProduto($idPedidoProduto){
            $this->idPedidoProduto = intval($idPedidoProduto);
        }
 
         function getPedido() {
            return $this->pedido;
        }

        function setPedido($objeto) {
            $this->pedido = $objeto;
        }

        function getProduto() {
            return $this->produto;
        }

        function setProduto($objeto) {
            $this->produto = $objeto;
        }         
		
        function getQuantidade(){
            return $this->situacao;
        }
        function setQuantidade($situacao){
            $this->situacao = intval($situacao);
        }

        function getValor(){
            return $this->valor;
        }
        function setValor($valor){
            $this->valor = floatval($valor);
        }         

	}
?>
