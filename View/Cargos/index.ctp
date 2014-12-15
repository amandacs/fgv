<div class="cargos index">
    <div class="navbar col-md-12">
        <legend><b>Cargos</b></legend>
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Cargo', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Classes', array('controller' => 'classes', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?><!--
            --><?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Classe', array('controller' => 'classes','action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>

        </div>
    </div>


    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>

            <?php $ids = array(); ?>

            <?php foreach ($cargos as $cargo): ?>
                <tr>
                    <td><?php echo h($cargo['Cargo']['nome']); ?>&nbsp;</td>

                    <td class="actions col-lg-1">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i>', array('action' => 'view', $cargo['Cargo']['id']), array('title'=>'Visualizar', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('action' => 'edit', $cargo['Cargo']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $cargo['Cargo']['id']), array('title'=>'Excluir','escape' => false), __('Tem certeza que deseja ecluir o cargo  #%s?', $cargo['Cargo']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | Total de cargos: {:count} ')
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