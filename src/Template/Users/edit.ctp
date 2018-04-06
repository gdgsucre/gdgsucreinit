<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

 // if ($this->request->is(['post'])) {
 //     echo json_encode($data);
 // } else {
?>
<div id="formEditUser" class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <?= $this->Form->create($user, ['id' => 'user']) ?>
        <div class="modal-header">
            <button type="button" class="close" onclick="$('#modalUsers').modal('hide')">×</button>
            <h4 class="modal-title">Modificar Usuario</h4>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#navUserProfile">Datos Personales</a></li>
                <li><a data-toggle="tab" href="#navUserLogin">Datos de Usuario</a></li>
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
                <div id="navUserLogin" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->input('username', ['label' => 'Usuario']); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('password_current', array('label' => 'Contraseña Actual', 'type' => 'password', 'minlength' => '6')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $this->Form->input('password_new', array('label' => 'Nueva Contraseña', 'type' => 'password', 'minlength' => '6')); ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $this->Form->input('password_confirm', array('label' => 'Confirmar Contraseña', 'type' => 'password', 'minlength' => '6')); ?>
                        </div>
                    </div>
                    <?php echo $this->Form->input('role_id', ['label' => 'Rol', 'empty' => '- Seleccione -', 'options' => $roles, 'class' => 'form-control select2', 'style' => 'width: 100%']); ?>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="status" class="icheck" value="A" <?php echo ($user->status == 'A') ? 'checked' : ''; ?>> Activo
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
            <button type="button" class="btn btn-danger" onclick="$('#modalUsers').modal('hide')"><i class="fa fa-times"></i> Cancelar</button>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#formEditUser form').submit(function (e) {
            if ($("#user").valid()) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $this->Url->build(); ?>',
                    data: $('#formEditUser form').serialize(),
                    success: function (response)
                    {
                        if (response.error == 0) {
                            $('#modalUsers').modal('hide');
                            $('#jqgUsers').trigger('reloadGrid');
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
            e.preventDefault();
        });

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
                email: {
                    required: true,
                    uniqueEmail: true
                },
                username: {
                    required: true,
                    maxlength: 30
                },
                password_current: {
                    required: true,
                    minlength: 6
                },
                password_new: {
                    required: true,
                    minlength: 6
                },
                password_confirm: {
                    required: true,
                    minlength: 6
                }
            }
        });

        $('input[type="checkbox"].icheck, input[type="radio"].icheck').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        var responseEmail = true;
        $.validator.addMethod('uniqueEmail', function (value, element) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Url->build(['controller' => 'users', 'action' => 'validateEmail']); ?>',
                data: "email=" + value + '&email_current=<?php echo $user->email; ?>',
                dataType: 'json',
                success: function (data)
                {
                    responseEmail = (data.result == 'true') ? true : false;
                }
            });
            return responseEmail;
        }, "El Correo Electrónico ya existe");
    });
</script>
<?php //} ?>
