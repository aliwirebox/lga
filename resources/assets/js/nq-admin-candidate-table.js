$(document).ready(function () {
    var table = $('#candidates-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[0, 'asc']],
        language: {
            emptyTable: 'Currently there are 0 candidates registered to the site.',
            lengthMenu: 'Display _MENU_ candidates per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ candidates',
            infoEmpty: 'Showing 0 to 0 of 0 candidates',
            infoFiltered: '(filtered from _MAX_ total candidates)',
            loadingRecords: 'Loading candidates...',
            processing: 'Loading candidates...',
            zeroRecords: 'No matching candidates found'
        },
        columns: [
            {
                data: {
                    _: 'id',
                    display: 'reference',
                    filter: 'reference'
                },
                name: 'reference'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'telephone',
                name: 'telephone'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'email_verified',
                name: 'email_verified'
            },
            {
                data: 'is_live',
                name: 'is_live'
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
                data: 'match_candidate_cv_download',
                name: 'match_candidate_cv_download',
                className: 'text-center'
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
                render: function (data, type, row) {
                    return '<a href="/nq-admin/candidates/' + row.id + '/toggle-live-status" class="btn btn-rounded btn-primary btn-block btn-xs btn-pad-20">Toggle Live Status</a>';
                }
            },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return '<a href="/nq-admin/candidates/' + row.id + '/login" class="btn btn-rounded btn-primary btn-block btn-xs btn-pad-20">Login as Candidate</a>';
                }
            }
        ]
    });
});
