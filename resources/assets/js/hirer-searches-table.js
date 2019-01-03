$(document).ready(function() {
    var table = $('#saved-searches-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: savedSearchesRoute,
        order: [[ 7, 'desc' ]],
        language: {
            emptyTable: 'You currently have 0 searches. Run and save a <a href="' + newSearchRoute + '">search</a>',
            lengthMenu: 'Display _MENU_ searches per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ searches',
            infoEmpty: 'Showing 0 to 0 of 0 searches',
            infoFiltered: '(filtered from _MAX_ total searches)',
            loadingRecords: 'Loading searches...',
            processing: 'Loading searches...',
            zeroRecords: 'No matching records found'
        },
        columns: [
            { 
                data: 'hirer_name',
                name: 'hirer_name'
            },
            {
                data: 'name',
                name: 'name'
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
                data: 'role_type',
                name: 'role_type'
            },
            { 
                data: 'vacancy_location_name',
                name: 'vacancy_location_name'
            },
            {
                data: {
                    _: 'vacancy_salary',
                    display: 'vacancy_salary_text',
                    filter: 'vacancy_salary_text'
                },
                className: 'text-center'
            },
            {
                data: 'vacancy_department_name',
                name: 'vacancy_department_name'
            },
            {
                data: 'unviewed_matches_count',
                name: 'unviewed_matches_count',
                className: 'text-center'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                defaultContent: '',
                className: 'text-center'
            }
        ]
    });
});
