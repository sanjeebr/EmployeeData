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
	{ data: 'skills_name', name: 'skills_name', orderable: false},
	{ data: 'stack_id', name: 'stack_id' },
        { data: 'stack_nickname', name: 'stack_nickname' },
	{ data: 'created_by_name', name: 'created_by_name' },
        { data: 'updated_by_name', name: 'updated_by_name' },
    ],
});
