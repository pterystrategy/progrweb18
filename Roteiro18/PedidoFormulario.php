<?php	
	session_start();

	require_once 'ControleAcesso.php';

	require_once 'class/PedidoDAO.php';
	require_once 'class/UsuarioDAO.php';
	require_once 'class/ProdutoDAO.php';
	require_once 'class/PedidoProdutoDAO.php';
	
	$pedido = new Pedido();
	
	$operacao = "visualizar";

	if(isset($_GET["operacao"])){
		$operacao = $_GET["operacao"];
	}

	if(isset($_GET["idPedido"])){
		
		$idPedido = $_GET["idPedido"];

		$pedidoDAO = new PedidoDAO();
		$pedido = $pedidoDAO->buscarPorId($idPedido);
	}
			
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Grupo</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/pedido.css"/>

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.mask.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/pedidoFormulario.js"></script>

    </head>

    <body>	
	
		<div class="cabecalho">	
			<?php 
				include_once("Cabecalho.php");  	
			?>
		</div>					
		
		<div class="container">	

			<h5 class="cabecalho"> <?php echo $menu; ?> </h5>	

			<div class="mb-2 clearfix">
				<p><a class="btn btn-primary float-right" href="PedidoTabela.php">Voltar</a></p>	
			</div>

						
			<form id="formPedido" action="PedidoControlador.php?operacao=salvar" method="post">

				<fieldset <?php if($operacao=="visualizar"){echo 'disabled';}?> >

					<div class="row form-group">
						
						<div class="col-md-8">
							  
							
							<input type="hidden" name="idPedido" id="idPedido" value="<?php echo $pedido->getIdPedido() ?>" >

							<label for="usuario">Usuário</label>	
							<select id="idUsuario" name="idUsuario" class="form-control" required>						  
								<?php
									$usuarioDAO = new UsuarioDAO();
									$lista = $usuarioDAO->listar();

									if($pedido->getUsuario()->getIdUsuario() == 0){
										echo "<option 
										     value='' disabled selected>Selecione um usuário</option>";
									}

									foreach($lista as $usuario){	
										if($usuario->getIdUsuario() == $pedido->getUsuario()->getIdUsuario()){
											echo "<option selected 
											        value='{$usuario->getIdUsuario()}'>{$usuario->getNome()}
												  </option>";
										}
										else{
											echo "<option 
													value='{$usuario->getIdUsuario()}'>{$usuario->getNome()}
												 </option>";
										}
										
									}
								?>	
						
							</select>							

							
						</div>

						<div class="col-md-4">
							<label for="dataPedido">Data do Pedido</label>  
							<input class="form-control campo" name="dataPedido" id="dataPedido" type="text" value="<?php echo $pedido->getDataPedido() ?>" >
						</div>						

					</div>	

					<?php 
						if($operacao=="visualizar"){
							echo "<div class='row form-group ocultar'>";
						}else{
							echo "<div class='row form-group'>";
						}
					?>
						<div class="col-md-11">
						
						<?php 
							if($permissao == 2){
								echo "<button class='btn btn-success' type='submit' name='salvar' id='salvar' value='salvar'>Salvar</button>";
								echo "<button class='btn btn-primary mx-2' type='submit' name='salvarVoltar' id='salvarVoltar' value='salvarVoltar'>Salvar + Voltar</button>";
								echo "<button class='btn btn-dark' type='reset' id='cancelar'>Cancelar</button>";					
							}
						?>						
						</div>																										
					</div>	<!-- fechamento da div dos botões -->

				</fieldset>

			</form >	

			<?php 
				if($pedido->getIdPedido()==0){
					echo "<div class='ocultar'>";
				}
			?>
				
				<form id="formPedidoProduto" action="PedidoProdutoControlador.php?operacao=salvar" method="post">

					<fieldset <?php if($operacao=="visualizar"){echo 'disabled';} ?> >
					
						<input type="hidden" name="idPedido" id="idPedido" value="<?php echo $pedido->getIdPedido() ?>" >

						<div class="row form-group">
							<div class="col-md-6">
								<label for="idProduto">Produto</label>
								<select id="idProduto" name="idProduto" class="form-control" required>		
									<?php
										$produtoDAO = new ProdutoDAO();
										$lista = $produtoDAO->listar();

										echo "<option value='' disabled selected>Selecione um acesso</option>";
										
										foreach($lista as $produto){	
											echo "<option value='{$produto->getIdProduto()}'>{$produto->getDescricao()}</option>";								
										}
									?>						
								</select>
							</div>

							<div class="col-md-3">
								<label for="quantidade">Quantidade</label>
								<input class="form-control campo" name="quantidade" id="quantidade" type="text" value="0" >
							</div>		
							
							<div class="col-md-3">
								<label for="valor">Valor</label>
								<input class="form-control campo" name="valor" id="valor" type="text" value="0" >
							</div>							

						</div>	

						<?php 
							if($operacao=="visualizar"){
								echo "<div class='row form-group ocultar'>";
							}else{
								echo "<div class='row form-group'>";		
							}
						?>							
							<div class="col-md-12">
								<button class="btn btn-success" type="submit" id="adicionar">Adicionar</button>
							</div>	

						</div> <!-- fechamento da div do botão adicionar -->

					</fieldset>				
				</form >

				<div class="row form-group">
					<div class="col-md-12">
						<table class="table">
							<thead>					
								<tr>
									<th>Produto</th>
									<th>Quantidade</th>
									<th>Valor</th>									
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($pedido->getIdPedido()!=0){

										$pedidoProdutoDAO = new PedidoProdutoDAO();
										$lista = $pedidoProdutoDAO->listarPorPedido($pedido->getIdPedido());

										foreach($lista as $pedidoProduto){						
											echo"<tr>";	
											
											echo"<td>{$pedidoProduto->getProduto()->getDescricao()}</td>";
											echo"<td>{$pedidoProduto->getQuantidade()} </td>";
											echo"<td>{$pedidoProduto->getValor()} </td>";

											if($operacao=="visualizar"){				
												echo"<td></td>";
											}else{
												echo"<td class='float-right'> <a class='btn btn-danger' href='PedidoProdutoControlador.php?operacao=excluir&idPedidoProduto={$pedidoProduto->getIdPedidoProduto()}&idPedido={$pedidoProduto->getPedido()->getIdPedido()}'>Excluir</a></td>";	
											}

											echo"</tr>";							
										}

									}						
									
								?>									
																						
							</tbody>
						</table>						

					</div>
				</div>	

			<?php 
				if($pedido->getIdPedido()==0){
					echo "</div>";
					//fechamento da div do segundo formulário
				}
			?>
		</div>
	
    </body>
</html>