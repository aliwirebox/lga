function toggleCurrentFirmQuestion(onFirstLoad) {
    var show = $('input[name=employed_by_training_firm]').filter(':checked').val() == 'No';

    var fadeToggle = (show) ? 'fadeIn' : 'fadeOut';

    console.log(onFirstLoad);
    if (!onFirstLoad) {
        $('select[name=current_law_firm]').val("").selectpicker('render').trigger("change");
    }

    $('#current-firm-question')[fadeToggle]();
}

function toggleWorkingWithQuestion(show) {
    if (show) {
        $('#working-with-question').fadeIn();
        enableWorkingWithRadioButtons();
    }
    else {
        $('#working-with-question').fadeOut();
        setTrainingFirmToCurrentFirm();
        disableWorkingWithRadioButtons();
    }
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

function disableWorkingWithRadioButtons() {
    $('#c4').attr('disabled', true);
    $('#c5').attr('disabled', true);
    $('#c4-sprites').css({opacity: 0.5});
    $('#c5-sprites').css({opacity: 0.5});
}

function enableWorkingWithRadioButtons() {
    $('#c4').attr('disabled', false);
    $('#c5').attr('disabled', false);
    $('#c4-sprites').css({opacity: 1});
    $('#c5-sprites').css({opacity: 1});
}

function setTrainingFirmToCurrentFirm() {
    var $employedByTrainingFirm = $('input[name=employed_by_training_firm]');
    $employedByTrainingFirm.filter('[value=Yes]').prop('checked', true);
    toggleCurrentFirmQuestion();
}

function toggleQualifiedDateDisplay(qualifiedDate) {
    var now = moment().startOf('month');
    var toggle = moment.isMoment(qualifiedDate) && qualifiedDate.startOf('month').isSameOrBefore(now);

    toggleWorkingWithQuestion(toggle);
}

$(document).ready(function () {

    var datePicker = $('.datetimepicker').datetimepicker({
        ignoreReadonly: true,
        inline: displayInlineDateTimePicker(),
        minDate: moment(candidateCreatedAt).startOf('month').subtract(24, 'months'),
        maxDate: moment(candidateCreatedAt).startOf('month').add(24, 'months'),
        viewMode: 'months',
        ignoreReadonly: true,
        format: 'MMMM YYYY'
    }).on('dp.update dp.change', function (e) {
        var dataField = jQuery(jQuery(this).data('field'));

        if (dataField.length > 0) {
            //date and date are two different functions
            //first date() returns a moment object, which has another function `date`
            var qualifiedDate = jQuery(this).data('DateTimePicker').date().startOf('month');

            dataField.val(qualifiedDate.format('YYYY-MM-DD'));

            toggleQualifiedDateDisplay(qualifiedDate);
        }
    })

    $('input[name=employed_by_training_firm]').change(function(){
        toggleCurrentFirmQuestion();
    });

    jQuery('.custom-select-element').customSelect({});

    jQuery('select[name=university], select[name=training_law_firm], select[name=current_law_firm]').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        liveSearch: true,
        liveSearchStyle: 'startsWith',
        showTick: true
    });

    jQuery('select[name=degree_class]').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });

    toggleCurrentFirmQuestion(true);

    var qualifiedDate = datePicker.data('DateTimePicker').date();

    toggleQualifiedDateDisplay(qualifiedDate);
});
