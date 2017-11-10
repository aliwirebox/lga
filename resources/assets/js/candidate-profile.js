function toggleDegreeClassQuestion(show) {
    if (show) {
        $('#degree-class-question').fadeIn();
    }
    else {
        $('#degree-class-question').fadeOut();
    }
}

$(document).ready(function () {
    $('input[name=has_degree]').change(function(){
        if($(this).val() == 1 ){
            toggleDegreeClassQuestion(true);
        }
        else{
            toggleDegreeClassQuestion(false);
        }
    });

    $('input[name=has_degree]').change();

    jQuery('.custom-select-element').customSelect({});

    jQuery('select[name=current_law_firm]').selectpicker({
        liveSearch: true,
        liveSearchStyle: 'startsWith',
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });

    jQuery('select[name=degree_class]').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });
});
