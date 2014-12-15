<?php $grupos = array(); ?>
<?php foreach ($perguntas as $perg): ?>
    <?php array_push($grupos, $perg['Grupo']['nome']); ?>
<?php endforeach; ?>
<?php $grupos = array_unique($grupos); ?>
<div class="respostas view" style="border-left: none; margin-top: 30px; float: left">
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
        <legend style="color: red">Todas as questões são de preenchimento obrigatório.</legend>
        <?php if($grupos == 0)?>
        <?php foreach ($grupos as $grupo):?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-leaf" style="font-weight: bold"></i>
                        <?php echo $grupo; ?>
                    </h3>
                </div>
            </div>
            <div class="panel-body">
                <?php foreach ($perguntas as $i=>$pergunta): ?>
                    <div class="col-md-14">
                        <?php if (($pergunta['Grupo']['nome'] == $grupo)): ?>
                            <div class="form-group">
                                <label >
                                    <?php echo ($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']);?>
                                </label>
                                <?php echo ($this->Form->input('UsuarioResposta.'.$i.'.pergunta_id', array('type'=>'hidden','class' => 'form-control', 'value'=>$pergunta['Pergunta']['id']))); ?>
                                <select name="data[UsuarioResposta][<?=$i;?>][resposta_avaliador_id]" id="UsuarioResposta<?=$i;?>RespostaAvaliadorId" style="width: 600px; height: 25px">
                                    <option value="">Selecione uma graduação</option>
                                    <?php foreach($pergunta['Grau'] as $c=>$grau):?>
                                        <option value=<?=$grau['id']?>><?php echo $grau['grau_indicador'].' - '.$grau['nome'];?></option>
                                    <?php endforeach?>
                                </select>
                                <?php /*echo ($this->Form->input('UsuarioResposta.'.$i.'.usuario_avaliacao_id',array('type'=>'hidden','class' => 'form-control', 'value'=>$usuarioAvaliacoes))); */?>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php $i++; ?>
        <?php endforeach; ?>
        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>