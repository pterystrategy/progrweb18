	<?php	
	require_once 'CrudDAO.php';
	require_once 'UsuarioDAO.php';
	require_once './Venda.php';

	class PedidoDAO extends CrudDAO
	{

		public function salvar($venda){	
			$situacao = FALSE;
			try{
				
				if($venda->getId()==0){

					$situacao = $this->incluir($venda);

				}else{	
					$situacao = $this->atualizar($venda);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($venda){	
			$situacao = FALSE;

			try{
				
				
            $pdo = Banco::conectar();

            $sql = "INSERT INTO tbVenda (cliente, cpf, dataVenda, total) VALUES (:cliente, :cpf, :dataVenda, :total)";
            $run = $pdo->prepare($sql);


            $run->bindParam(':cliente', $venda->getCliente(), PDO::PARAM_STR);
            $run->bindParam(':cpf', $venda->getCpf(), PDO::PARAM_STR);
            $run->bindParam(':dataVenda', $venda->getDataVenda());
            $run->bindParam(':total', $venda->getTotal(), PDO::PARAM_INT);

            $run->execute();

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
				$venda->setId($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($venda){	
			$situacao = FALSE;
			try{
	/* @var $pdo type */
            $pdo = Banco::conectar();

            $sql = "UPDATE tbVenda SET cliente = :cliente, cpf = :cpf, dataVenda = :dataVenda, total = :total  WHERE  id = :id";
            $run = $pdo->prepare($sql);

            $run->bindParam(':id', $venda->getId(), PDO::PARAM_INT);
            $run->bindParam(':cliente', $venda->getCliente(), PDO::PARAM_STR);
            $run->bindParam(':cpf', $venda->getCpf(), PDO::PARAM_STR);
            $run->bindParam(':dataVenda', $venda->getDataVenda(), PDO::PARAM_STR);
            $run->bindParam(':total', $venda->getTotal(), PDO::PARAM_INT);
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
				    $pdo = Banco::conectar();

            $sql = "DELETE FROM tbVenda WHERE id = :id";


            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $venda->getId(), PDO::PARAM_INT);
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
				
				 $pdo = Banco::conectar();

            $sql = "DELETE FROM tbVenda WHERE id = :id";

            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $codigo, PDO::PARAM_INT);
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

		public function listar() {

        $objetos = array();

        try {

            $pdo = Banco::conectar();

            $sql = "SELECT * FROM tbVenda";

            $run = $pdo->prepare($sql);
            $run->execute();
            $resultado = $run->fetchAll();

            foreach ($resultado as $objeto) {

                $venda = new Venda();
                $venda->setId($objeto['id']);
                $venda->setCliente($objeto['cliente']);
                $venda->setCpf($objeto['cpf']);
                $venda->setDataVenda($objeto['dataVenda']);
                $venda->setTotal($objeto['total']);
                array_push($objetos, $venda);
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $objetos;
    }
		public function buscarPorId($codigo) {

        try {

            $pdo = Banco::conectar();

            $sql = "SELECT * FROM tbVenda WHERE id = :id";

            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $codigo, PDO::PARAM_INT);
            $run->execute();
            $resultado = $run->fetch();
            $venda = new Venda();
            $venda->setId($resultado['id']);
            $venda->setCliente($resultado['cliente']);
            $venda->setCpf($resultado['cpf']);
            $venda->setDataVenda($resultado['dataVenda']);
            $venda->setTotal($resultado['total']);
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            Banco::desconectar();
        }

        return $venda;
    }
		public function filtrar($venda){

			$objetos = array();	

			try{
				
				$pdo = parent::conectar();
					
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