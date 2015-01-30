<?php
/**
 * Created by PhpStorm.
 * User: amanda.sanguanini
 * Date: 07/01/2015
 * Time: 10:20
 */?>
<div class="col-md-2"><?php echo $this->Html->image('pmbv.png') ?></div>
<div ><h2>PREFEITURA DO MUNICÍPIO DE BOA VISTA</h2></div>

<br>

<?php $grupos = array(); ?>
<?php foreach ($perguntas as $perg): ?>
    <?php array_push($grupos, $perg['Grupo']['id']); ?>
<?php endforeach; ?>
<?php $grupos = array_unique($grupos); ?>

<div class="panel panel-default">

    <div class="panel-heading text-center"  style="background-color: mediumseagreen; color: #ffffff">AVALIAÇÃO DE COMPETÊNCIAS E DESEMPENHO</div>
    <table class="table">
        <tr style="background-color: #f5f5f5">
            <td class="text-center" colspan="2"  style="background-color: lightgrey"> IDENTIFICAÇÃO</td>
        </tr>
        <tr>
            <td>Nome do Avaliado:  <?php echo $ava['Avaliado']['nome']?></td>
            <td>Matrícula: <?php echo $ava['Avaliado']['matricula']?></td>
        </tr>
        <tr>
            <td>Cargo do Avaliado: <?php echo $ava['CargoAvaliado']['nome']?></td>
            <td>Classe: <?php echo $ava['ClasseAvaliado']['nome']?></td>
        </tr>
        <tr>
            <?php $secretaria = null;
            $i =0;
            $k =0;
            while($secretaria == null):
                if($orgs[$i]['Organizacao']['id']==$ava['Avaliado']['organizacao_id']):
                    while($secretaria == null):
                        if($orgs[$k]['Organizacao']['id'] == $orgs[$i]['Organizacao']['secretaria_id']):
                            $secretaria = $orgs[$k]['Organizacao']['nome'];
                        endif;
                        $k++;
                    endwhile;
                    $departamento = $orgs[$i]['Organizacao']['nome'];
                endif;
                $i++;
            endwhile;
            ?>
            <td colspan="2">Diretoria: <?php echo $departamento;?></td>
        </tr>
        <tr>
            <td colspan="2">Nome do Avaliador: <?php echo $ava['Avaliador']['nome']?></td>
        </tr>
        <tr>
            <td colspan="2">Cargo do Avaliador: <?php echo $ava['CargoAvaliador']['nome']?> </td>
        </tr>
        <tr>
            <td>Secretaria:<?php echo $secretaria;?>
            </td>
            <td>Data: <?php echo $ava['UsuarioAvaliacao']['data_avaliador']?></td>
        </tr>
        <tr>
            <td colspan="2">Periodo de Avaliação:</td>
        </tr>
    </table>
    <div class="panel-body">
        <p> 1. Este formulário tem como objetivo avaliar as competências comportamentais e técnicas de cada servidor/colaborador e alguns fatores de desempenho durante o período acima estabeçecido.
            <br> 2. Ao avaliar cada Competência Essencial, Comportamental e Técnica utilize as seguintes graduações:</p>
    </div>
    <table class="table">
        <tr style="background-color: #f5f5f5">
            <td class="text-center" colspan="2"  style="background-color: lightgrey"> COMPETÊNCIAS</td>
        </tr>
        <tr>
            <td class="col-md-1">GRAU 1:</td>
            <td>O servidor/colaborador <b>não possui a competência e/ou não aplica a competência</b> no desenvolvimento de suas atividades, conforme o esperado.</td>
        </tr>
        <tr>
            <td>GRAU 2:</td>
            <td>O servidor/colaborador possui a competência <b>abaixo do esperado e/ou apresenta uma lacuna significativa</b>
                em relação a aplicação da competência na realização das atividades.</td>
        </tr>
        <tr>
            <td>GRAU 3:</td>
            <td>O servidor/colaborador possui a competência em <b>grau adequado</b>
                ao desenvolvimento das atribuições do cargo e /ou <b> aplica a competência corretamente</b>em suas atividades.</td>
        </tr>
        <tr>
            <td>GRAU 4:</td>
            <td>O servidor/colaborador adquiriu e <b>desenvolveu plenamente</b> a competência estando <b>acima do esperado e/ ou aplica a competência em grande escala</b>
                tornando-se <b> referência</b> em sua área de atuação.
        </tr>
    </table>
    <!-- Table -->
</div>
<?php
$pontos_fracos = "";
$pontos_fortes = "";
?>
<div class="panel-heading text-center"  style="background-color: mediumseagreen; color: #ffffff">COMPETÊNCIAS ESSENCIAIS</div>
<br>
<?php if($grupos == 0)?>
<?php $qtd_grupos = 0; ?>
<?php $soma_media_avaliado = 0; ?>
<?php $soma_media_avaliador = 0; ?>
<?php foreach ($grupos as $grupo):?>
    <?php foreach ($gruponome as $groupname):?>
        <?php if($groupname['Grupo']['id']==$grupo): ?>
            <?php if($groupname['Grupo']['competencia_id']==2):?>
                <?php $qtd_grupos = $qtd_grupos+1; ?>
                <?php $grupo_perguntas = 0; ?>
                <?php $grupo_respostas_avaliado = 0; ?>
                <?php $grupo_respostas_avaliador = 0; ?>
                <div class="panel panel-default">
                    <br>
                    <div class="panel-body">
                        <div class="col-md-2 text-center"> <?php echo $groupname['Grupo']['ordem'].".".$groupname['Grupo']['nome'] ?></div>
                        <div class="col-md-10"><?php echo $groupname['Grupo']['observacao']?></div>
                        <br><br><br>
                        <table class="table table-bordered">
                            <tr style="background-color: lightgrey ">
                                <td class="col-md-8" style="text-align: center">INDICADORES</td>
                                <td class="col-md-2" style="text-align: center">AUTO-AVALIAÇÃO</td>
                                <td class="col-md-2" style="text-align: center">AVALIADOR</td>
                            </tr>
                            <?php foreach ($perguntas as $i=>$pergunta): ?>
                                <?php if ($pergunta['Grupo']['id'] == $grupo): ?>
                                    <tr>
                                        <td><?php echo$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao'])?></td>
                                        <?php foreach ($ava["UsuarioResposta"] as $resposta): ?>
                                            <?php if ($pergunta['Pergunta']['id'] == $resposta["pergunta_id"]): ?>
                                                <?php $grupo_perguntas = $grupo_perguntas+1; ?>
                                                <?php $grupo_respostas_avaliado = $grupo_respostas_avaliado+$resposta["resposta_avaliado_id"]; ?>
                                                <?php $grupo_respostas_avaliador = $grupo_respostas_avaliador+$resposta["resposta_avaliador_id"]; ?>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliado_id"]?></td>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliador_id"]?></td>
                                                <?php if($resposta["resposta_avaliador_id"]<=2):?>
                                                    <?php $pontos_fracos = $pontos_fracos."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>
                                                <?php if($resposta["resposta_avaliador_id"]>=3):?>
                                                    <?php $pontos_fortes = $pontos_fortes."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <tr>
                                <td style="text-align: right"><b>PONTUAÇÃO</b></td>
                                <?php $soma_media_avaliado = $soma_media_avaliado+($grupo_respostas_avaliado/$grupo_perguntas); ?>
                                <?php $soma_media_avaliador = $soma_media_avaliador+($grupo_respostas_avaliador/$grupo_perguntas); ?>
                                <td style="text-align: center"><?php echo ($grupo_respostas_avaliado/$grupo_perguntas);?></td>
                                <td style="text-align: center"><?php echo ($grupo_respostas_avaliador/$grupo_perguntas);?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<table class="table table-bordered">
    <tr style="background-color: lightgrey ">
        <td class="col-md-8" style="text-align: center">MÉDIA COMPETÊNCIAS ESSENCIAIS</td>
        <?php $competencia_geral_avaliado= ($soma_media_avaliado/$qtd_grupos)?>
        <?php $competencia_geral_avaliador= ($soma_media_avaliador/$qtd_grupos)?>
        <td class="col-md-2" style="text-align: center"><?php echo ($soma_media_avaliado/$qtd_grupos)?></td>
        <td class="col-md-2" style="text-align: center"><?php echo ($soma_media_avaliador/$qtd_grupos)?></td>
    </tr>
</table>
<div class="panel-heading text-center"  style="background-color: mediumseagreen; color: #ffffff">COMPETÊNCIAS COMPORTAMENTAIS</div>
<br>
<?php if($grupos == 0)?>
<?php $qtd_grupos = 0; ?>
<?php $soma_media_avaliado = 0; ?>
<?php $soma_media_avaliador = 0; ?>
<?php foreach ($grupos as $grupo):?>
    <?php foreach ($gruponome as $groupname):?>
        <?php if($groupname['Grupo']['id']==$grupo): ?>
            <?php if($groupname['Grupo']['competencia_id']==48):?>
                <?php $qtd_grupos = $qtd_grupos+1; ?>
                <?php $grupo_perguntas = 0; ?>
                <?php $grupo_respostas_avaliado = 0; ?>
                <?php $grupo_respostas_avaliador = 0; ?>
                <div class="panel panel-default">
                    <br>
                    <div class="panel-body">
                        <div class="col-md-2 text-center"> <?php echo $groupname['Grupo']['ordem'].".".$groupname['Grupo']['nome'] ?></div>
                        <div class="col-md-10"><?php echo $groupname['Grupo']['observacao']?></div>
                        <br><br><br>
                        <table class="table table-bordered">
                            <tr style="background-color: lightgrey ">
                                <td class="col-md-8" style="text-align: center">INDICADORES</td>
                                <td class="col-md-2" style="text-align: center">AUTO-AVALIAÇÃO</td>
                                <td class="col-md-2" style="text-align: center">AVALIADOR</td>
                            </tr>
                            <?php foreach ($perguntas as $i=>$pergunta): ?>
                                <?php if ($pergunta['Grupo']['id'] == $grupo): ?>
                                    <tr>
                                        <td><?php echo$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao'])?></td>
                                        <?php foreach ($ava["UsuarioResposta"] as $resposta): ?>
                                            <?php if ($pergunta['Pergunta']['id'] == $resposta["pergunta_id"]): ?>
                                                <?php $grupo_perguntas = $grupo_perguntas+1; ?>
                                                <?php $grupo_respostas_avaliado = $grupo_respostas_avaliado+$resposta["resposta_avaliado_id"]; ?>
                                                <?php $grupo_respostas_avaliador = $grupo_respostas_avaliador+$resposta["resposta_avaliador_id"]; ?>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliado_id"]?></td>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliador_id"]?></td>
                                                <?php if($resposta["resposta_avaliador_id"]<=2):?>
                                                    <?php $pontos_fracos = $pontos_fracos."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>
                                                <?php if($resposta["resposta_avaliador_id"]>=3):?>
                                                    <?php $pontos_fortes = $pontos_fortes."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <tr>
                                <td style="text-align: right"><b>PONTUAÇÃO</b></td>
                                <?php $soma_media_avaliado = $soma_media_avaliado+($grupo_respostas_avaliado/$grupo_perguntas); ?>
                                <?php $soma_media_avaliador = $soma_media_avaliador+($grupo_respostas_avaliador/$grupo_perguntas); ?>
                                <td style="text-align: center"><?php echo ($grupo_respostas_avaliado/$grupo_perguntas);?></td>
                                <td style="text-align: center"><?php echo ($grupo_respostas_avaliador/$grupo_perguntas);?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<table class="table table-bordered">
    <tr style="background-color: lightgrey ">
        <td class="col-md-8" style="text-align: center">MÉDIA COMPETÊNCIAS COMPORTAMENTAIS</td>
        <?php $competencia_geral_avaliado= $competencia_geral_avaliado+($soma_media_avaliado/$qtd_grupos)?>
        <?php $competencia_geral_avaliador= $competencia_geral_avaliador+($soma_media_avaliador/$qtd_grupos)?>
        <td class="col-md-2" style="text-align: center"><?php echo number_format(($soma_media_avaliado/$qtd_grupos),2)?></td>
        <td class="col-md-2" style="text-align: center"><?php echo number_format(($soma_media_avaliador/$qtd_grupos),2)?></td>
    </tr>
</table>
<div class="panel-heading text-center"  style="background-color: mediumseagreen; color: #ffffff">COMPETÊNCIAS TÉCNICAS</div>
<br>
<?php if($grupos == 0)?>
<?php $qtd_grupos = 0; ?>
<?php $soma_media_avaliado = 0; ?>
<?php $soma_media_avaliador = 0; ?>
<?php foreach ($grupos as $grupo):?>
    <?php foreach ($gruponome as $groupname):?>
        <?php if($groupname['Grupo']['id']==$grupo): ?>
            <?php if($groupname['Grupo']['competencia_id']==18):?>
                <?php $qtd_grupos = $qtd_grupos+1; ?>
                <?php $grupo_perguntas = 0; ?>
                <?php $grupo_respostas_avaliado = 0; ?>
                <?php $grupo_respostas_avaliador = 0; ?>
                <div class="panel panel-default">
                    <br>
                    <div class="panel-body">
                        <div class="text-center"> <?php echo $groupname['Grupo']['ordem'].".".$groupname['Grupo']['nome'] ?></div>
                        <br>
                        <table class="table table-bordered">
                            <tr style="background-color: lightgrey ">
                                <td class="col-md-8" style="text-align: center">INDICADORES</td>
                                <td class="col-md-2" style="text-align: center">AUTO-AVALIAÇÃO</td>
                                <td class="col-md-2" style="text-align: center">AVALIADOR</td>
                            </tr>
                            <?php foreach ($perguntas as $i=>$pergunta): ?>
                                <?php if ($pergunta['Grupo']['id'] == $grupo): ?>
                                    <tr>
                                        <td><?php echo$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao'])?></td>
                                        <?php foreach ($ava["UsuarioResposta"] as $resposta): ?>
                                            <?php if ($pergunta['Pergunta']['id'] == $resposta["pergunta_id"]): ?>
                                                <?php $grupo_perguntas = $grupo_perguntas+1; ?>
                                                <?php $grupo_respostas_avaliado = $grupo_respostas_avaliado+$resposta["resposta_avaliado_id"]; ?>
                                                <?php $grupo_respostas_avaliador = $grupo_respostas_avaliador+$resposta["resposta_avaliador_id"]; ?>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliado_id"]?></td>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliador_id"]?></td>
                                                <?php if($resposta["resposta_avaliador_id"]<=2):?>
                                                    <?php $pontos_fracos = $pontos_fracos."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>
                                                <?php if($resposta["resposta_avaliador_id"]>=3):?>
                                                    <?php $pontos_fortes = $pontos_fortes."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <tr>
                                <td style="text-align: right"><b>PONTUAÇÃO</b></td>
                                <?php $soma_media_avaliado = $soma_media_avaliado+($grupo_respostas_avaliado/$grupo_perguntas); ?>
                                <?php $soma_media_avaliador = $soma_media_avaliador+($grupo_respostas_avaliador/$grupo_perguntas); ?>
                                <td style="text-align: center"><?php echo number_format(($grupo_respostas_avaliado/$grupo_perguntas),2);?></td>
                                <td style="text-align: center"><?php echo number_format(($grupo_respostas_avaliador/$grupo_perguntas),2);?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<table class="table table-bordered">
    <tr style="background-color: lightgrey ">
        <td class="col-md-8" style="text-align: center">MÉDIA COMPETÊNCIAS TÉCNICAS</td>
        <?php $competencia_geral_avaliado= $competencia_geral_avaliado+($soma_media_avaliado/$qtd_grupos)?>
        <?php $competencia_geral_avaliador= $competencia_geral_avaliador+($soma_media_avaliador/$qtd_grupos)?>
        <td class="col-md-2" style="text-align: center"><?php echo number_format(($soma_media_avaliado/$qtd_grupos),2)?></td>
        <td class="col-md-2" style="text-align: center"><?php echo number_format(($soma_media_avaliador/$qtd_grupos),2)?></td>
    </tr>
</table>

<table class="table table-bordered">
    <tr style="background-color: lightgrey ">
        <td class="col-md-8" style="text-align: center">MÉDIA GERAL DAS COMPETÊNCIAS </td>
        <td class="col-md-2" style="text-align: center"><?php echo number_format(($competencia_geral_avaliado/3),2)?></td>
        <td class="col-md-2" style="text-align: center"><?php echo number_format(($competencia_geral_avaliador/3),2)?></td>
    </tr>
</table>

<div class="panel panel-default">

    <div class="panel-heading text-center"  style="background-color: mediumseagreen; color: #ffffff">FATORES DE DESEMPENHO</div>
    <table class="table">
        <tr style="background-color: #f5f5f5">
            <td class="text-center" colspan="2"  style="background-color: lightgrey"> Para avaliar os Fatores de Desempenho utilize as seguintes graduações:</td>
        </tr>
        <tr>
            <td class="col-md-1">GRAU 1:</td>
            <td><b>Raramente</b> cumpre com o que é estabelecido no fator desempenho.</td>
        </tr>
        <tr>
            <td>GRAU 2:</td>
            <td><b>Eventualmente</b> cumpre com o que é estabelecido no fator desempenho.</td>
        </tr>
        <tr>
            <td>GRAU 3:</td>
            <td>Cumpre <b>regurlamente</b> com o que é estabelecido no fator desempenho.</td>
        </tr>
        <tr>
            <td>GRAU 4:</td>
            <td>Cumpre <b>acima do esperado</b> com o que é estabelecido no fator desempenho.</td>
        </tr>
    </table>
    <!-- Table -->
</div>
<br>
<?php if($grupos == 0)?>
<?php $qtd_grupos = 0; ?>
<?php $soma_media_avaliado = 0; ?>
<?php $soma_media_avaliador = 0; ?>
<?php foreach ($grupos as $grupo):?>
    <?php foreach ($gruponome as $groupname):?>
        <?php if($groupname['Grupo']['id']==$grupo): ?>
            <?php if($groupname['Grupo']['competencia_id']==19):?>
                <?php $qtd_grupos = $qtd_grupos+1; ?>
                <?php $grupo_perguntas = 0; ?>
                <?php $grupo_respostas_avaliado = 0; ?>
                <?php $grupo_respostas_avaliador = 0; ?>
                <div class="panel panel-default">
                    <br>
                    <div class="panel-body">
                        <div class="col-md-2 text-center"> <?php echo $groupname['Grupo']['ordem'].".".$groupname['Grupo']['nome'] ?></div>
                        <div class="col-md-10"><?php echo $groupname['Grupo']['observacao']?></div>
                        <br><br><br>
                        <table class="table table-bordered">
                            <tr style="background-color: lightgrey ">
                                <td class="col-md-8" style="text-align: center">INDICADORES</td>
                                <td class="col-md-2" style="text-align: center">AUTO-AVALIAÇÃO</td>
                                <td class="col-md-2" style="text-align: center">AVALIADOR</td>
                            </tr>
                            <?php foreach ($perguntas as $i=>$pergunta): ?>
                                <?php if ($pergunta['Grupo']['id'] == $grupo): ?>
                                    <tr>
                                        <td><?php echo$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao'])?></td>
                                        <?php foreach ($ava["UsuarioResposta"] as $resposta): ?>
                                            <?php if ($pergunta['Pergunta']['id'] == $resposta["pergunta_id"]): ?>
                                                <?php $grupo_perguntas = $grupo_perguntas+1; ?>
                                                <?php $grupo_respostas_avaliado = $grupo_respostas_avaliado+$resposta["resposta_avaliado_id"]; ?>
                                                <?php $grupo_respostas_avaliador = $grupo_respostas_avaliador+$resposta["resposta_avaliador_id"]; ?>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliado_id"]?></td>
                                                <td style="text-align: center"><?php echo $resposta["resposta_avaliador_id"]?></td>
                                                <?php if($resposta["resposta_avaliador_id"]<=2):?>
                                                    <?php $pontos_fracos = $pontos_fracos."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>
                                                <?php if($resposta["resposta_avaliador_id"]>=3):?>
                                                    <?php $pontos_fortes = $pontos_fortes."".$groupname['Grupo']['ordem'].".".($pergunta['Pergunta']['ordem'].'.'.$pergunta['Pergunta']['descricao']) ?>
                                                <?php endif ?>

                                            <?php endif ?>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <tr>
                                <td style="text-align: right"><b>PONTUAÇÃO</b></td>
                                <?php $soma_media_avaliado = $soma_media_avaliado+($grupo_respostas_avaliado/$grupo_perguntas); ?>
                                <?php $soma_media_avaliador = $soma_media_avaliador+($grupo_respostas_avaliador/$grupo_perguntas); ?>
                                <td style="text-align: center"><?php echo ($grupo_respostas_avaliado/$grupo_perguntas);?></td>
                                <td style="text-align: center"><?php echo ($grupo_respostas_avaliador/$grupo_perguntas);?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach; ?>
<?php endforeach; ?>
<table class="table table-bordered">
    <tr style="background-color: lightgrey ">
        <td class="col-md-8" style="text-align: center">MÉDIA GERAL DOS FATORES DE DESEMPENHO</td>
        <td class="col-md-2" style="text-align: center"><?php echo ($soma_media_avaliado/$qtd_grupos)?></td>
        <td class="col-md-2" style="text-align: center"><?php echo ($soma_media_avaliador/$qtd_grupos)?></td>
    </tr>
</table>
<table class="table table-bordered">
    <tr style="background-color: lightgrey ">
        <td class="col-md-8" style="text-align: center">CLASSIFICAÇÃO FINAL</td>
        <td class="col-md-2" style="text-align: center"><?php echo "C".intval(($competencia_geral_avaliado/3))."F".intval(($soma_media_avaliado/$qtd_grupos))?></td>
        <td class="col-md-2" style="text-align: center"><?php echo "C".intval(($competencia_geral_avaliador/3))."F".intval(($soma_media_avaliador/$qtd_grupos))?></td>
    </tr>
</table>
<table class="table table-bordered">
    <tr>
        <td><b>PONTOS FORTES:</b><br> <?php echo $pontos_fortes?></td>
    </tr>
    <tr>
        <td><b>PONTOS FRACOS:</b><br><?php echo $pontos_fracos?></td>
    </tr>
    <tr>
        <td><b>COMENTÁRIOS DO AVALIADOR(JUSTIFIQUE OS INDICADORES APONTADOS COM GRAUS 1 E 2):</b><br><?php echo $ava['UsuarioAvaliacao']['comentario_avaliador']?></td>
    </tr>
    <tr>
        <td><b>COMENTÁRIOS DO AVALIADO:</b> <br><?php echo $ava['UsuarioAvaliacao']['comentario_avaliado']?></td>
    </tr>
    <tr>
        <td><b>DATA E ASSINATURA DO AVALIADO:</b><br></td>
    </tr>
    <tr>
        <td><b>DATA E ASSINATURA DO AVALIADOR:</b><br></td>
    </tr>
    <tr>
        <td><b>DATA E ASSINATURA DO CHEFE IMEDIATO- VALIDAÇÃO:</b><br></td>
    </tr>
</table>

<?php debug($ava);?>