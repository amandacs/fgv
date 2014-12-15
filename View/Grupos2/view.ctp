<div class="_view">
    <h2><?php echo __('Grupo'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($grupos['Grupo']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Nome'); ?></dt>
        <dd>
            <?php echo h($grupos['Grupo']['nome']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Definição'); ?></dt>
        <dd>
            <?php echo h($grupos['Grupo']['observacao']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Competência'); ?></dt>
        <dd>
        <?php echo h($grupos['Competencia']['nome']); ?>
        &nbsp;
        </dd>
        <dt><?php echo __('Total de Perguntas'); ?></dt>
        <dd>
            <?php echo h($grupos['Grupo']['count']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link('<i class="fa fa-cogs fa-lg pull-right"></i> '.__('Listar Grupos'), array('action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-folder-open fa-lg pull-right"></i> '.__('Listar Avaliações'), array('controller'=>'action','action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-list fa-lg pull-right"></i> '.__('Listar Indicadores'), array('controller' => 'perguntas', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i> '.__('Listar Usuários'), array('controller' => 'usuarios', 'action' => 'index'), array('escape'=>false)); ?> </li>
    </ul>
</div>
<div class="related">
	<h3><?php echo __('Indicadores relacionados'); ?></h3>
	<?php if (!empty($grupos)): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Descrição'); ?></th>
		<th><?php echo __('Ordem'); ?></th>
		<th><?php echo __('Obrigatória'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($grupos['Pergunta'] as $pergunta): ?>
		<tr>
			<td><?php echo $pergunta['id']; ?>&nbsp;</td>
			<td><?php echo $pergunta['descricao']; ?>&nbsp;</td>
			<td><?php echo $pergunta['ordem']; ?>&nbsp;</td>
            <td><?php if($pergunta['obrigatoria'] == 1){
                echo ('sim');
            }else{
                echo ('não');
                }
                ?></td>
			<td class="actions">
                <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller' => 'perguntas', 'action' => 'edit', $pergunta['id']), array('title'=>'Editar','escape' => false)); ?>
                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller' => 'perguntas', 'action' => 'delete', $pergunta['id']), array('title'=>'Excluir','escape'=>false), __('Tem certeza que deseja excluir o indicador  #%s?', $pergunta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>