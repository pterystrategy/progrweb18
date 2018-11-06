<?php
	class Grupo
	{
		private  $idGrupo;
		private  $descricao;
                
        function __construct() {
            $this->setIdGrupo(0);
            $this->setDescricao("");
        }

		function __toString() 
		{
			return $this->getDescricao();
		}
        		
        function getIdGrupo() {
            return $this->idGrupo;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function setIdGrupo($idGrupo) {
            $this->idGrupo = intval($idGrupo);
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }
	}
?>
