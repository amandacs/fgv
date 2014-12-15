<div  style="background: #fff; z-index: 1;   display: inline-block; text-align: center;">

    <div style="width: 100%;">
        <?php echo $this->Form->create('Usuario', array('action'=>'index', 'type'=>'GET'));?>
        <div class="input-group" style="margin: 30px 50px 0px 0px">

            <input autofocus="autofocus" name="q" type="text" class="form-control input-lg uppercase search" required="required" placeholder="Pesquise pela matrícula ou pelo nome..." value="<?=isset($_GET['q'])?$_GET['q']:null;?>">
                    <span class="input-group-btn">
                        <button class="btn btn-primary input-lg" type="submit"><i class="fa fa-search fa-lg fa-2x" style="color: #fff"></i></button>
                    </span>
        </div>
                <span class="help-block">
                    <small style="margin-bottom: 2px">
                        O resultado da sua pesquisa será exibido abaixo!
                    </small>
                </span>
        <?php echo $this->Form->end(); ?>
    </div>

</div>