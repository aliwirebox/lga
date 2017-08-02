$(document).ready(function() {
    var table = $('#hirers-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[ 0, 'asc' ]],
        language: {
            emptyTable: 'Currently there are 0 hirers registered to the site.',
            lengthMenu: 'Display _MENU_ hirers per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ hirers',
            infoEmpty: 'Showing 0 to 0 of 0 hirers',
            infoFiltered: '(filtered from _MAX_ total hirers)',
            loadingRecords: 'Loading hirers...',
            processing: 'Loading hirers...',
            zeroRecords: 'No matching hirers found'
        },
        columns: [
            { 
                data: 'law_firm_name',
                name: 'law_firm_name'
            },
            { 
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'telephone',
                name: 'telephone'
            },

            {
                data: 'email_verified',
                name: 'email_verified'
            },
            {
                data: 'law_firm',
                name: 'law_firm'
            },
            {
                data: {
                    _: 'created_at_sort',
                    display: 'created_at',
                    filter: 'created_at'
                },
                name: 'created_at'
            },
            {
                data: {
                    _: 'updated_at_sort',
                    display: 'updated_at',
                    filter: 'updated_at'
                },
                name: 'updated_at'
            },
            {
                data: null,
                orderable: false,
                render: function ( data, type, row ) {
                    return '<a href="/nq-admin/hirers/' + row.id + '/login" class="btn btn-rounded btn-primary btn-block btn-xs btn-pad-20">Login as Hirer</a>';
                }
            }
        ]
    });
});
