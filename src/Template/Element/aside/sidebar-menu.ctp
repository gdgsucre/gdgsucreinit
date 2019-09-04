<?php

use App\Utils\Constants;
?>
<ul class="sidebar-menu">
    <li class="header">MENÚ PRINCIPAL</li>
    <li>
        <a href="<?php echo $this->Url->build('/'); ?>">
            <i class="fa fa-home"></i> <span>Inicio</span>
        </a>
    </li>
    <?php if ($auth->user('role_id') == 1) { ?>
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'participants', 'action' => 'index']); ?>">
            <i class="fa fa-users"></i> <span>Participantes</span>
        </a>
    </li>
    <?php } ?>
    <?php if ($auth->user('role_id') == 1) { ?>
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'index']); ?>">
            <i class="fa fa-users"></i> <span>Usuarios</span>
        </a>
    </li>
    <?php } ?>
</ul>
