$(document).ready(function(){
    var input = $(this).closest("div").find('#password');
    $(input).val('');
    $(".erro").on("click", function(){
        var clean = $(this).closest("div").find("div.error-message");
        $(clean).css("display", "none");

    });
});
$(document).ready(function(){
    var input = $('.form-group');
    $(input).find('input').each(function (){
        $('#password').val('');
        $('#confirm_password').val('');
    });
});