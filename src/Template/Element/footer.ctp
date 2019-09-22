<?php
use Cake\Core\Configure;
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b><?php echo Configure::read('Application.alias'); ?> </b> v<?php echo Configure::read('Application.version'); ?>
    </div>
    <strong>Copyright &copy; 2019 <a href="http://www.rootcode.com.bo">Servicios Informáticos #RootCode</a>.</strong> Todos los derechos reservados.
</footer>
<?php
echo $this->Html->script('jquery.validate.min', ['block' => 'script']);
echo $this->Html->script('additional-methods.min', ['block' => 'script']);
echo $this->Html->script('messages_es.min', ['block' => 'script']);
$this->Html->script([
    'jqgrid/i18n/grid.locale-es',
    'jqgrid/jquery.jqGrid.min',
    'jqgrid/jquery.jqGrid.formatters',
    // 'bootstrap-datepicker',
    // 'bootstrap3-typeahead',
    'AdminLTE./plugins/datepicker/bootstrap-datepicker',
    'AdminLTE./plugins/datepicker/locales/bootstrap-datepicker.es',
    'AdminLTE./plugins/select2/select2.min',
    'AdminLTE./plugins/iCheck/icheck.min',
    'custom',
    'validator'
],
['block' => 'script']);

echo $this->Html->css([
    'jqgrid/ui.jqgrid-bootstrap',
    'jqgrid/ui.jqgrid-custom',
    'AdminLTE./plugins/datepicker/datepicker3',
    'AdminLTE./plugins/iCheck/all',
    //'bootstrap-datepicker',
    'AdminLTE./plugins/select2/select2.min',
    'custom'
],
['inline' => false]);
?>
