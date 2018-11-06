<?php	
	session_start();
	
	require_once 'ControleAcesso.php';

	require_once 'class/GrupoDAO.php';
		
?>
	
<html>
    <head>
		<meta charset="utf-8">
		<title>Grupo</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/datatables.css"/>
		<link type="text/css" rel="stylesheet" href="css/grupo.css"/>	

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
				<p><button type='button' class='btn btn-primary float-left filtrar'>Filtrar</button></p>

				<?php
					if(isset($_GET["operacao"])=="filtrar"){
						echo "<a class='mx-2 btn btn-warning float-left' href='GrupoTabela.php'>Limpar</a>";
					}

					if($permissao == 2){
						echo "<p><a class='btn btn-primary float-right' href='GrupoFormulario.php?operacao=novo'>Novo</a></p>";
					}
				?>

			</div>
						
			<table id="tabelaGrupo" class="table table-striped">
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
	
						$grupoDAO = new GrupoDAO();

						if(isset($_GET["operacao"])=="filtrar"){

							$descricao = "";
							
							if(isset($_POST["descricao"])){
								$descricao =  $_POST["descricao"];
							}

							$lista = $grupoDAO->filtrar($descricao);	

						}else{
							$lista = $grupoDAO->listar();	
						}
						

						foreach($lista as $grupo){						
							echo"<tr>";			
							echo"<td>{$grupo->getDescricao()}</td>";

							if($permissao == 2){													
														
								echo"<td><button type='button' class='btn btn-danger excluir' id='{$grupo->getIdGrupo()}'>excluir</button></td>";	

								echo"<td> <a class='btn btn-success' href='GrupoFormulario.php?operacao=editar&idGrupo={$grupo->getIdGrupo()}'> editar </a> </td>";

							}else{
								echo"<td></td>";
								echo"<td></td>";
							}


							echo"<td> <a class='btn btn-secondary' href='GrupoFormulario.php?operacao=visualizar&idGrupo={$grupo->getIdGrupo()}'> visualizar </a> </td>";								

							echo"</tr>";							
						}						
						
					?>		
						
				</tbody>
			</table>	
		<div>
		
		
		
		
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header atencao">
			            Atenção
			        </div>
			        <div class="modal-body">
			            Confirma exclusão deste registro?
			        </div>
			        <div class="modal-footer">
			            <button type="button" class="btn btn-dark" data-dismiss="modal" href="#">Cancelar</button>
			            <a class="btn btn-danger excluir" id="botaoExcluir" >Excluir</a>
			        </div>
			    </div>
			</div>	
		</div>

		<div class="modal fade" id="confirm-filtro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
			    	<form id="formGrupo" action="GrupoTabela.php?operacao=filtrar" method="post">
				        <div class="modal-body">
							<div class="row form-group">
								<div class="col-md-12">
									<label for="descricao">Descrição</label>  
									<input class="form-control campo" name="descricao" id="descricao" type="text" value="" >

								</div>
							</div>					        	
				        </div>
				        <div class="modal-footer">
				            <button type="button" class="btn btn-dark" data-dismiss="modal" href="#">Cancelar</button>
				            <button type="submit" class="btn btn-primary filtro" id="botaoFiltro"> Aplicar </button>
				        </div>
			    	</form>
			    </div>
			</div>	
		</div>		

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/datatables.js"></script>
		<script type="text/javascript" src="js/grupoTabela.js"></script>
		
    </body>
</html>