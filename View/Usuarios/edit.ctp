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
                <div class="form-group">
                    <label class="required">Nome:</label>
                    <?php echo $this->Form->input('nome', array('type' => 'text', 'class' => 'form-control max', 'required' => true)); ?>
                </div>
                <div class="form-group">
                    <label class="required">Matrícula:</label>
                    <?php echo $this->Form->input('matricula', array('id' => 'matricula', 'class' => 'form-control erro min', 'required' => true)); ?>
                </div>
                <?php if (!isset($this->request->data['Usuario']['matricula'])): ?>
                    <div class="form-group">
                        <label class="required">CPF:</label>
                        <?php echo $this->Form->input('cpf', array('id' => 'cpf', 'class' => 'form-control erro min cpf', 'required' => true)); ?>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label>CPF:</label>
                        <?php echo $this->Form->input('cpf', array('id' => 'cpf', 'class' => 'form-control erro min cpf')); ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label class="required">Email:</label>
                    <?php echo $this->Form->input('email', array('type'=>'email','class' => 'form-control erro med', 'required' => true)); ?>
                </div>
                <div class="form-group">
                    <label class="required">Login:</label>
                    <?php echo $this->Form->input('username', array('id' => 'username', 'class' => 'form-control erro min', 'required' => true)); ?>
                </div>
                <div class="form-group">
                    <label class="required">Organização:</label>
                    <?php echo $this->Form->input('organizacao_id', array('class' => 'form-control max', 'required' => true, 'empty'=>'Selecione a organização do usuário...'));?>
                </div>
                <div class="form-group">
                    <label class="required">Perfil:</label>
                    <?php echo $this->Form->input('perfil_id', array('class' => 'form-control med', 'required' => true, 'empty'=>'Selecione o perfil do usuário...')); ?>
                </div>
                <div>
                    <label class="required">Cargo:</label>
                    <?php echo $this->Form->input('cargo_id', array('type' => 'select', 'options' => $cargos, 'id' => 'cargos', 'class' => 'form-control max', 'required' => true, 'empty'=>'Selecione o cargo do usuário...')); ?>
                </div>
                <div class="form-group">
                    <label class="required" style="margin-top: 10px;">Classe:</label>
                    <?php echo $this->Form->input('classe_id', array('type' => 'select', 'class' => 'form-control max', 'id' => 'classes', 'required' => true, 'empty'=>'Selecione  o cargo do usuário...')); ?>
                </div>
                <div class="form-group">
                    <label class="required">Função:</label>
                    <?php echo $this->Form->input('funcao_id', array('type' => 'select', 'id' => 'funcoes', 'class' => 'form-control max', 'required' => true, 'empty'=>'Selecione o cargo do usuário...')); ?>
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
<?php $this->start('script'); ?>
<?php echo $this->Html->script('views/usuarios/listar_classes.js'); ?>
<?php echo $this->Html->script('views/usuarios/listar_funcoes.js'); ?>
<?php echo $this->Html->script('default'); ?>
<?php $this->end(); ?>