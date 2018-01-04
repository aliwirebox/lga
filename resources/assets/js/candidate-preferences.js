jQuery(document).ready(function () {
    var typeOfFirmsSelect = jQuery('select[name="type_of_firms[]"]').customSelect({}),
        deparmentsSelect = jQuery('select[name*="departments"]').customSelect({}),
        lawFirmBlacklistSelect = jQuery('select[name="law_firm_blacklist[]"]').customSelect({}),
        locationsSelect = jQuery('select[name="locations[]"]').customSelect({
            liveSearchStyle: 'contains',
        });

    jQuery('select[name=minimum_salary]').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });

    var debounce = function(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    var updateTypeOfFirmOptions = function() {
        var data = {
            locations: locationsSelect.val()
        };

        jQuery.post(typeOfFirmsOptionRoute, data, function(optionsHtml){
            typeOfFirmsSelect.destroy()
                .html(optionsHtml)
                .customSelect({});

            var fadeToggle = (optionsHtml.length != 0) ? 'fadeIn' : 'fadeOut';

            jQuery('#type-of-firms-group')[fadeToggle]();
        });
    }

    var debounceUpdateTypeOfFirmsOption = debounce(function(){
        updateTypeOfFirmOptions();
    }, 400);
    
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
    var datePicker = $('.datetimepicker').datetimepicker({
        ignoreReadonly: true,
        inline: displayInlineDateTimePicker(),
        maxDate: moment().add(6, 'months'),
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

    locationsSelect.on('customSelect:change', debounceUpdateTypeOfFirmsOption);

    updateTypeOfFirmOptions();
});
