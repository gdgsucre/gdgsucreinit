<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WarehouseSetting $setting
 */
?>

<section class="content-header">
    <h1>
        Usuario
        <small>Modificar Contrase&ntilde;a</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Usuario</a></li>
        <li class="active">Modificar Contrase&ntilde;a</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary no-margin-bottom">
                <?= $this->Form->create($user, ['id' => 'user']) ?>
                <div class="box-header with-border">
                    <h4 class="modal-title">Modificar Modificar Contrase&ntilde;a</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('password_current', array('label' => 'Contraseña Actual', 'type' => 'password', 'minlength' => '6'));
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('password_new', array('label' => 'Nueva Contraseña', 'type' => 'password', 'minlength' => '6'));
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('password_confirm', array('label' => 'Confirmar Contraseña', 'type' => 'password', 'minlength' => '6'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer with-border">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</section>
<?php $this->start('scriptBottom'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#setting").validate({
            rules: {
                password_current: {
                    required: true
                },
                password_new: {
                    required: true
                },
                password_confirm: {
                    required: true
                }
            }
        });
    });
</script>
<?php $this->end(); ?>
