
$(document).ready(function() {
    $('#tabelaMusica').DataTable(
		{
        "order": [[ 0, "asc" ]],
        "columnDefs": [
            { "orderable": true,  "targets": 0 },
            { "orderable": false,  "targets": 1 },
            { "orderable": false,  "targets": 2 },
            { "orderable": false,  "targets": 3 },
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
});


