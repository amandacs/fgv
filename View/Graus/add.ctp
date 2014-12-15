<div class="col-md-8">
    <div class="graus form">
        <?php
        echo $this->Form->create('Grau', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>

                <legend>Adicionar Grau</legend>

            <div class="form-group">
                <label class="required">Nome:</label>
                <?php echo $this->Form->input('nome', array('type' => 'text', 'class' => 'form-control', 'required' => true)); ?>
            </div>
            <div class="form-group" style="display: none">
                <label class="required">Indicador:</label>
                <?php echo $this->Form->input('pergunta_id', array('class' => 'form-control uppercase', 'required' => true)); ?>
            </div>

<!--            <div class="form-group">-->
<!--                <label class="required">HTML</label>-->
<!--                --><?php //echo $this->Form->input('html_select_option_mode', array('class' => 'form-control', 'required' => true)); ?>
<!--            </div>-->
            <div class="form-group">
                <label class="required">Ordem:</label>
                <?php echo $this->Form->input('ordem', array('class' => 'form-control', 'required' => true)); ?>
            </div>
        </fieldset>

        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

