<?php
session_start();
require_once 'class/VendaDAO.php';

$venda = new Venda();

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
        <link type="text/css" rel="stylesheet" href="css/usuario.css"/>
    </head>

    <body>

        <div class="cabecalho">
            <?php
            $menu = "venda";
            include_once("Cabecalho.php");
            ?>
        </div>


        <form id="formUsuario" action="VendaControlador.php?operacao=salvar" method="post">
            <div class="container">
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="cliente">Cliente</label>
                        <input type="hidden" name="id" id="id" value="<?php echo $venda->getId() ?>" >
                        <input class="form-control" name="cliente" id="cliente" type="text" value="<?php echo $venda->getCliente() ?>">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="cpf">cpf</label>
                        <input class="form-control" id="cpf" name="cpf" type="text" value="<?php echo $venda->getCpf() ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="date">Data da Venda</label>
                        <input class="form-control" id="date" name="date" type="date" value="<?php echo $venda->getDataVenda() ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="total">Total</label>
                        <input class="form-control" id="total" name="total" type="number" min="0.00" max="10000.00" step="0.01"  value="<?php echo $venda->getTotal() ?>">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-11">
                        <button class="btn btn-success" type="submit" name="action">Salvar</button>
                        <button class="btn btn-danger" type="reset" name="action">Cancelar</button>
                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-primary" href="VendaTabela.php">Voltar</a>
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