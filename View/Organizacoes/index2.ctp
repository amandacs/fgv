<div class="organizacoes index">
    <div class="navbar col-md-12">
        <legend><b>Organizações</b></legend>
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Organização', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Usuários', array('controller' => 'usuarios', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?><!--
            --><?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Usuário', array('controller' => 'usuarios','action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>

        </div>
    </div>

    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Organização</th>
                <!--<th>Parent </th>
                <th>Parent Array </th>-->
                <!--<th>Responsavel</th>-->
                <th>Ações</th>
            </tr>

            <?php $ids = array(); ?>

            <?php foreach ($organizacoes as $organizacao): ?>
                <tr>
                    <td style="text-align: left"><?php echo h($organizacao['Organizacao']['nome']); ?>&nbsp;</td>
                    <!--<td>
                        <?php /*echo $this->Html->link($organizacao['ParentOrganizacao']['id'], array('controller' => 'organizacoes', 'action' => 'view', $organizacao['ParentOrganizacao']['id'])); */?>
                    </td>
                    <td><?php /*echo h($organizacao['Organizacao']['parent_array']); */?>&nbsp;</td>-->
<!--                    <td>-->
<!--                        --><?php //echo $this->Html->link($organizacao['Organizacao']['responsavel']/*, array('controller' => 'usuarios', 'action' => 'view', $organizacao['Chefe']['id'])*/); ?>
<!--                    </td>-->

                    <td class="actions col-lg-1">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i>', array('action' => 'view', $organizacao['Organizacao']['id']), array('data-toggle'=>'modal', 'data-target'=>'#modal','title'=>'Visualizar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('action' => 'edit', $organizacao['Organizacao']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $organizacao['Organizacao']['id']), array('title'=>'Excluir','escape' => false), __('Are you sure you want to delete # %s?', $organizacao['Organizacao']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | Total de organizações: {:count} ')
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