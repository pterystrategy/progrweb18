<?php	
	require_once 'CrudDAO.php';
	require_once 'Acesso.php';

	require_once 'CrudDAO.php';
	require_once 'Categoria.php';

	class AcessoDAO extends CrudDAO
	{

		public function salvar($acesso){	
			$situacao = FALSE;
			try{
				
				if($acesso->getIdAcesso()==0){

					$situacao = $this->incluir($acesso);

				}else{	
					$situacao = $this->atualizar($acesso);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($acesso){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	

				$sql = "INSERT INTO tbAcesso (descricao, menu, arquivo, tipo, idAcessoPai) VALUES (:descricao, :menu, :arquivo, :tipo. :idAcessoPai)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':descricao', $acesso->getDescricao()); 
				$run->bindValue(':menu', $acesso->getMenu()); 
				$run->bindValue(':arquivo', $acesso->getArquivo());  
				$run->bindValue(':tipo', $acesso->getTipo()); 	
				$run->bindValue(':idAcessoPai', $acesso->getIdAcessoPai());				
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$acesso->setIdAcesso($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($acesso){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "UPDATE tbAcesso SET descricao = :descricao, menu = :menu, arquivo = :arquivo, tipo = :tipo, idAcessoPai = :idAcessoPai  WHERE idAcesso = :idAcesso";

				$run = $pdo->prepare($sql);
				$run->bindValue(':descricao', $acesso->getDescricao()); 
				$run->bindValue(':menu', $acesso->getMenu()); 
				$run->bindValue(':arquivo', $acesso->getArquivo()); 
				$run->bindValue(':tipo', $acesso->getTipo()); 
	  			$run->bindValue(':idAcesso', $acesso->getIdAcesso());				
	  			$run->bindValue(':idAcessoPai', $acesso->getIdAcessoPai());	
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

		public function excluir($acesso){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbAcesso WHERE idAcesso = :idAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idAcesso', $acesso->getIdAcesso(), PDO::PARAM_INT);			
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
					
				$sql = "DELETE FROM tbAcesso WHERE idAcesso = :idAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idAcesso', $codigo);			
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
					
				$sql = "SELECT * FROM tbAcesso";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$acesso = new Acesso();
					$acesso->setIdAcesso($objeto['idAcesso']);
					$acesso->setDescricao($objeto['descricao']);
					$acesso->setMenu($objeto['menu']);
					$acesso->setArquivo($objeto['arquivo']);					
					$acesso->setTipo($objeto['tipo']);
					$acesso->setIdAcessoPai($objeto['idAcessoPai']);

					array_push($objetos, $acesso);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$acesso = new Acesso();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbAcesso WHERE idAcesso = :idAcesso";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idAcesso', $codigo, PDO::PARAM_INT);			
				$run->execute(); 

				$resultado = $run->fetch();

				$acesso->setIdAcesso($resultado['idAcesso']);
				$acesso->setDescricao($resultado['descricao']);
				$acesso->setMenu($resultado['menu']);
				$acesso->setArquivo($resultado['arquivo']);
				$acesso->setTipo($resultado['tipo']);
				$acesso->setIdAcessoPai($resultado['idAcessoPai']);				

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $acesso;
		}

		public function listarPorAcessoPai($codigo){

			$objetos = array();	

			try{
				
				$pdo = parent::conectar();
					
				$sql = "SELECT * FROM tbAcesso WHERE  idAcessoPai = :codigo";

				$run = $pdo->prepare($sql);	
				$run->bindValue(':codigo', $codigo);					
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$acesso = new Acesso();
					$acesso->setIdAcesso($objeto['idAcesso']);
					$acesso->setDescricao($objeto['descricao']);
					$acesso->setMenu($objeto['menu']);
					$acesso->setArquivo($objeto['arquivo']);					
					$acesso->setTipo($objeto['tipo']);
					$acesso->setIdAcessoPai($objeto['idAcessoPai']);

					array_push($objetos, $acesso);
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