<div class="organizacoes view">
<h2><?php echo __('Organizacão'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($organizacao['Organizacao']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($organizacao['Organizacao']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent'); ?></dt>
		<dd>
			<?php echo h($organizacao['ParentOrganizacao']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Array'); ?></dt>
		<dd>
			<?php echo h($organizacao['Organizacao']['parent_array']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Responsável'); ?></dt>
		<dd>
			<?php echo h($organizacao['Organizacao']['responsavel']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link('<i class="fa fa-sitemap fa-lg pull-right"></i> '.__('Listar Organizações'), array('controller' => 'organizacoes', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-folder-open fa-lg pull-right"></i> '.__('Listar Avaliações'), array('controller'=>'avaliacoes','action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-list fa-lg pull-right"></i> '.__('Listar Indicadores'), array('controller' => 'perguntas', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i> '.__('Listar Usuários'), array('controller' => 'usuarios', 'action' => 'index'), array('escape'=>false)); ?> </li>
	</ul>
</div>
<div class="related">
	<?php if (!empty($organizacao['ChildOrganizacao'])): ?>
        <h3><?php echo __('Organizações relacionadas'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Id Parent'); ?></th>
		<th><?php echo __('Parent Array'); ?></th>
		<th><?php echo __('Id Chefe'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizacao['ChildOrganizacao'] as $childOrganizacao): ?>
		<tr>
			<td><?php echo $childOrganizacao['id']; ?></td>
			<td><?php echo $childOrganizacao['nome']; ?></td>
			<td><?php echo $childOrganizacao['parent_id']; ?></td>
			<td><?php echo $childOrganizacao['parent_array']; ?></td>
			<td><?php echo $childOrganizacao['chefe_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'organizacoes', 'action' => 'edit', $childOrganizacao['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'organizacoes', 'action' => 'delete', $childOrganizacao['id']), array(), __('Are you sure you want to delete # %s?', $childOrganizacao['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<div class="related">
	<h3><?php echo __('Usuários relacionados'); ?></h3>
	<?php if (!empty($organizacao['Usuario'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Cpf'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Matricula'); ?></th>
		<th><?php echo __('Id Organização'); ?></th>
		<th><?php echo __('Id Cargo'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($organizacao['Usuario'] as $usuario): ?>
		<tr>
			<td><?php echo $usuario['id']; ?></td>
			<td><?php echo $usuario['cpf']; ?></td>
			<td><?php echo $usuario['nome']; ?></td>
			<td><?php echo $usuario['email']; ?></td>
			<td><?php echo $usuario['matricula']; ?></td>
			<td><?php echo $usuario['organizacao_id']; ?></td>
			<td><?php echo $usuario['cargo_id']; ?></td>
			<td><?php echo $usuario['username']; ?></td>
			<td class="actions">
                <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller' => 'usuarios', 'action' => 'edit', $usuario['id']), array('title'=>'Editar','escape' => false)); ?>
                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller' => 'usuarios', 'action' => 'delete', $usuario['id']), array('title'=>'Excluir','escape'=>false), __('Are you sure you want to delete # %s?', $usuario['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
