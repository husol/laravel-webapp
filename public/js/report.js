$(document).ready(function() {
    $('a.edit-report').click(function() {
        var forId = $(this).attr('for');
        var endId = $(this).attr('end');
        $(this).hide();
        $("#div_" + forId).hide();
        CKEDITOR.replace(forId);
        $("#" + forId).fadeIn();
        $("#div_"+ forId).parent().removeClass('collapse');
        $("#" + endId).fadeIn();
    });

    $('a.start-edit-rate').click(function() {
       var forId =  $(this).attr('for');
       $(forId).removeClass('collapse');
       $(this).hide();
       $('a.end-edit-rate').show();
    });

    $('a.end-edit-rate').click(function() {
        var forId = $(this).attr('for'),
            rel = $(this).data('rel'),
            data  = $('#' + rel).is(':checked');

        callAjax('report', 'save', {key: rel, value: data});

        $(forId).addClass('collapse');
        $(this).hide();
        $('a.start-edit-rate').show();
    });

    $('input[type="checkbox"]').click(function (e) {
        var container = $(this).parent().parent();
        container.find('input[type=checkbox]').prop('checked', false);
        $(this).prop('checked', true);
    });

});