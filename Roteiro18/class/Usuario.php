<?php
    require_once 'Grupo.php';

	class Usuario
	{
        private  $idUsuario;
        private  $nome;
        private  $login;
        private  $senha;
        private  $email;
        private  $ultimoAcesso;
        private  $situacao;
        private  $foto;        
        private  $grupo;
                
        function __construct() {
            $this->setIdUsuario(0);
            $this->setLogin("");
            $this->setSenha("");
            $this->setEmail("");
            $this->setUltimoAcesso("");
            $this->setSituacao(1);
            $this->setFoto("usuarioPadrao.png"); 
            $grupo = new Grupo();           
            $this->setGrupo($grupo);
        }

		function __toString() 
		{
			return $this->getLogin();
		}

        function getIdUsuario(){
            return $this->idUsuario;
        }
        function setIdUsuario($idUsuario){
            $this->idUsuario = intval($idUsuario);
        }

        function getNome(){
            return $this->nome;
        }
        function setNome($nome){
            $this->nome = $nome;
        }        

        function getLogin(){
            return $this->login;
        }
        function setLogin($login){
            $this->login = $login;
        }        

        function getSenha(){
            return $this->senha;
        }
        function setSenha($senha){
            $this->senha = $senha;
        }   

        function getEmail(){
            return $this->email;
        }
        function setEmail($email){
            $this->email = $email;
        }  

        function getUltimoAcesso(){
            return $this->ultimoAcesso;
        }
        function setUltimoAcesso($ultimoAcesso){
            $this->ultimoAcesso = $ultimoAcesso;
        }

        function getSituacao(){
            return $this->situacao;
        }
        function setSituacao($situacao){
            $this->situacao = intval($situacao);
        }

        function getFoto(){
            return $this->foto;
        }
        function setFoto($foto){
            $this->foto = $foto;
        } 
             		
        function getGrupo() {
            return $this->grupo;
        }

        function setGrupo($objeto) {
            $this->grupo = $objeto;
        }

	}
?>
