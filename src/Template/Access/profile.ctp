<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\WarehouseSetting $user
 */
?>

<section class="content-header">
    <h1>
        Usuario
        <small>Modificar Perfil</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Usuario</a></li>
        <li class="active">Modificar Perfil</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary no-margin-bottom">
                <?= $this->Form->create($user, ['id' => 'user']) ?>
                <div class="box-header with-border">
                    <h4 class="modal-title">Modificar Perfil</h4>
                </div>
                <div class="box-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#navUserProfile">Datos Personales</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="navUserProfile" class="tab-pane fade in active">
                            <?php
                            echo $this->Form->input('document', ['label' => 'Documento']);
                            echo $this->Form->input('firstname', ['label' => 'Nombre']);
                            echo $this->Form->input('lastname', ['label' => 'Apellidos']);
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('address', ['label' => 'Dirección']); ?>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('email', ['label' => 'Correo electrónico']); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('mobile', ['label' => 'Teléfono Móvil']); ?>
                                </div>
                                <div class="col-md-6">
                                    <?php echo $this->Form->input('phone', ['label' => 'Teléfono']); ?>
                                </div>
                            </div>
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
        $("#user").validate({
            rules: {
                firstname: {
                    required: true,
                    maxlength: 60,
                    latinLetters: true
                },
                lastname: {
                    required: true,
                    maxlength: 30,
                    latinLetters: true
                },
                document: {
                    required: true,
                    numbersLatinLetters: true
                },
                username: {
                    required: true,
                    maxlength: 30
                }
            }
        });
    });
</script>
<?php $this->end(); ?>
