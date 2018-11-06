<?php	
	session_start();

	require_once 'ControleAcesso.php';

	require_once 'class/UsuarioDAO.php';
	require_once 'class/GrupoDAO.php';

	$usuario = new Usuario();		

	$operacao = "visualizar";

	if(isset($_GET["operacao"])){
		$operacao = $_GET["operacao"];
	}
	
	if(isset($_GET["idUsuario"])){
		
		$idUsuario = $_GET["idUsuario"];

		$usuarioDAO = new UsuarioDAO();
		$usuario = $usuarioDAO->buscarPorId($idUsuario);

	}
			
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Usuário</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/usuario.css"/>
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
				<p><a class="btn btn-primary float-right" href="UsuarioTabela.php">Voltar</a></p>	
			</div>	
					

			<form id="formUsuario" action="UsuarioControlador.php?operacao=salvar" method="post" enctype="multipart/form-data">
				
				<fieldset <?php if($operacao=="visualizar"){echo 'disabled';} ?> >

					<input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $usuario->getIdUsuario() ?>" >
					<div class="row form-group">
						<div class="col-md-12">
							<label for="nome">Nome</label>  						
							<input class="form-control" name="nome" id="nome" type="text" value="<?php echo $usuario->getNome() ?>">
						</div>			
					</div>
					<div class="row form-group">
						<div class="col-md-12">
							<label for="login">Login</label>  
							<input class="form-control" name="login" id="login" type="text" value="<?php echo $usuario->getLogin() ?>">
						</div>			
					</div>				
					<div class="row form-group">
						<div class="col-md-12">
							<label for="senha">Senha</label>
							<input class="form-control" id="senha" name="senha" type="password" value="<?php echo $usuario->getSenha() ?>">
						</div>			
					</div>	
					<div class="row form-group">
						<div class="col-md-12">
							<label for="email">E-mail</label>
							<input class="form-control" id="email" name="email" type="text" value="<?php echo $usuario->getEmail() ?>">
						</div>			
					</div>	
					
	  
					<div class="row form-group">
						<div class="col-md-12">
							<legend class="col-form-label">Situação</legend>

							<div class="form-check">
								<input class="form-check-input" type="radio" name="situacao" id="situacaoHabilitado" value="1" <?php if($usuario->getSituacao() == 1){echo 'checked';} ?>>
								<label class="form-check-label" for="situacaoHabilitado">Habilitado</label>
							</div>
							
							<div class="form-check">
								<input class="form-check-input" type="radio" name="situacao" id="situacaoBloqueado" value="0" <?php if($usuario->getSituacao() == 0){echo 'checked';} ?>>
								<label class="form-check-label" for="situacaoBloqueado">Bloqueado</label>
							</div>
						</div>
					</div>

					<div class="row form-group">		
						<div class="col-md-12">
							<label for="idGrupo">Grupo de Usuários</label>
							
							<select id="idGrupo" name="idGrupo" class="form-control" required>						  
								<?php
									$grupoDAO = new GrupoDAO();
									$lista = $grupoDAO->listar();

									if($usuario->getGrupo()->getIdGrupo() == 0){
										echo "<option value='' disabled selected>Selecione um grupo de acesso</option>";
									}

									foreach($lista as $grupo){	

										if($grupo->getIdGrupo() == $usuario->getGrupo()->getIdGrupo()){
											echo "<option selected value='{$grupo->getIdGrupo()}'>{$grupo->getDescricao()}</option>";
										}
										else{
											echo "<option value='{$grupo->getIdGrupo()}'>{$grupo->getDescricao()}</option>";
										}
										
									}
								?>	
						
							</select>
							
						</div>								
					</div>	

					<div class="row form-group">
						<div class="col-md-12">
							<label for="foto">Foto</label>
							<input class="form-control" id="foto" name="foto" type="file" value="<?php echo $usuario->getFoto() ?>">
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
		<script type="text/javascript" src="js/usuario.js"></script>
    </body>
</html>