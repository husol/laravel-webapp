$(document).ready(function() {
    $('#id_user_role').on('change', function() {
        $('input[type="checkbox"]').removeAttr('checked');
        if($('#id_user_role option').length && $('#id_user_role option:selected').attr('data').length > 0) {
            var data = $.parseJSON($('#id_user_role option:selected').attr('data'));
            for (var key in data) {
                if(data[key] == 'true') {
                    $('input[name=' + key + ']').prop('checked', true);
                }
            }
        }
    });

    $('#id_user_role').trigger('change');

    //Submit role
    $('.submit-role').click(function() {
        var role = {};
        $('input[type="checkbox"]').each(function() {
            if($(this).attr('name') != null && $(this).attr('name') != '' && $(this).attr('name') != undefined) {
                role[$(this).attr('name')] = $(this).is(':checked');
            }
        });

        var response = callAjax('user', 'saveRole', {id_user: $('#id_user_role').val(), role:role});

        if (response.result) {
            showMessageBubble('id_user_role', 'success', 'Cập nhật quyền thành công.');
        }
    });
});