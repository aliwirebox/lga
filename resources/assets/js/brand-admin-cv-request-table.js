$(document).ready(function() {
    var table = $('#cv-request-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[ 8, 'desc' ]],
        language: {
            emptyTable: 'Currently there are 0 CV requests.',
            lengthMenu: 'Display _MENU_ CV requests per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ CV requests',
            infoEmpty: 'Showing 0 to 0 of 0 CV requests',
            infoFiltered: '(filtered from _MAX_ total CV requests)',
            loadingRecords: 'Loading CV requests...',
            processing: 'Loading CV requests...',
            zeroRecords: 'No matching CV requests found'
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
                data: 'telephone',
                name: 'telephone'
            },
            { 
                data: 'email',
                name: 'email'
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
            },
            {
                data: null,
                orderable: false,
                defaultContent: '<a href="#" class="brand-sprite brand-exl new-request"></a>'
            }
        ]
    });

    $('#cv-request-table tbody').on('click', 'button.open-cv', function () {
        toggleCandidateProfileRow(table, $(this)); //candidate-profile-table.js
    });

    $('#cv-request-table').on('click', '.new-request', function (e) {
        e.preventDefault();                
        var button = $(this);
        updatePopupWithBrandAdminStatusParams(button, table);
        animateStatusPopUp(button);
    });

    $('.cv-request-buttons').click(function(){
        makeBrandAdminStatusChange($(this), table);
    });
});
