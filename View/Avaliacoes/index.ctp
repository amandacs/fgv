<div class="avaliacoes index">
    <div class="navbar col-md-12">
        <legend><b>Avaliações</b></legend>
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Avaliação', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Classes', array('controller' => 'classes', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?><!--
            --><?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Classe', array('controller' => 'classes','action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>


        </div>
    </div>

    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Prazo do avaliado</th>
                <th>Prazo do avaliador</th>
                <th>Ações</th>
            </tr>

            <?php $ids = array(); ?>

            <?php foreach ($avaliacoes as $avaliacao): ?>
                <tr>
                    <td><?php echo h($avaliacao['Avaliacao']['id']); ?>&nbsp;</td>
                    <td><?php echo h($avaliacao['Avaliacao']['descricao']); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format(h($avaliacao['Avaliacao']['prazo']), '%d/%m/%Y'); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format(h($avaliacao['Avaliacao']['prazo_avaliador']), '%d/%m/%Y'); ?>&nbsp;</td>

                    <td class="actions col-lg-1">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i>', array('action' => 'view', $avaliacao['Avaliacao']['id']), array('title'=>'Visualizar', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('action' => 'edit',  $avaliacao['Avaliacao']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete',  $avaliacao['Avaliacao']['id']), array('title'=>'Excluir','escape' => false), __('tem certeza que deseja excluir a avaliação #%s?',  $avaliacao['Avaliacao']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | Total de avaliações: {:count} ')
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
