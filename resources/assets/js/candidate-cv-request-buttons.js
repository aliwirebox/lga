function toggleChildren(parent, hide, show){
    parent.find(hide).hide();
    parent.find(show).fadeIn();
}

$(document).ready(function(){
    $('.cv-request-buttons').click(function(){
        var button = $(this),
            row = button.parent('div');

        toggleChildren(row, '.cv-request-buttons', '.loading');

        $.ajax({
            method: 'PATCH',
            url: button.attr('data-endpoint'),
            data: {
                status: button.attr('data-status')
            }
        }).done(function(){
            toggleChildren(row, '.loading', button.attr('data-answer'));
        }).fail(function(){
            toggleChildren(row, '.loading', '.error-button');
        });
    });
});
