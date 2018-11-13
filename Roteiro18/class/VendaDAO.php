<?php

require_once 'CrudDAO.php';
require_once 'Venda.php';

class VendaDAO extends CrudDAO {

    public function atualizar($venda) {
        $situacao = FALSE;
        try {

            $pdo = parent::conectar();

            $sql = "UPDATE tbVenda SET cliente = :cliente, cpf = :cpf, dataVenda =:data,total=:total WHERE id= :id";
            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $venda->getId(), PDO::PARAM_INT);
            $run->bindParam(':cliente', $venda->getCliente(), PDO::PARAM_STR);
            $run->bindParam(':cpf', $venda->getCpf(), PDO::PARAM_STR);
            $run->bindParam(':dataVenda', $venda->getDataVenda(), PDO::PARAM_STR);
            $run->bindParam(':total', $venda->getTotal(), PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            parent::desconectar();
        }

        return $situacao;
    }

    public function buscarPorId($codigo) {
        $venda = new Venda();

        try {

            $pdo = parent::conectar();

            $sql = "SELECT * FROM tbVenda WHERE id= :id";

            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $codigo, PDO::PARAM_INT);
            $run->execute();
            $resultado = $run->fetch();

            $venda->setId($resultado['id']);
            $venda->setCliente($resultado['cliente']);
            $venda->setCpf($resultado['cpf']);
            $venda->setDataVenda($resultado['dataVenda']);
            $venda->setTotal($resultado['total']);
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            parent::desconectar();
        }

        return $venda;
    }

    public function excluir($venda) {
        $situacao = FALSE;
        try {

            $pdo = parent::conectar();

            $sql = "DELETE FROM tbVenda WHERE id=:id";

            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $venda->getId(), PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            parent::desconectar();
        }

        return $situacao;
    }

    public function excluirPorId($codigo) {
        $situacao = FALSE;
        try {

            $pdo = parent::conectar();

            $sql = "DELETE FROM tbVenda WHERE id=:id";

            $run = $pdo->prepare($sql);
            $run->bindParam(':id', $codigo, PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            parent::desconectar();
        }

        return $situacao;
    }

    public function incluir($musica) {
        $situacao = FALSE;
        try {

            $pdo = parent::conectar();

            $sql = "INSERT INTO tbVenda (cliente, cpf, dataVenda, total) VALUES (:cliente, :cpf, :dataVenda, :total)";
            $run = $pdo->prepare($sql);


            $run->bindParam(':cliente', $venda->getCliente(), PDO::PARAM_STR);
            $run->bindParam(':cpf', $venda->getCpf(), PDO::PARAM_STR);
            $run->bindParam(':dataVenda', $venda->getDataVenda());
            $run->bindParam(':total', $venda->getTotal(), PDO::PARAM_INT);
            $run->execute();

            if ($run->rowCount() > 0) {
                $situacao = TRUE;
            }

            $musica->setIdMusica($pdo->lastInsertId());
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            parent::desconectar();
        }

        return $situacao;
    }

    public function listar() {
        $objetos = array();

        try {

            $pdo = parent::conectar();

           $sql = "SELECT * FROM tbVenda";

            $run = $pdo->prepare($sql);
            $run->execute();
            $resultado = $run->fetchAll();

             foreach ($resultado as $objeto) {

                $venda = new Venda();
                $venda->setId($objeto['id']);
                $venda->setCliente($objeto['cliente']);
                $venda->setCpf($objeto['cpf']);
                $venda->setDataVenda($objeto['dataVenda']);
                $venda->setTotal($objeto['total']);
                array_push($objetos, $venda);
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            parent::desconectar();
        }

        return $objetos;
    }

    public function salvar($venda) {
        $situacao = FALSE;
        try {

            if ($venda->getId() == 0) {

                $situacao = $this->incluir($venda);
            } else {
                $situacao = $this->atualizar($venda);
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        }

        return $situacao;
    }

    public function filtrar($cliente, $cpf, $dataVenda) {

        $objetos = array();

        try {

            $pdo = parent::conectar();

            $sql = "SELECT * FROM tbVenda     WHERE titulo LIKE '%{$cliente}%'
						AND compositor LIKE '%{$cpf}%'
						AND ano LIKE %{$dataVenda}%";

            $run = $pdo->prepare($sql);

            $run->execute();
            $resultado = $run->fetchAll();

            foreach ($resultado as $registro) {

                $ $venda = new Venda();
                $venda->setId($registro['id']);
                $venda->setCliente($registro['cliente']);
                $venda->setCpf($registro['cpf']);
                $venda->setDataVenda($registro['dataVenda']);
                $venda->setTotal($registro['total']);
                array_push($objetos, $venda);
            }
        } catch (Exception $ex) {
            echo $ex->getFile() . ' : ' . $ex->getLine() . ' : ' . $ex->getMessage();
        } finally {
            parent::desconectar();
        }

        return $objetos;
    }
}
