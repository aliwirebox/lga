$(document).ready(disableRegButtons());

function disableRegButtons()
{

    function validateForm()
    {
        var isValid = true;
        $('.tab-pane:visible form input').each(function(){
            if ( $(this).val() === '' ) isValid = false;
        });
        return isValid;
    }



    $('button[name*="register-"]').each(function(){
        $(this).on('click', function(){
            $(this).prop('disabled', true);
            $(this).parents('form').submit();
        });
    });

    $(document.body).keypress(function( event ) {
        if (validateForm() === true && event.which === 13)
        {
            event.preventDefault();
            $('button[name*="register-"]').prop('disabled', true);
            $('.tab-pane:visible form').submit();
        }
    });
}
