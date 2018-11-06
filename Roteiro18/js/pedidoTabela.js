//https://datatables.net/extensions/fixedcolumns/examples/initialisation/size_fluid.html

$(document).ready(function() {
    
  $('#dataInicio').mask('00/00/0000');
  $('#dataFim').mask('00/00/0000');
});


$(document).ready(function() {

    $('#tabelaPedido').DataTable(
    {
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { width: '60%', "orderable": true,  "targets": 0 },
			      { width: '45%', "orderable": true,  "targets": 1 },
            { width: '5%', "orderable": false, "targets": 2 },
            { width: '5%', "orderable": false, "targets": 3 },
            { width: '5%', "orderable": false, "targets": 4 }
          ],
          

        "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          }
        } 

    });

    $("#corpoTabela").css("visibility", "visible");
} );

$("button.excluir").click(function(){

    var $this = $(this);
    var idPedido = $this.attr("id");
    var $meu_alerta = $("#confirm-delete");
    $meu_alerta.modal();
    $('#botaoExcluir').attr('href', 'PedidoControlador.php?operacao=excluir&idPedido='+idPedido)
  
});

$("button.filtrar").click(function(){

    var $meu_alerta = $("#confirm-filtro");
    $meu_alerta.modal();
  
});

