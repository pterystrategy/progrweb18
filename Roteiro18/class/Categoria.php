<?php
	class Categoria
	{
		private  $idCategoria;
		private  $descricao;
                
        function __construct() {
            $this->setIdCategoria(0);
            $this->setDescricao("");
        }

		function __toString() 
		{
			return $this->getDescricao();
		}
        		
        function getIdCategoria() {
            return $this->idCategoria;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function setIdCategoria($idCategoria) {
            $this->idCategoria = intval($idCategoria);
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
	}
?>
