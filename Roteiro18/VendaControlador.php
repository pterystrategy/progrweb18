<?php

require_once 'class/VendaDAO.php';
require_once './class/Venda.php';

$operacao = $_GET['operacao'];
$vendaDAO = new VendaDAO();
$venda = new Venda();
switch ($operacao) {
    case 'salvar':

        $venda->setId($_POST["id"]);
        $venda->setCliente($_POST["cliente"]);
        $venda->setCpf($_POST["cpf"]);
        $venda->setDataVenda($_POST["date"]);
        $venda->setTotal($_POST["total"]);

        $resultado = $vendaDAO->salvar($venda);


        echo $resultado;

        if ($resultado == TRUE) {
            echo "<script>alert('Registro salvo com sucesso !!!'); location.href='VendaTabela.php';</script>";
        } else {

            echo "<script>alert('Erro ao salvar o registro '); location.href='VendaTabela.php';</script>";
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

    case 'verificarLogin':

        $login = $_POST["login"];
        $idUsuario = $_GET["idUsuario"];

        $resultado = $usuarioDAO->verificarLogin($idUsuario, $login);

        echo json_encode($resultado);


        break;
}
?>