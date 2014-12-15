<div class="modal-header" style="font-size: large">
    <span class="glyphicon glyphicon-th-list"></span>
    <?php echo $gruponome[$grupo]; ?>

</div>

<ul class="list-group">
    <a href="#" class="list-group-item disabled">
        <span class="badge">Avaliador</span>
        <span class="badge">Auto-Avaliação</span>
        <span>Indicador</span>
    </a>
    <?php foreach ($perguntas as $perg): ?>
        <?php foreach ($ava['UsuarioResposta'] as $resp): ?>
            <?php if ($resp['pergunta_id'] == $perg['Pergunta']['id']): ?>
                <li class="list-group-item">
                    <span class="badge"><?php echo $resp['resposta_avaliador_id'] ?></span>
                    <span class="badge "><?php echo $resp['resposta_avaliado_id'] ?></span>
                    <span><?php echo $perg['Pergunta']['ordem']?>.<?php"."?><?php echo $perg['Pergunta']['descricao'] ?></span>
                </li>
            <?php endif ?>
        <?php endforeach;?>
    <?php endforeach;?>
</ul>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
</div>

