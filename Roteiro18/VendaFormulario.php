<?php
session_start();

require_once 'ControleAcesso.php';

require_once 'class/VendaDAO.php';
require_once 'class/AcessoDAO.php';
require_once 'class/GrupoAcessoDAO.php';

$venda = new Venda();

$operacao = "visualizar";

if (isset($_GET["operacao"])) {
    $operacao = $_GET["operacao"];
}

if (isset($_GET["id"])) {

    $idGrupo = $_GET["id"];

    $vendaDAO = new VendaDAO();

    $venda = $vendaDAO->buscarPorId($id);
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Venda</title>
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
                <p><a class="btn btn-primary float-right" href="VendaTabela.php">Voltar</a></p>
            </div>


            <form id="formGrupo" action="VendaControlador.php?operacao=salvar" method="post">

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
                    </div>
                    </div>	<!-- fechamento da div dos botões -->

                </fieldset>

            </form >

            <?php
            if ($venda->getId() == 0) {
                echo "<div class='ocultar'>";
            }
            ?>

            <form id="formGrupoAcesso" action="GrupoAcessoControlador.php?operacao=salvar" method="post">

                <fieldset <?php
                if ($operacao == "visualizar") {
                    echo 'disabled';
                }
                ?> >

                    <input type="hidden" name="id" id="id" value="<?php echo $venda->getId() ?>" >

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="idAcesso">Acesso</label>
                            <select id="idAcesso" name="idAcesso" class="form-control" required>
                                <?php
                                $acessoDAO = new AcessoDAO();
                                $lista = $acessoDAO->listar();

                                echo "<option value='' disabled selected>Selecione um acesso</option>";

                                foreach ($lista as $acesso) {
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
                    if ($operacao == "visualizar") {
                        echo "<div class='row form-group ocultar'>";
                    } else {
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
                            if ($venda->getId() != 0) {

                                $grupoAcessoDAO = new GrupoAcessoDAO();
                                $lista = $grupoAcessoDAO->listarPorGrupo($venda->getId());

                                foreach ($lista as $grupoAcesso) {
                                    echo"<tr>";

                                    echo"<td>{$grupoAcesso->getAcesso()->getDescricao()}</td>";
                                    echo"<td>{$grupoAcesso->getDescricaoPermissao()} </td>";

                                    if ($operacao == "visualizar") {
                                        echo"<td></td>";
                                    } else {
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
            if ($venda->getId() == 0) {
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