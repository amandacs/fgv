
<div class="usuarios view">
    <div class="navbar col-md-12">
        <?php echo $this->Session->flash(); ?>
        <div class="panel panel-default" style="width: 100%">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-leaf"></i>
                    <strong><?php echo $usuario['Usuario']['nome'] ?></strong>
                    <span class="pull-right">
                        <strong><p style="font-weight: bold"><!--<i class="fa fa-leaf"></i>-->  Matrícula:  <?php echo $usuario['Usuario']['matricula']; ?></p> </strong>
                    </span>
                </h3>
            </div>
            <div class="panel-body">

                <div class="col-lg-6">
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
                        <!--<p><strong><?php /*echo 'Cargo: '; */?></strong>
                            <?php /*echo $usuario['Cargo']['nome']; */?>&nbsp;
                        </p>-->
                        <p style="width: 300px"><strong><?php echo 'Cargo: '; ?></strong>
                            <?php echo $usuario['Classe']['nome']; ?>&nbsp;
                        </p>
                    </dl>
                    <br/>
                </div>
                <div class="col-lg-6">

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
                        if($this->Session->read('Auth.User.perfil_id')<$usuario['Usuario']['perfil_id']){
                            if(isset($usuario_avaliacao['UsuarioAvaliacao']['avaliador_id'])){
                                echo $this->Html->link('Avaliação finalizada', array(), array('class' => 'btn btn-default', 'escape' => false, 'style' => 'font-size: 16px'));
                            }else{
                                if($prazo_avaliador<$hoje){
                                    echo $this->Html->link('<p style="font-weight: bold; height: 10px; text-align: center;">'.'O prazo para responder a avaliação do avaliado já expirou!'.'</p>', array(), array('class' => 'btn btn-default', 'escape' => false, 'style' => 'font-size: 16px'));
                                }else{
                                    echo $this->Html->link('Avaliar servidor', array('controller' => 'usuarioAvaliacoes', 'action' => 'edit', $usuario_avaliacao['UsuarioAvaliacao']['id']), array('class' => 'btn btn-default', 'escape' => false, 'style' => 'font-size: 16px'));
                                }
                               }
                        }else{
                            echo $this->Html->link('Avaliação respondida', array(), array('class' => 'btn btn-default', 'escape' => false, 'style' => 'font-size: 16px'));
                        }
                    }else{
                        if($this->Session->read('Auth.User.id')==$usuario['Usuario']['id']){
                            if($prazo>$hoje){
                                echo $this->Html->link($avaliacao['Avaliacao']['descricao'], array('controller' => 'usuarioAvaliacoes', 'action' => 'add', $usuario['Usuario']['id'], $avaliacao['Avaliacao']['id'],  $usuario['Usuario']['funcao_id'], $usuario['Usuario']['classe_id']), array('class' => 'btn btn-success btn-block', 'escape' => false, 'style' => 'font-size: 16px'));
                                echo('Prazo Avaliado: '.$prazo->format('d-m-Y'));
                            }else{
                                echo $this->Html->link('<p style="font-weight: bold; height: 10px; text-align: center;">'.'O prazo para responder a avaliação já expirou!'.'</p>', array(), array('class' => 'btn btn-default', 'escape' => false, 'style' => 'font-size: 16px'));
                                echo('<br>O prazo era até: '.$prazo->format('d-m-Y'));
                            }
                        }else{
                            if($prazo>$hoje){
                                echo $this->Html->link('<p style="font-weight: bold; height: 10px; text-align: center;">'.'Aguardando resolução do avaliado!'.'</p>', array(), array('class' => 'btn btn-default', 'escape' => false, 'style' => 'font-size: 16px'));

                                echo('<br>O prazo para o usuario é até: '.$prazo->format('d-m-Y'));
                            }else{
                                echo $this->Html->link('<p style="font-weight: bold; height: 10px; text-align: center;">'.'O avaliado não respondeu a avaliação no prazo!'.'</p>', array(), array('class' => 'btn btn-default', 'escape' => false, 'style' => 'font-size: 16px'));
                                echo('<br>O usuário perdeu o prazo, que era até: '.$prazo->format('d-m-Y'));
                            }
                        }
                    } ?>

                </div>
                <?php if ($this->Session->read('Auth.User.perfil_id') <= 2): ?>
                    <p style="float: right; width: 350px">
                        <?php
                        echo $this->Html->link('LISTA DE USUÁRIOS', array('controller' => 'usuarios', 'action' => 'index'), array('class' => 'btn btn-success btn-block', 'escape' => false, 'style' => 'font-size: 16px'));
                        ?>
                    </p>
                <?php endif; ?>
               <div>
               </div>
            </div>
        </div>
    </div>
</div>

