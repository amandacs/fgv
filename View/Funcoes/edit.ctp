<div class="col-md-8">
    <div class="funcoes form">
        <?php
        echo $this->Form->create('Funcao', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>
            <legend><?php echo __('Editar Função'); ?></legend>
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <label class="required">Função:</label>
                <?php echo $this->Form->input('nome', array('class' => 'form-control uppercase big', 'required' => true, 'autofocus')); ?>
            </div>
            <div class="form-group">
                <label class="required">Cargo:</label>
                <?php echo $this->Form->input('cargo_id', array('class' => 'form-control', 'empty'=>'Selecione o cargo da função acima...')); ?>
            </div>
        </fieldset>
        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>