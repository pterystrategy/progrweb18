<?php
session_start();
require_once 'class/VendaDAO.php';
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
            $menu = "vendaTabela";
            include_once("Cabecalho.php");
            ?>
        </div>

        <div class="container">
            <table id="tabelaUsuario" class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-4">cliente</th>
                        <th class="col-md-4">cpf</th>
                        <th class="col-md-1">data</th>
                        <th class="col-md-1">total</th>
                        <th class="col-md-1"></th>
                        <th class="col-md-1"><a class="btn btn-primary" href="VendaFormulario.php">Novo</a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $vendaDAO = new vendaDAO();
                    $lista = $vendaDAO->listar();

                    foreach ($lista as $venda) {

                        echo"<tr>";
                        echo"<td>{$venda->getCliente()}</td>";
                        echo"<td>{$venda->getCpf()}</td>";
                        echo"<td>" . date("d/m/Y", strtotime($venda->getDataVenda())) . "</td>";
                        echo"<td>{$venda->getTotal()}</td>";

                        echo"<td> <a class='btn btn-success' href='VendaFormulario.php?id={$venda->getId()}'> editar </a> </td>";
                        echo"<td> <a class='btn btn-danger'  href='VendaControlador.php?operacao=excluir&id={$venda->getId()}'> excluir </a> </td>";
                        echo"</tr>";
                    }
                    ?>

                </tbody>
            </table>
            <div>

                <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript" src="js/bootstrap.js"></script>
                <script type="text/javascript" src="js/usuario.js"></script>

                </body>
                </html>