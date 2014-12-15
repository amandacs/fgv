$(document).ready(function() {
    if($('#cargos').val().length != 0) {
        $.getJSON("listar_classes_json",{
            cargoId: $('#cargos').val()
        }, function(classes) {
            if(classes != null)
                popularListaDeClasses(classes, $('#classes').val());
        });
    }

    $('#cargos').on('change', function() {
        if($(this).val().length != 0) {
            $.getJSON("/fgv/usuarios/listar_classes_json",{
                cargoId: $(this).val()
            }, function(classes) {
                if(classes != null)
                    popularListaDeClasses(classes);
            });
        } else
            popularListaDeClasses(null);
    });
});

function popularListaDeClasses(classes, idClasse) {
    var options = '<option value style="font-weight: bold">Selecione a classe do usuário...</option>';
    if(classes != null) {
        $.each(classes, function(index, classe){
            if(idClasse == index)
                options += '<option selected="selected" value="' + index + '">' + classe + '</option>';
            else
                options += '<option value="' + index + '">' + classe + '</option>';
        });
    }
    $('#classes').html(options);
}