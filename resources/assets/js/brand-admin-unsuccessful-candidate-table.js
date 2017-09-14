$(document).ready(function() {
    var table = $('#unsuccessful-candidate-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[ 7, 'asc' ]],
        language: {
            emptyTable: 'Currently there are 0 unsuccessful candidates.',
            lengthMenu: 'Display _MENU_ unsuccessful candidates per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ unsuccessful candidates',
            infoEmpty: 'Showing 0 to 0 of 0 unsuccessful candidates',
            infoFiltered: '(filtered from _MAX_ total unsuccessful candidates)',
            loadingRecords: 'Loading unsuccessful candidates...',
            processing: 'Loading unsuccessful candidates...',
            zeroRecords: 'No matching unsuccessful candidates found'
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
                data: 'full_name',
                name: 'full_name'
            },
            { 
                data: 'match_hirer_law_firm_name',
                name: 'match_hirer_law_firm_name'
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
                defaultContent: '<button class="brand-sprite brand-arrow-down open-cv"></button>'
            }
        ]
    });

    $('#unsuccessful-candidate-table tbody').on('click', 'button.open-cv', function () {
        toggleCandidateProfileRow(table, $(this)); //candidate-profile-table.js
    });

    $('#unsuccessful-candidate-table').on('click', '.match-status', function (e) {
        e.preventDefault();                
        var button = $(this);
        updatePopupWithBrandAdminStatusParams(button, table);
        animateStatusPopUp(button);
    });

    $('.cv-request-buttons').click(function(){
        makeBrandAdminStatusChange($(this), table);
    });
});

