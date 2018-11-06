<?php
    require_once 'Categoria.php';

	class Produto
	{
        private  $idProduto;
        private  $nome;
        private  $descricao;
        private  $valor;
        private  $quantidade;
        private  $foto;
        private  $categoria;
         	 
        function __construct() {
            $this->setIdProduto(0);
            $this->setNome("");
            $this->setDescricao("");
            $this->setValor(0);
            $this->setQuantidade(0);
            $this->setFoto("produtoPadrao.png");
            $categoria = new Categoria(); 
            $this->setCategoria($categoria);
        }

		function __toString() 
		{
			return $this->getnome();
		}

        function getIdProduto(){
            return $this->idProduto;
        }
        function setIdProduto($idProduto){
            $this->idProduto = intval($idProduto);
        }

        function getNome(){
            return $this->nome;
        }
        function setNome($nome){
            $this->nome = $nome;
        }        

        function getDescricao(){
            return $this->descricao;
        }
        function setDescricao($descricao){
            $this->descricao = $descricao;
        }   

        function getValor(){
            return $this->valor;
        }
        function setValor($valor){
            $this->valor = floatval($valor);
        }  
		
        function getQuantidade(){
            return $this->situacao;
        }
        function setQuantidade($situacao){
            $this->situacao = intval($situacao);
        }
		
        function getFoto(){
            return $this->foto;
        }
        function setFoto($foto){
            $this->foto = $foto;
        }    
		
        function getCategoria() {
            return $this->categoria;
        }

        function setCategoria($objeto) {
            $this->categoria = $objeto;
        }

	}
?>
