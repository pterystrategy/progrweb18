		<?php
			require_once 'class/AcessoDAO.php';
		?>

		<nav class="navbar navbar-expand-md navbar-dark bg-dark">

		  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">	

			<?php 

				
				$arquivoAtual = basename($_SERVER['PHP_SELF']);

				foreach ($grupoAcessoUsuarioAtual as $grupoAcesso){

				

					if($grupoAcesso->getAcesso()->getTipo() == "menu"){

						if($grupoAcesso->getAcesso()->getArquivo() == $arquivoAtual){
							$ativo = "active";
						}else{
							$ativo = "";
						}							

						echo "<li class='nav-item {$ativo}'>";
						echo "<a class='nav-link' href='{$grupoAcesso->getAcesso()->getArquivo()}'>{$grupoAcesso->getAcesso()->getMenu()}</a>";
				  		echo "</li>";						

					}else{

						if($grupoAcesso->getAcesso()->getTipo() == "subMenu"){

							if($grupoAcesso->getAcesso()->getArquivo() == $arquivoAtual){
								$ativo = "active";
							}else{
								$ativo = "";
							}								

							echo "<li class='nav-item dropdown {$ativo}'>";

							    echo "<a class='nav-link dropdown-toggle' href='{$grupoAcesso->getAcesso()->getArquivo()}' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>{$grupoAcesso->getAcesso()->getMenu()}</a>";

							    echo "<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";

							    	$acessoDAO = new AcessoDAO();
							    	$listaAcesso = $acessoDAO->listarPorAcessoPai($grupoAcesso->getAcesso()->getIdAcesso());

							    	foreach($listaAcesso as $acessoMenuPai){
							        	echo "<a class='dropdown-item' href='{$acessoMenuPai->getArquivo()}'>{$acessoMenuPai->getMenu()}</a>";
							    	}

							    echo "</div>";
							echo "</li>";								

						}						

					}

			  	}	
				
			?> 

		
						  	    
			</ul>
			<div class="form-inline my-2 my-lg-0">
			  <label class="form-control mr-sm-2" readonly> <?php echo $usuarioAtual->getLogin(); ?> </label>
			  <a class="btn btn-outline-danger my-2 my-sm-0" href="LoginControlador.php?operacao=encerrar">Sair</a>
			</div>
		  </div>

		</nav>
		


