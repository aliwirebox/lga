$(document).ready(function() {
    var table = $('#unsuccessful-vacancy-table').DataTable({
        processing: true,
        fnInitComplete: function (oSettings, json) {
            jQuery('.match-additional-information').additionalInformationModal();
        },
        serverSide: false,
        ajax: dataRoute,
        order: [[ 5, 'desc' ]],
        language: {
            emptyTable: 'You currently have 0 Unsuccessful Jobs',
            lengthMenu: 'Display _MENU_ jobs per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ jobs',
            infoEmpty: 'Showing 0 to 0 of 0 jobs',
            infoFiltered: '(filtered from _MAX_ total jobs)',
            loadingRecords: 'Loading jobs...',
            processing: 'Loading jobs...',
            zeroRecords: 'No matching jobs found'
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
                className: 'text-center cursor-text'
            }
        ]
    });
});
