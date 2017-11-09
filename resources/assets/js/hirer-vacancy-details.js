
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

function toggleAvailableDateDisplay(availableDate) {
    var now = moment().startOf('month');
    var toggle = moment.isMoment(availableDate) && availableDate.startOf('month').isSameOrBefore(now);

//        toggleWorkingWithQuestion(toggle);
}

//Display Datetimepicker inline for small devices
function displayInlineDateTimePicker() {
    var windowsWidth = $(window).width();
    var pickerInline = false;
    if (windowsWidth <= 320) {
        pickerInline = true;
    }
    return pickerInline;
}

$(document).ready(function () {

    jQuery('select[name=location]').selectpicker({
        liveSearch: true,
        liveSearchStyle: 'contains',
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });

    jQuery('select[name=salary]').selectpicker({
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
    var datePicker = $('.datetimepicker').datetimepicker({
        ignoreReadonly: true,
        inline: displayInlineDateTimePicker(),
        minDate: moment(searchDateFromString), 
        maxDate: moment().startOf('month').add(24, 'months'),
        ignoreReadonly: true,
        format: 'DD MMMM YYYY'
    }).on('dp.update dp.change', function (e) {
        var dataField = jQuery(jQuery(this).data('field'));

        if (dataField.length > 0) {
            //date and date are two different functions
            //first date() returns a moment object, which has another function `date`
            var availableDate = jQuery(this).data('DateTimePicker').date();

            dataField.val(availableDate.format('YYYY-MM-DD'));

            toggleAvailableDateDisplay(availableDate);
        }
    });
    var availableDate = datePicker.data('DateTimePicker').date();

    toggleAvailableDateDisplay(availableDate);

});
