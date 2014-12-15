<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
    <h3 class="text-center"><?=$modal_title;?></h3>
</div>
<div class="modal-body">
    <?php echo $this->fetch('content');?>
</div>
<?php

echo $this->Html->script('_main');
echo $this->fetch('script');
?>
<?php /*echo $this->element('sql_dump'); */?>