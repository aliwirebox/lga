jQuery(document).ready(function () {
    var typeOfFirmsSelect = jQuery('select[name="type_of_firms[]"]').customSelect({}),
        deparmentsSelect = jQuery('select[name="departments[]"]').customSelect({}),
        locationsSelect = jQuery('select[name="locations[]"]').customSelect({});

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

    locationsSelect.on('customSelect:change', debounceUpdateTypeOfFirmsOption);

    updateTypeOfFirmOptions();
});
