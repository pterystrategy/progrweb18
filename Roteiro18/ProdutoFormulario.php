<?php	
	session_start();
	require_once 'ControleAcesso.php';

	require_once 'class/ProdutoDAO.php';
	require_once 'class/CategoriaDAO.php';

	$produto = new Produto();		
	
	if(isset($_GET["idProduto"])){
		
		$idProduto = $_GET["idProduto"];

		$produtoDAO = new ProdutoDAO();
		$produto = $produtoDAO->buscarPorId($idProduto);

	}
			
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
						

		<form id="formProduto" action="ProdutoControlador.php?operacao=salvar" method="post" enctype="multipart/form-data">
			<div class="container">
				<div class="row form-group">
					<div class="col-md-12">
						<label for="nome">Produto</label>  
						<input type="hidden" name="idProduto" id="idProduto" value="<?php echo $produto->getIdProduto() ?>" >
						<input class="form-control" name="nome" id="nome" type="text" value="<?php echo $produto->getNome() ?>">
					</div>			
				</div>
				
				<div class="row form-group">
					<div class="col-md-12">
						<label for="descricao">Descricao</label>
						<textarea class="form-control" id="descricao" name="descricao" rows="4"><?php echo $produto->getDescricao() ?></textarea>
					</div>		
				</div>
  
				<div class="row form-group">
					<div class="col-md-12">
						<label for="valor">Valor</label>
						<input class="form-control" id="valor" name="valor" type="text" value="<?php echo $produto->getValor() ?>">
					</div>			
				</div>	
				<div class="row form-group">
					<div class="col-md-12">
						<label for="quantidade">Quantidade</label>
						<input class="form-control" id="quantidade" name="quantidade" type="text" value="<?php echo $produto->getQuantidade() ?>">
					</div>			
				</div>					
				
				<div class="row form-group">		
					<div class="col-md-12">
						<label for="idCategoria">Categoria</label>
						<select id="idCategoria" name="idCategoria" class="form-control" required>						  
							<?php
								$musicaDAO = new CategoriaDAO();
								$lista = $musicaDAO->listar();

								if($produto->getIdProduto() == 0){
									echo "<option value='' disabled selected>Selecione uma categoria</option>";
								}

								foreach($lista as $musica){	
									if($produto->getCategoria() == $musica->getIdCategoria()){
										echo "<option selected value='{$musica->getIdCategoria()}'>{$musica->getDescricao()}</option>";
									}
									else{
										echo "<option value='{$musica->getIdCategoria()}'>{$musica->getDescricao()}</option>";
									}
								}
							?>	
						</select>
						
					</div>								
				</div>	
				
				<div class="row form-group">
					<div class="col-md-12">
						<label for="foto">Foto</label>
						<input class="form-control" id="foto" name="foto" type="file" value="<?php echo $produto->getFoto() ?>">
					</div>			
				</div>					
				
				<div class="row form-group">
					<div class="col-md-11">
						<button class="btn btn-success" type="submit" name="action">Salvar</button>
						<button class="btn btn-danger" type="reset" name="action">Cancelar</button>						
					</div>											
					<div class="col-md-1">
						<a class="btn btn-primary" href="ProdutoTabela.php">Voltar</a>
					</div>																									
				</div>					
			</div>
		</form >	
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/jquery.mask.js"></script>		
		<script type="text/javascript" src="js/produto.js"></script>
    </body>
</html>