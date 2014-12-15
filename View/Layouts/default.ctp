<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title', 'Avaliação Profissional'); ?>
    </title>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <link href="/fgv/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/fgv/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/fgv/css/standard.css">
    <link rel="stylesheet" type="text/css" href="/fgv/css/font-awesome.min.css">
    <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
    ?>
</head>
<body>
    <?php echo $this->element('menu');?>
    <div id="wrap">
        <div class="container content">
            <?php echo $this->fetch('content'); ?>
        </div>
        <div id="push"></div>
    </div>
    <div id="footer">
            <div class="text-muted pull-left">© <?php echo date('Y') ?> - Secretaria Extraordinária de Inclusão Digital.</div>
            <div class="text-muted pull-right">Prefeitura Municipal de Boa Vista</div>
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
echo $this->Html->script('_main');
echo $this->Html->script('jquery.mask');
echo $this->Html->script('jquery.mask.min');
echo $this->Html->script('_main');
echo $this->Html->script('oculta_mensagens_de_erro');
echo $this->fetch('script');
?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>

