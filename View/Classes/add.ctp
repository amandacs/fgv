<div class="col-md-8">
    <div class="classes form">
        <?php
        echo $this->Form->create('Classe', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            )
        ));
        ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>

            <legend>Adicionar Classe</legend>

            <div class="form-group">
                <label class="required">Nome:</label>
                <?php echo $this->Form->input('nome', array('type' => 'text', 'class' => 'form-control uppercase max', 'required' => true, 'autofocus')); ?>
            </div>
            <div class="form-group"  style="float: left">
                <label>Nova Classe Pai:</label>
                <?php echo $this->Form->input('classe_pai', array('class' => 'form-control', 'style'=>'width: 25%', 'type' => 'checkbox', 'value' => 0));?>
            </div>
            <div id="classe_id">
                <div class="form-group">
                    <label>Classe Pai:</label>
                    <?php echo $this->Form->input('parent_id', array('class' => 'form-control', 'empty' => 'Selecione uma competência para este grupo...'));?>
                </div>
                <div class="form-group">
                    <label class="required">Cargo:</label>
                    <?php echo $this->Form->input('cargo_id', array('class' => 'form-control', 'empty'=>'Selecione o cargo da classe acima...')); ?>
                </div>
            </div>
        </fieldset>

        <p class="pull-left">
            <?php echo $this->Form->button('Salvar', array('type' => 'submit', 'class' => 'btn btn-success')); ?>
            <?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn btn-danger')); ?>
        </p>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<?php $this->start('script'); ?>
<script>
    $(document).ready(function(){
        $("#ClasseClassePai").click(function(){
            console.log($(this).is(':checked'));
            if ($(this).is(':checked')){
                $(this).val(1);
                $("#classe_id").css("display", "none");
            }else{
                $(this).val(0);
                $("#classe_id").css("display", "block");
            }
        });
    });
</script>
<?php $this->end(); ?>