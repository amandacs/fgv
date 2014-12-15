<?php
$cakeDescription = __d('cake_dev', 'Login');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>: fgv-avaliação

    </title>
    <link rel="stylesheet" type="text/css" href="/fgv/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/fgv/css/standard.css">
    <link rel="stylesheet" type="text/css" href="/fgv/css/font-awesome.min.css">
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('cake.generic');
    echo $this->Html->css('bootstrap-theme.min');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('standard');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('forms');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
</head>
<body style="background-color: #f5f5f5">
<div id="container">
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
</div>
<div id="footer">
    <div class="container">
        <div class="muted credit pull-left">© <?php echo date('Y') ?> - Secretaria Extraordinária de Inclusão Digital.</div>
        <div class="muted credit pull-right">
            Prefeitura Municipal de Boa Vista
        </div>
    </div>
</div>
<?php
echo $this->Html->script('jquery');
echo $this->fetch('script');
?>
</body>
</html>
