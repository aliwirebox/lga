$(document).ready(function(){
    var confirmRemoveModal = $('#removeModal');

    function showRemoveLoading(){
        confirmRemoveModal.find('.remove-answer').hide();
        confirmRemoveModal.find('.remove-question').hide();
        confirmRemoveModal.find('.loading').fadeIn();
    }

    function showRemoveQuestion(){
        confirmRemoveModal.find('.remove-answer').hide();
        confirmRemoveModal.find('.remove-question').fadeIn();
        confirmRemoveModal.find('.loading').hide();
    }

    function showRemoveAnswer(){
        confirmRemoveModal.find('.remove-question').hide();
        confirmRemoveModal.find('.remove-answer').fadeIn();
        confirmRemoveModal.find('.loading').hide();
    }

    confirmRemoveModal.on('show.bs.modal', function (event) {
        showRemoveQuestion();
    });

    $('#delete-account').click(function (e) {
        showRemoveLoading();

        $.ajax({
            method: 'POST',
            url: route
        }).done(function(){
            showRemoveAnswer();
        });
    });
});
