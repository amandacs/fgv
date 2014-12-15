<div class="row">
    <div class="col-md-8">
        <div class="grupos form">
            <?php echo $this->Form->create('Grupo', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false
                )
            )); ?>
            <fieldset>
                <legend><?php echo 'Adicionanar Grupo'; ?></legend>

                <?php echo $this->Session->flash(); ?>

                <div class="form-group">
                    <label class="required">Nome:</label>
                    <?php echo $this->Form->input('nome', array('class' => 'form-control', 'required' => true));?>
                </div>
                <!--<div class="form-group">
                    <label class="required">Ordem:</label>
                    <?php /*echo $this->Form->input('ordem', array('class' => 'form-control', 'required' => true));*/?>
                </div>-->
                <div class="form-group">
                    <label>Definição:</label>
                    <?php echo $this->Form->input('observacao', array('class' => 'form-control'));?>
                </div>
                <!--<div class="form-group">
                    <label>Count:</label>
                    <?php /*echo $this->Form->input('count', array('class' => 'form-control'));*/?>
                </div>-->
                <div class="form-group">
                    <label class="required">Competência:</label>
                    <?php echo $this->Form->input('competencia_id', array('class' => 'form-control','required'=>true, 'empty' => 'Selecione uma competência para este grupo...'));?>
                </div>

            </fieldset>
            <p class="pull-left">
                <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
                <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
            </p>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>