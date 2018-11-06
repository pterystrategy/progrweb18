<html>
    <head>
		<meta charset="utf-8">
		<title>Login</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/login.css"/>
    </head>

    <body>	

		<form id="formLogin" action="LoginControlador.php?operacao=autenticar" method="post">
			<div class="container">
				<div class="row form-group">
					<div class="col-md-12">
						<label for="login">Usuário</label>  
						<input class="form-control" name="login" id="login" type="text">
					</div>			
				</div>
				<div class="row form-group">
					<div class="col-md-12">
						<label for="senha">Senha</label>
						<input class="form-control" id="senha" name="senha" type="password">
					</div>			
				</div>	
			
				<div class="row form-group">
					<div class="col-md-12">
						<button class="btn btn-success" type="submit" name="action">Login</button>
						<button class="btn btn-danger" type="reset" name="action">Cancelar</button>						
					</div>																																			
				</div>					
			</div>
		</form >	
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/usuario.js"></script>
    </body>
</html>