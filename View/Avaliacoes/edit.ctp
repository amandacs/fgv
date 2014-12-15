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
            <legend><?php echo __('Editar Avaliação'); ?></legend>
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <label class="required">Descrição:</label>
                <?php echo $this->Form->input('descricao', array('type' => 'text', 'class' => 'form-control uppercase max', 'required' => true, 'autofocus')); ?>
            </div>
            <div class="form-group">
                <label class="required">Prazo Avaliado:</label>
                <?php $dataFormatada = $this->Time->format('d/m/Y', $this->request->data['Avaliacao']['prazo']) ?>
                <?php echo $this->Form->input('prazo', array('type'=>'text', 'class' => 'form-control erro med date', 'required' => true, 'value' => $dataFormatada, 'readOnly'=>true)); ?>
            </div>
            <!--<div class="form-group">
                <label class="required">Hora Final Avaliado:</label>
                <?php /*echo $this->Form->input('hora_avaliado', array('type'=>'text', 'class' => 'form-control erro med time', 'required' => true)); */?>
            </div>-->
            <div class="form-group">
                <label class="required">Prazo Avaliador:</label>
                <?php $dataFormatada = $this->Time->format('d/m/Y', $this->request->data['Avaliacao']['prazo_avaliador']) ?>
                <?php echo $this->Form->input('prazo_avaliador', array('type'=>'text', 'class' => 'form-control erro med date', 'required' => true, 'value' => $dataFormatada, 'readOnly'=>true)); ?>
            </div>
            <!--<div class="form-group">
                <label class="required">Hora Final Avaliador:</label>
                <?php /*echo $this->Form->input('hora_avaliador', array('type'=>'text', 'class' => 'form-control erro med time', 'required' => true)); */?>
            </div>-->
        </fieldset>
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
<?php $this->end(); ?>