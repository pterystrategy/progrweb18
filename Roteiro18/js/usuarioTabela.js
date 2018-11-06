$(document).ready(function() {

    $('#tabelaUsuario').DataTable(
    {
        "order": [[ 1, "asc" ]],
        "columnDefs": [
            { "orderable": false,  "targets": 0 },
            { "orderable": true,  "targets": 1 },
            { "orderable": true,  "targets": 2 },
            { "orderable": true,  "targets": 3 },
            { "orderable": true, "targets": 4 },
            { "orderable": false, "targets": 5 },
            { "orderable": false, "targets": 6 },
            { "orderable": false, "targets": 7 }
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
    var idUsuario = $this.attr("id");
    var $meu_alerta = $("#confirm-delete");
    $meu_alerta.modal();
    $('#botaoExcluir').attr('href', 'UsuarioControlador.php?operacao=excluir&idUsuario='+idUsuario)
  
});

$("button.filtrar").click(function(){

    var $meu_alerta = $("#confirm-filtro");
    $meu_alerta.modal();
  
});

