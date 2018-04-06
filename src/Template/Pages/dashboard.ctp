<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $participantsCount; ?></h3>
                    <p>Participantes Registrados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-address-card"></i>
                </div>
                <a href="<?php echo $this->Url->build(['controller' => 'participants', 'action' => 'index']); ?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
<?php
$this->Html->css([
    'AdminLTE./plugins/iCheck/flat/blue',
    'AdminLTE./plugins/morris/morris',
    'AdminLTE./plugins/jvectormap/jquery-jvectormap-1.2.2',
    'AdminLTE./plugins/datepicker/datepicker3',
    'AdminLTE./plugins/daterangepicker/daterangepicker',
    'AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'
],
['block' => 'css']);
?>
