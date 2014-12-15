<?php $controller = $this->params['controller'] ?>
<?php $action = $this->params['action'] ?>
<?php $action_controller = $this->params['controller'] . '-' . $this->params['action'] ?>
<?php
$controllers = array('grupos', 'perguntas', 'graus', 'perguntas','avaliacoes', 'usuarios')
?>

<div class="navbar navbar-default navbar-fixed-top">
    <div id="wrap">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">
                    <?php echo $this->Html->image('pmbv_menu.png', array('alt' => 'PMBV', 'style' => 'margin-top: -15px; margin-bottom:-15px', 'width' => '46', 'height' => '46')); ?>
                </a>
            </div>
            <?php if($this->Session->read('Auth.User.perfil_id') <= 1): ?>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="<?php echo $action_controller == 'usuarios-index' || $action_controller == 'usuarios-search' ? 'active' : '' ?>">
                        <?php
                            echo $this->Html->link('<i class="fa fa-search menu"></i> Pesquisar', array('action' => 'index', 'controller' => 'usuarios'), array('escape' => false));
                        ?>
                    </li>
                    <li class="<?php echo $action_controller == 'usuarios-add' ? 'active' : '' ?>">
                        <?php echo $this->Html->link('<i class="fa fa-plus menu"></i> Cadastrar Usuario', array('action' => 'add', 'controller' => 'usuarios'), array('escape' => false));
                        ?>
                    </li>
                    <li class="dropdown menu<?php echo in_array($controller, $controllers) ? 'active' : '' ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Configurações <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">SOCIOECONÔMICO</li>
                            <li class="<?php echo $action_controller == 'grupos-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Grupo de Competências', array('action' => 'index', 'controller' => 'grupos')); ?>
                            </li>
                            <li class="<?php echo $action_controller == 'perguntas-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Indicadores', array('action' => 'index', 'controller' => 'perguntas')); ?>
                            </li>
                            <li class="<?php echo $action_controller == 'graus-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Graus', array('action' => 'index', 'controller' => 'graus')); ?>
                            </li>
                            <!--<li class="<?php /*echo $action_controller == 'formularios-index' ? 'active' : '' */?>">
                                <?php /*echo $this->Html->link('Formulários', array('action' => 'index', 'controller' => 'respostas')); */?>
                            </li>-->
                            <li class="<?php echo $action_controller == 'avaliacoes-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Avaliações', array('action' => 'index', 'controller' => 'avaliacoes')); ?>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-header">DADOS DA INSTITUIÇÃO</li>
                            <li class="<?php echo $action_controller == 'cargos-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Cargos', array('action' => 'index', 'controller' => 'cargos')); ?>
                            </li>
                            <li class="<?php echo $action_controller == 'funcoes-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Funções', array('action' => 'index', 'controller' => 'funcoes')); ?>
                            </li>
                            <li class="<?php echo $action_controller == 'classes-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Classes', array('action' => 'index', 'controller' => 'classes')); ?>
                            </li>
                            <li class="<?php echo $action_controller == 'organizacao-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Organizações', array('action' => 'index', 'controller' => 'organizacoes')); ?>
                            </li>
                            <li class="divider"></li>
                            <li class="dropdown-header">USUÁRIOS</li>
                            <li class="<?php echo $action_controller == 'perfis-index' ? 'active' : '' ?>">
                                <?php echo $this->Html->link('Perfis', array('action' => 'index', 'controller' => 'perfis')); ?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Usuários', array('controller' => 'usuarios', 'action' => 'index')); ?>
                            </li>
                            <!--<li>
                                <?php /*echo $this->Html->link('Perfis', array('action' => 'index', 'controller' => 'perfis')); */?>
                            </li>-->
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <div id="loggedin" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Olá, ').$this->Session->read('Auth.User.username'); ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <?php
                                    echo $this->Html->link('Meus Dados', array('action' => 'meusDados', 'controller' => "usuarios", $this->Session->read('Auth.User.id')), array('href' => '#'))
                                    ?>
                                </li>
                                <li>
                                    <?php
                                    echo $this->Html->link('Sair', array('action' => 'logout', 'controller' => "usuarios"), array('href' => '#'))
                                    ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>