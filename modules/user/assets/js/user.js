$(document).ready(function () {
    $('.js-switch_name').click(function () {
        var data = $('#api-form-name').serialize();
        $.ajax({
            url: 'user/default/switch-name',
            type: 'POST',
            data: data,
            async: false,
            success: function (data) {
                if (data) {
                    $('.js-switch_name').addClass('btn-success').removeClass('btn-danger, btn-primary');
                } else {
                    $('.js-switch_name').addClass('btn-danger').removeClass('btn-success, btn-primary');
                }
            }
        });
    });
    $('.js-money').click(function () {
        var data = $('#api-form-money').serialize();
        $.ajax({
            url: 'user/default/money',
            type: 'POST',
            data: data,
            async: false,
            success: function (data) {
                if (data) {
                    $('.js-money').addClass('btn-success').removeClass('btn-danger, btn-primary');
                    $('.js-new-money').text($('.js-new-money').text() - $('.js-pre-money').val());
                } else {
                    $('.js-money').addClass('btn-danger').removeClass('btn-success, btn-primary');
                }
            }
        });
    });
});