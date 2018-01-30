$(document).ready(function() {
    var table = $('#matches-table').DataTable({
        searching: false,
        processing: true,
        serverSide: false,
        ajax: matchesRoute,
        order: [[ 3, 'desc' ]],
        language: {
            emptyTable: "We haven't found any candidates that match your requirements",
            lengthMenu: 'Display _MENU_ matches per page',
            info: 'Showing _START_ to _END_ of _TOTAL_ matches',
            infoEmpty: 'Showing 0 to 0 of 0 matches',
            loadingRecords: 'Loading matches...',
            processing: 'Loading matches...'
        },
        createdRow: function( row, data, dataIndex ) {
            if (!data['match_hirer_viewed']) {
                $(row).addClass('info');
            }
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function ( data, type, row ) {
                    if (row.match_status_num == 0) {
                        return '<input class="alt-radio" name="match-id-checkboxes" value="' + row.id + '" type="checkbox" id="filter_' + row.id + '"><label for="filter_' + row.id + '"><span></span></label>';
                    }

                    return '';
                }
            },
            { 
                data: {
                    _: 'id',
                    display: 'reference'
                },
                name: 'reference'
            },
            { 
                data: {
                    _: 'match_status_num',
                    display: 'match_status_text'
                },
                name: 'match_status_text',
                className: 'text-center cursor-text'
            },
            { 
                data: {
                    _: 'match_created_at_sort',
                    display: 'match_created_at_human'
                },
                name: 'match_created_at' ,
                className: 'text-center'
            },
            {
                data: null,
                orderable: false,
                defaultContent: '<button class="brand-sprite brand-arrow-down open-cv"></button>'
            }
        ]
    });

    function toggleChildren(parent, hide, show){
        parent.children(hide).hide();
        parent.children(show).fadeIn();
    }

    function requestCvs(data, callback) {
        $.ajax({
            method: 'PATCH',
            url: requestCvRoute,
            data: data         
        }).done(function(){
            callback();
            table.ajax.reload();
        }).fail(function(){
            alert('Sorry there has been a error');
        });
    }

    $('#matches-table tbody').on('click', 'button.open-cv', function () {
        toggleCandidateProfileRow(table, $(this), function(tr, candidate){
            tr.removeClass('info');

            var data = {
                candidate_id_list: [
                    candidate.id
                ]
            };   

            $.ajax({
                method: 'PATCH',
                url: viewedMatchRoute,
                data: data         
            });
        }); //function is in candidate-profile-table.js
    });    

    $('#matches-table').on('click', '.request-single-cv-button', function () {
        var data = {
            candidate_id_list: []
        };

        var controlls = $(this).parent('td');

        toggleChildren(controlls, '.request-single-cv-button', '.loading');
       
        data.candidate_id_list.push($(this).attr('data-id'));

        requestCvs(data, function(){
            toggleChildren(controlls, '.loading', '.request-single-cv-button');
        });
    });
 
    $('#request-many-cvs-button').click(function () {
        var data = {
            candidate_id_list: []
        };
        
        var controlls = $(this).parent('div'),
            checkedCheckboxes = $("input[name=match-id-checkboxes]:checked");

        if(checkedCheckboxes.length == 0){
            alert("You haven't selected any candidates");
            return false;
        }

        toggleChildren(controlls, '#request-cvs-button', '.loading');

        checkedCheckboxes.each(function(){
            data.candidate_id_list.push($(this).val());
        });

        requestCvs(data, function(){
            toggleChildren(controlls, '.loading', '#request-cvs-button');
        });
    });

});
