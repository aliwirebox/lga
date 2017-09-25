$(document).ready(function () {
    jQuery('.custom-select-element').customSelect({});

    jQuery('select:not(.custom-select-element)').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        liveSearch: true,
        liveSearchStyle: 'startsWith',
        showTick: true
    });

    jQuery('#toggle-company').click(function (e) {
        e.preventDefault();
        jQuery('#select-company').hide();
        jQuery('#add-company').fadeIn();
    });
});
