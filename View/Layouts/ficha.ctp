<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title', 'Avaliação Profissional'); ?>
    </title>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <link href="/fgv_testes/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <!--<link rel="stylesheet" type="text/css" href="/fgv_testes/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/fgv_testes/css/standard.css">
    <link rel="stylesheet" type="text/css" href="/fgv_testes/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/fgv_testes/css/jquery-ui.css">-->
    <?php
    echo $this->fetch('meta');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('standard');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('jquery-ui');
    echo $this->fetch('css');
    ?>
</head>
<body>
<div id="wrap">
    <div class="container content">
        <?php echo $this->fetch('content'); ?>
    </div>
    <div id="push"></div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 85%">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
echo $this->Html->script('jquery');
echo $this->Html->script('bootstrap');
echo $this->Html->script('jquery.mask');
echo $this->Html->script('jquery.mask.min');
echo $this->Html->script('jquery-ui');
echo $this->Html->script('jquery-ui.min');
echo $this->Html->script('default');
echo $this->Html->script('oculta_mensagens_de_erro');
echo $this->Html->script('chart');
echo $this->fetch('script');
?>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>

