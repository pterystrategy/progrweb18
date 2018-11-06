	<?php	
	require_once 'CrudDAO.php';
	require_once 'UsuarioDAO.php';
	require_once 'Pedido.php';

	class PedidoDAO extends CrudDAO
	{

		public function salvar($pedido){	
			$situacao = FALSE;
			try{
				
				if($pedido->getIdPedido()==0){

					$situacao = $this->incluir($pedido);

				}else{	
					$situacao = $this->atualizar($pedido);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($pedido){	
			$situacao = FALSE;

			try{
				
				$pdo = parent::conectar();	

				$sql = "INSERT INTO tbPedido(idUsuario, dataPedido) 
						VALUES (:idUsuario, :dataPedido);";

				$dataPedido = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$pedido->getDataPedido())));
				$run = $pdo->prepare($sql);
				$run->bindValue(':idUsuario', $pedido->getUsuario()->getIdUsuario());
				$run->bindValue(':dataPedido', $dataPedido); 
				
	  			$run->execute();

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
				$pedido->setIdPedido($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($pedido){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbPedido SET idUsuario = :idUsuario, dataPedido = :dataPedido WHERE idPedido = :idPedido";
				
				$dataPedido = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$pedido->getDataPedido())));

				$run = $pdo->prepare($sql);
				$run->bindValue(':idPedido', $pedido->getIdPedido());  
				$run->bindValue(':idUsuario', $pedido->getUsuario()->getIdUsuario());
				$run->bindValue(':dataPedido', $dataPedido);  
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

		public function excluir($pedido){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbPedido WHERE idPedido = :idPedido";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedido', $pedido->getIdPedido());			
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
					
				$sql = "DELETE FROM tbPedido WHERE idPedido = :idPedido";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedido', $codigo);			
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
					
				$sql = "SELECT * FROM tbPedido";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$pedido = new Pedido();
					$pedido->setIdPedido($registro['idPedido']);
					
					$usuarioDAO = new UsuarioDAO();
					$usuario = $usuarioDAO->buscarPorId($registro['idUsuario']);
					$pedido->setUsuario($usuario);				
					$pedido->setDataPedido($registro['dataPedido']);
					
									
					array_push($objetos, $pedido);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$pedido = new Pedido();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbPedido WHERE idPedido = :idPedido";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedido', $codigo);			
				$run->execute(); 
				$registro = $run->fetch();

				$pedido->setIdPedido($registro['idPedido']);
				$usuarioDAO = new UsuarioDAO();
				$usuario = $usuarioDAO->buscarPorId($registro['idUsuario']);
				$pedido->setUsuario($usuario);
				$pedido->setDataPedido($registro['dataPedido']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $pedido;
		}

		public function filtrar($usuario, $dataInicio, $dataFim, $produto){

			$objetos = array();	

			try{
				
				$pdo = parent::conectar();
					

				if( $dataInicio != NULL){
					$dataInicio = date("Y-m-d H:i:s",strtotime(str_replace('/','-', $dataInicio)));	
					$dataInicio = "'".$dataInicio."'";
				}else{
					$dataInicio = 'NULL';
				}
				
				if( $dataFim != NULL){
					$dataFim = date("Y-m-d H:i:s",strtotime(str_replace('/','-', $dataFim)));
					$dataFim = "'".$dataFim."'";
				}else{
					$dataFim = 'NULL';
				}

				$sql = "SELECT DISTINCT ped.idPedido, ped.idUsuario, ped.dataPedido
                        FROM tbPedido AS ped 
                        LEFT JOIN tbUsuario AS usu ON ped.idUsuario = usu.idUsuario 
                        LEFT JOIN tbPedidoProduto AS pedpro ON ped.idPedido = pedpro.idPedido  
                        LEFT JOIN tbProduto AS pro ON pedpro.idProduto = pro.idProduto  
                        WHERE 
                            IFNULL(pro.nome, '') LIKE '%{$produto}%'     
                        AND usu.nome LIKE '%{$usuario}%' 
                        AND dataPedido BETWEEN IFNULL({$dataInicio}, dataPedido) AND IFNULL({$dataFim}, dataPedido);";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$pedido = new Pedido();
					$pedido->setIdPedido($registro['idPedido']);
					
					$usuarioDAO = new UsuarioDAO();
					$usuario = $usuarioDAO->buscarPorId($registro['idUsuario']);
					$pedido->setUsuario($usuario);
					$pedido->setDataPedido($registro['dataPedido']);
					
									
					array_push($objetos, $pedido);
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