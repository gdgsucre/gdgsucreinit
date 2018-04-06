<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <i class="fa fa-bars"></i>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $this->Html->image('user-160x160.jpg', array('class' => 'user-image', 'alt' => 'Imagen de Usuario')); ?>
                    <span class="hidden-xs"><?php echo $this->request->session()->read('Auth.User.name'); ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <?php echo $this->Html->image('user-160x160.jpg', array('class' => 'img-circle', 'alt' => 'Imagen de Usuario')); ?>
                        <p>
                            <?php echo $this->request->session()->read('Auth.User.name'); ?>
                            <small><?php echo $this->request->session()->read('Auth.Role.name'); ?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="<?php echo $this->Url->build(['controller' => 'access', 'action' => 'logout']) ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-cogs"></i></a>
            </li>
        </ul>
    </div>
</nav>
