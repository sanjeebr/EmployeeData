$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$('#users-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: 'http://localhost/employee_data/public/datatable',
        method: 'POST',
        },
    columns: [
        { data: 'emp_id', name: 'emp_id'},
        { data: 'first_name', name: 'first_name' },
        { data: 'last_name', name: 'last_name' },
    ],

    initComplete: function () {
        this.api().columns().every(function () {
            var column = this;
            var input = document.createElement("input");
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val()).draw();
            });
        });
    }
});
