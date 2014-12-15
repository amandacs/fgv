<div class="perfis form">
<?php echo $this->Form->create('Perfi'); ?>
	<fieldset>
		<legend><?php echo __('Add Perfi'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('sort');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Perfis'), array('action' => 'index')); ?></li>
	</ul>
</div>
