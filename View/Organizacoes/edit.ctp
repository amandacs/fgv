<div class="processos main form">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Editando Organização
                </h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Organizacao', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'role' => "form"
                    )
                )); ?>

                <fieldset>
                    <?php echo $this->Form->input('id');?>
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="required">Nome:</label>
                            <?php echo $this->Form->input('nome', array('class' => 'form-control uppercase', 'required' => true, 'autofocus')); ?>
                        </div>
                        <div class="col-sm-6">
                            <label>Sigla:</label>
                            <?php echo $this->Form->input('acronimo', array('class' => 'form-control uppercase')); ?>
                        </div>
                        <div class="col-sm-6">
                            <label>Telefone:</label>
                            <?php echo $this->Form->input('telefone', array('class' => 'telefone form-control')); ?>
                        </div>
                        <div class="col-sm-6">
                            <label>Ramal:</label>
                            <?php echo $this->Form->input('ramal', array('class' => 'form-control')); ?>
                        </div>
                    </div>
                </fieldset>
                <div class="pull-left" style="margin-top: 20px">
                    <div class="control-group">
                        <?php echo $this->Form->button('<i class="icon-save icon-large"></i> <b>Salvar</b>', array('type'=>'submit', 'class'=>'btn btn-success', 'escape'=>false)); ?>
                        <?php echo $this->Html->link(__('Cancelar'), array('action' => 'index'), array('class'=>'btn btn-default')); ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>
