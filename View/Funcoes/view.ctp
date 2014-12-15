<div class="_view">
<h2><?php echo __('Função'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($funcoes['Funcao']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($funcoes['Funcao']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cargo'); ?></dt>
		<dd>
			<?php echo h($funcoes['Cargo']['nome']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link('<i class="fa fa-arrows-alt fa-lg pull-right"></i> '.__('Listar Funções'), array('action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-folder-open fa-lg pull-right"></i> '.__('Listar Avaliações'), array('controller'=>'avaliacoes','action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-cogs fa-lg pull-right"></i> '.__('Listar Grupos'), array('controller'=>'grupos', 'action' => 'index'), array('escape'=>false)); ?> </li> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-list fa-lg pull-right"></i> '.__('Listar Indicadores'), array('controller' => 'perguntas', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i> '.__('Listar Usuários'), array('controller' => 'usuarios', 'action' => 'index'), array('escape'=>false)); ?> </li>
    </ul>
</div>
<div class="related">
	<h3><?php echo __('Usuários relacionados'); ?></h3>
	<?php if (!empty($funcoes)): ?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('Nome'); ?></th>
        <th><?php echo __('Matricula'); ?></th>
        <th><?php echo __('CPF'); ?></th>
        <th><?php echo __('Email'); ?></th>
        <!--<th><?php /*echo __('Organização Id'); */?></th>
		<th><?php /*echo __('Cargo'); */?></th>-->
        <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($funcoes['Usuario'] as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id']; ?>&nbsp;</td>
                <td><?php echo $usuario['nome']; ?>&nbsp;</td>
                <td><?php echo $usuario['matricula']; ?>&nbsp;</td>
                <td><?php echo $usuario['cpf']; ?>&nbsp;</td>
                <td><?php echo $usuario['email']; ?>&nbsp;</td>
                <!--<td><?php /*echo $usuario['organizacao_id']; */?>&nbsp;</td>
			<td><?php /*echo $cargos['Cargo']['nome']; */?>&nbsp;</td>-->
                <td class="actions">
                    <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller'=>'usuarios', 'action' => 'edit', $usuario['id']), array('title'=>'Editar','escape' => false)); ?>
                    <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller'=>'usuarios', 'action' => 'delete', $usuario['id']), array('title'=>'Excluir','escape'=>false), __('Tem certeza que deseja excluir o usuário  #%s?', $usuario['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>
