<div class="respostas index">
    <div class="navbar col-md-12">
        <legend><b>Formulários</b></legend>
        <!--<div class="btn-group">
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Formulário', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Avaliações', array('controller' => 'avaliacoes', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Avaliação', array('controller' => 'avaliacoes','action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Indicadores', array('controller' => 'perguntas', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Indicador', array('controller' => 'perguntas', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
        </div>-->
    </div>


    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed">
            <tr>
                <th>Avaliação</th>
                <th>Indicadores</th>
                <th>Resposta Funcionario</th>
                <th>Resposta Chefe</th>
                <th>Justificativa</th>
                <th>Ações</th>
            </tr>

            <?php $ids = array(); ?>

            <?php foreach ($respostas as $resposta): ?>
                <tr>
                    <td><?php echo h($resposta['UsuarioAvaliacao']['nome']); ?>&nbsp;</td>
                    <td><?php echo h($resposta['Pergunta']['descricao']); ?>&nbsp;</td>
                    <td><?php echo h($resposta['UsuarioResposta']['resposta_funcionario_id']); ?>&nbsp;</td>
                    <td><?php echo h($resposta['UsuarioResposta']['resposta_chefe_id']); ?>&nbsp;</td>
                    <td><?php echo h($resposta['UsuarioResposta']['justificativa_funcionario']); ?>&nbsp;</td>
                    <td class="actions col-lg-1">
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-file"></i>', array('action' => 'view', $resposta['UsuarioResposta']['id']), array('title'=>'Visualizar', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('action' => 'edit', $resposta['UsuarioResposta']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('action' => 'delete', $resposta['UsuarioResposta']['id']), array('title'=>'Excluir','escape' => false), __('Are you sure you want to delete # %s?', $resposta['UsuarioResposta']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | Total de respostas: {:count} ')
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