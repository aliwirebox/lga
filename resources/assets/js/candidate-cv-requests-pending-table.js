$(document).ready(function() {
    var table = $('#cv-requests-pending-table').DataTable({
        processing: true,
        fnInitComplete: function (oSettings, json) {
            jQuery('.match-additional-information').additionalInformationModal();
        },
        serverSide: false,
        ajax: dataRoute,
        order: [[ 5, 'desc' ]],
        language: {
            emptyTable: 'You currently have 0 CV Requests Pending',
            lengthMenu: 'Display _MENU_ cv requests pending per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ cv requests pending',
            infoEmpty: 'Showing 0 to 0 of 0 cv request pending',
            infoFiltered: '(filtered from _MAX_ total cv requests pending)',
            loadingRecords: 'Loading cv requests pending...',
            processing: 'Loading cv requests pending...',
            zeroRecords: 'No matching cv requests pending found'
        },
        columns: [
            {
                data: 'match_hirer_law_firm_name',
                name: 'match_hirer_law_firm_name'
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
                    _: 'match_vacancy_salary',
                    display: 'match_vacancy_salary_text',
                    filter: 'match_vacancy_salary_text'
                },
                className: 'text-center'
            },
            {
                data: 'match_vacancy_additional_information_button',
                name: 'match_vacancy_additional_information_button',
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
                defaultContent: '<a href="#" class="brand-sprite brand-exl new-request"></a>'
            }
        ]
    });

    $('#cv-requests-pending-table').on('click', '.new-request', function (e) {
        e.preventDefault();                

        var button = $(this),
            tr = button.closest('tr'),
            endpoint = table.row(tr).data().match_search_endpoint;

        $('.cv-request-buttons').attr('data-endpoint', endpoint);

        animateStatusPopUp(button);
    });
    
    $('.cv-request-buttons').click(function(){
        var button = $(this);
    
        showStatusPopupLoading();
    
        $.ajax({
            method: 'PATCH',
            url: button.attr('data-endpoint'),
            data: {
                status: button.attr('data-status')
            }
        }).done(function(){
            resetStatusPopup();
            table.ajax.reload();
        }).fail(function(){
            showStatusPopupError();
        });
    });
});
