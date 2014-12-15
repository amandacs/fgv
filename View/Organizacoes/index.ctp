<div class="organizacoes main index col-sm-12">
    <fieldset>
        <legend>Organizações</legend>

        <div class="row">
            <div class="col-sm-8">
                <?php echo $this->Form->create('Organizacao',array('action'=>'index', 'class'=>'form-horizontal', 'inputDefaults'=>array('label'=>false, 'div'=>false)));?>
              <!--  <div class="input-group">
                    <?php /*echo $this->Form->select('orgao_id', $orgaos,
                        array('class'=>'form-control', 'required' => 'required')
                    );*/?>
                    <span class="input-group-btn">
                        <?php /*echo $this->Form->button('Filtrar',
                            array('type'=>'submit', 'class'=>'btn btn-default loader')
                        );*/?>
                    </span>
                </div>--><!-- /input-group -->
                <?php echo $this->Form->end();?>
            </div>
            <div class="col-sm-4">
                <?php echo $this->Html->link('<i class="fa fa-plus"></i> Nova Organização',
                    array('action' => 'add', 1),
                    array('class'=>'btn btn-default','escape'=>false)
                );?>
            </div>
        </div>
        <div style="margin-top: 20px">
            <div id="breadCrumbHolder" class="breadCrumbHolder module col-sm-12" style="margin-left: 5px">

            </div>
            <div id="treeOrganizacoes" class="tree col-sm-5" data-action="add" data-setor="<?php echo $this->Session->read('Auth.User.organizacao_id');?>">

            </div>
            <?php echo $this->Form->hidden('tree-source',
                array(
                    'id' => 'tree-source',
                    'data-sources' => $arrayOrganizacaoDestino,
                    'data-id_root' => $id_root,
                    'data-label_root' => $label_root,
                    'data-node_id' => 0)
            );?>
            <div id="organizacao_destino_id" class="col-sm-6">

            </div>
        </div>
    </fieldset>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript" src="/fgv/js/jquery.rcrumbs.min.js?version=1.0.2"></script>
<script type="text/javascript" src="/fgv/js/tree.jquery.js?version=1.6.3"></script>
<?php echo $this->Html->script('organizacoes'); ?>
<?php $this->end(); ?>
