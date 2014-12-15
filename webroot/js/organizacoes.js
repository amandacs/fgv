$(document).ready(function(){
    var data = $('#tree-source').data('sources');
    var id_root = $('#tree-source').data('id_root');
    var label_root = $('#tree-source').data('label_root');
    var breadcrumb = [{id: id_root, label: label_root, children: null}];
    var selected_node_id = $('#tree-source').data('node_id');

    loadTree('#treeOrganizacoes', data, id_root);

    if(selected_node_id != 0){
        preSelectNode(selected_node_id, breadcrumb);
    }else{
        loadBreadCrumb(breadcrumb);
    }
});

function loadTree(treeID, data, id_root){
    $(treeID).tree({
        data: data,
        closedIcon: '',
        openedIcon: '',
        autoEscape: false
    });

    $(treeID).bind(
        'tree.select',
        function(e) {
            var node = $(treeID).tree('getNodeById', e.node.id);
            console.log(node);
            reloadTree(treeID, node);
            $.ajax({
                async:true,
                data:$(treeID).serialize(),
                url: "\/fgv\/organizacoes\/getOrganizacao\/" + e.node.id + "\/" + id_root,
                dataType:"html",
                type:"post"
            }).done(function(response) {
                setOrgaoSelecionado(response);
            });
        }
    );
}

function setOrgaoSelecionado(response){
    var json = JSON.parse(response);
    var $usuarios = [];
    var $size = json[0].usuarios.length;
    if($size > 0){
        $.each(json[0].usuarios, function(i, item){
            $usuarios.push(item.nome)
        });
    }else{
        $usuarios.push('Nenhum usuário neste órgão!')
    }
    if(json[0].id != 1){
        $('#documentoNumeracao').val(json[0].numeracao);
        $("#organizacao_destino_id").html(
            '<label>Você selecionou o órgão/setor:</label>' +
                '<p>' +
                '<i class="fa fa-check text-success"></i>' +
                '<span class="text-success">ID:</span> ' + json[0].id +
                '</p>' +
                '<p>' +
                '<i class="fa fa-check text-success"></i>' +
                '<span class="text-success">Nome:</span> ' + json[0].nome +
                '</p>' +
                '<p>' +
                '<i class="fa fa-check text-success"></i>' +
                '<span class="text-success">Sigla:</span> ' + json[0].acronimo +
                '</p>' +
                '<p>' +
                '<i class="fa fa-check text-success"></i>' +
                '<span class="text-success">Usuário(s):</span> ' + $usuarios +
                '</p>' +
                '<a href="/fgv/organizacoes/edit/'+ json[0].id + '" class="btn btn-link">Editar</a>' +
                '<a href="/fgv/organizacoes/add/' + json[0].id + '/' + json[0].secretaria_id + '" class="btn btn-link">Novo subordinado</a>' +
                '<a href="/fgv/usuarios/index/'+ json[0].id + '" class="btn btn-link">Usuarios</a>'
        );
        if(json[0].primeiro_documento_do_dia){
            $("#primeiro_documento_message").html(
                '<div class="alert alert-info fade in">' +
                    '<a href="#" class="close" onclick="$(this).parent().slideUp();return false;">&times;</a>' +
                    '<h4>Importante!</h4>' +
                    'Primeiro documento do dia para <b>' + json[0].nome + '</b>' +
                    '</div>'
            );
        }else{
            $("#primeiro_documento_message").html(null);
        }
        $('#hiddenFileds').html(
            '<input id="hiddenSetorId" type="hidden" name="data[Documento][setor_id]" role="form" value="'+ json[0].id +'">' +
                '<input id="hiddenSecretariaId" type="hidden" name="data[Documento][secretaria_id]" role="form" value="'+ json[0].secretaria_id +'">'
        );
    }else{
        $("#organizacao_destino_id").html(null);
        $("#primeiro_documento_message").html(null);
        $('#hiddenFileds').html(null);
    }
    var id_root = $('#tree-source').data('id_root');
    var label_root = $('#tree-source').data('label_root');
    var breadcrumb = [];

    if(json[0].breadcrumb.length > 0){
        $.each(json[0].breadcrumb, function(i, item){
            if(item.id == id_root){
                $label = '<i class="fa fa-sitemap"></i> ' + item.sigla;
            }else{
                $label = item.label;
            }
            breadcrumb.push({id:item.id, label:$label});
        });
    }
    loadBreadCrumb(breadcrumb);
};

function loadBreadCrumb(breadcrumb){
    var id_root = $('#tree-source').data('id_root');
    $("#breadCrumbHolder").empty();
    $('#breadCrumbHolder').append(
        '<div id="breadcrumbs" class="rcrumbs" data-breadcrumb="'+breadcrumb+'">' +
            '<ul>' +
            '</ul>' +
            '</div>'
    );
    for (var i=0; i < breadcrumb.length; i++){
        if((i + 1) == breadcrumb.length){
            $("#breadcrumbs ul").append('<li id="li_'+breadcrumb[i].id+'" style="text-decoration: underline;">'+ breadcrumb[i].label + '</li>');
        }else{
            $("#breadcrumbs ul").append('<li><a data-id="'+breadcrumb[i].id+'" href="javascript:void(0)" class="bread_item">'+ breadcrumb[i].label + '</a></li><li class="divider">→</li>');
        }
    }
    $("#breadcrumbs").rcrumbs();

    $('.bread_item').click(function(){
        var id = $(this).data('id');
        preSelectNode(id, breadcrumb);
    });
}

function preSelectNode(id, breadcrumb){
    var id_root = $('#tree-source').data('id_root');
    if(id == id_root){
        var data = $('#tree-source').data('sources');
        loadTree('#treeOrganizacoes', data, breadcrumb);
    }else{
        var node = $('#treeOrganizacoes').tree('getNodeById', id);
        reloadTree('#treeOrganizacoes', node);
    }

    $.ajax({
        async:true,
        data:$("#treeOrganizacoes").serialize(),
        url: "\/fgv\/organizacoes\/getOrganizacao\/" + id + "\/" + id_root,
        dataType:"html",
        type:"post"
    }).done(function(response) {
        setOrgaoSelecionado(response);
    });
}

function reloadTree(treeID, node){
    if(node.children.length > 0){
        var $tree = $(treeID);
        $tree.tree({
            data: node.children,
            closedIcon: '',
            openedIcon: '',
            autoEscape: false
        });
    }
}

var DataSource = function (options) {
    this._formatter = options.formatter;
    this._columns = options.columns;
    this._data = options.data;
};

DataSource.prototype = {
    columns: function () {
        return this._columns;
    },
    data: function (options, callback) {
        var self = this;
        if (options.search) {
            callback({ data: self._data, start: start, end: end, count: count, pages: pages, page: page });
        } else if (options.data) {
            callback({ data: options.data, start: 0, end: 0, count: 0, pages: 0, page: 0 });
        } else {
            callback({ data: self._data, start: 0, end: 0, count: 0, pages: 0, page: 0 });
        }
    }
};
