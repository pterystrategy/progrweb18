<?php	
	session_start();
	require_once 'ControleAcesso.php';

	require_once 'class/CategoriaDAO.php';

	$categoria = new Categoria();

	$operacao = "visualizar";

	if(isset($_GET["operacao"])){
		$operacao = $_GET["operacao"];
	}

		
	if(isset($_GET["idCategoria"])){
		
		$idCategoria = $_GET["idCategoria"];

		$categoriaDAO = new CategoriaDAO();
		$categoria = $categoriaDAO->buscarPorId($idCategoria);
	}
			
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Grupo de Acesso</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/categoria.css"/>
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
				<p><a class="btn btn-primary float-right" href="CategoriaTabela.php">Voltar</a></p>	
			</div>	
			
			<form id="formCategoria" action="CategoriaControlador.php?operacao=salvar" method="post">

				<fieldset <?php if($operacao=="visualizar"){echo 'disabled';} ?> >

					<div class="row form-group">
						<div class="col-md-12">
							<label for="descricao">Descrição</label>  
							<input type="hidden" name="idCategoria" id="idCategoria" value="<?php echo $categoria->getIdCategoria() ?>" >
							<input class="form-control" name="descricao" id="descricao" type="text" value="<?php echo $categoria->getDescricao() ?>" >
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
		</div>
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/categoriaFormulario.js"></script>
    </body>
</html>