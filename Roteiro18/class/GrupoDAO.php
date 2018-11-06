<?php	
	require_once 'CrudDAO.php';
	require_once 'Grupo.php';

	class GrupoDAO extends CrudDAO
	{

		public function salvar($grupo){	
			$situacao = FALSE;
			try{
				
				if($grupo->getIdGrupo()==0){

					$situacao = $this->incluir($grupo);

				}else{	
					$situacao = $this->atualizar($grupo);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($grupo){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();

				$sql = "INSERT INTO tbGrupo(descricao) VALUES (:descricao)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':descricao', $grupo->getDescricao(), PDO::PARAM_STR); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$grupo->setIdGrupo($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($grupo){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbGrupo SET descricao = :descricao WHERE idGrupo = :idGrupo";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':descricao', $grupo->getDescricao(), PDO::PARAM_STR);
	  			$run->bindValue(':idGrupo', $grupo->getIdGrupo(), PDO::PARAM_INT);				
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

		public function excluir($grupo){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbGrupo WHERE idGrupo = :idGrupo";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idGrupo', $grupo->getIdGrupo(), PDO::PARAM_INT);			
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
					
				$sql = "DELETE FROM tbGrupo WHERE idGrupo = :idGrupo";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idGrupo', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbGrupo";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$grupo = new Grupo();
					$grupo->setIdGrupo($registro['idGrupo']);
					$grupo->setDescricao($registro['descricao']);
					array_push($objetos, $grupo);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$grupo = new Grupo();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbGrupo WHERE idGrupo = :idGrupo";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idGrupo', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$registro = $run->fetch();

				$grupo->setIdGrupo($registro['idGrupo']);
				$grupo->setDescricao($registro['descricao']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $grupo;
		}	


		public function filtrar($descricao){

			$objetos = array();	

			try{
				
				$pdo = parent::conectar();
					
				$sql = "SELECT * FROM tbGrupo WHERE descricao LIKE '%{$descricao}%'";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$grupo = new Grupo();
					$grupo->setIdGrupo($registro['idGrupo']);
					$grupo->setDescricao($registro['descricao']);
					array_push($objetos, $grupo);
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