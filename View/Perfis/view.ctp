<div class="perfis view">
<h2><?php echo __('Perfi'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($perfi['Perfi']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($perfi['Perfi']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort'); ?></dt>
		<dd>
			<?php echo h($perfi['Perfi']['sort']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Perfi'), array('action' => 'edit', $perfi['Perfi']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Perfi'), array('action' => 'delete', $perfi['Perfi']['id']), array(), __('Are you sure you want to delete # %s?', $perfi['Perfi']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Perfis'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perfi'), array('action' => 'add')); ?> </li>
	</ul>
</div>
