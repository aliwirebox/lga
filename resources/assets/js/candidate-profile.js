
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

    jQuery('.custom-select-element').customSelect({});

   

    jQuery('select[name=degree_class]').selectpicker({
        header: '<span>Close</span>', //header has to have title so I have hidden it in css
        showTick: true
    });


});
