<div class="col-md-8">
    <div class="usuarios form">
        <?php echo $this->Session->flash(); ?>
        <legend>Editar Usuário</legend>
        <div class="panel panel-default" style="width: 700px">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="icon-leaf"></i>
                    <?php echo $usuario['Usuario']['nome']; ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Usuario', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    )
                )); ?>
                <?php echo $this->Form->input('id');?>
                <!--<div class="form-group">
                    <label>CPF:</label>
                    <?php /*echo $this->Form->input('cpf', array('class' => 'form-control erro min', 'disabled' => true)); */?>
                </div>
                <div class="form-group">
                    <label>Matricula:</label>
                    <?php /*echo $this->Form->input('matricula', array('class' => 'form-control erro min', 'disabled' => true)); */?>
                </div>-->
                <div class="form-group">
                    <label>Login:</label>
                    <?php echo $this->Form->input('username', array('class' => 'form-control erro min', 'disabled' => true));?>
                </div>
                <?php /*echo $this->Form->input('password', array('hidden'=>true)); */?>
                <div class="form-group">
                    <label class="required">Senha atual:</label>
                    <?php echo $this->Form->input('old_password', array('id' => 'old_password', 'type' => 'password', 'class' => 'form-control erro med', 'required' => true)); ?>
                </div>
                <div class="form-group">
                    <label class="required">Nova senha:</label>
                    <?php echo $this->Form->input('new_password', array('id' => 'new_password', 'type' => 'password', 'class' => 'form-control erro med', 'required' => true)); ?>
                </div>
                <div class="form-group">
                    <label class="required">Confirme a nova senha:</label>
                    <?php echo $this->Form->input('confirm_password', array('id' => 'confirm_password', 'type' => 'password', 'class' => 'form-control erro med', 'required' => true)); ?>
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
</div>