<div class="classes index">
    <div class="navbar col-md-12">
        <legend><b>Classes</b></legend>
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Classe', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Cargos', array('controller' => 'cargos', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Cargo', array('controller' => 'cargos','action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?><!--
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Indicadores', array('controller' => 'indicares', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            --><?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Indicador', array('controller' => 'perguntas','action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>


        </div>
    </div>

    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Ações</th>
            </tr>

            <?php $ids = array(); ?>

            <?php foreach ($classes as $classe): ?>
                <tr>
                    <td><?php echo h($classe['Classe']['nome']); ?>&nbsp;</td>
                    <td><?php echo h($classe['Cargo']['nome']); ?>&nbsp;</td>

                    <td class="actions col-lg-1">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i>', array('action' => 'view', $classe['Classe']['id']), array('title'=>'Visualizar', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('action' => 'edit', $classe['Classe']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $classe['Classe']['id']), array('title'=>'Excluir','escape' => false), __('Tem certeza que deseja excluir a classe %s?', $classe['Classe']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | Total de classes: {:count} ')
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

