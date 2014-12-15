<div class="usuarioAvaliacoes index">
    <div class="navbar col-md-12">
        <legend><b>Avaliações de Colaboradores</b></legend>
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Avaliação', array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Usuários', array('controller' => 'usuarios', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Usuário', array('controller' => 'usuarios', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?><!--
            <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Indicadores', array('controller' => 'perguntas', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
            --><?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Indicador', array('controller' => 'perguntas', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
        </div>
    </div>

    <div class="col-md-12">
        <?php echo $this->Session->flash(); ?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed" style="text-align: center">
            <tr>
                <th>Avaliado</th>
                <th>Função do Avaliado</th>
                <th>Classe do Avaliado</th>
                <th>Data Avaliado</th>
                <th>Avaliador</th>
                <th>Data Avaliador</th>
                <!--<th>Pontos Fortes</th>
                <th>Pontos Fracos</th>-->
                <th>Comentário Avaliado</th>
                <th>Comentário Avaliador</th>
                <th>Plano de Ação</th>
                <th>Ações</th>
            </tr>

            <?php $ids = array(); ?>

            <?php foreach ($avaliacoes as $avaliacao): ?>
                <tr>
                    <td><?php echo h($avaliacao['Avaliado']['nome']); ?></td>
                    <td><?php echo h($avaliacao['FuncaoAvaliado']['nome']); ?></td>
                    <td><?php echo h($avaliacao['ClasseAvaliado']['nome']); ?></td>
                    <td><?php echo h($this->Time->format('d/m/Y \à\s H:i:s', $avaliacao['UsuarioAvaliacao']['data_avaliacao'])); ?>&nbsp;</td>
                    <td><?php echo h($avaliacao['Avaliador']['nome']); ?></td>
                    <td><?php echo h($this->Time->format('d/m/Y \à\s H:i:s', $avaliacao['UsuarioAvaliacao']['data_avaliador'])); ?>&nbsp;</td>
                    <!--<td><?php /*echo h($avaliacao['UsuarioAvaliacao']['pontos_fortes']); */?>&nbsp;</td>
                    <td><?php /*echo h($avaliacao['UsuarioAvaliacao']['pontos_fracos']); */?>&nbsp;</td>-->
                    <td><?php echo h($avaliacao['UsuarioAvaliacao']['comentario_avaliado']); ?>&nbsp;</td>
                    <td><?php echo h($avaliacao['UsuarioAvaliacao']['comentario_avaliador']); ?>&nbsp;</td>
                    <td><?php echo h($avaliacao['UsuarioAvaliacao']['plano_acao']); ?>&nbsp;</td>
                    <td class="actions col-lg-1">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-file"></i>', array('controller'=>'usuarioAvaliacoes', 'action' => 'view', $avaliacao['UsuarioAvaliacao']['id']), array('title'=>'Visualizar', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('controller'=>'usuarioAvaliacoes', 'action' => 'edit', $avaliacao['UsuarioAvaliacao']['id']), array('title'=>'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-trash"></i>', array('controller'=>'usuarioAvaliacoes', 'action' => 'delete', $avaliacao['UsuarioAvaliacao']['id']), array('title'=>'Excluir','escape' => false), __('Tem certeza que deseja excluir a avaliação # %s?', $avaliacao['UsuarioAvaliacao']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pull-right">
            <p>
                <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Página {:page} de {:pages} | total de avaliações: {:count} ')
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

