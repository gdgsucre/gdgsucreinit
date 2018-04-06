<?= $this->Form->create() ?>
<?php echo $this->Form->input('username', ['required' => true, 'autofocus' => true, 'label' => 'Nombre de Usuario']); ?>
<?php echo $this->Form->input('password', ['required' => true, 'label' => 'Contraseña']) ?>
<?php echo $this->Form->button('<i class="fa fa-sign-in-alt"></i> Ingresar', ['class' => 'btn btn-success btn-block']); ?>
<?= $this->Form->end() ?>
