<?php	
	session_start();
	require_once 'ControleAcesso.php';

	require_once 'class/ProdutoDAO.php';
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Produto</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/produto.css"/>
		
    </head>

    <body>	
		
		<div class="cabecalho">	
			<?php 
				$menu = "produto";
				include_once("Cabecalho.php");  	
			?>
		</div>		
				
		<div class="container">				
			<table id="tabelaProduto" class="table table-striped">
				<thead>			
					<tr>
						<th></th>
						<th class="col-md-6">Produto</th>
						<th class="col-md-5">Quantidade</th>
						<th class="col-md-1"></th>
						<th class="col-md"><a class="btn btn-primary" href="ProdutoFormulario.php">Novo</a></th>
					</tr>
				</thead>
				<tbody>
					<?php

						$produtoDAO = new ProdutoDAO();
						$lista = $produtoDAO->listar();

						foreach($lista as $produto){
		
							echo"<tr>";								
							echo"<td> <img class='fotoProduto' src='imagens/{$produto->getFoto()}'> </td>";
							echo"<td>{$produto->getNome()}</td>";
							echo"<td>{$produto->getQuantidade()}</td>";
							echo"<td> <a class='btn btn-success' href='ProdutoFormulario.php?idProduto={$produto->getIdProduto()}'> editar </a> </td>";
							echo"<td> <a class='btn btn-danger'  href='ProdutoControlador.php?operacao=excluir&idProduto={$produto->getIdProduto()}'> excluir </a> </td>";								
							echo"</tr>";					
						}
					?>		
						
				</tbody>
			</table>	
		<div>				
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		
    </body>
</html>