<?php

require_once 'class/VendaDAO.php';
$vendaDAO = new VendaDAO();
$venda = new Venda();

$operacao = $_GET["operacao"];

switch ($operacao) {
    case 'salvar':

        $venda->setId($_POST["id"]);
        $venda->setCliente($_POST["cliente"]);
        $venda->setCpf($_POST["cpf"]);
        $venda->setDataVenda($_POST["dataVenda"]);
        $musica->setTotal($_POST["total"]);
        $resultado = $vendaDAO->salvar($venda);

        if (isset($_POST["salvar"])) {
            $pagina = "VendaFormulario.php?operacao=editar&id={$venda->getId()}";
        } else {
            if (isset($_POST["salvarVoltar"])) {
                $pagina = "VendaTabela.php";
            }
        }

        if ($resultado == 1) {
            echo "<script>alert('Registro salvo com sucesso !!!'); location.href='{$pagina}';</script>";
        } else {
            echo "<script>alert('Erro ao salvar o registro'); location.href='{$pagina}';</script>";
        }

        break;

    case 'excluir':

        $resultado = $vendaDAO->excluirPorId($_GET["id"]);

        if ($resultado == 1) {
            echo "<script>alert('Registro excluido com sucesso !!!'); location.href='VendaTabela.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir o registro'); location.href='VendaTabela.php';</script>";
        }
        break;
}

