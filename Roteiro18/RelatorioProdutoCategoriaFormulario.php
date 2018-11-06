<?php	
	session_start();
	require_once 'ControleAcesso.php';
				
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Grupo de Acesso</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/RelatorioProdutoCategoriaFormulario.css"/>
    </head>

    <body>	
	
		<div class="cabecalho">	
			<?php 
				include_once("Cabecalho.php");  	
			?>
		</div>					
		
		<div class="container">	

			<h5 class="cabecalho"> <?php echo $menu; ?> </h5>	

			<form id="formRelatorioProdutoCategoriaFormulario" action="relatorio/RelatorioProdutoCategoriaImpressao.php" method="post">

				<fieldset>

					<div class="row form-group">
						<div class="col-md-12">
							<label for="categoria">Categoria</label>  
							<input class="form-control" name="categoria" id="categoria" type="text" value="" >
						</div>
						<div class="col-md-6">
							<label for="minimo">Estoque mínimo</label>  
							<input class="form-control" name="minimo" id="minimo" type="text" value="" >
						</div>
						<div class="col-md-6">
							<label for="maximo">Estoque máximo</label>  
							<input class="form-control" name="maximo" id="maximo" type="text" value="" >
						</div>
						<div class="col-md-12">
							<label for="produto">Produto</label>  
							<input class="form-control" name="produto" id="produto" type="text" value="" >
						</div>																		
						
					</div>		
	
					<div class='row form-group'>
	
						<div class="col-md-11">
						<?php 
							if($permissao == 2){
								echo "<button class='btn btn-success' type='submit' name='imprimir' id='imprimir' value='imprimir'>Imprimir</button>";
								echo "<button class='btn btn-dark mx-2' type='reset' id='cancelar'>Cancelar</button>";					
							}
						?>
						</div>																																			
					</div>

				</fieldset>				
			</form >	
		</div>
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/jquery.mask.js"></script>		
		<script type="text/javascript" src="js/RelatorioProdutoCategoriaFormulario.js"></script>
    </body>
</html>