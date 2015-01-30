<div class="_view">
<h2><?php echo __('Avaliação'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($avaliacao['UsuarioAvaliacao']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data Avaliação'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('d/m/Y \à\s H:m:s', $avaliacao['UsuarioAvaliacao']['data_avaliacao'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Avaliado'); ?></dt>
		<dd>
			<?php echo h($avaliacao['Avaliado']['nome']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Função Avaliado'); ?></dt>
        <dd>
            <?php echo h($avaliacao['FuncaoAvaliado']['nome']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Classe Avaliado'); ?></dt>
        <dd>
            <?php echo h($avaliacao['ClasseAvaliado']['nome']); ?>
            &nbsp;
        </dd>
		<dt><?php echo __('Avaliador'); ?></dt>
		<dd>
			<?php echo h($avaliacao['Avaliador']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pontos Fortes'); ?></dt>
		<dd>
			<?php echo h($avaliacao['UsuarioAvaliacao']['pontos_fortes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pontos Fracos'); ?></dt>
		<dd>
			<?php echo h($avaliacao['UsuarioAvaliacao']['pontos_fracos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comentário Avaliado'); ?></dt>
        <dd>
        <?php echo h($avaliacao['UsuarioAvaliacao']['comentario_avaliado']); ?>
        &nbsp;
        </dd>
        <dt><?php echo __('Comentário Avaliador'); ?></dt>
        <dd>
            <?php echo h($avaliacao['UsuarioAvaliacao']['comentario_avaliador']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Plano de Ação'); ?></dt>
        <dd>
			<?php echo h($avaliacao['UsuarioAvaliacao']['plano_acao']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link('<i class="fa fa-folder-open fa-lg pull-right"></i> '.__('Listar Avaliações'), array('action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-cogs fa-lg pull-right"></i> '.__('Listar Grupos'), array('controller'=>'grupos', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-list fa-lg pull-right"></i> '.__('Listar Indicadores'), array('controller' => 'perguntas', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i> '.__('Listar Usuários'), array('controller' => 'usuarios', 'action' => 'index'), array('escape'=>false)); ?> </li>
	</ul>
</div>
<div class="related">
</div>