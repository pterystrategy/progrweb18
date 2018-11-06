<?php	
	session_start();
	require_once 'ControleAcesso.php';

	require_once 'class/CategoriaDAO.php';	
?>
	
<html>
    <head>
		<meta charset="utf-8">
		<title>Categoria</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/datatables.css"/>	
		<link type="text/css" rel="stylesheet" href="css/categoria.css"/>
    </head>

    <body>	
	
		<div class="cabecalho">	
			<?php 
				include_once("Cabecalho.php");  	
			?>
		</div>
	
		<div id="corpoTabela" class="container">		

			<h5 class="cabecalho"> <?php echo $menu; ?> </h5>		
			
			<div class="mb-2 clearfix">
				<p><button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modalFiltro">Filtrar</button></p>	
				
				<?php
					if(isset($_GET["operacao"])=="filtrar"){
						echo "<a class='mx-2 btn btn-warning float-left' href='CategoriaTabela.php'>Limpar</a>";
					}

					if($permissao == 2){
						echo "<p><a class='btn btn-primary float-right' href='CategoriaFormulario.php?operacao=novo'>Novo</a></p>";
					}					
				?>
				
			</div>
			
			<table id="tabelaCategoria" class="table table-striped">
				<thead>					
					<tr>
						<th class="col-md-9">Descrição</th>
						<th class="col-md-1"></th>
						<th class="col-md-1"></th>
						<th class="col-md-1"></th>
					</tr>
				</thead>
				<tbody>
					<?php
	
						$categoriaDAO = new CategoriaDAO();
						
						if(isset($_GET["operacao"])=="filtrar"){							
							$descricao = "";							
							if(isset($_POST["descricao"])){
								$descricao = $_POST["descricao"];
							}
							$lista = $categoriaDAO->filtrar($descricao);
						}else{
							$lista = $categoriaDAO->listar();
						}

						foreach($lista as $categoria){		

							echo"<tr>";			
							echo"<td>{$categoria->getDescricao()}</td>";

							if($permissao == 2){	
							echo"<td> <a class='btn btn-danger'  href='CategoriaControlador.php?operacao=excluir&idCategoria={$categoria->getIdCategoria()}'> excluir </a> </td>";	

							echo"<td> <a class='btn btn-success' href='CategoriaFormulario.php?operacao=editar&idCategoria={$categoria->getIdCategoria()}'> editar </a> </td>";	

							}else{
								echo"<td></td>";
								echo"<td></td>";						
							}

							echo"<td> <a class='btn btn-secondary'  href='CategoriaFormulario.php?operacao=visualizar&idCategoria={$categoria->getIdCategoria()}'> Visualizar </a> </td>";															
							echo"</tr>";							
						}						
						
					?>		
						
				</tbody>
			</table>	
		</div>				
		
		<!-- Modal -->	
		<div class="modal fade" id="modalFiltro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
				<form id="formFiltroCategoria" action="CategoriaTabela.php?operacao=filtrar" 
					method="post">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Filtro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					 <label for="descricao">Descrição</label>  
					 <input class="form-control campo" name="descricao" 
						id="descricao" type="text" value="" >
				  </div>
				  <div class="modal-footer">
					<button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Aplicar</button>
				  </div>
				</form>
			</div>
		  </div>
		</div>		
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/datatables.js"></script>
		<script type="text/javascript" src="js/categoriaTabela.js"></script>
    </body>
</html>