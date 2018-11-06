<?php	
	session_start();

	require_once 'ControleAcesso.php';

	require_once 'class/GrupoDAO.php';
	require_once 'class/AcessoDAO.php';
	require_once 'class/GrupoAcessoDAO.php';
	
	$grupo = new Grupo();
	
	$operacao = "visualizar";

	if(isset($_GET["operacao"])){
		$operacao = $_GET["operacao"];
	}

	if(isset($_GET["idGrupo"])){
		
		$idGrupo = $_GET["idGrupo"];

		$grupoDAO = new GrupoDAO();
		$grupo = $grupoDAO->buscarPorId($idGrupo);
	}
			
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Grupo</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/grupo.css"/>
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
				<p><a class="btn btn-primary float-right" href="GrupoTabela.php">Voltar</a></p>	
			</div>

						
			<form id="formGrupo" action="GrupoControlador.php?operacao=salvar" method="post">

				<fieldset <?php if($operacao=="visualizar"){echo 'disabled';}?> >

					<div class="row form-group">
						<div class="col-md-12">
							<label for="descricao">Descrição</label>  
							<input type="hidden" name="idGrupo" id="idGrupo" value="<?php echo $grupo->getIdGrupo() ?>" >
							<input class="form-control campo" name="descricao" id="descricao" type="text" value="<?php echo $grupo->getDescricao() ?>" >

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
				if($grupo->getIdGrupo()==0){
					echo "<div class='ocultar'>";
				}
			?>
				
				<form id="formGrupoAcesso" action="GrupoAcessoControlador.php?operacao=salvar" method="post">

					<fieldset <?php if($operacao=="visualizar"){echo 'disabled';} ?> >
					
						<input type="hidden" name="idGrupo" id="idGrupo" value="<?php echo $grupo->getIdGrupo() ?>" >

						<div class="row form-group">
							<div class="col-md-6">
								<label for="idAcesso">Acesso</label>
								<select id="idAcesso" name="idAcesso" class="form-control" required>		
									<?php
										$acessoDAO = new AcessoDAO();
										$lista = $acessoDAO->listar();

										echo "<option value='' disabled selected>Selecione um acesso</option>";
										
										foreach($lista as $acesso){	
											echo "<option value='{$acesso->getIdAcesso()}'>{$acesso->getDescricao()}</option>";								
										}
									?>						
								</select>
							</div>

							<div class="col-md-6">
								<label for="permissao">Permissão</label>
								<select id="permissao" name="permissao" class="form-control" required>		<option value='' disabled selected>Selecione uma permissão</option>
									<option value='1'>Leitura</option>
									<option value='2'>Total</option>		
								</select>
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
									<th>Acesso</th>
									<th>Permissão</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($grupo->getIdGrupo()!=0){

										$grupoAcessoDAO = new GrupoAcessoDAO();
										$lista = $grupoAcessoDAO->listarPorGrupo($grupo->getIdGrupo());

										foreach($lista as $grupoAcesso){						
											echo"<tr>";	

											echo"<td>{$grupoAcesso->getAcesso()->getDescricao()}</td>";
											echo"<td>{$grupoAcesso->getDescricaoPermissao()} </td>";

											if($operacao=="visualizar"){				
												echo"<td></td>";
											}else{
												echo"<td class='float-right'> <a class='btn btn-danger' href='GrupoAcessoControlador.php?operacao=excluir&idGrupoAcesso={$grupoAcesso->getIdGrupoAcesso()}&idGrupo={$grupoAcesso->getGrupo()->getIdGrupo()}'>Excluir</a></td>";	
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
				if($grupo->getIdGrupo()==0){
					echo "</div>";
					//fechamento da div do segundo formulário
				}
			?>
		</div>
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/grupoFormulario.js"></script>
    </body>
</html>