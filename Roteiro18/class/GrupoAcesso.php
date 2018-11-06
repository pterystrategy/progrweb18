<?php
    require_once 'Grupo.php';
    require_once 'Acesso.php';

	class GrupoAcesso
	{
		private  $idGrupoAcesso;
		private  $grupo;
        private  $acesso;
        private  $permissao;
                
        function __construct() {
            $this->setIdGrupoAcesso(0);
            $grupo = new Grupo(); 
            $this->setGrupo($grupo);
            $acesso = new Acesso(); 
            $this->setAcesso($acesso);
            $this->setPermissao(0);
        }

		function __toString() 
		{
			return $this->getGrupo();
		}
        		
        function getIdGrupoAcesso() {
            return $this->idGrupoAcesso;
        }

        function setIdGrupoAcesso($idGrupoAcesso) {
            $this->idGrupoAcesso = intval($idGrupoAcesso);
        }        

        function getGrupo() {
            return $this->grupo;
        }

        function setGrupo($objeto) {
            $this->grupo = $objeto;
        }

        function getAcesso() {
            return $this->acesso;
        }

        function setAcesso($objeto) {
            $this->acesso = $objeto;
        }     

        function getPermissao() {
            return $this->permissao;
        }

        function getDescricaoPermissao() {
            $permissao = "";
            switch ($this->permissao) {
                case 1:
                    $permissao = "Leitura";
                    break;
                case 2:
                    $permissao = "Total";
                    break;                
            }
            return $permissao;
        }        

        function setPermissao($permissao) {
            $this->permissao = intval($permissao);
        }     

	}
?>
