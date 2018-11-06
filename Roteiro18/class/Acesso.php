<?php
class Acesso
    {
        private  $idAcesso;
        private  $descricao;
        private  $menu;
        private  $arquivo;                         
        private  $tipo;
        private  $idAcessoPai;
        
       function __construct() {
            $this->setIdAcesso(0);
            $this->setDescricao("");
            $this->setMenu("");
            $this->setArquivo("");
            $this->setTipo("");
            $this->setIdAcessoPai(0);
        }

        function __toString() 
        {
            return $this->getDescricao();
        }
                
        function getIdAcesso() {
            return $this->idAcesso;
        }

        function getDescricao() {
            return $this->descricao;
        }

        function getMenu() {
            return $this->menu;
        }

        function getTipo() {
            return $this->tipo;
        }

        function getArquivo() {
            return $this->arquivo;
        }

        function getIdAcessoPai() {
            return $this->idAcessoPai;
        }        

        function setIdAcesso($idAcesso) {
            $this->idAcesso = intval($idAcesso);
        }

        function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        function setMenu($menu) {
            $this->menu = $menu;
        }

        function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        function setIdAcessoPai($idAcessoPai) {
            $this->idAcessoPai = intval($idAcessoPai);
        }        

        function setArquivo($arquivo) {
            $this->arquivo = $arquivo;
        }

    }	
?>
