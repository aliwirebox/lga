$(document).ready(function() {
    var table = $('#candidates-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[ 7, 'desc' ]],
        language: {
            emptyTable: 'You currently have 0 CV Requests',
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
                data: 'match_search_name',
                name: 'match_search_name'
            },
            { 
                data: 'match_hirer_name',
                name: 'match_hirer_name'
            },
            { 
                data: 'match_vacancy_location',
                name: 'match_vacancy_location'
            },
            {
                data: {
                    _: 'match_vacancy_salary',
                    display: 'match_vacancy_salary_text',
                    filter: 'match_vacancy_salary_text'
                },
                className: 'text-center'
            },
            {
                data: 'match_vacancy_department',
                name: 'match_vacancy_department'
            },
            { 
                data: {
                    _: 'match_status_num',
                    display: 'match_status_text',
                    filter: 'match_status_text'
                },
                name: 'match_status_text',
                className: 'text-center'
            },
            {
                data: {
                    _: 'match_updated_at_sort',
                    display: 'match_updated_at_ddmmyyyy',
                    filter: 'match_updated_at_ddmmyyyy'
                },
                name: 'match_updated_at'
            },
            {
                data: null,
                orderable: false,
                defaultContent: '<button class="nq-sprite nq-arrow-down open-cv"></button>'
            }
        ]
    });

    $('#candidates-table tbody').on('click', 'button.open-cv', function () {
        toggleCandidateProfileRow(table, $(this)); //candidate-profile-table.js
    });
});
