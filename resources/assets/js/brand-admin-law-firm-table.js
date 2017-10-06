$(document).ready(function () {
    var table = $('#law-firms-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[0, 'asc']],
        language: {
            emptyTable: 'Currently there are 0 companies registered to the site.',
            lengthMenu: 'Display _MENU_ companies per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ companies',
            infoEmpty: 'Showing 0 to 0 of 0 companies',
            infoFiltered: '(filtered from _MAX_ total companies)',
            loadingRecords: 'Loading companies...',
            processing: 'Loading companies...',
            zeroRecords: 'No matching companies found'
        },
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'domains',
                name: 'domains',
                orderable: false
            },
            {
                data: 'hirers_count',
                name: 'hirers_count'
            },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return '<a href="/brand-admin/law-firms/' + row.id + '/edit" class="btn btn-success btn-rounded btn-xs btn-block">Edit</a><a data-law-firm-id="' + row.id + '" data-law-firm-name="' + row.name + '" class="btn btn-rounded btn-primary btn-block btn-xs btn-pad-20 delete-law-firm">Delete</a>';
                }
            },
        ]
    });

    $('#law-firms-table').on('click', '.delete-law-firm', function (e) {
        if(confirm("Are you sure you want to delete " + $(this).data('law-firm-name'))) {
            $.ajax({
                method: 'DELETE',
                url: '/brand-admin/law-firms/' + $(this).data('law-firm-id'),
            }).complete(function(){
                table.ajax.reload();
            });
        }
    });
});
