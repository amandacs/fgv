<?php $grupos = array(); ?>
<?php foreach ($perguntas as $perg): ?>
    <?php array_push($grupos, $perg['Grupo']['nome']); ?>
<?php endforeach; ?>
<?php $grupos = array_unique($grupos); ?>
<div class="respostas view">
    <div class="navbar col-md-12">
        <?php echo $this->Session->flash(); ?>
        <?php

        echo $this->Form->create('UsuarioResposta', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <?php if($grupos == 0)?>
        <?php foreach ($grupos as $grupo):?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-leaf"></i>
                        EXIBINDO INFORMAÇÕES DE <?php echo $grupo; ?>
                    </h3>
                </div>
            </div>
            <div class="panel-body">
                <?php foreach ($perguntas as $i=>$pergunta): ?>
                    <div class="col-md-14">
                        <?php if ($pergunta['Grupo']['nome'] == $grupo): ?>
                            <div class="form-group">
                                <label class="required">
                                    <?php echo ($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']); ?>
                                </label>
                                <?php echo ($this->Form->input('UsuarioResposta.'.$i.'.pergunta_id', array('type'=>'hidden','class' => 'form-control', 'value'=>$pergunta['Pergunta']['id']))); ?>
                                <?php echo ($this->Form->input('UsuarioResposta.'.$i.'.resposta_funcionario_id', array('class' => 'form-control','required'=>true,'empty' => 'Selecione uma graduação'))); ?>
                                <?php echo ($this->Form->input('UsuarioResposta.'.$i.'.avaliacao_id',array('type'=>'hidden','class' => 'form-control', 'value'=>$avaliacao))); ?>
                                <?php //echo ($this->Form->input('UsuarioResposta.'.$i.'.resposta_chefe_id', array('class' => 'form-control'))); ?>
                                <?php // echo $this->Form->input('UsuarioResposta.'.$i.'.justificativa_funcionario', array('type'=>'hidden','class' => 'form-control')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>