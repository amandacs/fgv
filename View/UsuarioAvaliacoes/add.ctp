<?php $grupos = array(); ?>
<?php foreach ($perguntas as $perg): ?>
    <?php array_push($grupos, $perg['Grupo']['id']/*, $perg['Grupo']['nome']*/); ?>
<?php endforeach; ?>
<?php $grupos = array_unique($grupos); ?>
    <div class="respostas view" style="border-left: none; margin-top: 30px; float: left">
        <div class="navbar col-md-12">
            <?php echo $this->Session->flash(); ?>
            <?php
            echo $this->Form->create('UsuarioAvaliacao', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false
                )
            ));
            ?>
            <legend style="font-weight: bold; font-size: 26px"> <?php echo $perguntas[0]['Avaliacao']['descricao']; ?> <span style="color: red; font-size: 17px; padding-left: 25%">*Todas as questões são de preenchimento obrigatório.</span></legend>
            <?php if($grupos == 0)?>
            <?php foreach ($grupos as $grupo):?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-weight: bold">
                            <i class="fa fa-leaf"></i>
                            <?php echo $gruponome[$grupo] ?>
                        </h3>
                    </div>
                </div>
                <div id="panel_<?php echo $grupo; ?>" class="panel-body">
                    <?php $j = 0; ?>
                    <?php foreach ($perguntas as $i=>$pergunta): ?>
                        <div class="col-md-14">
                            <?php if ($pergunta['Grupo']['id'] == $grupo): ?>
                                <div class="form-group" id="avaliacao">
                                    <label>
                                        <?php echo ($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']);?>
                                    </label>
                                    <?php echo ($this->Form->input('UsuarioResposta.'.$i.'.pergunta_id', array('type'=>'hidden','class' => 'form-control ', 'value'=>$pergunta['Pergunta']['id']))); ?>
                                    <label class="input">
                                        <?php echo ($this->Form->input('UsuarioResposta.'.$i.'.resposta_avaliado_id', array('type'=>'numeric', 'maxlength'=>1, 'class' => 'form-control resposta_avaliado '.$pergunta['Grupo']['id'], 'data-alias' => 'avaliado', 'data-grupo_id' => $pergunta['Grupo']['id'],'data-ordem' => $pergunta['Pergunta']['ordem'], 'required' => true, 'autofocus', 'onchange' => 'exibe_media(this),exibe_ponto_i(this), exibe_ponto(this)')));?>
                                        <?php echo ($this->Form->input('UsuarioResposta.'.$i.'.resposta_avaliador_id', array('type'=>'numeric', 'disabled' => true, 'class' => 'form-control resposta_avaliador')));?>
                                    </label>
                                </div>
                                <?php $j++; ?>
                            <?php endif ?>
                        </div>
                    <?php endforeach; ?>
                    <label class="input" style="float: right">
                        <?php echo ($this->Form->input('mediaAvaliado', array('id'=>'media_avaliado_'.$grupo, 'name'=>'mediaAvaliado', 'data-qtde_perguntas' => $j,  'type'=>'numeric', 'disabled' => true, 'class' => 'form-control', 'value' => 0)));?>
                        <?php echo ($this->Form->input('mediaAvaliador', array('id'=>'media_avaliador_', 'name'=>'mediaAvaliador', 'type'=>'numeric', 'disabled' => true, 'class' => 'form-control')));?>
                    </label>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
            <!-- PONTOS FRACOS E FORTES -->
            <div id="quadro_geral">
                <div class="panel panel-collapse" id="pontos_fortes">
                    <h4> PONTOS FORTES: </h4>
                    <?php foreach ($grupos as $grupo):?>
                        <span id="ponto_forte_<?php echo $grupo;?>"> </span>
                        <?php foreach ($perguntas as $i=>$pergunta): ?>
                            <?php if ($pergunta['Grupo']['id'] == $grupo): ?>
                                <span id="ponto_forte_<?php echo $grupo; ?>_<?php echo $pergunta['Pergunta']['ordem']?>"></span>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
                <div class="panel panel-collapse" id="pontos_fracos">
                    <h4>PONTOS FRACOS:</h4>
                    <?php foreach ($grupos as $grupo):?>
                        <span id="ponto_fraco_<?php echo $grupo;?>"> </span>
                        <?php foreach ($perguntas as $i=>$pergunta): ?>
                            <?php if ($pergunta['Grupo']['id'] == $grupo): ?>
                                <span id="ponto_fraco_<?php echo $grupo; ?>_<?php echo $pergunta['Pergunta']['ordem']?>"></span>
                            <?php endif ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <!--        Fim Pontos fracos e fortes -->

            <div style="margin-bottom: 20px">
                <label style="font-weight: bold; font-size: 20px"><i class="fa fa-leaf"></i>   Justifique as notas de sua avaliação:</label>
                <?php echo $this->Form->input('comentario_avaliado', array('class' => 'form-control', 'required' => true));?>
            </div>
            <p class="pull-left">
                <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
                <?php foreach($usuarios as $usuario):
                    echo $this->Html->link('Cancelar', array('controller' => 'usuarios', 'action' => 'view', $usuario['Avaliado']['id']), array('class' => 'btn btn-danger'));
                endforeach; ?>
            </p>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
<?php $this->start('script'); ?>
<?php echo $this->Html->script('views/usuarioAvaliacoes/mediaAvaliado.js'); ?>
<!--<script>
    $(function(){
        $.each($('.resposta_avaliado'), function(i,o){
            $(o).val(aleatorio(1,4));
        });
    });

    function aleatorio(inferior,superior){
        numPossibilidades = superior - inferior
        aleat = Math.random() * numPossibilidades
        aleat = Math.floor(aleat)
        return parseInt(inferior) + aleat;
    }
</script>-->
<?php $this->end(); ?>