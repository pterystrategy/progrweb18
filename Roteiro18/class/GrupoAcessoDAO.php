<?php	
	require_once 'CrudDAO.php';
	require_once 'GrupoDAO.php';
	require_once 'AcessoDAO.php';
	require_once 'GrupoAcesso.php';

	class GrupoAcessoDAO extends CrudDAO
	{

		public function salvar($grupoAcesso){	
			$situacao = FALSE;
			try{
				
				if($grupoAcesso->getIdGrupoAcesso()==0){

					$situacao = $this->incluir($grupoAcesso);

				}else{	
					$situacao = $this->atualizar($grupoAcesso);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($grupoAcesso){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	

				$sql = "INSERT INTO tbGrupoAcesso(idGrupo, idAcesso, permissao) VALUES (:idGrupo, :idAcesso, :permissao)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idGrupo', $grupoAcesso->getGrupo()->getIdGrupo()); 
				$run->bindValue(':idAcesso', $grupoAcesso->getAcesso()->getIdAcesso()); 
				$run->bindValue(':permissao', $grupoAcesso->getPermissao()); 			
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$grupoAcesso->setIdGrupoAcesso($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($grupoAcesso){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbGrupoAcesso SET idGrupo = :idGrupo, idAcesso = :idAcesso, permissao = :permissao WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idGrupo', $grupoAcesso->getGrupo()->getIdGrupo()); 
				$run->bindValue(':idAcesso', $grupoAcesso->getAcesso()->getIdAcesso()); 
				$run->bindValue(':permissao', $grupoAcesso->getPermissao()); 

				$run->bindValue(':idGrupoAcesso', $grupoAcesso->getIdGrupoAcesso()); 
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}			

			return $situacao;
		}						

		public function excluir($grupoAcesso){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbGrupoAcesso WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idGrupoAcesso', $grupoAcesso->getIdGrupoAcesso());		
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}			

			return $situacao;

		}

		public function excluirPorId($codigo){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbGrupoAcesso WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idGrupoAcesso', $codigo);			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}			

			return $situacao;

		}					

		public function listar(){

			$objetos = array();	

			try{
				
				$pdo = parent::conectar();
					
				$sql = "SELECT * FROM tbGrupoAcesso";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				$grupoDAO = new GrupoDAO();
				$acessoDAO = new AcessoDAO();

				foreach ($resultado as $registro){

					$grupoAcesso = new GrupoAcesso();
					$grupoAcesso->setIdGrupoAcesso($registro['idGrupoAcesso']);

					$grupo = $grupoDAO->buscarPorId($registro['idGrupo']);
					$grupoAcesso->setGrupo($grupo);

					$acesso = $acessoDAO->buscarPorId($registro['idAcesso']);
					$grupoAcesso->setAcesso($acesso);

					$grupoAcesso->setPermissao($registro['permissao']);

					array_push($objetos, $grupoAcesso);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;
		}			
		
		public function buscarPorId($codigo){

			$grupoAcesso = new GrupoAcesso();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbGrupoAcesso WHERE idGrupoAcesso = :idGrupoAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idGrupoAcesso', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$registro = $run->fetch();

				$grupoDAO = new GrupoDAO();
				$acessoDAO = new AcessoDAO();				

				$grupoAcesso = new GrupoAcesso();
				$grupoAcesso->setIdGrupoAcesso($registro['idGrupoAcesso']);

				$grupo = $grupoDAO->buscarPorId($registro['idGrupo']);
				$grupoAcesso->setGrupo($grupo);

				$acesso = $acessoDAO->buscarPorId($registro['idAcesso']);
				$grupoAcesso->setAcesso($acesso);

				$grupoAcesso->setPermissao($registro['permissao']);


			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $grupoAcesso;
		}	


		public function listarPorGrupo($idGrupo){

			$objetos = array();	

			try{
				
				$pdo = parent::conectar();
					
				$sql = "SELECT * FROM tbGrupoAcesso WHERE idGrupo = :idGrupo ORDER BY idacesso";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idGrupo', $idGrupo);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				$grupoDAO = new GrupoDAO();
				$acessoDAO = new AcessoDAO();

				foreach ($resultado as $registro){

					$grupoAcesso = new GrupoAcesso();
					$grupoAcesso->setIdGrupoAcesso($registro['idGrupoAcesso']);

					$grupo = $grupoDAO->buscarPorId($registro['idGrupo']);
					$grupoAcesso->setGrupo($grupo);

					$acesso = $acessoDAO->buscarPorId($registro['idAcesso']);
					$grupoAcesso->setAcesso($acesso);

					$grupoAcesso->setPermissao($registro['permissao']);

					array_push($objetos, $grupoAcesso);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;
		}					
	}
	
?> 