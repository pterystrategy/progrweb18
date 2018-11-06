<?php	
	require_once 'CrudDAO.php';
	require_once 'Categoria.php';

	class CategoriaDAO extends CrudDAO
	{

		public function salvar($categoria){	
			$situacao = FALSE;
			try{
				
				if($categoria->getIdCategoria()==0){

					$situacao = $this->incluir($categoria);

				}else{	
					$situacao = $this->atualizar($categoria);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($categoria){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	

				$sql = "INSERT INTO tbCategoria(descricao) VALUES (:descricao)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':descricao', $categoria->getDescricao(), PDO::PARAM_STR); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$categoria->setIdCategoria($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($categoria){	
			
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbCategoria SET descricao = :descricao WHERE idCategoria = :idCategoria";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':descricao', $categoria->getDescricao(), PDO::PARAM_STR);
	  			$run->bindValue(':idCategoria', $categoria->getIdCategoria(), PDO::PARAM_INT);				
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

		public function excluir($categoria){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbCategoria WHERE idCategoria = :idCategoria";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idCategoria', $categoria->getIdCategoria(), PDO::PARAM_INT);			
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
					
				$sql = "DELETE FROM tbCategoria WHERE idCategoria = :idCategoria";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idCategoria', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbCategoria ORDER BY  descricao";

				$run = $pdo->prepare($sql);			
				$run->execute(); 

				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){
					$categoria = new Categoria();
					$categoria->setIdCategoria($registro['idCategoria']);
					$categoria->setDescricao($registro['descricao']);
					array_push($objetos, $categoria);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$categoria = new Categoria();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbCategoria WHERE idCategoria = :idCategoria";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idCategoria', $codigo, PDO::PARAM_INT);			
				$run->execute(); 

				$registro = $run->fetch();

				$categoria->setIdCategoria($registro['idCategoria']);
				$categoria->setDescricao($registro['descricao']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $categoria;
		}

		public function filtrar($descricao){
			
			$objetos = array();	

			$categoria = new Categoria();						
			try{
				$pdo = parent::conectar();
				
				$sql = "SELECT * FROM tbCategoria WHERE descricao LIKE :descricao";
				$run = $pdo->prepare($sql);
	  			$run->bindValue(':descricao', '%'.$descricao.'%');
				
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){
					$categoria = new Categoria();
					$categoria->setIdCategoria($registro['idCategoria']);
					$categoria->setDescricao($registro['descricao']);
					array_push($objetos, $categoria);
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