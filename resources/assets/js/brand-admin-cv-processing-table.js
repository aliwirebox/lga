$(document).ready(function() {
    var table = $('#cv-processing-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: dataRoute,
        order: [[ 9, 'asc' ]],
        language: {
            emptyTable: 'Currently there are 0 candidate CV\'s to process.',
            lengthMenu: 'Display _MENU_ candidate CV\'s per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ candidate CV\'s',
            infoEmpty: 'Showing 0 to 0 of 0 candidate CV\'s',
            infoFiltered: '(filtered from _MAX_ total candidate CV\'s)',
            loadingRecords: 'Loading candidate CV\'s...',
            processing: 'Loading candidate CV\'s...',
            zeroRecords: 'No matching candidate CV\'s found'
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
                data: 'match_hirer_email',
                name: 'match_hirer_email'
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
                data: 'prefered_role',
                name: 'prefered_role'
            },
            {
                data: 'match_candidate_cv_download',
                name: 'match_candidate_cv_download',
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
                data: {
                    _: 'match_status_num',
                    display: 'match_status_text',
                    filter: 'match_status_text'
                },
                name: 'match_status_text',
                className: 'text-center'
            },
            {
                data: null,
                orderable: false,
                defaultContent: '<button class="brand-sprite brand-arrow-down open-cv"></button>'
            }        
        ]
    });

    $('#cv-processing-table tbody').on('click', 'button.open-cv', function () {
        toggleCandidateProfileRow(table, $(this)); //candidate-profile-table.js
    });
  
    $('#cv-processing-table').on('click', '.match-status', function (e) {
        e.preventDefault();                
        var button = $(this);
        updatePopupWithBrandAdminStatusParams(button, table);
        animateStatusPopUp(button);
    });

    $('.cv-request-buttons').click(function(){
        makeBrandAdminStatusChange($(this), table);
    });
});
