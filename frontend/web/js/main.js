$(document).ready(function () {
    $('body').on('click', '#send', function (e) {
        e.preventDefault();
        showLoader();
        $('.alert-danger').hide();
        var data = {};
        data[$('meta[name=csrf-param]').attr("content")] = $('meta[name=csrf-token]').attr("content");
        data['start_date'] = $('#start-date').val();
        data['amount'] = $('#amount').val();
        data['term'] = $('#term').val();
        data['percent'] = $('#percent').val();
        $.ajax({
            url: '/site/calc',
            type: 'POST',
            data: data,
            success: function (result) {
                hideLoader();
                console.log(result);
                $('.schedule-payment > table > tbody').empty();
                $('.schedule-payment > table > tbody').html(result.html);
                $('.schedule-payment').show();
                $('#loan-id').text(result.loan_id);
            },
            error: function (result) {
                hideLoader();
                $('.alert-danger > .msg').text(result.responseJSON.message);
                $('.alert-danger').show();
            }
        });
    });

    $('body').on('click', '#search', function (e) {
        e.preventDefault();
        showLoader();
        $('.alert-danger').hide();
        var data = {};
        data[$('meta[name=csrf-param]').attr("content")] = $('meta[name=csrf-token]').attr("content");
        data['loan_id'] = $('#loan_id').val();
        $.ajax({
            url: '/site/schedule',
            type: 'POST',
            data: data,
            success: function (result) {
                hideLoader();
                console.log(result);
                $('.schedule-payment > table > tbody').empty();
                $('.schedule-payment > table > tbody').html(result.html);
                $('.schedule-payment').show();
                $('#loan-id').text(result.loan_id);
            },
            error: function (result) {
                hideLoader();
                $('.alert-danger > .msg').text(result.responseJSON.message);
                $('.alert-danger').show();
            }
        });
    });

    function showLoader(){
        $('.main-row').addClass('loader');
    }

    function hideLoader(){
        $('.main-row').removeClass('loader');
    }
});