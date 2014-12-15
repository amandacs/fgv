<div class="grupos index row">
    <div class="navbar col-md-12">
        <legend><b>Grupo de Competências</b></legend>
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Grupo', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
        </div>
    </div>

    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Nome</th>
                <th>Ordem</th>
                <th>Observação</th>
                <th>Competência</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($grupos as $grupo): ?>
                <tr>
                    <td style="text-align: left"><strong><?php echo h($grupo['Grupo']['nome']); ?></strong>&nbsp;</td>
                    <td><?php echo h($grupo['Grupo']['ordem']); ?>&nbsp;</td>
                    <td style="text-align: left"><?php echo h($grupo['Grupo']['observacao']); ?>&nbsp;</td>
                    <td><?php echo h($grupo['Grupo']['competencia_id']); ?>&nbsp;</td>
                    <td class="actions col-lg-1">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i>', array('controller'=>'grupos', 'action' => 'view', $grupo['Grupo']['id']), array('title'=>'Visualizar', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller'=>'grupos', 'action' => 'edit', $grupo['Grupo']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller'=>'grupos', 'action' => 'delete', $grupo['Grupo']['id']), array('title'=>'Excluir','escape' => false), __('tem certeza que deseja excluir o grupo  #%s?', $grupo['Grupo']['ordem'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | Total de grupos: {:count} ')
                ));
                ?>
            </p>

            <div class="pull-right" style="margin-top: -20px">
                <ul class="pagination">
                    <li> <?php echo $this->Paginator->prev('« ' . __('Anterior'), array(), null, array('class' => 'prev disabled')); ?> </li>
                    <li> <?php echo $this->Paginator->numbers(array('separator' => '')); ?> </li>
                    <li> <?php echo $this->Paginator->next(__('Próxima') . ' »', array(), null, array('class' => 'next disabled')); ?> </li>
                </ul>
            </div>
        </div>
    </div>
</div>


