<div class="_view">
    <h2><?php echo __('Avaliação'); ?></h2>
        <dl>
            <dt><?php echo __('Id'); ?></dt>
            <dd>
                <?php echo h($avaliacoes['Avaliacao']['id']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Descrição'); ?></dt>
            <dd>
                <?php echo h($avaliacoes['Avaliacao']['descricao']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Prazo Avaliado'); ?></dt>
            <dd>
                <?php echo h($avaliacoes['Avaliacao']['prazo']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Prazo Avaliador'); ?></dt>
            <dd>
                <?php echo h($avaliacoes['Avaliacao']['prazo_avaliador']); ?>
                &nbsp;
            </dd>
        </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link('<i class="fa fa-folder-open fa-lg pull-right"></i> '.__('Listar Avaliações'), array('action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-cogs fa-lg pull-right"></i> '.__('Listar Grupos'), array('controller'=>'grupos', 'action' => 'index'), array('escape'=>false)); ?> </li> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-list fa-lg pull-right"></i> '.__('Listar Indicadores'), array('controller' => 'perguntas', 'action' => 'index'), array('escape'=>false)); ?> </li>
        <li><?php echo $this->Html->link('<i class="fa fa-users fa-lg pull-right"></i> '.__('Listar Usuários'), array('controller' => 'usuarios', 'action' => 'index'), array('escape'=>false)); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Indicadores Relacionados'); ?></h3>
    <?php if (!empty($avaliacoes)): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Descrição'); ?></th>
                <th><?php echo __('Ordem'); ?></th>
                <th><?php echo __('Grupo id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($avaliacoes['Pergunta'] as $pergunta): ?>
                <tr>
                    <td><?php echo $pergunta['id']; ?>&nbsp;</td>
                    <td><?php echo $pergunta['descricao']; ?>&nbsp;</td>
                    <td><?php echo $pergunta['ordem']; ?>&nbsp;</td>
                    <td><?php echo $pergunta['grupo_id']; ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller' => 'perguntas', 'action' => 'edit', $pergunta['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller' => 'perguntas', 'action' => 'delete', $pergunta['id']), array('title'=>'Excluir','escape'=>false), __('Tem certeza que deseja excluir o indicador  #%s?', $pergunta['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <!--<h3><?php /*echo __('Indicadores Relacionados'); */?></h3>
    <?php /*if (empty($pergunta)): */?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php /*echo __('Id'); */?></th>
                <th><?php /*echo __('Descrição'); */?></th>
                <th><?php /*echo __('Ordem'); */?></th>
                <th><?php /*echo __('Grupo'); */?></th>
                <th class="actions"><?php /*echo __('Actions'); */?></th>
            </tr>
            <?php /*foreach ($perguntas as $pergunta): */?>
                <tr>
                    <td><?php /*echo $pergunta['Pergunta']['id']; */?>&nbsp;</td>
                    <td><?php /*echo $pergunta['Pergunta']['descricao']; */?>&nbsp;</td>
                    <td><?php /*echo $pergunta['Pergunta']['ordem']; */?>&nbsp;</td>
                    <td><?php /*echo $pergunta['Grupo']['nome']; */?>&nbsp;</td>
                    <td class="actions">
                        <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller' => 'perguntas', 'action' => 'edit', $pergunta['Pergunta']['id']), array('title'=>'Editar','escape' => false)); */?>
                        <?php /*echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller' => 'perguntas', 'action' => 'delete', $pergunta['Pergunta']['id']), array('title'=>'Excluir','escape'=>false), __('Tem certeza que deseja deletar a perhuinta # %s?', $pergunta['Pergunta']['id'])); */?>
                    </td>
                </tr>
            <?php /*endforeach; */?>
        </table>
    --><?php /*endif; */?>
</div>