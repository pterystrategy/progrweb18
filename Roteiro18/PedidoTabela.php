<?php
session_start();

require_once 'ControleAcesso.php';

require_once 'class/PedidoDAO.php';
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Pedido</title>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
        <link type="text/css" rel="stylesheet" href="css/datatables.css"/>
        <link type="text/css" rel="stylesheet" href="css/pedido.css"/>	

    </head>

    <body>	

        <div class="cabecalho">	
            <?php
            include_once("Cabecalho.php");
            ?>
        </div>

        <div id="corpoTabela" class="container">

            <h5 class="cabecalho"> <?php echo $menu; ?> </h5>

            <div class="mb-2 clearfix">
                <p><button type='button' class='btn btn-primary float-left filtrar'>Filtrar</button></p>

                <?php
                if (isset($_GET["operacao"]) == "filtrar") {
                    echo "<a class='mx-2 btn btn-warning float-left' href='PedidoTabela.php'>Limpar</a>";
                }

                if ($permissao == 2) {
                    echo "<p><a class='btn btn-primary float-right' href='PedidoFormulario.php?operacao=novo'>Novo</a></p>";
                }
                ?>

            </div>

            <table id="tabelaPedido" class="table table-striped">
                <thead>					
                    <tr>
                        <th>Usuário</th>
                        <th>Data</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pedidoDAO = new PedidoDAO();

                    if (isset($_GET["operacao"]) == "filtrar") {

                        $dataInicio = NULL;
                        $dataFim = NULL;
                        $usuario = "";
                        $produto = "";

                        if (isset($_POST["usuario"])) {
                            $usuario = $_POST["usuario"];
                        }

                        if (isset($_POST["produto"])) {
                            $produto = $_POST["produto"];
                        }

                        if (isset($_POST["dataInicio"])) {
                            if (strlen($_POST["dataInicio"]) > 0) {
                                $dataInicio = $_POST["dataInicio"];
                            }
                        }

                        if (isset($_POST["dataFim"])) {
                            if (strlen($_POST["dataFim"]) > 0) {
                                $dataFim = $_POST["dataFim"];
                            }
                        }

                        $lista = $pedidoDAO->filtrar($usuario, $dataInicio, $dataFim, $produto);
                    } else {
                        $lista = $pedidoDAO->listar();
                    }



                    foreach ($lista as $pedido) {
                        echo"<tr>";
                        echo"<td>{$pedido->getUsuario()->getNome()}</td>";
                        echo"<td>" . date("d/m/Y", strtotime($pedido->getDataPedido())) . "</td>";

                        if ($permissao == 2) {

                            echo"<td><button type='button' class='btn btn-danger excluir' id='{$pedido->getIdPedido()}'>excluir</button></td>";

                            echo"<td> <a class='btn btn-success' href='PedidoFormulario.php?operacao=editar&idPedido={$pedido->getIdPedido()}'> editar </a> </td>";
                        } else {
                            echo"<td></td>";
                            echo"<td></td>";
                        }


                        echo"<td> <a class='btn btn-secondary' href='PedidoFormulario.php?operacao=visualizar&idPedido={$pedido->getIdPedido()}'> visualizar </a> </td>";

                        echo"</tr>";
                    }
                    ?>		

                </tbody>
            </table>	
            <div>




                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header atencao">
                                Atenção
                            </div>
                            <div class="modal-body">
                                Confirma exclusão deste registro?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal" href="#">Cancelar</button>
                                <a class="btn btn-danger excluir" id="botaoExcluir" >Excluir</a>
                            </div>
                        </div>
                    </div>	
                </div>

                <div class="modal fade" id="confirm-filtro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="formPedidoModal" action="PedidoTabela.php?operacao=filtrar" method="post">
                                <div class="modal-body">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <label for="usuario">Usuário</label>  
                                            <input class="form-control campo" name="usuario" id="usuario" type="text" value="" >
                                        </div>

                                        <div class="col-md-6">
                                            <label for="dataInicio">Data início</label>  
                                            <input class="form-control campo" name="dataInicio" id="dataInicio" type="text" value="" >

                                        </div>

                                        <div class="col-md-6">
                                            <label for="dataFim">Data fim</label>  
                                            <input class="form-control campo" name="dataFim" id="dataFim" type="text" value="" >

                                        </div>	

                                        <div class="col-md-12">
                                            <label for="produto">Produto</label>  
                                            <input class="form-control campo" name="produto" id="produto" type="text" value="" >
                                        </div>															

                                    </div>					        	
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-dismiss="modal" href="#">Cancelar</button>
                                    <button type="submit" class="btn btn-primary filtro" id="botaoFiltro"> Aplicar </button>
                                </div>
                            </form>
                        </div>
                    </div>	
                </div>		

                <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript" src="js/bootstrap.js"></script>
                <script type="text/javascript" src="js/jquery.mask.js"></script>
                <script type="text/javascript" src="js/jquery.validate.js"></script>		
                <script type="text/javascript" src="js/datatables.js"></script>
                <script type="text/javascript" src="js/pedidoTabela.js"></script>	

                </body>
                </html>