<?php

class Venda {

    private $id;
    private $cliente;
    private $cpf;
    private $dataVenda;
    private $total;

    function getId() {
        return $this->id;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getDataVenda() {
        return $this->dataVenda;
    }

    function getTotal() {
        return $this->total;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setDataVenda($dataVenda) {
        $this->dataVenda = $dataVenda;
    }

    function setTotal($total) {
        $this->total = $total;
    }

}
