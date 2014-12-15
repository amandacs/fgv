<br>
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
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<div class="panel panel-default" style="width: 100%">
    <div class="panel-heading" role="tab" id="headingOne">
        <h3 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fa fa-leaf"></i>
                <strong><?php echo $usuario['Usuario']['nome'] ?></strong>
                            <span class="pull-right">
                                <strong><p style="font-weight: bold"><!--<i class="fa fa-leaf"></i>-->  Matrícula:  <?php echo $usuario['Usuario']['matricula']; ?></p> </strong>
                            </span>
            </a>
        </h3>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">

        <div>
            <legend style="font-size: 15px">
                <strong>DADOS DO COLABORADOR</strong>
                <div class="pull-right">
                    <?php //TODO editar funcionario /*echo $this->Html->link('<i class="fa fa-pencil fa-lg-fqa"></i>', array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'title' => 'Editar Dados Gerais')); ?>
                </div>
            </legend>
            <dl>
                <p><strong><?php echo 'CPF: '; ?></strong>
                    <?php echo $usuario['Usuario']['cpf']; ?>&nbsp;
                </p>
                <p><strong><?php echo 'Organização: '; ?></strong>
                    <?php echo $usuario['Organizacao']['nome']; ?>&nbsp;
                </p>
               <!-- <p><strong><?php /*echo 'Cargo: '; */?></strong>
                            <?php /*echo $usuario['Cargo']['nome']; */?>&nbsp;
                        </p>
                <p style="width: 300px"><strong><?php /*echo 'Cargo: '; */?></strong>
                    <?php /*echo $usuario['Classe']['nome']; */?>&nbsp;
                </p>-->
            </dl>
            <br/>
        </div>
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

                if($this->Session->read('Auth.User.perfil_id')<$usuario['Usuario']['perfil_id']||$usuario['Organizacao']['parent_id']==$this->Session->read('Auth.User.organizacao_id')){
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
                    <?php if ($ava == null):?>
                        <?php echo "A avaliação ainda não foi respondida!";?>
                    <?php endif ?>
                    <?php if ($ava != null):?>
                    <legend style="font-size: 15px">
                        <strong>Média Geral</strong>
                        <div class="pull-right">
                            <?php //TODO editar funcionario /*echo $this->Html->link('<i class="fa fa-pencil fa-lg-fqa"></i>', array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'title' => 'Editar Dados Gerais')); ?>
                        </div>
                    </legend>
                    <dl>
                        <p><strong><?php echo 'Data da Auto-Avaliação: '; ?></strong>
                            <?php echo $ava['UsuarioAvaliacao']['data_avaliacao']; ?>&nbsp;
                        </p>
                        <p><strong><?php echo 'Nome do Avaliador: '; ?></strong>
                            <?php echo $ava['Avaliador']['nome']; ?>&nbsp;
                        </p>
                        <p><strong><?php echo 'Data da Avaliação: '; ?></strong>
                            <?php echo $ava['UsuarioAvaliacao']['data_avaliador']; ?>&nbsp;
                        </p>
                    </dl>
                    <legend style="font-size: 15px">
                        <strong>Pontos Fracos e Fortes</strong>
                        <div class="pull-right">
                            <?php //TODO editar funcionario /*echo $this->Html->link('<i class="fa fa-pencil fa-lg-fqa"></i>', array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'title' => 'Editar Dados Gerais')); ?>
                        </div>
                    </legend>

                    <?php $grupos = array(); ?>
                    <?php foreach ($perguntas as $perg): ?>
                        <?php array_push($grupos, $perg['Grupo']['id']); ?>
                    <?php endforeach; ?>
                    <?php $grupos = array_unique($grupos); ?>

                    <ul class="list-group">
                        <a href="#" class="list-group-item disabled">
                            <span class="badge">Média</span>
                            <span class="badge">Auto-Avaliação</span>
                            <span>Grupo</span>
                        </a>
                        <?php $media_avaliado = 0; ?>
                        <?php $media_avaliador = 0; ?>
                        <?php $k = 0; ?>
                        <?php $forte =0;?>
                        <?php $fraco = 0;?>
                        <?php foreach ($grupos as $grupo): ?>
                            <?php $soma_avaliado = 0; ?>
                            <?php $soma_avaliador = 0; ?>
                            <?php $j = 0; ?>
                            <?php foreach ($perguntas as $perg): ?>
                                <?php if ($perg['Grupo']['id'] == $grupo): ?>
                                    <?php foreach ($ava['UsuarioResposta'] as $indice): ?>
                                        <?php if ($indice['pergunta_id'] == $perg['Pergunta']['id']): ?>
                                            <?php $soma_avaliado = $soma_avaliado + $indice['resposta_avaliado_id']; ?>
                                            <?php $soma_avaliador = $soma_avaliador + $indice['resposta_avaliador_id']; ?>
                                            <?php $j++; ?>
                                        <?php endif ?>
                                    <?php endforeach;?>
                                <?php endif ?>
                            <?php endforeach;?>
                            <script>

                            </script>
                            <?php if (($soma_avaliador/$j)>2):?>
                                <?php /*echo $this->Html->link('<b><span class="glyphicon glyphicon-plus"></span> <br> Adicionar</b>',
                                    array('controller'=>'usuarios', 'action' => 'view_indicadores', $grupo,$usuario['Usuario']['id']),
                                    array('escape' => false,'data-target'=>'#myModal', 'data-toggle'=>'modal', 'title' => 'View Indicadores', 'data-label'=>'View Indicadores'));
                                */?>
                                <?php $forte++; ?>
                                <a href="/fgv/usuarios/view_indicadores/<?php echo $grupo?>/<?php echo $usuario['Usuario']['id'] ?>" class="list-group-item list-group-item-success" data-target="#myModal" data-toggle="modal" title="View Indicadores" data-label="View Indicadores" target="_self">
                                    <span class="badge"><?php echo $soma_avaliador/$j ?></span>
                                    <span class="badge"><?php echo $soma_avaliado/$j ?></span>
                                    <?php echo $gruponome[$grupo] ?>
                                </a>
                            <?php else: ?>
                                <?php $fraco++; ?>
                                <a href="/fgv/usuarios/view_indicadores/<?php echo $grupo?>/<?php echo $usuario['Usuario']['id'] ?>" class="list-group-item list-group-item-danger " data-target="#myModal" data-toggle="modal" title="View Indicadores" data-label="View Indicadores" target="_self">
                                    <span class="badge"><?php echo $soma_avaliador/$j ?></span>
                                    <span class="badge "><?php echo $soma_avaliado/$j ?></span>
                                    <?php echo $gruponome[$grupo] ?>
                                </a>
                            <?php endif ?>
                            <?php $media_avaliado = $media_avaliado + intval($soma_avaliado/$j)  ?>
                            <?php $media_avaliador = $media_avaliador + intval($soma_avaliador/$j)  ?>
                            <?php $k++;  ?>
                        <?php endforeach; ?>
                        <a href="#" class="list-group-item disabled">
                            <span class="badge"><?php echo intval($media_avaliador/$k) ?></span>
                            <span class="badge "><?php echo intval($media_avaliado/$k) ?></span>
                            <span>Média Final</span>
                        </a>
                    </ul>
                    <br/>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" >
                    <i class="glyphicon glyphicon-stats"></i>
                    <strong>Gráficos</strong>
                </a>
            </h4>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                <div id="canvas-holder">

                    <canvas id="chart-area" width="250" height="250"/>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>
</div>

</div>



<?php $this->start('script');?>

<script>


    var doughnutData = [

        {

            value: <?php echo $fraco?>,

            color:"#F7464A",

            highlight: "#FF5A5E",

            label: "Pontos Fracos"

        },

        {

            value: <?php echo $forte?>,

            color: "#46BFBD",

            highlight: "#5AD3D1",

            label: "Pontos Fortes"
        }
    ];

    $('#collapseThree').on('show.bs.collapse', function () {
        console.log('teste');
        var ctx = document.getElementById("chart-area").getContext("2d");

        window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : false});
    })





</script>
<?php $this->end();?>

<!--Modal Oficial -->
<div class="myModal">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modal-body" class="modal-body">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>