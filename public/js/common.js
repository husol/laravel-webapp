// COMMON FUNCTIONS
/////////////////////// ajax jQuery //////////////////////////////////////
/* Usage:
var dataReps = callAjax(
    'objectName',
    'functionName',
    { parameter_1_name: value_1, parameter_2_name: value_2, parameter_n_name: value_n }
);
Then we can use 'dataReps' variable with 'dataReps.content'. Note: Default dataType is 'json'
*/
function callAjax(object,func,args) {
    var defs = {
        type: 'json', method: 'POST', args: null, 
        error: function(msg){},
        begin: function(){},
        success: function(result){}
    };

    var parameter = {args: args};
    opts = $.extend({}, defs, parameter);

    // convert args from boolean(true,false) to number(1,0)
    $.each(opts.args, function(key, value){
        if (typeof(value) === 'undefined') {
            opts.args[key] = 'null';
        }
        if (typeof(value) == 'boolean') {
            opts.args[key] = value ? 1 : 0;
        }
    });
    opts.args.ajaxcall = true;

    var dataresponse = $.ajax({
        cache: false, async: false,
        data: {_token: CSRF_TOKEN, object:object,func:func,parameters:opts.args}, dataType: opts.type, 
        type: opts.method, url: BASE_URL + "/ajax",
        error: function(xhr, stt, err) {
            opts.error(xhr, stt, err);
        },
        beforeSend: function(xhr) {
            opts.begin(xhr);
            xhr.setRequestHeader("ajaxcall", "true");
        },
        success: function(result) {
            opts.success(result);
        }
    });
    dataresponse.result = dataresponse.responseText;
    if(opts.type === 'json') {
        dataresponse.result = $.parseJSON(dataresponse.result);
    }
    return dataresponse;
}

function safe_tags(str) {
    var safe = String(str).replace(/(['"])/g, "\\$1");
    return safe;
}

function displayProof() {
    $('#proofbrowse').modal('show');
}

function returnFileUrl(str) {
    $('td.cke_dialog_ui_hbox_last div.cke_dialog_ui_labeled_content div.cke_dialog_ui_input_text input.cke_dialog_ui_input_text').val(str);
    $('#proofbrowse').modal('hide');
}

// Show tooltip when input data is not valid or successful
function showMessageBubble(id, type, msg, seconds){
    var delay = seconds || 2.7;
    jQuery.showMessage({
        thisMessage:	    [msg],
        className:		    type,
        position:		    'top',
        opacity:		    90,
        displayNavigation:	true,
        autoClose:		    true,
        delayTime:		    delay*1000
    });
	document.getElementById(id).focus();
    return false;
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validatePassword(password) {
    //Password is minimum 6 characters in length, and should contain 3 out of 4 of the below items:
    //- Uppercase letters
    //- Lowercase letters
    //- Numbers
    //- Special characters (@, $, #, %, ...)
    var re = /^(?=^.{6,255}$)((?=.*\d)(?=.*[A-Z])(?=.*[a-z])|(?=.*\d)(?=.*[^A-Za-z0-9])(?=.*[a-z])|(?=.*[^A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z])|(?=.*\d)(?=.*[A-Z])(?=.*[^A-Za-z0-9]))^.*$/;
    return re.test(password);
}

//END COMMON FUNCTION
jQuery(function($){

    $('a.end-edit').click(function() {
        var forId = $(this).attr('for');
        var endId = $(this).attr('end');
        var data  = CKEDITOR.instances[forId].getData()
        $(this).hide();
        CKEDITOR.instances[forId].destroy(true);
        $("#" + forId).hide();
        $("#" + endId).fadeIn();
        $("#div_" + forId).fadeIn();
        $("#div_" + forId).html(data);
        $("#" + forId).val(data);

        callAjax('report', 'save', {key: forId, value: data});
    });

    $('a.edit').click(function() {
        var data = $.parseJSON($(this).attr('data'));
        for (var key in data) {
            if(key == 'avatar') {
                key = 'avatar_url';
            }
            //for selectbox
            $('select[name='+ key + '] option[value="' + safe_tags(data[key]) + '"]').attr('selected', 'selected');
            $('select[name='+ key + ']').val(safe_tags(data[key]));
            $('select[name="info['+ key + ']"] option[value="' + safe_tags(data[key]) + '"]').attr('selected', 'selected');
            $('select[name="info['+ key + ']"]').val(safe_tags(data[key]));
            //for input
            $('input[name=' + key + ']').attr('value', safe_tags(data[key]));
            $('input[name=' + key + ']').val(safe_tags(data[key]));
            $('input[name="info[' + key + ']"]').attr('value', safe_tags(data[key]));
            $('input[name="info[' + key + ']"]').val(safe_tags(data[key]));
            //for textarea
            $('textarea[name=' + key + ']').attr('value', data[key]);
            $('textarea[name=' + key + ']').val(data[key]);
            $('textarea[name="info[' + key + ']"]').attr('value', data[key]);
            $('textarea[name="info[' + key + ']"]').val(data[key]);
        }

        for(var name in CKEDITOR.instances) {
            CKEDITOR.instances[name].destroy(true);
        }

        if ($('#textnoidung').length) CKEDITOR.replace('textnoidung');
        if ($('#textmota').length) CKEDITOR.replace('textmota');
    });

    $('a.delete').click(function() {
        var cfm = window.confirm("Are you sure you want to delete this item?");
        if (cfm) {
            document.location.href = $(this).attr("href");
        }
        return false;
    });

    $('[data-dismiss="modal"]').click(function() {
        $('form:not(.not-clear) input[type=text], form:not(.not-clear) textarea, form:not(.not-clear) input[name=id], form:not(.not-clear) input[type=email]').val("");
        $('form:not(.not-clear) select option').eq(0).prop('selected', true);
        if (!($(this).data('clearCK') == undefined || $(this).data('clearCK') == 'false')) {
            for(var name in CKEDITOR.instances) {
                CKEDITOR.instances[name].destroy(true);
            }
        }

        if ($('#textnoidung').length) {
            CKEDITOR.replace('textnoidung');
        }
        if ($('#textmota').length) {
            CKEDITOR.replace('textmota');
        }
    });
/* Validation list
    required – Makes the element required.
    remote – Requests a resource to check the element for validity.
    minlength – Makes the element require a given minimum length.
    maxlength – Makes the element require a given maximum length.
    rangelength – Makes the element require a given value range.
    min – Makes the element require a given minimum.
    max – Makes the element require a given maximum.
    range – Makes the element require a given value range.
    step – Makes the element require a given step.
    email – Makes the element require a valid email
    url – Makes the element require a valid url
    date – Makes the element require a date.
    dateISO – Makes the element require an ISO date.
    number – Makes the element require a decimal number.
    digits – Makes the element require digits only.
    equalTo – Requires the element to be the same as another one
 */
    $("form").each(function() {
        $(this).validate({
            lang: 'vi',
            errorClass: "red",
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    //Validate username
    $('input[name=username]').change(function() {
        var response = callAjax('user', 'checkUsername', {username: $(this).val()});
        if (response.result > 0) {
            var message = '';
            if (response.result == 1) {
                message = "Tên đăng nhập phải bằng đầu bằng chữ<br />Tên đăng nhập không được phép có ký tự đặc biệt<br />Tên đăng nhập từ 3 đến 25 ký tự<br />Tên đăng nhập không có ký tự in hoa";
            } else if (response.result == 2) {
                message = 'Tên đăng nhập đã tồn tại trong hệ thống.';
            }
            $('button[type=submit]').attr('disabled', 'disabled');
            showMessageBubble('username', 'error', message);
            return false;
        }
        $('button[type=submit]').removeAttr('disabled');
        return false;
    });

    //Validate password
    $('#passuser, #passuserinfo').on('change', function(){
        if ($(this).is(':visible') && !validatePassword($(this).val())) {
            var id = $(this).attr('id');
            var message = 'Mật khẩu có ít nhất 6 ký tự và phải thỏa 3 trong 4 điều kiện sau:<br />- Có ký tự viết hoa<br />- Có ký tự viết thường<br />- Có chữ số<br />- Có ký tự đặc biệt (@, $, #, %, ...)';
            $('button[type=submit]').attr('disabled', 'disabled');
            showMessageBubble(id, 'error', message);
            return false;
        }
        $('button[type=submit]').removeAttr('disabled');
        return false;
    });

    $(document).on("click", "a.cke_button__link", function(){
        setTimeout(function() {
            $("<a class='cke_dialog_ui_button cke_dialog_ui_button_ok' onclick='displayProof()'><span class='cke_dialog_ui_button'>Chọn Minh chứng</span></a>").replaceAll('td.cke_dialog_ui_vbox_child a.cke_dialog_ui_button');
        }, 600);
    });
});