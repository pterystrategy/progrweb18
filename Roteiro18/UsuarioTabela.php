<?php	
	session_start();

	require_once 'ControleAcesso.php';

	require_once 'class/UsuarioDAO.php';
	require_once 'class/GrupoDAO.php';
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Usuário</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/datatables.css"/>
		<link type="text/css" rel="stylesheet" href="css/usuario.css"/>
		
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
						echo "<a class='mx-2 btn btn-warning float-left' href='UsuarioTabela.php'>Limpar</a>";
					}
				
					if($permissao == 2){
						echo "<p><a class='btn btn-primary float-right' href='UsuarioFormulario.php?operacao=novo'>Novo</a></p>";
					}
					
				?>
			</div>

			<table id="tabelaUsuario" class="table table-striped">
				<thead>			
					<tr>
						<th></th>
						<th>Nome</th>
						<th>Login</th>
						<th>E-mail</th>
						<th>Último acesso</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php

						$usuarioDAO = new UsuarioDAO();		

						if(isset($_GET["operacao"])=="filtrar"){
							
							$situacao = 'NULL';
							$idGrupo = 'NULL';
							$nome = "";
							$login = "";
							$email = "";
							
							if(isset($_POST["nome"])){
								$nome =  $_POST["nome"];
							}

							if(isset($_POST["login"])){
								$login =  $_POST["login"];
							}
							if(isset($_POST["email"])){
								$email =  $_POST["email"];							
							}

							if(isset($_POST["situacao"])){
								$situacao =  $_POST["situacao"];
							}

							if(isset($_POST["idGrupo"])){
								$idGrupo  =  $_POST["idGrupo"];
							}	

							$lista = $usuarioDAO->filtrar($nome, $login, $email, $situacao, $idGrupo);
							

						}else{
							$lista = $usuarioDAO->listar();	
						}						

						foreach($lista as $usuario){
		
							echo"<tr>";		
							echo"<td> <img class='fotoUsuario' src='imagens/{$usuario->getFoto()}'> </td>";		
							echo"<td>{$usuario->getNome()}</td>";			
							echo"<td>{$usuario->getLogin()}</td>";
							echo"<td>{$usuario->getEmail()}</td>";

							if(strlen($usuario->getUltimoAcesso()) > 0){
								echo"<td>".date("d/m/Y", strtotime($usuario->getUltimoAcesso()))." ".date("H:i:s", strtotime($usuario->getUltimoAcesso()))."</td>";								
							}else{
								echo"<td></td>";
							}

							if($permissao == 2){													
								echo"<td><button type='button' class='btn btn-danger excluir float-left' id='{$usuario->getIdUsuario()}'>excluir</button></td>";	

								echo"<td> <a class='btn btn-success float-left' href='UsuarioFormulario.php?operacao=editar&idUsuario={$usuario->getIdUsuario()}'> editar </a> </td>";	
							}else{
								echo"<td></td>";
								echo"<td></td>";
							}

							echo"<td> <a class='btn btn-secondary float-left' href='UsuarioFormulario.php?operacao=visualizar&idUsuario={$usuario->getIdUsuario()}'> visualizar </a> </td>";							

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
			    	<form id="formGrupo" action="UsuarioTabela.php?operacao=filtrar" method="post">
				        <div class="modal-body">
							<div class="row form-group">
								<div class="col-md-12">
									<label for="nome">Nome</label>  
									<input class="form-control campo" name="nome" id="nome" type="text" value="" >
								</div>
								<div class="col-md-12">
									<label for="login">Login</label>  
									<input class="form-control campo" name="login" id="login" type="text" value="" >
								</div>		
								<div class="col-md-12">
									<label for="email">Email</label>  
									<input class="form-control campo" name="email" id="email" type="text" value="" >
								</div>	
								<div class="col-md-12">								
									<legend class="col-form-label">Situação</legend>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="situacao" id="situacaoHabilitado" value="1">
										<label class="form-check-label" for="situacaoHabilitado">Habilitado</label>
									</div>									
									<div class="form-check">
										<input class="form-check-input" type="radio" name="situacao" id="situacaoBloqueado" value="0" >
										<label class="form-check-label" for="situacaoBloqueado">Bloqueado</label>
									</div>						
								</div>		
								<div class="col-md-12">
									<label for="idGrupo">Grupo de Usuários</label>
									<select id="idGrupo" name="idGrupo" class="form-control">						  
										<?php
											$grupoDAO = new GrupoDAO();
											$lista = $grupoDAO->listar();

											echo "<option value='0' disabled selected>Selecione um grupo de acesso</option>";
											
											foreach($lista as $grupo){	
												echo "<option value='{$grupo->getIdGrupo()}'>{$grupo->getDescricao()}</option>";
											}
										?>	
								
									</select>
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
		<script type="text/javascript" src="js/usuarioTabela.js"></script>		
		
    </body>
</html>