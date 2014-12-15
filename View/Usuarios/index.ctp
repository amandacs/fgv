
<?php $search = $this->Session->read('search');?>
<div class="index row" style="margin-top: 50px">
    <div class="row">

        <?=$this->element('search');?><!--CAMPO DE BUSCA-->
        <div class="row" style="margin-top: 65px">
            <div class="row" >
                <div style="margin: 0 auto;text-align: center!important;">
                    <?php echo $this->Session->flash(); ?>
                </div>
                <?php $empty_field = '<span style="color: #eb8822">-------</span>'?>
                <?php if($search): ?>
                    <?php if($usuarios != null): ?>
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed table-search">
                            <?php if($org_nome != null){ ?>
                                <div>
                                    <legend><?php echo $org_nome['Organizacao']['nome'] ?>   </legend>
                                </div>
                            <?php }?>
                            <div class="btn-group" style="margin-bottom: 20px">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-refresh"></i>', array('action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Usuário', array('controller' => 'usuarios', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Avaliações', array('controller' => 'usuarioAvaliacoes', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                                <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Avaliação', array('controller' => 'avaliacoes', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?><!--
                                    <?php /*echo $this->Html->link('<i class="glyphicon glyphicon-th-list"></i> Listar Indicadores', array('controller' => 'perguntas', 'action' => 'index'), array('class' => 'btn btn-primary', 'escape' => false)); */?>
                                    --><?php /*echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> Adicionar Indicador', array('controller' => 'perguntas', 'action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)); */?>

                            </div>
                        <?php if ($this->Session->read('Auth.User.perfil_id') >1): ?>
                            <?php echo $this->Html->link('<i class="glyphicon glyphicon-home"></i> Minha Avaliação', array('controller' => 'usuarios', 'action' => 'view', $this->Session->read('Auth.User.id')), array('class' => 'btn btn-primary pull-right', 'escape' => false)); ?>
                        <?php endif; ?>

                            <tr>
                                <th>Matricula</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Cargo</th>
                                <th>Avaliado</th>
                                <?php if($perfil == 1){ ?>
                                    <th>Nome do Avaliador</th>
                                <?php }?>
                                <th>Avaliador</th>
                                <?php if($perfil == 1){ ?>
                                    <th>Organização</th>
                                <?php }?>
                                <th>Acões</th>
                            </tr>

                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td>
                                        <?php echo h($usuario['Usuario']['matricula']); ?>&nbsp;
                                    </td>
                                    <td>
                                        <?php echo $this->Html->link('<strong style="color: #1D9D74">'.h($usuario['Usuario']['nome']).'</strong>',
                                            array('action' => 'view', $usuario['Usuario']['id']), array('escape' => false)); ?>&nbsp;
                                    </td>
                                    <td>
                                        <?php echo h($usuario['Usuario']['cpf']); ?>&nbsp;
                                    </td>
                                    <td>
                                        <?php echo h($usuario['Cargo']['nome']); ?>&nbsp;
                                    </td>
                                    <td style="text-align: center">
                                        <?php if(isset($usuario['UsuarioAvaliacao']['id'])): ?>
                                            <i class="glyphicon glyphicon-ok" style="color: green"></i>
                                        <?php else: ?>
                                            <i class="glyphicon glyphicon-remove" style="color: crimson"></i>
                                        <?php endif ?>
                                    </td>
                                    <?php if($perfil == 1){ ?>
                                        <?php if($usuario['Usuario']['perfil_id'] == 2){ ?>
                                            <?php if($usuario['Usuario']['organizacao_id'] == 2){ ?>
                                                <td>
                                                    <?php echo 'ROOT'; ?>
                                                </td>
                                            <?php } else{?>
                                                <?php $find = 0;?>
                                                <?php foreach ($testes as $teste): ?>
                                                    <?php if($usuario['Usuario']['organizacao_id'] == $teste['Organizacao']['id']){ ?>
                                                        <?php foreach ($testes as $tst): ?>
                                                            <?php if($tst['Organizacao']['id'] == $teste['Organizacao']['parent_id']){ ?>
                                                                <?php foreach($tst['Usuario'] as $usr):?>
                                                                    <?php if($usr['perfil_id'] == 2 ){ ?>
                                                                        <td>
                                                                            <?php echo $usr['nome'];
                                                                            $find = 1;
                                                                            ?>
                                                                        </td>
                                                                    <?php }?>
                                                                <?php endforeach; ?>
                                                            <?php }?>
                                                        <?php endforeach; ?>
                                                    <?php }?>
                                                <?php endforeach; ?>
                                                <?php if($find == 0 ){ ?>
                                                    <td>
                                                        <?php echo "Não tem Avaliador";?>
                                                    </td>
                                                <?php }?>
                                            <?php }?>
                                        <?php }else{?>
                                            <?php $find = 0;?>
                                            <?php if($usuario['Usuario']['perfil_id'] == 3){ ?>
                                                <?php foreach ($testes as $teste): ?>
                                                    <?php if($usuario['Usuario']['organizacao_id'] == $teste['Organizacao']['id']){ ?>
                                                        <?php foreach($teste['Usuario'] as $usr):?>
                                                            <?php if($usr['perfil_id'] == 2 ){ ?>
                                                                <td>
                                                                    <?php echo $usr['nome'];
                                                                    $find = 1;
                                                                    ?>
                                                                </td>
                                                            <?php }?>
                                                        <?php endforeach; ?>
                                                    <?php }?>
                                                <?php endforeach; ?>
                                                <?php if($find == 0 ){ ?>
                                                    <td>
                                                        <?php echo "Não tem Avaliador";?>
                                                    </td>
                                                <?php }?>
                                            <?php }else{?>
                                                <td>
                                                    <?php echo 'ADMINISTRADOR'?>
                                                </td>
                                            <?php }?>
                                        <?php }?>
                                    <?php }?>
                                    <td style="text-align: center">
                                        <?php if(isset($usuario['UsuarioAvaliacao']['id']) and !is_null($usuario['UsuarioAvaliacao']['avaliador_id'])): ?>
                                            <i class="glyphicon glyphicon-ok" style="color: green"></i>
                                        <?php else: ?>
                                            <i class="glyphicon glyphicon-remove" style="color: crimson"></i>
                                        <?php endif; ?>
                                    </td>
                                    <?php if($perfil == 1){ ?>
                                        <?php foreach ($testes as $teste): ?>
                                            <?php if($usuario['Usuario']['organizacao_id'] == $teste['Organizacao']['id']){ ?>
                                                <td>
                                                    <?php echo $teste['Organizacao']['acronimo']; ?>
                                                </td>
                                            <?php }?>
                                        <?php endforeach; ?>
                                    <?php }?>
                                    <td class="actions col-lg-1" style="text-align: center">
                                        <?php echo $this->Form->postLink('<i class="fa fa-key fa-lg"></i>', array('controller' => 'usuarios', 'action' => 'resetaSenha', $usuario['Usuario']['id']), array('title'=>'Nova Senha','escape' => false), __('Deseja realmente gerar uma nova  senha para o usuário #%s?', $usuario['Usuario']['id'])); ; ?>
                                        <?php echo $this->Html->link('<i class="fa fa-pencil fa-lg"></i>', array('controller' => 'usuarios', 'action' => 'edit', $usuario['Usuario']['id']), array('title'=>'Editar','escape' => false)); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                        <div class="pull-right">
                            <p>
                                <?php
                                echo $this->Paginator->counter(array(
                                    'format' => __('Página {:page} de {:pages} | Total de pessoas encontradas: {:count} ')
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

                    <?php else: ?>
                        <div class="alert alert-danger" style="font-size: 18px">
                            <strong>Importante!</strong>
                            Nenhum resultado encontrado para sua pesquisa!
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!--
<script type="text/javascript">
    document.getElementById('param').focus();
</script>-->



