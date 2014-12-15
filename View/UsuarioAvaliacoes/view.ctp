<div class="_view">
<h2><?php echo __('Avaliação de Usuário'); ?></h2>
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
	<!--<h3><?php /*echo __('Questionários relacionados'); */?></h3>
	<?php /*if (!empty($avaliacao['Questionario'])): */?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php /*echo __('Id'); */?></th>
		<th><?php /*echo __('Id Avalição'); */?></th>
		<th><?php /*echo __('Id Pergunta'); */?></th>
		<th><?php /*// echo __('UsuarioResposta Avaliado Id'); */?></th>
		<th><?php /*echo __('UsuarioResposta Chefe Id'); */?></th>
		<th><?php /*echo __('Justificativa Avaliador'); */?></th>
		<th class="actions"><?php /*echo __('Actions'); */?></th>
	</tr>
	<?php /*foreach ($avaliacao['Questionario'] as $questionario): */?>
		<tr>
			<td><?php /*echo $questionario['id']; */?></td>
			<td><?php /*echo $questionario['avaliacao_id']; */?></td>
			<td><?php /*echo $questionario['pergunta_id']; */?></td>
			<td><?php /*// echo $questionario['resposta_funcionario_id']; */?></td>
			<td><?php /*echo $questionario['resposta_chefe_id']; */?></td>
			<td><?php /*echo $questionario['justificativa_funcionario']; */?></td>
			<td class="actions">
                <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller' => 'questionarios', 'action' => 'edit', $questionario['id']), array('title'=>'Editar','escape' => false)); */?>
                <?php /*echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller' => 'questionarios', 'action' => 'delete', $questionario['id']), array('title'=>'Excluir','escape'=>false), __('Are you sure you want to delete # %s?', $questionario['id'])); */?>
			</td>
		</tr>
	<?php /*endforeach; */?>
	</table>
--><?php /*endif; */?>
</div>
