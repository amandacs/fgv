<div class="col-md-8">
    <div class="perguntas form">
        <?php echo $this->Form->create('Pergunta', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        )); ?>
        <fieldset>
            <legend><?php echo __('Editar Indicador'); ?></legend>
            <?php echo $this->Form->input('id');?>

            <?php echo $this->Session->flash(); ?>
            <div class="form-group">
                <label class="required">Avaliação:</label>
                <?php echo $this->Form->input('avaliacao_id', array('class' => 'form-control', 'required' => true, 'autofocus', 'empty' => 'Selecione a avaliação relacionada a este indicador...'));?>
            </div>
            <div class="form-group">
                <label class="required">Grupo:</label>
                <?php echo $this->Form->input('grupo_id', array('class' => 'form-control', 'required' => true, 'empty' => 'Selecione o grupo relacionado a este indicador...'));?>
            </div>
            <div class="form-group">
                <label class="required">Indicador:</label>
                <?php echo $this->Form->input('descricao', array('class' => 'form-control', 'required' => true, 'rows'));?>
            </div>
            <div class="checkbox">
                <label><?php echo $this->Form->input('obrigatoria');?> Obrigatório?</label>
            </div>
            <div class="form-group"  style="margin-top: 10px">
                <label>Observação:</label>
                <?php echo $this->Form->input('observacao', array('class' => 'form-control', 'rows'=>2));?>
            </div>
        </fieldset>
        <p class="pull-left" style="margin-top: 10px">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>