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
    jQuery('.custom-select-element').customSelect({});

    jQuery('select:not(.custom-select-element)').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });

    var updateAlternateDate = function (date) {
        var dataField = jQuery(date.data('field'));

        if (dataField.length > 0) {
            var value = date.data('DateTimePicker').date().startOf('month').format('YYYY-MM-DD');

            dataField.val(value);
        }
    };

    var setMinDateForToDate = function() {
        var fromDate = from.data('DateTimePicker').date();

        if (fromDate) {
            var minDate = fromDate.startOf('month').add(1, 'months');

            to.data('DateTimePicker').minDate(minDate);
        }
    };

    var from = jQuery('.qualified_date_from'),
        to = jQuery('.qualified_date_to');

    // by default min date is - 24 months of now. Unless it is a very old search which in that case just use the "from date" as min
    var defaultMinDate = moment().startOf('month').subtract(25, 'months'); //for some reason I need to minus 25 months for it to equal 24
    var searchDateFrom = moment(searchDateFromString).startOf('month');
    var startDate = defaultMinDate.isSameOrBefore(searchDateFrom) ? defaultMinDate : searchDateFrom;

    from.datetimepicker({
        ignoreReadonly: true,
        inline: displayInlineDateTimePicker(),
        viewMode: 'months',
        format: 'MMMM YYYY',
        minDate: startDate,
        maxDate: moment().startOf('month').add(23, 'months'),
    }).on('dp.update dp.change', function (e) {
        setMinDateForToDate();
        updateAlternateDate(from);
    });

    to.datetimepicker({
        ignoreReadonly: true,
        inline: displayInlineDateTimePicker(),
        minDate: startDate.startOf('month').add(1, 'months'),
        maxDate: moment().startOf('month').add(24, 'months'),
        viewMode: 'months',
        format: 'MMMM YYYY'
    }).on('dp.update dp.change', function (e) {
        updateAlternateDate(to);
    });

    setMinDateForToDate();
});
