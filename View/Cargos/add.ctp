<div class="col-md-8">
    <div class="cargos form">
        <?php
        echo $this->Form->create('Cargo', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>
            <legend>Adicionar Cargo</legend>
            <div class="form-group">
                <label class="required">Nome:</label>
                <?php echo $this->Form->input('nome', array('type' => 'text', 'class' => 'form-control uppercase med', 'required' => true, 'autofocus')); ?>
            </div>
        </fieldset>

        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>