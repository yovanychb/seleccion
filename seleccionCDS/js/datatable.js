$(document).ready(function() {

    //Configuracion de los text input para filtrar
    $('#vista tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Buscar ' + title + '" />');
    });

    //Definicion del DataTable
    var table = $('#vista').DataTable({
        stateSave: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'pdfHtml5',
                download: 'open',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }, 
        ],
        "language": {
            "emptyTable": "No se encontrarion registros",
            "info": "Registros _START_ al _END_ de _TOTAL_ registros en total",
            "infoEmpty": "Sin registros",
            "infoFiltered": "(Filtrando de _MAX_ Registros)",
            "thousands": ",",
            "lengthMenu": "",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin registros",
            "paginate": {
                "first": "Inicio",
                "last": "Fin",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }

    });

    // Filtrar
    table.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });

    //Algo
    $('.dataTables_length').addClass('bs-select');
});