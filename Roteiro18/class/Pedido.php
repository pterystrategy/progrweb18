<?php
	require_once 'Usuario.php';
	 
	class Pedido
	{
        private  $idPedido;
		private  $usuario;
        private  $dataPedido;
    
        function __construct() {
            $this->setIdPedido(0);
			$usuario = new Usuario();
			$this->setUsuario($usuario);
			$this->setDataPedido("");
        }
		
        function getUsuario(){
            return $this->usuario;
        }

        function setUsuario($usuario){
            $this->usuario = $usuario;
        }		

        function getIdPedido(){
            return $this->idPedido;
        }

        function setIdPedido($idPedido){
            $this->idPedido = intval($idPedido);
        }
		
        function getDataPedido(){
            return $this->dataPedido;
        }
        function setDataPedido($dataPedido){
            $this->dataPedido = $dataPedido;
        }	

	}
?>
