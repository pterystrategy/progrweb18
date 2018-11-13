<?php
session_start();
require_once 'ControleAcesso.php';

require_once 'class/VendaDao.php';

require_once 'class/Venda.php';

$venda = new Venda();

$operacao = "visualizar";

if (isset($_GET["operacao"])) {
    $operacao = $_GET["operacao"];
}


if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $vendaDAO = new VendaDAO();
    $venda = $vendaDAO->buscarPorId($id);
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Venda</title>
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
                <p><a class="btn btn-primary float-right" href="VendaTabela.php">Voltar</a></p>	
            </div>	

            <form id="formUsuario" action="VendaControlador.php?operacao=salvar" method="post">

                <fieldset <?php
                if ($operacao == "visualizar") {
                    echo 'disabled';
                }
                ?> >

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="cliente">Cliente</label>
                            <input type="hidden" name="id" id="id" value="<?php echo $venda->getId() ?>" >
                            <input class="form-control" name="cliente" id="cliente" type="text" value="<?php echo $venda->getCliente() ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="cpf">cpf</label>
                            <input class="form-control" id="cpf" name="cpf" type="text" value="<?php echo $venda->getCpf() ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="dataVenda">Data da Venda</label>
                            <input class="form-control" id="dataVenda" name="dataVenda" type="dataVenda" value="<?php echo $venda->getDataVenda() ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="total">Total</label>
                            <input class="form-control" id="total" name="total" type="number" min="0.00" max="10000.00" step="0.01"  value="<?php echo $venda->getTotal() ?>">
                        </div>
                    </div>		

                    <?php
                    if ($operacao == "visualizar") {
                        echo "<div class='row form-group ocultar'>";
                    } else {
                        echo "<div class='row form-group'>";
                    }
                    ?>
                    <div class="col-md-11">

                        <?php
                        if ($permissao == 2) {
                            echo "<button class='btn btn-success' type='submit' name='salvar' id='salvar' value='salvar'>Salvar</button>";
                            echo "<button class='btn btn-primary mx-2' type='submit' name='salvarVoltar' id='salvarVoltar' value='salvarVoltar'>Salvar + Voltar</button>";
                            echo "<button class='btn btn-dark' type='reset' id='cancelar'>Cancelar</button>";
                        }
                        ?>																																
                    </div>	<!-- fechamento da div dos botões -->
                    <!-- fechamento da div dos botões -->

                </fieldset>				
            </form >	
        </div>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/musicaFormulario.js"></script>
    </body>
</html>