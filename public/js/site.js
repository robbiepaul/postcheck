$(function(){

    $('#checkAll').bind('change', function(){
        var c = $(this).prop('checked');
        $('.toCheck').prop('checked', c);
    });

    if($('[data-multiple-action]').length) {

        $('input[type=checkbox]').bind('change', function(){
            var disabled = true;
            $('input[type=checkbox]').each(function(){
                if($(this).prop('checked') == true) disabled = false;
            });
            postCheck.showMultipleButtons(disabled);
        });

    }


});

var postCheck = {}
postCheck.showMultipleButtons = function(b) {
    if(b == true) {
        $('[data-multiple-action]').addClass('disabled');
    } else {
        $('[data-multiple-action]').removeClass('disabled');
    }
};