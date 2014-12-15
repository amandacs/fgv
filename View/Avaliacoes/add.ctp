<link rel="stylesheet" type="text/css" href="/fgv/css/jquery-ui.css">
<div class="col-md-8">
    <div class="avaliacoes form">
        <?php
        echo $this->Form->create('Avaliacao', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>
            <legend>Adicionar Avavliação</legend>

            <div class="form-group">
                <label class="required">Descrição:</label>
                <?php echo $this->Form->input('descricao', array('type' => 'text', 'class' => 'form-control uppercase max', 'required' => true, 'autofocus')); ?>
            </div>
            <div class="form-group">
                <label class="required">Prazo Avaliado:</label>
                <?php echo $this->Form->input('prazo', array('type'=>'text', 'class' => 'form-control erro med date', 'required' => true, 'readOnly'=>true)); ?>
            </div>
            <div class="form-group">
                <label class="required">Prazo Avaliador:</label>
                <?php echo $this->Form->input('prazo_avaliador', array('type'=>'text', 'class' => 'form-control erro med date', 'required' => true, 'readOnly'=>true)); ?>
            </div>
            <!--<div class="form-group">
                <label class="required">Descrição:</label>
                <?php /*echo $this->Form->input('descricao', array('type' => 'text', 'class' => 'form-control', 'required' => true)); */?>
            </div>
            <div class="form-group">
                <label class="required">Prazo Avaliado:</label>
                <?php /*echo $this->Form->input('prazo', array('type'=>'text', 'class' => 'form-control erro med date', 'required' => true)); */?>
            </div>
            <div class="form-group">
                <label class="required">Prazo Avaliador:</label>
                <?php /*echo $this->Form->input('prazo_avaliador', array('type'=>'text', 'class' => 'form-control erro med date', 'required' => true)); */?>
            </div>   -->
        </fieldset>

        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<?php $this->start('script');?>
<?php echo $this->Html->script('jquery-ui.js'); ?>
<?php echo $this->Html->script('jquery-ui.min.js'); ?>
<?php echo $this->Html->script('default'); ?>
<?php $this->end();?>