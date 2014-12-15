<?php /*debug($ava);*/?>
<div class=" row">
    <div class="row">
        <?php if ($this->Session->read('Auth.User.perfil_id') <= 2): ?>
            <p style="float: left; width: 350px">
                <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left" style="color: white"></i> LISTA DE USUÁRIOS', array('controller' => 'usuarios', 'action' => 'index'), array('escape' => false,'class' => 'btn btn-success')); ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="row">

        <?php echo $this->Session->flash(); ?>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default" style="width: 100%">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-leaf"></i>
                            <strong><?php echo $usuario['Usuario']['nome'] ?></strong>
                            <span class="pull-right">
                                <strong><p style="font-weight: bold"><!--<i class="fa fa-leaf"></i>-->  Matrícula:  <?php echo $usuario['Usuario']['matricula']; ?></p> </strong>
                            </span>
                        </a>
                    </h3>
                </div>
                <div class="panel-body">

                    <div>
                        <legend style="font-size: 15px">
                            <strong>DADOS DO COLABORADOR</strong>
                            <div class="pull-right">
                                <?php //TODO editar funcionario /*echo $this->Html->link('<i class="fa fa-pencil fa-lg-fqa"></i>', array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'title' => 'Editar Dados Gerais')); */?>
                            </div>
                        </legend>
                        <dl>
                            <p><strong><?php echo 'CPF: '; ?></strong>
                                <?php echo $usuario['Usuario']['cpf']; ?>&nbsp;
                            </p>
                            <p><strong><?php echo 'Organização: '; ?></strong>
                                <?php echo $usuario['Organizacao']['nome']; ?>&nbsp;
                            </p>
                            <p><strong><?php echo 'Cargo: '; ?></strong>
                                <?php echo $usuario['Classe']['nome']; ?>&nbsp;
                            </p>
                        </dl>
                        <br/>
                    </div>
                </div>
                <?php if ($this->Session->read('Auth.User.perfil_id') >1): ?>
                    <div>
                    <?php $arrayAvaliacoes = array(); ?>
                    <?php foreach($usuarioAvaliacoes as $usuario_avaliacao):
                        array_push($arrayAvaliacoes, $usuario_avaliacao['UsuarioAvaliacao']['avaliacao_id']);
                    endforeach; ?>

                    <?php
                    /*Debugger::dump($avaliacao);*/
                    $prazo = new DateTime($avaliacao['Avaliacao']['prazo']);
                    $prazo_avaliador = new DateTime($avaliacao['Avaliacao']['prazo_avaliador']);
                    $hoje  = new DateTime();
                    ?>
                    <?php if(in_array($avaliacao['Avaliacao']['id'], $arrayAvaliacoes)){
                        if($this->Session->read('Auth.User.perfil_id')<$usuario['Usuario']['perfil_id'] or $this->Session->read('Auth.User.organizacao_id')!=$usuario['Usuario']['organizacao_id']){
                            if(isset($usuario_avaliacao['UsuarioAvaliacao']['avaliador_id'])){
                                echo $this->Html->link('Avaliação finalizada', array(), array('class' => 'btn btn-default btn-block', 'escape' => false, 'style' => 'font-size: 16px'));
                            }else{
                                if($prazo_avaliador<$hoje){
                                    echo $this->Html->link('O prazo para responder a avaliação do avaliado já expirou!', array('escape' => false, 'class' => 'btn btn-default btn-block', 'style' => 'font-size: 16px'));
                                }else{
                                    echo $this->Html->link('Avaliar servidor', array('controller' => 'usuarioAvaliacoes', 'action' => 'edit', $usuario_avaliacao['UsuarioAvaliacao']['id']), array('class' => 'btn btn-default btn-block', 'escape' => false, 'style' => 'font-size: 16px'));
                                }
                            }
                        }else{

                            echo $this->Html->link('Avaliação respondida', array(), array('class' => 'btn btn-default btn-block', 'escape' => false, 'style' => 'font-size: 16px'));
                        }
                    }else{
                        if($this->Session->read('Auth.User.id')==$usuario['Usuario']['id']){
                            if($prazo>$hoje){
                                echo('Prazo Avaliado: '.$prazo->format('d-m-Y'));
                                echo $this->Html->link($avaliacao['Avaliacao']['descricao'], array('controller' => 'usuarioAvaliacoes', 'action' => 'add', $usuario['Usuario']['id'], $avaliacao['Avaliacao']['id'],  $usuario['Usuario']['funcao_id'], $usuario['Usuario']['classe_id']), array('class' => 'btn btn-success btn-block', 'escape' => false, 'style' => 'font-size: 16px'));

                            }else{
                                echo('<br>O prazo era até: '.$prazo->format('d-m-Y'));
                                echo $this->Html->link('O prazo para responder a avaliação já expirou!', array(), array('class' => 'btn btn-default btn-block', 'escape' => false, 'style' => 'font-size: 16px'));

                            }
                        }else{
                            if($prazo>$hoje){
                                echo('<br>O prazo para o usuario é até: '.$prazo->format('d-m-Y'));
                                echo $this->Html->link('Aguardando resolução do avaliado!', array(), array('class' => 'btn btn-default btn-block', 'escape' => false, 'style' => 'font-size: 16px'));


                            }else{
                                echo('<br>O usuário perdeu o prazo, que era até: '.$prazo->format('d-m-Y'));
                                echo $this->Html->link('<p style="font-weight: bold; height: 10px; text-align: center;">'.'O avaliado não respondeu a avaliação no prazo!'.'</p>', array(), array('class' => 'btn btn-default btn-block', 'escape' => false, 'style' => 'font-size: 16px'));

                            }
                        }
                    } ?>
                </div>
                <?php endif; ?>
            </div>
            <?php if ($this->Session->read('Auth.User.perfil_id') == 1): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <i class="glyphicon glyphicon-list-alt"></i>
                               <strong>Relatório</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div>
                                <legend style="font-size: 15px">
                                    <strong>Média Geral</strong>
                                    <div class="pull-right">
                                        <?php //TODO editar funcionario /*echo $this->Html->link('<i class="fa fa-pencil fa-lg-fqa"></i>', array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'title' => 'Editar Dados Gerais')); */?>
                                    </div>
                                </legend>
                                <dl>
                                    <p><strong><?php echo 'Média Parcial (Auto-Avaliação): '; ?></strong>
                                        <?php echo $usuario['Usuario']['cpf']; ?>&nbsp;
                                    </p>
                                    <p><strong><?php echo 'Média Final: '; ?></strong>
                                        <?php echo $usuario['Organizacao']['nome']; ?>&nbsp;
                                    </p>
                                    <!--<p><strong><?php /*echo 'Cargo: '; */?></strong>
                            <?php /*echo $usuario['Cargo']['nome']; */?>&nbsp;
                        </p>-->
                                    <p style="width: 300px"><strong><?php echo 'Média Parcial dos Fatores de Desempenho (Auto-Avaliação): '; ?></strong>
                                        <?php echo $usuario['Classe']['nome']; ?>&nbsp;
                                    </p>
                                    <p><strong><?php echo 'Média Final dos Fatores de Desempenho: '; ?></strong>
                                        <?php echo $usuario['Organizacao']['nome']; ?>&nbsp;
                                    </p>
                                </dl>
                                <legend style="font-size: 15px">
                                    <strong>Pontos Fracos e Fortes</strong>
                                    <div class="pull-right">
                                        <?php //TODO editar funcionario /*echo $this->Html->link('<i class="fa fa-pencil fa-lg-fqa"></i>', array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'title' => 'Editar Dados Gerais')); */?>
                                    </div>
                                </legend>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <i class="glyphicon glyphicon-stats"></i>
                                <strong>Gráficos</strong>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>