<div class="col-md-8">
    <div class="grupos form">
        <?php echo $this->Form->create('Grupo', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        )); ?>
        <fieldset>
            <legend>Editar Grupo</legend>
            <?php echo $this->Form->input('id'); ?>
            <?php echo $this->Session->flash(); ?>

            <div class="form-group">
                <label class="required">Nome:</label>
                <?php echo $this->Form->input('nome', array('class' => 'form-control uppercase big', 'required' => true, 'autofocus')); ?>
            </div>
            <div class="form-group">
                <label>Definição:</label>
                <?php echo $this->Form->input('observacao', array('class' => 'form-control'));?>
            </div>
            <div class="form-group"  style="float: left">
                <label>Nova competencia:</label>
                <?php echo $this->Form->input('nova_competencia', array('class' => 'form-control check', 'type' => 'checkbox'));?>
            </div>
            <div id="grupo_id">
                <div class="form-group">
                    <label>Competência:</label>
                    <?php echo $this->Form->input('competencia_id', array('class' => 'form-control', 'empty' => 'Selecione uma competência para este grupo...')); ?>
                </div>
                <label style="margin: 20px 0 10px 0">Classes:</label>
                <div id="perg_box">
                    <?php foreach($classes as $id => $classe): ?>
                        <?php $checked = '' ;?>
                        <?php if(in_array($id, $this->App->arrayFromDB($this->request->data['Grupo']['classe_array']))){
                            $checked = 'checked';
                        }?>
                        <label class="perg_label"><?php echo $this->Form->checkbox('classe_array', array('hiddenField' => false,'id'=>'GrupoClasseArray'.$id, 'name'=>'data[Grupo][classe_array][]',
                                'label'=>'GrupoClasseArray'.$id, 'value'=>$id, $checked));?><?php echo' '.$classe;?></label>
                    <?php endforeach; ?>
                </div>
                <label style="margin: 20px 0 10px 0">Funções:</label>
                <div>
                    <?php echo $this->Form->input('funcao_id', array('class' => 'form-control', 'empty' => 'Selecione a função relacionanda a este grupo...'));?>
                </div>
            </div>
        </fieldset>
        <p class="pull-left" style="margin-top:30px">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<?php $this->start('script'); ?>
<script>
    $(document).ready(function(){
        $("#GrupoNovaCompetencia").click(function(){
            console.log($(this).is(':checked'));
            if ($(this).is(':checked')){
                $(this).val(1);
                $("#grupo_id").css("display", "none");
            }else{
                $(this).val(0);
                $("#grupo_id").css("display", "block");
            }
        });
    });
</script>
<?php $this->end(); ?>