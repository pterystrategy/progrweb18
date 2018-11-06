<?php	
	require_once 'CrudDAO.php';
	require_once 'CategoriaDAO.php';	
	require_once 'Produto.php';

	class ProdutoDAO extends CrudDAO
	{

		public function salvar($produto){	
			$situacao = FALSE;
			try{
				
				if($produto->getIdProduto()==0){

					$situacao = $this->incluir($produto);

				}else{	
					$situacao = $this->atualizar($produto);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($produto){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	

				$sql = "INSERT INTO tbProduto(nome, descricao, valor, quantidadeEstoque, foto, idCategoria) VALUES (:nome, :descricao, :valor, :quantidade, :foto, :idCategoria)";
				
				$run = $pdo->prepare($sql);
				$run->bindValue(':nome', $produto->getNome()); 
				$run->bindValue(':descricao', $produto->getDescricao()); 
				$run->bindValue(':valor', $produto->getValor()); 
				$run->bindValue(':quantidade', $produto->getQuantidade()); 
				$run->bindValue(':foto', $produto->getFoto()); 
				$run->bindValue(':idCategoria', $produto->getCategoria()->getIdCategoria()); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$produto->setIdProduto($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($produto){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbProduto SET nome = :nome, descricao = :descricao, valor = :valor, quantidadeEstoque = :quantidade, foto = :foto, idCategoria = :idCategoria WHERE idProduto = :idProduto";
				
				$run = $pdo->prepare($sql);
				$run->bindValue(':idProduto', $produto->getIdProduto()); 
				$run->bindValue(':nome', $produto->getNome()); 
				$run->bindValue(':descricao', $produto->getDescricao()); 
				$run->bindValue(':valor', $produto->getValor()); 
				$run->bindValue(':quantidade', $produto->getQuantidade()); 
				$run->bindValue(':foto', $produto->getFoto()); 
				$run->bindValue(':idCategoria', $produto->getCategoria()->getIdCategoria()); 
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

		public function excluir($produto){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbProduto WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idProduto', $produto->getIdProduto());			
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
					
				$sql = "DELETE FROM tbProduto WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idProduto', $codigo);			
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
					
				$sql = "SELECT * FROM tbProduto  ORDER BY nome";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();
				
				$categoriaDAO = new CategoriaDAO();

				foreach ($resultado as $registro){

					$produto = new Produto();

					$produto->setIdProduto($registro['idProduto']);
					$produto->setNome($registro['nome']);
					$produto->setDescricao($registro['descricao']);
					$produto->setValor($registro['valor']);
					$produto->setQuantidade($registro['quantidadeEstoque']);
					$produto->setFoto($registro['foto']);
					
					$categoria = $categoriaDAO->buscarPorId($registro['idCategoria']);
					$produto->setCategoria($categoria);									

					array_push($objetos, $produto);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$produto = new Produto();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbProduto WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idProduto', $codigo);			
				$run->execute(); 
				$registro = $run->fetch();

				$categoriaDAO = new CategoriaDAO();

				$produto = new Produto();

				$produto->setIdProduto($registro['idProduto']);
				$produto->setNome($registro['nome']);
				$produto->setDescricao($registro['descricao']);
				$produto->setValor($registro['valor']);
				$produto->setQuantidade($registro['quantidadeEstoque']);
				$produto->setFoto($registro['foto']);
				
				$categoria = $categoriaDAO->buscarPorId($registro['idCategoria']);
				$produto->setCategoria($categoria);	


			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $produto;
		}		

	}
	
?> 