const defaultDataTableOptions = {
    pageLength: 10,
    columnDefs: [
        {
            responsivePriority: 1, // Set a high priority for the "last actions" column
            targets: -1, // The last column index (starts from 0)
        },
    ],
    dom: "flrtpi",
    language: {
        lengthMenu: 'Mostrar _MENU_ <span class="d-none d-sm-inline-block">registros por página</span>',
        zeroRecords: "Ningun registro encontrado",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Ningun registro encontrado",
        infoFiltered: "(filtrados desde _MAX_ registros totales)",
        search: "Buscar:",
        LoadingRecords: "Cargando ...",
        paginate: {
            first: '<i class="fas fa-angle-double-left"></i>',
            last: '<i class="fas fa-angle-double-right"></i>',
            next: '<i class="fas fa-angle-right"></i>',
            previous: '<i class="fas fa-angle-left"></i>',
        },
        search: "",
        searchPlaceholder: "Buscar",
    },
    responsive: true,
    processing: false,
    serverSide: true,
    pagingType: "full_numbers",
};
