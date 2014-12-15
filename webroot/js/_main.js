document.addEventListener("DOMContentLoaded", function() {
    $('body').on('hide.bs.modal', '.modal', function(){
        $('.modal-content').html('');
        $(this).removeData('bs.modal');
    });
}, false);