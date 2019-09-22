<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tipos de Participantes
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <a class="btn btn-sm btn-success" data-toggle="modal" id="btnAddType"><i class="fa fa-plus-circle"></i> Nuevo</a>
          <a class="btn btn-sm btn-warning" data-toggle="modal" id="btnEditType"><i class="fa fa-edit"></i> Modificar</a>
          <a class="btn btn-sm btn-danger" data-toggle="modal" id="btnDeleteType"><i class="fa fa-trash"></i> Eliminar</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table id="jqgTypes"></table>
              <div id="jqgTypesPager"></div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>

<div class="modal fade" id="modalTypes" role="dialog" data-backdrop="static" data-keyboard="false"></div>

<?=
  $this->Html->scriptStart(['block' => true]);
?>
var urlListTypes = "<?= $this->Url->build(['controller' => 'types', 'action' => 'data']); ?>";
var urlAddType = "<?= $this->Url->build(['controller' => 'types', 'action' => 'add']); ?>";
var urlEditType = "<?= $this->Url->build(['controller' => 'types', 'action' => 'edit']); ?>";
var urlDeleteType = "<?= $this->Url->build(['controller' => 'types', 'action' => 'delete']); ?>";
var enabledOptions = '<?= $enabled ?>';
<?= $this->Html->scriptEnd(); ?>
<?php
$this->Html->script(
  [
    'types/index',
  ],
  ['block' => 'scriptBottom']
);
?>