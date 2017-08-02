
/**
 * Setup Additional Information textarea count down
 */
function setupAdditionalInformationCountDown() {
    var maxLength = $( "#additional_information" ).attr('maxlength');
    $('#additional_information').keyup(function() {
        var length = $(this).val().length;
        var length = maxLength-length;
        $('#chars').text(length);
    });
}

$(document).ready(function () {

    jQuery('select[name=salary], select[name=location]').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });

    jQuery('select[name=departments]').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        liveSearch: true,
        liveSearchStyle: 'startsWith',
        showTick: true
    });

    setupAdditionalInformationCountDown();

});
