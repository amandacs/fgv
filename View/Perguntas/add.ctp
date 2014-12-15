<div class="col-md-8">
    <div class="perguntas form">
        <?php echo $this->Form->create('Pergunta', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        )); ?>
        <fieldset>
            <legend>Adicionar Indicador</legend>
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
                <?php echo $this->Form->input('descricao', array('class' => 'form-control', 'required' => true));?>
            </div>

            <div class="checkbox">
                <label><?php echo $this->Form->input('obrigatoria');?> Obrigatório?</label>
            </div>
            <!--<label style="margin: 20px 0 0 0">Classes:</label>
            <div id="perg_box">
                <?php /*echo $this->Form->input('classe_array', array('type'=>'select', 'options'=>$classes, 'multiple'=>'checkbox', 'class'=>'perg_box'));*/?>
            </div>
            <label style="margin: 20px 0 0 0">Funções:</label>
            <div>
                <?php /*echo $this->Form->input('funcao_id', array('class' => 'form-control', 'required' => true, 'empty' => 'Selecione a função relacionanda a este indicador...'));*/?>
            </div>-->
        </fieldset>
        <p class="pull-left" style="margin-top: 10px">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>