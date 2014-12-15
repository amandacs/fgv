<div class="perguntas index">

    <div class="navbar col-md-12">
        <legend><b>Indicadores</b></legend>
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Indicador', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Graus', array('controller' => 'graus', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?><!--
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Grau', array('controller' => 'graus', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            --><?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Grupos', array('controller' => 'grupos', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
        </div>
    </div>

    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Grupo</th>
                <th>Descrição</th>
                <th>Acões</th>
            </tr>
            <?php $ids = array(); ?>

            <?php foreach ($perguntas as $pergunta): ?>
                <tr>
                    <?php if (!in_array($pergunta['Grupo']['id'], $ids)): ?>
                        <?php array_push($ids, $pergunta['Grupo']['id']); ?>
                        <td rowspan="<?php echo $pergunta['Grupo']['count']?>" style="vertical-align: middle">
                            <?php echo $this->Html->link( $pergunta['Grupo']['ordem'].'. '.$pergunta['Grupo']['nome'], array('controller' => 'grupos', 'action' => 'view', $pergunta['Grupo']['id']), array('data-toggle'=>'modal', 'data-target'=>'#modal', 'escape'=>false));?>
                        </td>
                    <?php endif; ?>
                    <td>
                        <?php echo h($pergunta['Pergunta']['ordem'] . '. ' . $pergunta['Pergunta']['descricao'] ); ?>&nbsp;
                        <?php if ($pergunta['Pergunta']['obrigatoria']): ?>
                            <i class="fa fa-asterisk" style="color: red"></i>
                        <?php endif; ?>
                    </td>
                    <td class="actions col-lg-1">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i>', array('action' => 'view', $pergunta['Pergunta']['id']), array('title'=>'Visualizar', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('action' => 'edit', $pergunta['Pergunta']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $pergunta['Pergunta']['id']), array('title'=>'Excluir','escape' => false), __('tem certeza que deseja excluir o indicador  #%s?', $pergunta['Pergunta']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p style="margin-left: 33px">
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | Total de perguntas: {:count} ')
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