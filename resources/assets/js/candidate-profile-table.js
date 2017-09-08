function toggleCandidateProfileRow(table, arrow, onOpenCallback) {
    var tr = arrow.closest('tr'),
        row = table.row(tr),
        candidate = row.data();
    
    if (row.child.isShown()) {
        // Close row
        row.child.hide();
        tr.removeClass('shown active');
        arrow.addClass('brand-arrow-down').removeClass('brand-arrow-up');
    } else {
        // Open row
        var profileTemplate = Handlebars.compile($("#profile-template").html());
        var html = profileTemplate(candidate);

        row.child(html).show();

        row.child().find('.items-modal').itemsModal();

        arrow.removeClass('brand-arrow-down').addClass('brand-arrow-up');
        tr.addClass('shown active').next().addClass('active');

        if (typeof onOpenCallback === "function") {
            onOpenCallback(tr, candidate);
        }
    }
}

Handlebars.registerHelper('getDifference', function (index, object, key) {
    return (object[key].length - index);
});

Handlebars.registerHelper('ifGreatThan', function (v1, v2, options) {
    if (v1 > v2) {
        return options.fn(this);
    }

    return options.inverse(this);
});

Handlebars.registerHelper('toJSON', function (object, key) {
    return new Handlebars.SafeString(JSON.stringify(object[key]));
});

function animateStatusPopUp(clickedButton){
    var top = clickedButton.offset().top - 130,
        left = clickedButton.offset().left - 105;

    if(!$('.brand-popover').is(':visible')){
        $('.brand-popover').css({left: left, top: top}).fadeIn();
        return true;
    }

    if(top + "px" == $('.brand-popover').css('top')){
        $('.brand-popover').fadeOut();
    } else {
        $('.brand-popover').animate({left: left, top: top});
    }
}
 
function toggleChildren(parent, hide, show){
    parent.children(hide).hide();
    parent.children(show).fadeIn();
}

function resetStatusPopup()
{
    $('.brand-popover').fadeOut();
    toggleChildren($('.brand-popover'), '.loading, .error-button', '.cv-request-buttons, strong');
}

function showStatusPopupLoading()
{
    toggleChildren($('.brand-popover'), '.cv-request-buttons, strong, .error-button', '.loading');
}

function showStatusPopupError()
{
    toggleChildren(row, '.loading, .cv-request-buttons, strong', '.error-button');
}

function makeBrandAdminStatusChange(button, table)
{
    showStatusPopupLoading();

    $.ajax({
        method: 'PATCH',
        url: button.attr('data-endpoint'),
        data: {
            status: button.attr('data-status'),
            candidate_id: button.attr('data-candidate-id')
        }
    }).done(function(){
        resetStatusPopup();
        table.ajax.reload();
    }).fail(function(){
        showStatusPopupError();
    });
}

function updatePopupWithBrandAdminStatusParams(button, table)
{
    var tr = button.closest('tr'),
        endpoint = table.row(tr).data().match_search_endpoint,
        candidateId = table.row(tr).data().id;
      
    $('.cv-request-buttons').attr('data-endpoint', endpoint)
                            .attr('data-candidate-id', candidateId);
}
