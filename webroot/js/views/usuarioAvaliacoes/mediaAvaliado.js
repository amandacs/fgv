function calcula_media(el){
    var alias = $(el).data('alias');//seto o elemento escolhido(input neste caso) pelo apelido(alias)
    var grupoId = $(el).data('grupo_id');//seto o id do grupo(grupo_id)
    var qtdePerguntas = $('#media_' + alias + '_' + grupoId).data('qtde_perguntas');//pego o numero de elementos(alias) dentro deste grupo(grupoId)
    var total = 0;//zero a variavel que vai guardar a soma dos valores digitados em alias
    var panel = $('#panel_'+ grupoId);//setando cada grupo pelo id especifico
    $(el).closest(panel).find('input.resposta_' + alias).each(function(index, element){
        var valor = $(element).val();
        if(valor.length > 0){
            total += parseInt(valor);
        }
    });
    var media = (total/qtdePerguntas);
    console.log(alias);
    console.log('Media: '+ media);
    console.log('***********************************************');
    $('#media_' + alias + '_' + grupoId).val(media);
}
function exibe_media(el){
    if($(el).val()==1 || $(el).val()==2 || $(el).val()==3 || $(el).val()==4){
        $(el).removeClass("valor_invalido")
        calcula_media(el);
    }else{
        $('#avaliador').focus();
        console.log('#avaliador');
        $(el).addClass("valor_invalido");
        alert("Este campo só aceita valores numéricos entre 1 e 4. Por favor, altere o valor.");
    }
}
function calcula_ponto_i(el){

    var alias = $(el).data('alias');//seto o elemento escolhido(input neste caso) pelo apelido(alias)
    var grupoId = $(el).data('grupo_id');//seto o id do grupo(grupo_id)
    var ordem = $(el).data('ordem');
    var valor = $(el).val();
    console.log(valor);
    if(valor>2)
    {
        $('#ponto_fraco_'+grupoId+'_'+ordem).html(null);
        $('#ponto_forte_'+grupoId+'_'+ordem).html("<li>"+"Indicador_"+grupoId+"_"+ordem+"</li>");
    }
    else{
        $('#ponto_forte_'+grupoId+'_'+ordem).html(null);
        $('#ponto_fraco_'+grupoId+'_'+ordem).html("<li>"+"Indicador_"+grupoId+"_"+ordem+"</li>");
    }
}
function exibe_ponto_i(el){
    calcula_ponto_i(el);
}
function calcula_ponto(el){
    var alias = $(el).data('alias');//seto o elemento escolhido(input neste caso) pelo apelido(alias)
    var grupoId = $(el).data('grupo_id');//seto o id do grupo(grupo_id)
    var qtdePerguntas = $('#media_' + alias + '_' + grupoId).data('qtde_perguntas');//pego o numero de elementos(alias) dentro deste grupo(grupoId)
    var total = 0;//zero a variavel que vai guardar a soma dos valores digitados em alias
    var panel = $('#panel_'+ grupoId);//setando cad grupo pelo id especifico
    $(el).closest(panel).find('input.resposta_' + alias).each(function(index, element){
        var valor = $(element).val();
        if(valor.length > 0){
            total += parseInt(valor);
        }
    });
    var media = parseInt(total/qtdePerguntas);
    if(media>2)
    {
        $('#ponto_fraco_'+grupoId).html(null);
        $('#ponto_forte_'+grupoId).html("<li>"+"Grupo"+grupoId+"</li>");
    }
    else{
        $('#ponto_forte_'+grupoId).html(null);
        $('#ponto_fraco_'+grupoId).html("<li>"+"Grupo"+grupoId+"</li>");
    }
    $('#ponto_' + alias + '_' + grupoId).val(ponto);

}
function exibe_ponto(el){
    calcula_ponto(el);
}