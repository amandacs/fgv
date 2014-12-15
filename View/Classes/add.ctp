<div class="col-md-8">
    <div class="classes form">
        <?php
        echo $this->Form->create('Classe', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>

            <legend>Adicionar Classe</legend>

            <div class="form-group">
                <label class="required">Nome:</label>
                <?php echo $this->Form->input('nome', array('type' => 'text', 'class' => 'form-control uppercase max', 'required' => true, 'autofocus')); ?>
            </div>
            <div class="form-group">
                <label class="required">Cargo:</label>
                <?php echo $this->Form->input('cargo_id', array('class' => 'form-control uppercase', 'required' => true, 'empty'=>'Selecione o cargo da classe acima...')); ?>
            </div>
        </fieldset>

        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>