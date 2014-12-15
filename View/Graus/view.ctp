
<div class="_view">
<h2><?php echo __('Grau'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($grau['Grau']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($grau['Grau']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Indicador'); ?></dt>
		<dd>
			<?php echo h($grau['Pergunta']['descricao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ordem'); ?></dt>
		<dd>
			<?php echo h($grau['Grau']['grau_indicador']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link('<i class="fa fa-sort-numeric-asc fa-lg pull-right"></i> '.__('Listar Graus'), array('action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-folder-open fa-lg pull-right"></i> '.__('Listar Avaliações'), array('controller'=>'avaliacoes','action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-cogs fa-lg pull-right"></i> '.__('Listar Grupos'), array('controller'=>'grupos', 'action' => 'index'), array('escape'=>false)); ?> </li> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-list fa-lg pull-right"></i> '.__('Listar Indicadores'), array('controller' => 'perguntas', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i> '.__('Listar Usuários'), array('controller' => 'usuarios', 'action' => 'index'), array('escape'=>false)); ?> </li>
	</ul>
</div>
<div class="related">
</div>
