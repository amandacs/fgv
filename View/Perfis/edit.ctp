<div class="col-md-8">
    <div class="perfis form">
        <?php
        echo $this->Form->create('Perfi', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>
            <legend>Editar Perfil</legend>
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <label class="required">Nome:</label>
                <?php echo $this->Form->input('nome', array('class' => 'form-control  uppercase max', 'required' => true, 'autofocus')); ?>
            </div>

        </fieldset>
        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
