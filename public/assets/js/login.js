function reset_password_process(national) {
    $('#reset_password_form_token [name=national]').val(national);
    setTimeout(function(){
        $('.firstForm').slideToggle(500, function () {
            $('.secondForm').slideToggle(500);
        })
    }, 3000);
}