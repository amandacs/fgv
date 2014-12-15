<div id="content_signin">
    <div class="form-signin">
        <div class="signin-top"></div>
        <div class="signin-inputs">
            <?php echo $this->Form->create('Usuario', array('url'=>array('action'=>'login'))); ?>
            <section class="user-box">
                <?php echo $this->Html->image('pmbv.png') ?>
                <p>FGV - AVALIAÇÃO PROFISSIONAL</p>
            </section>
            <section class="input-box">
                <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                    <input class="form-control" type="text" placeholder="Nome de usuário" autofocus="" name="data[Usuario][username]">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                    <input class="form-control" type="password" placeholder="Senha" name="data[Usuario][password]">
                </div>
            </section>
            <?php echo $this->Form->button('<b>'.__('Enter').'</b>', array('type'=>'submit', 'class'=>'btn btn-primary btn-lg btn-block', 'id'=>'enter_login')); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

