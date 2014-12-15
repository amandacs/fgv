$(document).ready(function() {
    if($('#cargos').val().length != 0) {
        $.getJSON("listar_funcoes_json",{
            cargoId: $('#cargos').val()
        }, function(funcoes) {
            if(funcoes != null)
                popularListaDeFuncoes(funcoes, $('#funcoes').val());
        });
    }

    $('#cargos').on('change', function() {
        if($(this).val().length != 0) {
            $.getJSON("/fgv/usuarios/listar_funcoes_json",{
                cargoId: $(this).val()
            }, function(funcoes) {
                if(funcoes != null)
                    popularListaDeFuncoes(funcoes);
            });
        } else
            popularListaDeFuncoes(null);
    });
});

function popularListaDeFuncoes(funcoes, idFuncao) {
    var options = '<option value>Selecione a funcão do usuário...</option>';
    if(funcoes != null) {
        $.each(funcoes, function(index, funcao){
            if(idFuncao == index)
                options += '<option selected="selected" value="' + index + '">' + funcao + '</option>';
            else
                options += '<option value="' + index + '">' + funcao + '</option>';
        });
    }
    $('#funcoes').html(options);
}