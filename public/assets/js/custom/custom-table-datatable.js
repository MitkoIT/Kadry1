/*
---------------------------------------
    : Custom - Table Datatable js :
---------------------------------------
*/
"use strict";
$(document).ready(function() {
    /* -- Table - Datatable -- */
    $('#datatable').DataTable({
        responsive: true
    });
    $('#default-datatable').DataTable( {
        "order": [[ 0, "asc" ]],
        language: {
            processing: "Processing...",
            search: "Wyszukaj:",
            lengthMenu: "Wyświetl _MENU_ rekordów na stronie.",
            info: "Pokazywanie od _START_ do _END_ rekordu.",
            infoEmpty: "Brak rekordów.",
            infoFiltered: "(wyszukano _MAX_ rekordów)",
            loadingRecords: "Ładowanie...",
            zeroRecords: "Nie znaleziono rekordów.",
            emptyTable: "Brak rekordów w tabeli.",
            paginate: {
                first: "Pierwsza",
                previous: "Poprzednia",
                next: "Następna",
                last: "Ostatnia"
            },
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            }
        },
        pageLength: 100,
        lengthMenu: [50, 100, 250],
        responsive: true
    } );    
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        responsive: true,
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
    table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
});